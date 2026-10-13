<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ApotekController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnlinePendaftaranController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// ROUTE PUBLIK / PASIEN (TANPA LOGIN)
// ==========================================
Route::get('/pendaftaran-online', [OnlinePendaftaranController::class, 'index'])->name('pendaftaran-online.index');
Route::post('/pendaftaran-online/check', [OnlinePendaftaranController::class, 'checkPasien'])->name('pendaftaran-online.check');
Route::get('/pendaftaran-online/status/{keyword}', [OnlinePendaftaranController::class, 'checkStatus'])->name('pendaftaran-online.status');
Route::post('/pendaftaran-online/lihat-tiket', [OnlinePendaftaranController::class, 'lihatTiket'])->name('pendaftaran-online.lihat-tiket');
Route::get('/get-dokter/{poli}', [OnlinePendaftaranController::class, 'getDokterByPoli'])->where('poli', '.*');
Route::post('/pendaftaran-online', [OnlinePendaftaranController::class, 'store'])->name('pendaftaran-online.store');
Route::get('/pendaftaran-online/sukses/{id}', [OnlinePendaftaranController::class, 'sukses'])->name('pendaftaran-online.sukses');

// ==========================================
// ROUTE INTERNAL / PETUGAS (BUTUH LOGIN)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard: dokter diarahkan ke pemeriksaan, apoteker ke apotek.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile tetap bisa diakses semua user internal.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ADMIN: data pasien dan pendaftaran poli.
    Route::middleware('role:admin')->group(function () {
        Route::resource('pasiens', PasienController::class);
        Route::resource('pendaftarans', PendaftaranController::class);

        // Route helper lama tetap dipertahankan, tetapi tidak lagi dapat dipanggil publik.
        Route::get('/fix-dokter-sekarang', function () {
            User::where('role', 'dokter')->delete();

            User::create(['name' => 'dr. Andi Pratama, Sp.PD', 'email' => 'andi@simrs.com', 'password' => Hash::make('password'), 'role' => 'dokter', 'poli' => 'Poli Penyakit Dalam']);
            User::create(['name' => 'dr. Sarah Wijaya, Sp.PD', 'email' => 'sarah@simrs.com', 'password' => Hash::make('password'), 'role' => 'dokter', 'poli' => 'Poli Penyakit Dalam']);
            User::create(['name' => 'dr. Budi Santoso, Sp.A', 'email' => 'budi@simrs.com', 'password' => Hash::make('password'), 'role' => 'dokter', 'poli' => 'Poli Anak']);
            User::create(['name' => 'dr. Rian Hidayat, Sp.KG', 'email' => 'rian@simrs.com', 'password' => Hash::make('password'), 'role' => 'dokter', 'poli' => 'Poli Gigi']);
            User::create(['name' => 'drg. Maya Indah', 'email' => 'maya@simrs.com', 'password' => Hash::make('password'), 'role' => 'dokter', 'poli' => 'Poli Gigi']);
            User::create(['name' => 'dr. Siti Rahma', 'email' => 'siti@simrs.com', 'password' => Hash::make('password'), 'role' => 'dokter', 'poli' => 'Poli Umum']);
            User::create(['name' => 'dr. Hendra Kusuma', 'email' => 'hendra@simrs.com', 'password' => Hash::make('password'), 'role' => 'dokter', 'poli' => 'Poli Umum']);

            return 'BERHASIL! Data Dokter Sudah Masuk ke Database.';
        });
    });

    // DOKTER: pemeriksaan, RME, diagnosa, tindakan, dan resep digital.
    // Admin tetap diberi akses untuk kebutuhan supervisi/debug yang sudah ada sebelumnya.
    Route::middleware('role:admin,dokter')->group(function () {
        Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
        Route::get('/rekam-medis/periksa/{pendaftaran_id}', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
        Route::post('/rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
    });

    // FARMASI/APOTEKER: menerima resep digital dan konfirmasi penyerahan obat.
    // Admin tetap diberi akses untuk supervisi/debug.
    Route::middleware('role:admin,apoteker')->group(function () {
        Route::get('/apotek', [ApotekController::class, 'index'])->name('apotek.index');
        Route::post('/apotek/serahkan/{pendaftaran_id}', [ApotekController::class, 'serahkanObat'])->name('apotek.serahkan');
        Route::get('/apotek/cetak/{id}', [ApotekController::class, 'cetak'])->name('apotek.cetak');
    });
});

require __DIR__.'/auth.php';
