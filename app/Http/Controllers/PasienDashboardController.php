<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PasienDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $antreanAktif = Pendaftaran::where('user_id', $user->id)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->latest()
            ->first();

        $riwayatKunjungan = Pendaftaran::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard-pasien', compact('antreanAktif', 'riwayatKunjungan'));
    }
}