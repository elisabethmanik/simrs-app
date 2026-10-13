<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\RekamMedis;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect otomatis jika yang login adalah Dokter
        if (auth()->user()->role === 'dokter') {
            return redirect()->route('dokter.dashboard');
        }

        // Variabel statistik untuk Dashboard Admin
        $totalPasien = Pasien::count();
        $menungguPemeriksaan = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())
            ->where('status', 'menunggu')
            ->count();
        $menungguApotek = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())
            ->whereIn('status', ['menunggu_apotek', 'menunggu_obat'])
            ->count();
        $pelayananSelesai = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())
            ->where('status', 'selesai')
            ->count();

        $antreanHariIni = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->latest()
            ->take(5)
            ->get();

        $pemeriksaanTerbaru = RekamMedis::with('pasien')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPasien',
            'menungguPemeriksaan',
            'menungguApotek',
            'pelayananSelesai',
            'antreanHariIni',
            'pemeriksaanTerbaru'
        ));
    }
}