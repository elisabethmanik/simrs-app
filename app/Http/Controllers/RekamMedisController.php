<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class RekamMedisController extends Controller
{
    /**
     * Menampilkan daftar antrean pemeriksaan & riwayat rekam medis
     */
    public function index()
    {
        $user = auth()->user();

        // 1. Ambil antrean pemeriksaan hari ini (dinamis berdasarkan role)
        $antreans = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->whereIn('status', ['menunggu', 'diperiksa'])
            ->when($user->role === 'dokter', function ($query) use ($user) {
                // Saring antrean khusus untuk dokter yang sedang login
                $query->where(function ($q) use ($user) {
                    $q->where('dokter_id', $user->id)
                      ->orWhere('poli', 'LIKE', '%' . str_ireplace('poli', '', $user->poli) . '%');
                });
            })
            ->orderBy('no_antrean', 'asc')
            ->get();

        // 2. Ambil riwayat rekam medis terbaru
        $historyMedis = RekamMedis::with(['pasien', 'dokter'])
            ->when($user->role === 'dokter', function ($query) use ($user) {
                $query->where('dokter_id', $user->id);
            })
            ->latest()
            ->take(20)
            ->get();

        return view('rekam_medis.index', compact('antreans', 'historyMedis'));
    }

    /**
     * Panggil / ACC Pasien Selanjutnya untuk Diperiksa
     */
    public function panggilPasien($pendaftaran_id)
    {
        try {
            $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
            
            // Ubah status antrean menjadi 'diperiksa'
            $pendaftaran->update([
                'status' => 'diperiksa'
            ]);

            return redirect()->route('rekam-medis.create', $pendaftaran->id)
                ->with('success', 'Pasien ' . ($pendaftaran->pasien->nama ?? '') . ' berhasil dipanggil!');
                
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memanggil pasien: ' . $e->getMessage());
        }
    }

    /**
     * Form input rekam medis untuk pasien tertentu
     */
    public function create($pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])->findOrFail($pendaftaran_id);

        // Otomatis ubah status pendaftaran menjadi 'diperiksa' saat form dibuka
        if ($pendaftaran->status === 'menunggu') {
            $pendaftaran->update(['status' => 'diperiksa']);
        }

        return view('rekam_medis.create', compact('pendaftaran'));
    }

    /**
     * Simpan data rekam medis & alihkan status ke Apotek
     */
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'pasien_id'      => 'required|exists:pasiens,id',
            'dokter_id'      => 'required|exists:users,id',
            'keluhan_utama'  => 'required|string',
            'diagnosa'       => 'required|string',
            'tensi_darah'    => 'nullable|string|max:20',
            'suhu_tubuh'     => 'nullable|string|max:10',
            'tindakan'       => 'nullable|string',
            'resep_obat'     => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Simpan Data Rekam Medis
                RekamMedis::create([
                    'pendaftaran_id' => $request->pendaftaran_id,
                    'pasien_id'      => $request->pasien_id,
                    'dokter_id'      => $request->dokter_id,
                    'keluhan_utama'  => trim($request->keluhan_utama),
                    'tensi_darah'    => $request->tensi_darah,
                    'suhu_tubuh'     => $request->suhu_tubuh,
                    'diagnosa'       => trim($request->diagnosa),
                    'tindakan'       => $request->tindakan,
                    'resep_obat'     => $request->resep_obat,
                ]);

                // 2. Tentukan status selanjutnya: jika ada resep maka masuk ke apotek, jika tidak langsung 'selesai'
                $statusBaru = !empty($request->resep_obat) ? 'menunggu_apotek' : 'selesai';

                Pendaftaran::where('id', $request->pendaftaran_id)->update([
                    'status' => $statusBaru
                ]);
            });

            return redirect()->route('rekam-medis.index')
                ->with('success', 'Pemeriksaan medis berhasil disimpan dan pasien dirujuk ke Apotek!');

        } catch (Exception $e) {
            return back()->with('error', 'Gagal menyimpan rekam medis: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Detail Rekam Medis Pasien
     */
    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])->findOrFail($id);
        return view('rekam_medis.show', compact('rekamMedis'));
    }
}