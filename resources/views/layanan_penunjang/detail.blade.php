<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $layanan['judul'] ?? $namaLayanan ?? 'Layanan Penunjang' }} - RS Cipta Medika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: { 500: '#10b981', 600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b', 950: '#022c22' },
                        slate: { 800: '#1e293b', 900: '#0f172a', 950: '#020617' }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-100 min-h-screen flex flex-col justify-between selection:bg-emerald-500 selection:text-white">

    <!-- TOPBAR HIJAU TUA -->
    <div style="background-color: #022c22;" class="text-emerald-200 text-xs py-2.5 px-6 border-b border-emerald-900/60 z-20 relative">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <span>📍 Jl. Jend. Sudirman No. 10, Jakarta Selatan</span>
                <span>📞 Hotline: (021) 570-3000</span>
                <span>✉️ rsciptamedika@ciptamedika.id</span>
            </div>
            <div class="flex items-center gap-4">
                <span>Selamat datang di RS Cipta Medika</span>
                <span class="bg-emerald-800/80 px-2 py-0.5 rounded text-[10px] font-bold">🇮🇩 ID</span>
            </div>
        </div>
    </div>

    <!-- NAVBAR UTAMA DENGAN POP-UP MEGA MENU -->
    <header style="background-color: #020617;" class="border-b border-emerald-900/40 sticky top-0 z-50 shadow-xl backdrop-blur-md bg-opacity-95">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <!-- LOGO RS -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl shadow-lg group-hover:bg-emerald-500 transition">
                    +
                </div>
                <div>
                    <span class="text-xl font-extrabold tracking-tight text-white block leading-none">RS CIPTA MEDIKA</span>
                    <span class="text-[10px] font-bold text-emerald-400 tracking-wider uppercase">Care & Medical Center</span>
                </div>
            </a>

            <!-- MENU UTAMA & DROPDOWN -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="{{ route('home') }}" class="text-slate-300 hover:text-emerald-400 transition">Beranda</a>

                <!-- POP-UP DROPDOWN FASILITAS & LAYANAN -->
                <div class="relative group py-6">
                    <button class="flex items-center gap-1.5 text-emerald-400 font-bold hover:text-emerald-300 transition focus:outline-none">
                        <span>Fasilitas & Layanan</span>
                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- MEGA MENU POP-UP KOTAK -->
                    <div class="absolute top-full left-1/2 -translate-x-1/2 w-[850px] bg-[#064e3b] border border-emerald-700/60 rounded-2xl shadow-2xl p-6 hidden group-hover:grid grid-cols-3 gap-6 transition-all duration-300 z-50">
                        
                        <!-- GRID LAYANAN (KLIK LANGSUNG MENUJU DETAILNYA) -->
                        <div class="col-span-2 grid grid-cols-3 gap-2.5 text-xs">
                            <a href="{{ route('layanan-penunjang.detail', 'rawat-jalan') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-900/80 transition text-emerald-100 hover:text-white">
                                <span>🩺</span> <span class="font-semibold">Rawat Jalan</span>
                            </a>
                            <a href="{{ route('layanan-penunjang.detail', 'rawat-inap') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-900/80 transition text-emerald-100 hover:text-white">
                                <span>🛏️</span> <span class="font-semibold">Rawat Inap</span>
                            </a>
                            <a href="{{ route('layanan-penunjang.detail', 'medical-check-up') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-900/80 transition text-emerald-100 hover:text-white">
                                <span>👨‍⚕️</span> <span class="font-semibold">Medical Check Up</span>
                            </a>
                            <a href="{{ route('layanan-penunjang.detail', 'hemodialisa') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-900/80 transition text-emerald-100 hover:text-white">
                                <span>🩸</span> <span class="font-semibold">Hemodialisa</span>
                            </a>
                            <a href="{{ route('layanan-penunjang.detail', 'laboratorium') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-900/80 transition text-emerald-100 hover:text-white">
                                <span>🧪</span> <span class="font-semibold">Laboratorium</span>
                            </a>
                            <a href="{{ route('layanan-penunjang.detail', 'kamar-operasi') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-900/80 transition text-emerald-100 hover:text-white">
                                <span>✂️</span> <span class="font-semibold">Kamar Operasi</span>
                            </a>
                            <a href="{{ route('layanan-penunjang.detail', 'fisioterapi') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-900/80 transition text-emerald-100 hover:text-white">
                                <span>🏃</span> <span class="font-semibold">Fisioterapi</span>
                            </a>
                            <a href="{{ route('layanan-penunjang.detail', 'radiologi') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-emerald-900/80 transition text-emerald-100 hover:text-white">
                                <span>☢️</span> <span class="font-semibold">Radiologi</span>
                            </a>
                        </div>

                        <!-- KARTU PREVIEW KANAN -->
                        <div class="bg-slate-900/90 border border-emerald-800/60 rounded-xl p-4 flex flex-col justify-between shadow-inner">
                            <div>
                                <div class="rounded-lg overflow-hidden mb-3 h-28 bg-cover bg-center border border-emerald-700/40" style="background-image: url('https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=600&auto=format&fit=crop');"></div>
                                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-2">Fasilitas Penunjang</h4>
                                <ul class="text-[11px] text-slate-300 space-y-1">
                                    <li>• Operating Theatre Modern</li>
                                    <li>• CT-Scan 128 Slice</li>
                                    <li>• NICU - PICU - ICU</li>
                                </ul>
                            </div>
                            <a href="{{ route('pendaftaran-online.index') }}" class="text-emerald-400 text-xs font-bold hover:underline block mt-3 pt-2 border-t border-emerald-900/60">Buat Janji Online →</a>
                        </div>

                    </div>
                </div>

                <a href="{{ route('home') }}" class="text-slate-300 hover:text-emerald-400 transition">Tentang Kami</a>
                <a href="{{ route('home') }}" class="text-slate-300 hover:text-emerald-400 transition">Jadwal Dokter</a>
            </nav>

            <div class="flex items-center space-x-4">
                <a href="{{ route('pendaftaran-online.index') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-5 py-2.5 rounded-xl text-xs uppercase tracking-wider shadow-lg transition">
                    Buat Janji Temu
                </a>
            </div>

        </div>
    </header>

    <!-- BREADCRUMB -->
    <div style="background-color: #022c22;" class="text-emerald-300 py-3 px-6 border-b border-emerald-900/50 text-xs md:text-sm">
        <div class="max-w-7xl mx-auto flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a> 
            <span class="text-emerald-700">/</span> 
            <span>Layanan Penunjang</span>
            <span class="text-emerald-700">/</span> 
            <span class="font-bold text-emerald-400">{{ $layanan['judul'] }}</span>
        </div>
    </div>

    <!-- MAIN CONTENT DETAIL LAYANAN -->
    <main class="flex-1">
        <section class="py-12 md:py-16 px-6 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- KIRI: DESKRIPSI -->
                <div class="lg:col-span-5 space-y-6">
                    <span class="text-emerald-400 font-bold text-xs uppercase tracking-widest block">LAYANAN UTAMA RS CIPTA MEDIKA</span>
                    <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight leading-tight">
                        {{ $layanan['judul'] }}
                    </h1>
                    <p class="text-slate-300 text-sm md:text-base leading-relaxed">
                        {{ $layanan['deskripsi'] }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="https://wa.me/62811901874" target="_blank" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-6 py-3.5 rounded-xl transition shadow-lg flex items-center gap-2 text-sm">
                            <span>💬</span>
                            <span>Reservasi lewat WhatsApp</span>
                        </a>
                        <a href="tel:0811901874" class="border border-emerald-700/80 hover:bg-emerald-950 text-emerald-300 font-bold px-6 py-3.5 rounded-xl transition flex items-center gap-2 text-sm">
                            <span>📞</span>
                            <span>0811-901-874</span>
                        </a>
                    </div>
                </div>

                <!-- KANAN: KARTU FLYER & FASILITAS -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl p-6 md:p-8 text-slate-800 shadow-2xl border border-slate-200 relative overflow-hidden">
                        
                        <div class="bg-emerald-900 text-white p-4 rounded-2xl mb-6 flex justify-between items-center shadow-md">
                            <div>
                                <h3 class="font-extrabold text-lg md:text-xl">{{ $layanan['judul'] }}</h3>
                                <p class="text-xs text-emerald-200 mt-0.5">Penanganan Medis Spesialis & Terpercaya</p>
                            </div>
                            <span class="bg-emerald-500 text-white font-bold text-[10px] px-3 py-1 rounded-full uppercase tracking-wider">RS CIPTA MEDIKA</span>
                        </div>

                        <div class="rounded-2xl overflow-hidden h-64 md:h-80 bg-cover bg-center mb-6 shadow-md border border-slate-100" 
                             style="background-image: url('https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=800&auto=format&fit=crop');">
                        </div>

                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-2">
                            <h4 class="font-bold text-slate-800 text-sm mb-2">Fasilitas & Cakupan Layanan:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                                @foreach($layanan['fasilitas'] as $fasilitas)
                                    <div class="flex items-center gap-2 text-slate-700 font-semibold bg-white p-2.5 rounded-xl border border-slate-200">
                                        <span class="text-emerald-600 font-bold">✓</span>
                                        <span>{{ $fasilitas }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION RESERVASI & CARA RESERVASI -->
        <section class="py-12 bg-slate-900/60 border-t border-emerald-900/40 px-6">
            <div class="max-w-7xl mx-auto space-y-10">
                <div>
                    <h2 class="text-2xl font-bold text-white">Reservasi dan Informasi</h2>
                    <p class="text-slate-400 text-xs md:text-sm mt-1">Jadwal dokter, biaya, dan ketentuan konsultasi dapat ditanyakan lewat Customer Service.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-950 border border-emerald-900/60 p-6 rounded-2xl space-y-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-400">CUSTOMER SERVICE</span>
                        <p class="text-2xl font-black text-white">0811-901-874</p>
                        <div class="flex items-center gap-3 pt-2">
                            <a href="https://wa.me/62811901874" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2">
                                <span>💬</span> Chat WhatsApp
                            </a>
                            <a href="tel:0811901874" class="border border-slate-700 text-slate-300 text-xs font-bold px-4 py-2.5 rounded-xl hover:bg-slate-900 transition flex items-center gap-2">
                                <span>📞</span> Telepon
                            </a>
                        </div>
                    </div>

                    <div class="bg-slate-950 border border-emerald-900/60 p-6 rounded-2xl space-y-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-400">HUNTING / OPERATOR</span>
                        <p class="text-2xl font-black text-white">(021) 570-3000</p>
                        <div class="pt-2">
                            <a href="tel:0215703000" class="border border-slate-700 text-slate-300 text-xs font-bold px-4 py-2.5 rounded-xl hover:bg-slate-900 transition inline-flex items-center gap-2">
                                <span>📞</span> Telepon
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARA RESERVASI 3 LANGKAH -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-white">Cara Reservasi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-slate-950 border border-emerald-900/40 p-5 rounded-2xl flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-emerald-900/80 border border-emerald-500/40 text-emerald-300 font-bold flex items-center justify-center text-sm shrink-0">1</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Hubungi Customer Service</h4>
                                <p class="text-xs text-slate-400 mt-1 leading-relaxed">Tanyakan jadwal dokter yang tersedia. Anda tidak perlu menjelaskan keluhan secara rinci di tahap ini.</p>
                            </div>
                        </div>

                        <div class="bg-slate-950 border border-emerald-900/40 p-5 rounded-2xl flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-emerald-900/80 border border-emerald-500/40 text-emerald-300 font-bold flex items-center justify-center text-sm shrink-0">2</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Tentukan Jadwal</h4>
                                <p class="text-xs text-slate-400 mt-1 leading-relaxed">Petugas mengonfirmasi jadwal konsultasi beserta ketentuan dan biayanya.</p>
                            </div>
                        </div>

                        <div class="bg-slate-950 border border-emerald-900/40 p-5 rounded-2xl flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-emerald-900/80 border border-emerald-500/40 text-emerald-300 font-bold flex items-center justify-center text-sm shrink-0">3</div>
                            <div>
                                <h4 class="font-bold text-white text-sm">Konsultasi</h4>
                                <p class="text-xs text-slate-400 mt-1 leading-relaxed">Dokter memeriksa kondisi Anda, lalu menjelaskan pilihan penanganan yang sesuai.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer style="background-color: #044e42;" class="text-white py-12 px-6 border-t border-emerald-900/80 relative z-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-xs">
            <div class="space-y-4">
                <h4 class="font-bold text-emerald-200 uppercase text-xs">Sosial Media Kami</h4>
                <div class="flex items-center space-x-3">
                    <span class="w-8 h-8 bg-emerald-900/80 rounded-lg flex items-center justify-center">🌐</span>
                    <span class="w-8 h-8 bg-emerald-900/80 rounded-lg flex items-center justify-center">📸</span>
                    <span class="w-8 h-8 bg-emerald-900/80 rounded-lg flex items-center justify-center">🎥</span>
                </div>
            </div>
            <div class="space-y-3">
                <h4 class="font-bold text-emerald-200 uppercase text-xs">Hubungi Kami</h4>
                <p class="text-emerald-100">📍 Jl. Jend. Sudirman No. 10, Jakarta Selatan</p>
                <p class="text-emerald-100">📞 (021) 570-3000</p>
            </div>
            <div class="space-y-3">
                <h4 class="font-bold text-emerald-200 uppercase text-xs">Layanan 24/7</h4>
                <p class="text-emerald-100">Customer Service: 0811-901-874</p>
            </div>
        </div>
        <div class="border-t border-emerald-800/60 mt-8 pt-6 text-center text-[11px] text-emerald-200">
            Copyright &copy; {{ date('Y') }} RS CIPTA MEDIKA. All Rights Reserved.
        </div>
    </footer>

    <!-- TOMBOL IGD MELAYANG -->
    <a href="tel:0215703000" class="fixed bottom-6 right-6 bg-red-600 hover:bg-red-500 text-white font-black px-5 py-3.5 rounded-full shadow-2xl flex items-center gap-2.5 text-xs z-50 border-2 border-white/25 transition transform hover:scale-105">
        <span class="animate-pulse">🚨</span>
        <span>IGD 24 Jam</span>
    </a>

</body>
</html>