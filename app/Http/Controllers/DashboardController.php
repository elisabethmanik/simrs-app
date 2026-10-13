<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\RekamMedis;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Landing page disesuaikan dengan aktor tanpa mengubah desain halaman.
        if ($user->role === 'dokter') {
            return redirect()->route('rekam-medis.index');
        }

        if ($user->role === 'apoteker') {
            return redirect()->route('apotek.index');
        }

        $today = now()->toDateString();

        // Dashboard lama tetap dipakai untuk admin/aktor internal lain.
        $totalPasien = Pasien::count();
        $antreanHariIni = Pendaftaran::whereDate('tanggal_daftar', $today)->count();
        $menungguPemeriksaan = Pendaftaran::whereDate('tanggal_daftar', $today)->where('status', 'menunggu')->count();
        $menungguObat = Pendaftaran::whereDate('tanggal_daftar', $today)->where('status', 'menunggu_obat')->count();
        $layananSelesai = Pendaftaran::whereDate('tanggal_daftar', $today)->where('status', 'selesai')->count();

        $antreanTerbaru = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', $today)
            ->latest()
            ->take(5)
            ->get();

        $rekamMedisTerbaru = RekamMedis::with(['pasien', 'dokter'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPasien',
            'antreanHariIni',
            'menungguPemeriksaan',
            'menungguObat',
            'layananSelesai',
            'antreanTerbaru',
            'rekamMedisTerbaru'
        ));
    }
}
