<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan Halaman Form Login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses Autentikasi Login & Redirect Berdasarkan Role
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect otomatis berdasarkan Role
        if ($user->role === 'dokter') {
            return redirect()->intended(route('dokter.dashboard'));
        } 
        
        if (in_array($user->role, ['apoteker', 'farmasi'])) {
            return redirect()->intended(route('apotek.index'));
        }
        if ($user->role === 'pasien') {
        return redirect()->intended(route('pasien.dashboard'));
    }

        // Default untuk Admin / Petugas Loket
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Proses Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}