<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\SpesialisController;
use App\Http\Controllers\OnlinePendaftaranController;

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

// 2. Redirect Dashboard ke Beranda
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

// 3. Detail Spesialis Poli
Route::get('/spesialis/{slug}', [SpesialisController::class, 'show'])->name('spesialis.show');

// 4. Form & Proses Pendaftaran Online Pasien
Route::get('/pendaftaran-online', [OnlinePendaftaranController::class, 'index'])->name('pendaftaran-online.index');
Route::post('/pendaftaran-online', [OnlinePendaftaranController::class, 'store'])->name('pendaftaran-online.store');

// 5. Route Dinamis Layanan Penunjang
Route::get('/layanan-penunjang/{slug}', function ($slug) {
    $layananList = [
        'rawat-jalan' => [
            'judul' => 'Rawat Jalan',
            'icon' => '🩺',
            'deskripsi' => 'Layanan perawatan medis tanpa memerlukan rawat inap. Pasien dapat melakukan konsultasi, pemeriksaan, diagnosis, dan tindakan medis dalam satu hari dengan cepat dan efisien.',
            'fasilitas' => ['Poliklinik Eksekutif', 'Poliklinik Umum', 'Jakarta Pain Clinic', 'Jakarta Brain Centre', 'Beauty & Health Clinic']
        ],
        'rawat-inap' => [
            'judul' => 'Rawat Inap',
            'icon' => '🛏️',
            'deskripsi' => 'Layanan pemulihan dan perawatan intensif bagi pasien yang membutuhkan pengawasan medis 24 jam oleh tim dokter dan perawat profesional.',
            'fasilitas' => ['Kamar VVIP & VIP', 'Kamar Kelas 1, 2, & 3', 'Ruang Isolasi Tekanan Negatif', 'Unit Perawatan Intensif (ICU/ICCU)', 'Layanan Keperawatan 24 Jam']
        ],
        'medical-check-up' => [
            'judul' => 'Medical Check Up (MCU)',
            'icon' => '👨‍⚕️',
            'deskripsi' => 'Layanan pemeriksaan kesehatan menyeluruh secara berkala untuk mendeteksi dini potensi penyakit serta menjaga kualitas hidup optimal.',
            'fasilitas' => ['Paket MCU Basic & Executive', 'Pemeriksaan Jantung & Paru', 'Skrining Laboratorium Lengkap', 'Pemeriksaan Mata & THT', 'Konsultasi Dokter Spesialis']
        ],
        'hemodialisa' => [
            'judul' => 'Hemodialisa (Cuci Darah)',
            'icon' => '🩸',
            'deskripsi' => 'Unit terapi cuci darah bagi penderita gagal ginjal dengan peralatan modern serta sistem pemurnian air (Reverse Osmosis) berstandar tinggi.',
            'fasilitas' => ['Mesin Dialisis Terkini', 'Ruang Perawatan Nyaman & Steril', 'Pengawasan Dokter Spesialis Ginjal (KGH)', 'Layanan Snack & Edukasi Nutrisi']
        ],
        'laboratorium' => [
            'judul' => 'Laboratorium Klinik',
            'icon' => '🧪',
            'deskripsi' => 'Layanan pemeriksaan spesimen darah, urin, dan jaringan tubuh dengan peralatan otomatis canggih untuk hasil diagnostik yang akurat dan cepat.',
            'fasilitas' => ['Hematologi & Kimia Darah', 'Pemeriksaan Imunologi & Serologi', 'Mikrobiologi & Parasitologi', 'Layanan Drive-Thru / Sameday Result']
        ],
        'kamar-operasi' => [
            'judul' => 'Kamar Operasi (OK)',
            'icon' => '✂️',
            'deskripsi' => 'Fasilitas tindakan bedah minor hingga mayor yang dilengkapi sistem ventilasi Laminar Air Flow dan sterilisasi tingkat tinggi.',
            'fasilitas' => ['Bedah Laparoskopi (Minimal Invasif)', 'Ruang Pulih Sadar (PACU)', 'Peralatan Anestesi Canggih', 'Tim Bedah & Anestesi Standby 24 Jam']
        ],
        'fisioterapi' => [
            'judul' => 'Fisioterapi & Rehabilitasi Medis',
            'icon' => '🏃',
            'deskripsi' => 'Layanan pemulihan fungsi tubuh pasca cedera, stroke, atau operasi melalui terapi fisik, manipulasi otot, dan latihan terpandu.',
            'fasilitas' => ['Electrotherapy & Ultrasound', 'Terapi Inframerah & Diatermi', 'Gym Rehabilitasi Medis', 'Terapi Stroke & Cedera Olahraga']
        ],
        'radiologi' => [
            'judul' => 'Radiologi & Diagnostic Imaging',
            'icon' => '☢️',
            'deskripsi' => 'Pemeriksaan pencitraan medis canggih untuk membantu dokter melihat kondisi organ dalam tubuh secara detail dan presisi.',
            'fasilitas' => ['Digital X-Ray', 'CT-Scan Multi Slice', 'USG 3D/4D Color Doppler', 'Panoramic & Cephalometric Dental']
        ],
    ];

    if (!array_key_exists($slug, $layananList)) {
        return redirect()->route('home');
    }

    $layanan = $layananList[$slug];

    return view('layanan_penunjang.detail', compact('layanan', 'slug'));
})->name('layanan-penunjang.detail');

// 6. Route AJAX Fetch Dokter Sesuai Poli
Route::get('/get-dokter/{poli}', function ($poli) {
    $keyword = str_replace('Poli ', '', $poli);

    $dokters = User::where('role', 'dokter')
        ->where(function ($query) use ($poli, $keyword) {
            $query->where('poli', $poli)
                  ->orWhere('poli', 'LIKE', '%' . $keyword . '%');
        })
        ->select('id', 'name')
        ->get();

    return response()->json($dokters);
});