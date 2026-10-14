<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\SpesialisController;
use App\Http\Controllers\OnlinePendaftaranController;
use App\Http\Controllers\PasienDashboardController;
use App\Http\Controllers\Auth\PatientRegisteredController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ApotekController;
use App\Http\Controllers\LayananPenunjangController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Beranda / Landing Page
Route::get('/', function () {
    // Array 8 Layanan Penunjang Medis Lengkap dengan Gambar Latar Belakang
    $layanan = [
        [
            'slug' => 'rawat-jalan',
            'nama' => 'Rawat Jalan',
            'icon' => '🩺',
            'img'  => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&auto=format&fit=crop'
        ],
        [
            'slug' => 'rawat-inap',
            'nama' => 'Rawat Inap',
            'icon' => '🛏️',
            'img'  => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=600&auto=format&fit=crop'
        ],
        [
            'slug' => 'medical-check-up',
            'nama' => 'Medical Check Up',
            'icon' => '👨‍⚕️',
            'img'  => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&auto=format&fit=crop'
        ],
        [
            'slug' => 'hemodialisa',
            'nama' => 'Hemodialisa',
            'icon' => '🩸',
            'img'  => 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1cdb?w=600&auto=format&fit=crop'
        ],
        [
            'slug' => 'laboratorium',
            'nama' => 'Laboratorium',
            'icon' => '🧪',
            'img'  => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?w=600&auto=format&fit=crop'
        ],
        [
            'slug' => 'kamar-operasi',
            'nama' => 'Kamar Operasi',
            'icon' => '✂️',
            'img'  => 'https://images.unsplash.com/photo-1551076805-e1869033e561?w=600&auto=format&fit=crop'
        ],
        [
            'slug' => 'fisioterapi',
            'nama' => 'Fisioterapi',
            'icon' => '🏃',
            'img'  => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&auto=format&fit=crop'
        ],
        [
            'slug' => 'radiologi',
            'nama' => 'Radiologi',
            'icon' => '☢️',
            'img'  => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=600&auto=format&fit=crop'
        ],
    ];

    // Array 18 Dokter Spesialis Lengkap dengan Gambar Latar Belakang
    $listPoli = [
        ['nama' => 'Anak', 'slug' => 'anak', 'icon' => '👶', 'img' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=500&auto=format&fit=crop'],
        ['nama' => 'Anestesi', 'slug' => 'anestesi', 'icon' => '💉', 'img' => 'https://images.unsplash.com/photo-1551076805-e1869033e561?w=500&auto=format&fit=crop'],
        ['nama' => 'Bedah', 'slug' => 'bedah', 'icon' => '✂️', 'img' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=500&auto=format&fit=crop'],
        ['nama' => 'Bedah Plastik & Estetika', 'slug' => 'bedah-plastik', 'icon' => '✨', 'img' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=500&auto=format&fit=crop'],
        ['nama' => 'Bedah Saraf', 'slug' => 'bedah-saraf', 'icon' => '🧠', 'img' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=500&auto=format&fit=crop'],
        ['nama' => 'Dry Needling Fungsional', 'slug' => 'dry-needling', 'icon' => '📍', 'img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500&auto=format&fit=crop'],
        ['nama' => 'Gigi', 'slug' => 'gigi', 'icon' => '🦷', 'img' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=500&auto=format&fit=crop'],
        ['nama' => 'Gizi Klinik', 'slug' => 'gizi-klinik', 'icon' => '🥗', 'img' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=500&auto=format&fit=crop'],
        ['nama' => 'Jantung & Pembuluh Darah', 'slug' => 'jantung-dan-pembuluh-darah', 'icon' => '🫀', 'img' => 'https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?w=500&auto=format&fit=crop'],
        ['nama' => 'Kedokteran Fisik & Rehabilitasi', 'slug' => 'rehabilitasi-medik', 'icon' => '⚡', 'img' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=500&auto=format&fit=crop'],
        ['nama' => 'Kedokteran Jiwa', 'slug' => 'kedokteran-jiwa', 'icon' => '🧘', 'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&auto=format&fit=crop'],
        ['nama' => 'Kedokteran Olahraga', 'slug' => 'kedokteran-olahraga', 'icon' => '🏋️', 'img' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?w=500&auto=format&fit=crop'],
        ['nama' => 'Konsultan Gastroenterologi', 'slug' => 'gastroenterologi', 'icon' => '🔍', 'img' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=500&auto=format&fit=crop'],
        ['nama' => 'Konsultan Ginjal & Hipertensi', 'slug' => 'ginjal-hipertensi', 'icon' => '🩺', 'img' => 'https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=500&auto=format&fit=crop'],
        ['nama' => 'Kulit & Kelamin', 'slug' => 'kulit-dan-kelamin', 'icon' => '🛡️', 'img' => 'https://images.unsplash.com/photo-1512290900673-030103565017?w=500&auto=format&fit=crop'],
        ['nama' => 'Mata', 'slug' => 'mata', 'icon' => '👁️', 'img' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=500&auto=format&fit=crop'],
        ['nama' => 'Obstetri & Ginekologi', 'slug' => 'obstetri-dan-ginekologi', 'icon' => '🤰', 'img' => 'https://images.unsplash.com/photo-1531983412531-1f49a365ffed?w=500&auto=format&fit=crop'],
        ['nama' => 'Ortopedi & Traumatologi', 'slug' => 'ortopedi', 'icon' => '🦴', 'img' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=500&auto=format&fit=crop'],
    ];

    return view('welcome', compact('listPoli', 'layanan'));
})->name('home');

// 2. Detail Spesialis Poli & Layanan Penunjang Publik
Route::get('/spesialis/{slug}', [SpesialisController::class, 'show'])->name('spesialis.show');
Route::get('/layanan-penunjang/{slug}', [LayananPenunjangController::class, 'detail'])->name('layanan-penunjang.detail');

// 3. Form & Proses Pendaftaran Online Pasien (Publik)
Route::get('/pendaftaran-online', [OnlinePendaftaranController::class, 'index'])->name('pendaftaran-online.index');
Route::post('/pendaftaran-online', [OnlinePendaftaranController::class, 'store'])->name('pendaftaran-online.store');

// 4. Registrasi & Login Publik Khusus Pasien
Route::get('/register-pasien', [PatientRegisteredController::class, 'create'])->name('register.pasien');
Route::post('/register-pasien', [PatientRegisteredController::class, 'store'])->name('register.pasien.store');
Route::get('/portal-pasien/login', function () {
    return view('auth.login-pasien');
})->name('login.pasien');

// ==========================================
// ROUTE INTERNAL / PETUGAS (BUTUH LOGIN)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Utama Staf/Admin/Dokter
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ADMIN: Data Pasien & Pendaftaran Poli
    Route::middleware('role:admin')->group(function () {
        Route::resource('pasiens', PasienController::class);
        Route::resource('pendaftarans', PendaftaranController::class);

        // Helper seeding data dokter
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

    // DOKTER: Pemeriksaan, RME, Diagnosa, Tindakan, Resep Digital
    Route::middleware('role:admin,dokter')->group(function () {
        Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
        Route::get('/rekam-medis/periksa/{pendaftaran_id}', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
        Route::post('/rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
    });

    // FARMASI / APOTEKER: Menerima Resep & Penyerahan Obat
    Route::middleware('role:admin,apoteker')->group(function () {
        Route::get('/apotek', [ApotekController::class, 'index'])->name('apotek.index');
        Route::post('/apotek/serahkan/{pendaftaran_id}', [ApotekController::class, 'serahkanObat'])->name('apotek.serahkan');
        Route::get('/apotek/cetak/{id}', [ApotekController::class, 'cetak'])->name('apotek.cetak');
    });
});

// ==========================================
// ROUTE KHUSUS PASIEN (AUTH)
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/pasien/dashboard', [App\Http\Controllers\PasienDashboardController::class, 'index'])->name('pasien.dashboard');
});

// Include rute autentikasi bawaan Laravel Breeze
require __DIR__.'/auth.php';