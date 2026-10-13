<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RekamMedisController extends Controller
{
    private function ensureCanView(): void
    {
        abort_unless(
            auth()->check() && in_array(auth()->user()->role, ['admin', 'dokter'], true),
            403,
            'Anda tidak memiliki akses ke rekam medis.'
        );
    }

    private function ensureDoctor(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'dokter',
            403,
            'Hanya dokter yang dapat memeriksa pasien dan mengisi rekam medis.'
        );
    }

    public function index(Request $request)
    {
        $this->ensureCanView();

        $user = auth()->user();
        $search = trim((string) $request->get('search', ''));
        $normalizedRm = preg_replace('/[^A-Za-z0-9]/', '', $search);

        $historyMedis = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])
            ->when($user->role === 'dokter', fn ($query) => $query->where('dokter_id', $user->id))
            ->when($search !== '', function ($query) use ($search, $normalizedRm) {
                $query->where(function ($q) use ($search, $normalizedRm) {
                    $q->whereHas('pasien', function ($pasien) use ($search, $normalizedRm) {
                        $pasien->where('nama', 'like', "%{$search}%")
                            ->orWhere('nik', 'like', "%{$search}%")
                            ->orWhere('no_rm', 'like', "%{$search}%");

                        if ($normalizedRm !== '') {
                            $pasien->orWhereRaw("REPLACE(REPLACE(no_rm, '-', ''), ' ', '') LIKE ?", ["%{$normalizedRm}%"]);
                        }
                    })
                    ->orWhere('diagnosa', 'like', "%{$search}%")
                    ->orWhere('keluhan_utama', 'like', "%{$search}%")
                    ->orWhere('resep_obat', 'like', "%{$search}%")
                    ->orWhereHas('dokter', fn ($dokter) => $dokter->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->take(100)
            ->get();

        return view('rekam_medis.index', compact('historyMedis', 'search'));
    }

    public function panggilPasien($pendaftaran_id)
    {
        $this->ensureDoctor();

        try {
            $pendaftaran = Pendaftaran::with('pasien')->findOrFail($pendaftaran_id);

            abort_unless($pendaftaran->dokter_id === auth()->id(), 403, 'Pasien ini bukan antrean Anda.');
            abort_unless(in_array($pendaftaran->status, ['menunggu', 'diperiksa'], true), 422, 'Status pasien sudah tidak dapat diperiksa.');

            $pendaftaran->update(['status' => 'diperiksa']);

            return redirect()->route('rekam-medis.create', $pendaftaran->id)
                ->with('success', 'Pasien ' . ($pendaftaran->pasien->nama ?? '') . ' berhasil dipanggil!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memanggil pasien: ' . $e->getMessage());
        }
    }

    public function create($pendaftaran_id)
    {
        $this->ensureDoctor();

        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])->findOrFail($pendaftaran_id);

        abort_unless($pendaftaran->dokter_id === auth()->id(), 403, 'Pasien ini bukan antrean Anda.');
        abort_if(RekamMedis::where('pendaftaran_id', $pendaftaran->id)->exists(), 422, 'Rekam medis untuk pendaftaran ini sudah tersimpan.');

        if ($pendaftaran->status === 'menunggu') {
            $pendaftaran->update(['status' => 'diperiksa']);
        }

        abort_unless($pendaftaran->status === 'diperiksa', 422, 'Status pendaftaran tidak dapat diperiksa.');

        return view('rekam_medis.create', compact('pendaftaran'));
    }

    public function store(Request $request)
    {
        $this->ensureDoctor();

        $validated = $request->validate([
            'pendaftaran_id' => ['required', 'exists:pendaftarans,id', 'unique:rekam_medis,pendaftaran_id'],
            'keluhan_utama' => ['required', 'string', 'min:3', 'max:2000'],
            'diagnosa' => ['required', 'string', 'min:2', 'max:2000'],
            'tensi_darah' => ['nullable', 'regex:/^\d{2,3}\/\d{2,3}$/'],
            'suhu_tubuh' => ['nullable', 'numeric', 'between:30,45'],
            'tindakan' => ['nullable', 'string', 'max:2000'],
            'resep_obat' => ['nullable', 'string', 'max:3000'],
        ], [
            'pendaftaran_id.unique' => 'Rekam medis untuk pendaftaran ini sudah pernah disimpan.',
            'keluhan_utama.required' => 'Keluhan utama wajib diisi.',
            'keluhan_utama.min' => 'Keluhan utama minimal 3 karakter.',
            'diagnosa.required' => 'Diagnosa wajib diisi.',
            'diagnosa.min' => 'Diagnosa minimal 2 karakter.',
            'tensi_darah.regex' => 'Tekanan darah harus memakai format seperti 120/80.',
            'suhu_tubuh.numeric' => 'Suhu tubuh harus berupa angka.',
            'suhu_tubuh.between' => 'Suhu tubuh harus berada antara 30 sampai 45 °C.',
            'tindakan.max' => 'Catatan tindakan terlalu panjang.',
            'resep_obat.max' => 'Resep obat terlalu panjang.',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($validated['pendaftaran_id']);
        abort_unless($pendaftaran->dokter_id === auth()->id(), 403, 'Anda tidak dapat mengisi rekam medis pasien dokter lain.');
        abort_unless($pendaftaran->status === 'diperiksa', 422, 'Pasien belum berada pada status pemeriksaan.');

        try {
            $punyaResep = filled(trim((string) ($validated['resep_obat'] ?? '')));

            DB::transaction(function () use ($validated, $pendaftaran, $punyaResep) {
                RekamMedis::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'pasien_id' => $pendaftaran->pasien_id,
                    'dokter_id' => auth()->id(),
                    'keluhan_utama' => trim($validated['keluhan_utama']),
                    'tensi_darah' => $validated['tensi_darah'] ?? null,
                    'suhu_tubuh' => $validated['suhu_tubuh'] ?? null,
                    'diagnosa' => trim($validated['diagnosa']),
                    'tindakan' => isset($validated['tindakan']) ? trim($validated['tindakan']) : null,
                    'resep_obat' => $punyaResep ? trim($validated['resep_obat']) : null,
                ]);

                $pendaftaran->update([
                    'status' => $punyaResep ? 'menunggu_apotek' : 'selesai',
                ]);
            });

            $message = $punyaResep
                ? 'Rekam medis berhasil disimpan. Resep otomatis dikirim ke Farmasi.'
                : 'Rekam medis berhasil disimpan. Pelayanan pasien selesai karena tidak ada resep.';

            return redirect()->route('rekam-medis.index')->with('success', $message);
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan rekam medis: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $this->ensureCanView();

        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])->findOrFail($id);

        if (auth()->user()->role === 'dokter') {
            abort_unless($rekamMedis->dokter_id === auth()->id(), 403, 'Anda tidak dapat melihat rekam medis dokter lain.');
        }

        return view('rekam_medis.show', compact('rekamMedis'));
    }
}
