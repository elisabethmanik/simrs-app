<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PendaftaranController extends Controller
{
    private function ensureQueueViewer(): void
    {
        abort_unless(
            auth()->check() && in_array(auth()->user()->role, ['admin', 'dokter'], true),
            403,
            'Anda tidak memiliki akses ke antrean pasien.'
        );
    }

    private function ensureAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403,
            'Hanya admin yang dapat mengelola pendaftaran poli.'
        );
    }

    public function index(Request $request)
    {
        $this->ensureQueueViewer();

        $user = auth()->user();
        $search = trim((string) $request->get('search', ''));
        $normalizedRm = preg_replace('/[^A-Za-z0-9]/', '', $search);

        $pendaftarans = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
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
                    ->orWhere('poli', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('dokter', fn ($dokter) => $dokter->where('name', 'like', "%{$search}%"));
                });
            })
            ->orderByRaw("FIELD(status, 'diperiksa', 'menunggu', 'menunggu_apotek', 'menunggu_obat', 'selesai', 'batal')")
            ->orderBy('no_antrean', 'asc')
            ->get();

        return view('pendaftarans.index', compact('pendaftarans', 'search'));
    }

    public function create()
    {
        $this->ensureAdmin();

        $pasiens = Pasien::orderBy('nama')->get();
        $polis = User::where('role', 'dokter')
            ->whereNotNull('poli')
            ->where('poli', '!=', '')
            ->select('poli')
            ->distinct()
            ->orderBy('poli')
            ->pluck('poli');

        return view('pendaftarans.create', compact('pasiens', 'polis'));
    }

    public function getDokterByPoli(string $poli)
    {
        $this->ensureAdmin();

        $poli = trim(urldecode($poli));

        $dokters = User::where('role', 'dokter')
            ->where('poli', $poli)
            ->orderBy('name')
            ->get(['id', 'name', 'poli']);

        return response()->json($dokters);
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'pasien_id' => ['required', 'exists:pasiens,id'],
            'poli' => [
                'required',
                'string',
                'max:255',
                Rule::exists('users', 'poli')->where(fn ($query) => $query->where('role', 'dokter')),
            ],
            'dokter_id' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) use ($request) {
                    $query->where('role', 'dokter')->where('poli', $request->poli);
                }),
            ],
        ], [
            'pasien_id.required' => 'Pasien wajib dipilih.',
            'pasien_id.exists' => 'Data pasien tidak ditemukan.',
            'poli.required' => 'Poli tujuan wajib dipilih.',
            'poli.exists' => 'Poli yang dipilih tidak memiliki dokter aktif.',
            'dokter_id.required' => 'Dokter wajib dipilih.',
            'dokter_id.exists' => 'Dokter tidak valid atau tidak sesuai dengan poli yang dipilih.',
        ]);

        $sudahTerdaftar = Pendaftaran::where('pasien_id', $validated['pasien_id'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->whereIn('status', ['menunggu', 'diperiksa', 'menunggu_apotek', 'menunggu_obat'])
            ->exists();

        if ($sudahTerdaftar) {
            return back()->withErrors([
                'pasien_id' => 'Pasien ini masih memiliki pendaftaran aktif hari ini.',
            ])->withInput();
        }

        $todayCount = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())->count();
        $noAntrean = 'A-' . str_pad($todayCount + 1, 3, '0', STR_PAD_LEFT);

        Pendaftaran::create([
            'pasien_id' => $validated['pasien_id'],
            'dokter_id' => $validated['dokter_id'],
            'poli' => $validated['poli'],
            'no_antrean' => $noAntrean,
            'tanggal_daftar' => now()->toDateString(),
            'jam_daftar' => now()->format('H:i:s'),
            'status' => 'menunggu',
        ]);

        return redirect()->route('pendaftarans.index')->with('success', 'Pasien berhasil didaftarkan ke antrean!');
    }
}
