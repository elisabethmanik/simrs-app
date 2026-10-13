<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;

class ApotekController extends Controller
{
    // Menampilkan resep digital hari ini untuk aktor farmasi/apoteker.
    public function index()
    {
        $reseps = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])
            ->whereNotNull('resep_obat')
            ->whereHas('pendaftaran', function ($query) {
                $query->whereDate('tanggal_daftar', now()->toDateString())
                    ->whereIn('status', ['menunggu_obat', 'selesai']);
            })
            ->latest()
            ->get();

        return view('apotek.index', compact('reseps'));
    }

    // Konfirmasi penyerahan obat ke pasien.
    public function serahkanObat($pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);

        if ($pendaftaran->status !== 'menunggu_obat') {
            return redirect()->route('apotek.index')
                ->with('error', 'Resep ini sudah tidak berada pada antrean farmasi.');
        }

        $pendaftaran->update(['status' => 'selesai']);

        return redirect()->route('apotek.index')->with('success', 'Obat berhasil diserahkan ke pasien!');
    }

    // Cetak resep / nota resep yang sudah dibuat dokter.
    public function cetak($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])->findOrFail($id);

        return view('apotek.cetak', compact('rekamMedis'));
    }
}
