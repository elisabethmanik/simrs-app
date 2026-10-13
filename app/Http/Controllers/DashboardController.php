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

        if ($user->role === 'dokter') {
            return redirect()->route('dokter.dashboard');
        }

        if (in_array($user->role, ['apoteker', 'farmasi'], true)) {
            return redirect()->route('apotek.index');
        }

        abort_unless($user->role === 'admin', 403, 'Anda tidak memiliki akses ke dashboard admin.');

        $totalPasien = Pasien::count();

        $menungguPemeriksaan = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())
            ->where('status', 'menunggu')
            ->count();

        $menungguObat = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())
            ->whereIn('status', ['menunggu_apotek', 'menunggu_obat'])
            ->count();

        $layananSelesai = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())
            ->where('status', 'selesai')
            ->count();

        $antreanTerbaru = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->latest()
            ->take(5)
            ->get();

        $rekamMedisTerbaru = RekamMedis::with('pasien')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPasien',
            'menungguPemeriksaan',
            'menungguObat',
            'layananSelesai',
            'antreanTerbaru',
            'rekamMedisTerbaru'
        ));
    }
}
