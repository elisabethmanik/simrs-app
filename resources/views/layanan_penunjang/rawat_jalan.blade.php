<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rawat Jalan - RS Cipta Medika</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col justify-between">

    <!-- NAVBAR HEADER -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-teal-600 text-white rounded-lg flex items-center justify-center font-bold text-2xl shadow">
                    +
                </div>
                <div>
                    <span class="text-xl font-extrabold tracking-tight text-teal-950 block leading-none">RS CIPTA MEDIKA</span>
                    <span class="text-[10px] font-bold text-teal-600 tracking-wider uppercase">Care & Medical Center</span>
                </div>
            </a>

            <div class="flex items-center gap-4">
                <a href="/" class="text-sm font-semibold text-gray-600 hover:text-teal-600">← Kembali ke Beranda</a>
                <a href="{{ route('pendaftaran-online.index') }}" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
                    Buat Janji Berobat
                </a>
            </div>
        </div>
    </header>

    <!-- BREADCRUMB BANNER -->
    <div class="bg-teal-600 text-white py-4 px-6">
        <div class="max-w-7xl mx-auto text-sm font-medium">
            <a href="/" class="hover:underline">Beranda</a> &nbsp;-&nbsp; <span class="font-bold">Rawat Jalan</span>
        </div>
    </div>

    <!-- MAIN CONTENT PAGE -->
    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto px-6 space-y-10">
            
            <!-- PARAGRAF DESKRIPSI UTAMA -->
            <div class="space-y-4 text-gray-700 leading-relaxed text-base">
                <p>
                    <b class="text-teal-900">Rawat Jalan</b> RS Cipta Medika merupakan salah satu layanan kesehatan yang dirancang untuk memberikan perawatan medis tanpa memerlukan rawat inap. Layanan ini ditujukan bagi pasien yang membutuhkan konsultasi, pemeriksaan, diagnosis, pengobatan, maupun tindakan medis yang dapat dilakukan dalam satu hari. Dengan fasilitas modern, tenaga medis yang profesional, serta berbagai spesialisasi yang lengkap, layanan rawat jalan kami memastikan pasien mendapatkan penanganan yang cepat, efisien, dan tepat waktu.
                </p>

                <p>
                    <b>Poliklinik eksekutif</b> adalah layanan kesehatan dengan konsep <i>one-stop service</i> yang menyediakan konsultasi, pemeriksaan, serta tindakan medis dalam satu tempat dengan standar pelayanan terbaik. Dibandingkan dengan poliklinik umum, poliklinik eksekutif menawarkan kenyamanan ekstra dan prioritas dalam hal antrian, fasilitas, dan konsultasi dengan dokter spesialis atau subspesialis.
                </p>
            </div>

            <!-- CARDS DAFTAR LAYANAN POLIKLINIK & PENUNJANG -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Card 1: Layanan Poliklinik Eksekutif -->
                <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm space-y-4">
                    <div class="flex items-center space-x-3 border-b pb-3 border-gray-100">
                        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center font-bold text-xl">
                            ⭐
                        </div>
                        <h3 class="text-lg font-bold text-teal-900">Layanan di Poliklinik Eksekutif</h3>
                    </div>

                    <ul class="space-y-2 text-sm text-gray-600 list-disc pl-5">
                        <li><b>Penyakit Dalam</b>: Pelayanan HIV, Alergi Imunologi & Autoimun, Gastroscopy & Endoscopy</li>
                        <li><b>Penyakit Paru</b>: Pelayanan TB DOTS</li>
                        <li><b>Penyakit Jantung</b>: Treadmill, Echo Cardiology</li>
                        <li><b>Penyakit Ginjal</b>, Hati & Saluran Pencernaan</li>
                        <li><b>Penyakit THT</b>: Audiometri, Endoscopy THT</li>
                        <li><b>Kesehatan Anak</b>: Vaksinasi</li>
                        <li><b>Kebidanan & Kandungan</b>: USG 2D</li>
                        <li><b>Bedah Umum</b>: Perawatan Luka DM, Bedah Digestif, Urologi, Saraf, Vaskuler</li>
                        <li><b>Kesehatan Jiwa & Konsultasi Gizi</b></li>
                    </ul>
                </div>

                <!-- Card 2: Pelayanan Rawat Jalan Lainnya -->
                <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm space-y-4">
                    <div class="flex items-center space-x-3 border-b pb-3 border-gray-100">
                        <div class="w-10 h-10 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center font-bold text-xl">
                            🏥
                        </div>
                        <h3 class="text-lg font-bold text-teal-900">Pelayanan Rawat Jalan Lainnya</h3>
                    </div>

                    <ul class="space-y-2.5 text-sm text-gray-600 list-disc pl-5">
                        <li><b>Poliklinik Umum</b></li>
                        <li><b>Hemodialisa & Fisioterapi</b></li>
                        <li><b>Pain Clinic</b>: Spesialis Anestesi & Orthopedi</li>
                        <li><b>Brain Centre</b>: EEG, TMS, TCD</li>
                        <li><b>Beauty & Health Clinic</b>: Microdermabrasi, Chemical Peeling, Facial, Akupunktur</li>
                    </ul>
                </div>

            </div>

            <!-- CALL TO ACTION BANNER -->
            <div class="bg-gradient-to-r from-teal-800 to-teal-900 text-white p-8 rounded-2xl shadow-md flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-xl font-bold">Butuh Penanganan Rawat Jalan?</h3>
                    <p class="text-teal-100 text-sm mt-1">Daftar sekarang untuk mendapatkan prioritas nomor antrean dan jadwal pemeriksaan dokter.</p>
                </div>
                <a href="{{ route('pendaftaran-online.index') }}" class="bg-amber-500 hover:bg-amber-600 text-teal-950 px-6 py-3 rounded-xl font-bold text-sm transition shadow shrink-0">
                    Daftar Berobat Online →
                </a>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-teal-950 text-teal-200 py-8 text-xs text-center border-t border-teal-900">
        <p class="font-bold text-white text-sm">RS CIPTA MEDIKA</p>
        <p class="text-teal-400 mt-1">&copy; {{ date('Y') }} RS Cipta Medika. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>