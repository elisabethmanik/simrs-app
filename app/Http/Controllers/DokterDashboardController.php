<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\RekamMedis;
use Carbon\Carbon;

class DokterDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        // 1. Total Pasien Antrean Hari Ini
        $totalAntrean = Pendaftaran::where('dokter_id', $user->id)
            ->whereDate('tanggal_daftar', $today)
            ->count();

        // 2. Pasien Menunggu
        $pasienMenunggu = Pendaftaran::where('dokter_id', $user->id)
            ->whereDate('tanggal_daftar', $today)
            ->where('status', 'menunggu')
            ->count();

        // 3. Pasien Selesai Diperiksa Hari Ini
        $pasienSelesai = Pendaftaran::where('dokter_id', $user->id)
            ->whereDate('tanggal_daftar', $today)
            ->whereIn('status', ['menunggu_apotek', 'selesai'])
            ->count();

        // 4. Daftar Antrean Pasien Aktif Hari Ini
        $antreans = Pendaftaran::with('pasien')
            ->where('dokter_id', $user->id)
            ->whereDate('tanggal_daftar', $today)
            ->whereIn('status', ['menunggu', 'diperiksa'])
            ->orderBy('no_antrean', 'asc')
            ->get();

        // 5. Riwayat Rekam Medis Terakhir yang Ditangani Dokter Ini
        $riwayats = RekamMedis::with('pasien')
            ->where('dokter_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dokter.dashboard', compact(
            'totalAntrean',
            'pasienMenunggu',
            'pasienSelesai',
            'antreans',
            'riwayats'
        ));
    }
}