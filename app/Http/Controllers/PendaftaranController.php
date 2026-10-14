<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        // Ambil daftar antrean pendaftaran hari ini
        $pendaftarans = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_daftar', now()->toDateString())
            ->orderBy('id', 'asc')
            ->get();

        return view('pendaftarans.index', compact('pendaftarans'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = User::where('role', 'dokter')->get();

        return view('pendaftarans.create', compact('pasiens', 'dokters'));
    }

    use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'nik' => ['required', 'string', 'max:16', 'unique:'.User::class], // Pastikan NIK divalidasi dan wajib diisi saat daftar!
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'nik' => $request->nik, // SIMPAN NIK KE TABEL USERS DI SINI!
        'role' => 'pasien',    // Pastikan role-nya pasien
        'password' => Hash::make($request->password),
    ]);


        // Hitung nomor antrean otomatis untuk hari ini
        $todayCount = Pendaftaran::whereDate('tanggal_daftar', now()->toDateString())->count();
        $noAntrean = 'A-' . str_pad($todayCount + 1, 3, '0', STR_PAD_LEFT);

        Pendaftaran::create([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'poli' => $request->poli,
            'no_antrean' => $noAntrean,
            'tanggal_daftar' => now()->toDateString(),
            'status' => 'menunggu',
        ]);

            // Event/Login otomatis setelah register
    event(new Registered($user));
    Auth::login($user);

        return redirect()->route('pendaftarans.index')->with('success', 'Pasien berhasil didaftarkan ke antrean!');
    }
}