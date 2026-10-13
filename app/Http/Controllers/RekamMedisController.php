<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    // Menampilkan antrean pemeriksaan dan riwayat rekam medis.
    // Dokter hanya melihat pasien dan riwayat yang menjadi tanggung jawabnya.
    public function index()
    {
        $user = auth()->user();

        $antreans = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->whereIn('status', ['menunggu', 'diperiksa'])
            ->when($user->role === 'dokter', function ($query) use ($user) {
                $query->where('dokter_id', $user->id);
            })
            ->orderBy('id', 'asc')
            ->get();

        $historyMedis = RekamMedis::with(['pasien', 'dokter'])
            ->when($user->role === 'dokter', function ($query) use ($user) {
                $query->where('dokter_id', $user->id);
            })
            ->latest()
            ->get();

        return view('rekam_medis.index', compact('antreans', 'historyMedis'));
    }

    // Form input rekam medis untuk pasien tertentu.
    public function create($pendaftaran_id)
    {
        $user = auth()->user();

        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])->findOrFail($pendaftaran_id);

        if ($user->role === 'dokter' && (int) $pendaftaran->dokter_id !== (int) $user->id) {
            abort(403, 'Pasien ini bukan antrean dokter yang sedang login.');
        }

        if (! in_array($pendaftaran->status, ['menunggu', 'diperiksa'], true)) {
            return redirect()->route('rekam-medis.index')
                ->with('error', 'Pasien ini sudah tidak berada pada tahap pemeriksaan dokter.');
        }

        $pendaftaran->update(['status' => 'diperiksa']);

        return view('rekam_medis.create', compact('pendaftaran'));
    }

    // Simpan data rekam medis dan kirim resep digital ke antrean farmasi.
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'pasien_id'      => 'required|exists:pasiens,id',
            'dokter_id'      => 'required|exists:users,id',
            'keluhan_utama'  => 'required|string',
            'diagnosa'       => 'required|string',
            'tensi_darah'    => 'nullable|string',
            'suhu_tubuh'     => 'nullable|string',
            'tindakan'       => 'nullable|string',
            'resep_obat'     => 'nullable|string',
        ]);

        $user = auth()->user();
        $pendaftaran = Pendaftaran::findOrFail($request->pendaftaran_id);

        if ($user->role === 'dokter' && (int) $pendaftaran->dokter_id !== (int) $user->id) {
            abort(403, 'Anda tidak dapat menyimpan pemeriksaan untuk pasien dokter lain.');
        }

        $dokterId = $user->role === 'dokter' ? $user->id : $request->dokter_id;

        RekamMedis::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'pasien_id'      => $request->pasien_id,
            'dokter_id'      => $dokterId,
            'keluhan_utama'  => $request->keluhan_utama,
            'tensi_darah'    => $request->tensi_darah,
            'suhu_tubuh'     => $request->suhu_tubuh,
            'diagnosa'       => $request->diagnosa,
            'tindakan'       => $request->tindakan,
            'resep_obat'     => $request->resep_obat,
        ]);

        // Sesuai alur dokter -> farmasi: setelah pemeriksaan, resep masuk antrean apotek.
        $pendaftaran->update(['status' => 'menunggu_obat']);

        return redirect()->route('rekam-medis.index')
            ->with('success', 'Pemeriksaan medis berhasil disimpan dan dirujuk ke Apotek!');
    }
}
