<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ApotekController extends Controller
{
    /**
     * Menampilkan daftar resep obat pasien hari ini yang perlu disiapkan
     */
    public function index()
    {
        // Ambil resep obat pasien hari ini yang status pendaftarannya masih dalam antrean apotek
        $reseps = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])
            ->whereHas('pendaftaran', function ($query) {
                $query->whereDate('tanggal_daftar', now()->toDateString())
                      ->whereIn('status', ['menunggu_apotek', 'menunggu_obat', 'selesai']);
            })
            ->whereNotNull('resep_obat')
            ->where('resep_obat', '!=', '')
            ->latest()
            ->get();

        return view('apotek.index', compact('reseps'));
    }

    /**
     * Konfirmasi penyerahan obat ke pasien & menyelesaikan status pendaftaran
     */
    public function serahkanObat($pendaftaran_id)
    {
        try {
            DB::transaction(function () use ($pendaftaran_id) {
                $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
                
                // Ubah status pendaftaran menjadi selesai
                $pendaftaran->update([
                    'status' => 'selesai'
                ]);
            });

            return redirect()->route('apotek.index')
                ->with('success', 'Obat berhasil diserahkan ke pasien dan pelayanan dinyatakan selesai!');

        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses penyerahan obat: ' . $e->getMessage());
        }
    }

    /**
     * Cetak Struk / Etiket / Nota Resep Obat Pasien
     */
    public function cetak($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])->findOrFail($id);

        return view('apotek.cetak', compact('rekamMedis'));
    }
}