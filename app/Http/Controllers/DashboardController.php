<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika user adalah pasien, arahkan atau ambil data khusus pasien
        if ($user->role === 'pasien') {
            // Ambil antrean aktif pasien yang sedang login
            $antreanAktif = Pendaftaran::where('pasien_id', $user->id) // atau sesuaikan relasi pasien kamu
                ->whereIn('status', ['menunggu', 'diproses'])
                ->latest()
                ->first();

            // Ambil riwayat kunjungan pasien
            $riwayatKunjungan = Pendaftaran::where('pasien_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('dashboard-pasien', compact('antreanAktif', 'riwayatKunjungan'));
        }

        // Jika user adalah Admin / Petugas / Dokter, tampilkan statistik dashboard umum
        $antreanHariIni = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())->count();
        $totalPasien = Pasien::count();
        $pasienSelesai = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())->where('status', 'selesai')->count();
        
        $pendaftarans = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get();

        $rekamMedis = RekamMedis::latest()->take(5)->get();

        return view('dashboard', compact(
            'antreanHariIni', 
            'totalPasien', 
            'pasienSelesai', 
            'pendaftarans', 
            'rekamMedis'
        ));
    }
}