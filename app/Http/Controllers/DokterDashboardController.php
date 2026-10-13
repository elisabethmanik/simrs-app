<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\RekamMedis;
use Carbon\Carbon;

class DokterDashboardController extends Controller
{
    public function index()
    {
        abort_unless(auth()->check() && auth()->user()->role === 'dokter', 403, 'Hanya dokter yang dapat mengakses dashboard dokter.');

        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $totalAntrean = Pendaftaran::where('dokter_id', $user->id)
            ->whereDate('tanggal_daftar', $today)
            ->count();

        $pasienMenunggu = Pendaftaran::where('dokter_id', $user->id)
            ->whereDate('tanggal_daftar', $today)
            ->where('status', 'menunggu')
            ->count();

        $pasienSelesai = Pendaftaran::where('dokter_id', $user->id)
            ->whereDate('tanggal_daftar', $today)
            ->whereIn('status', ['menunggu_apotek', 'menunggu_obat', 'selesai'])
            ->count();

        $antreans = Pendaftaran::with('pasien')
            ->where('dokter_id', $user->id)
            ->whereDate('tanggal_daftar', $today)
            ->whereIn('status', ['menunggu', 'diperiksa'])
            ->orderBy('no_antrean', 'asc')
            ->get();

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
