<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RS Cipta Medika - Care & Medical Center</title>
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
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Jl. Jend. Sudirman No. 10, Jakarta Selatan
                </span>
                <span class="hidden md:flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    Hotline: (021) 570-3000
                </span>
                <span class="hidden lg:flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    rsciptamedika@ciptamedika.id
                </span>
            </div>
            <div class="flex items-center gap-4">
                <span>Selamat datang di RS Cipta Medika</span>
                <span class="bg-emerald-800/80 px-2 py-0.5 rounded text-[10px] font-bold">🇮🇩 ID</span>
            </div>
        </div>
    </div>

    <!-- HEADER NAVBAR UTAMA DENGAN POP-UP MEGA MENU -->
    <header style="background-color: #020617;" class="border-b border-emerald-900/40 sticky top-0 z-50 shadow-xl backdrop-blur-md bg-opacity-95">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <!-- LOGO RS CIPTA MEDIKA -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl shadow-lg group-hover:bg-emerald-500 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <div>
                    <span class="text-xl font-extrabold tracking-tight text-white block leading-none">RS CIPTA MEDIKA</span>
                    <span class="text-[10px] font-bold text-emerald-400 tracking-wider uppercase">Care & Medical Center</span>
                </div>
            </a>

            <!-- MENU NAVIGASI UTAMA -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="{{ route('home') }}" class="text-emerald-400 font-bold transition">Beranda</a>

                <!-- POP-UP DROPDOWN "FASILITAS & LAYANAN" -->
                <div class="relative group py-6">
                    <button class="flex items-center gap-1.5 text-slate-300 hover:text-emerald-400 transition focus:outline-none">
                        <span>Fasilitas & Layanan</span>
                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- KOTAK POP-UP MEGA MENU -->
                    <div class="absolute top-full left-1/2 -translate-x-1/2 pt-2 hidden group-hover:block z-50">
                        <div class="w-[850px] bg-[#064e3b] border border-emerald-700/60 rounded-2xl shadow-2xl p-6 grid grid-cols-3 gap-6">
                            
                            <!-- DAFTAR LAYANAN MEGA MENU DENGAN IKON SESUAI LAYANAN -->
                            <div class="col-span-2 grid grid-cols-3 gap-3 text-xs">
                                @foreach($layanan as $item)
                                    <a href="{{ route('layanan-penunjang.detail', $item['slug']) }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-emerald-900/90 border border-transparent hover:border-emerald-600/50 transition text-emerald-100 hover:text-white group/item">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center text-emerald-400 group-hover/item:text-emerald-300 shrink-0">
                                            @if($item['slug'] == 'rawat-jalan')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            @elseif($item['slug'] == 'rawat-inap')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            @elseif($item['slug'] == 'medical-check-up')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                            @elseif($item['slug'] == 'hemodialisa')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                            @elseif($item['slug'] == 'laboratorium')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                            @elseif($item['slug'] == 'kamar-operasi')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 0L4 4m5.121 5.121L4 14.243M12 12l2.879-2.879M12 12l-2.879 2.879"></path></svg>
                                            @elseif($item['slug'] == 'fisioterapi')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                            @else
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                            @endif
                                        </div>
                                        <span class="font-semibold">{{ $item['nama'] }}</span>
                                    </a>
                                @endforeach
                            </div>

                            <!-- PREVIEW FASILITAS -->
                            <div class="bg-slate-900/90 border border-emerald-800/60 rounded-xl p-4 flex flex-col justify-between shadow-inner">
                                <div>
                                    <div class="rounded-lg overflow-hidden mb-3 h-28 bg-cover bg-center border border-emerald-700/40" style="background-image: url('{{ $layanan[0]['img'] ?? 'https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=600&auto=format&fit=crop' }}');"></div>
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
                </div>

                <a href="#tentang" class="text-slate-300 hover:text-emerald-400 transition">Tentang Kami</a>
                <a href="#dokter" class="text-slate-300 hover:text-emerald-400 transition">Jadwal Dokter</a>
            </nav>

<!-- GANTI TOMBOL LAMA DENGAN INI -->
<div class="flex items-center gap-3">
    <!-- Portal Pasien (Arahkan ke route login.pasien) -->
    <a href="{{ route('login.pasien') }}" class="inline-flex items-center gap-2 text-emerald-300 hover:text-white text-sm font-semibold px-4 py-2 transition">
        <span>Portal Pasien</span>
    </a>

    <!-- Portal Staf Medis (Baru mengarah ke route login staf) -->
    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-full transition shadow-md text-sm">
        <span>Portal Staf Medis</span>
    </a>
</div>
</div>

        </div>
    </header>

    <!-- HERO BANNER SECTION -->
    <section class="relative py-20 px-6 overflow-hidden bg-gradient-to-b from-slate-900 via-[#064e3b]/30 to-slate-950 border-b border-emerald-900/30">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-6">
                <span class="bg-emerald-900/80 text-emerald-300 border border-emerald-700/60 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider inline-block">
                    🏥 Rumah Sakit Standar Internasional
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight leading-tight">
                    Layanan Kesehatan Terpadu <span class="text-emerald-400">&amp; Segenap Hati</span>
                </h1>
                <p class="text-slate-300 text-sm md:text-base leading-relaxed max-w-2xl">
                    RS Cipta Medika menghadirkan fasilitas medis modern, teknologi mutakhir, serta tim dokter spesialis berpengalaman untuk memberikan pelayanan kesehatan terbaik bagi Anda dan keluarga.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-4">
                    <a href="{{ route('pendaftaran-online.index') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-8 py-4 rounded-xl transition shadow-xl text-sm uppercase tracking-wide">
                        Pendaftaran Online Pasien
                    </a>
                    <a href="https://wa.me/62811901874" target="_blank" class="border border-emerald-700/80 hover:bg-emerald-950 text-emerald-300 font-bold px-6 py-4 rounded-xl transition flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        Chat WhatsApp
                    </a>
                </div>
            </div>

            <!-- KARTU LAYANAN CEPAT HERO -->
            <div class="lg:col-span-5">
                <div class="bg-slate-900/90 border border-emerald-800/60 p-6 md:p-8 rounded-3xl shadow-2xl space-y-6">
                    <h3 class="text-lg font-bold text-white border-b border-emerald-900/60 pb-3">Layanan Cepat Tanggap</h3>
                    
                    <div class="space-y-4 text-xs">
                        <div class="flex items-center justify-between p-3.5 bg-emerald-950/60 border border-emerald-800/40 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-red-950/80 border border-red-700/60 flex items-center justify-center text-red-400 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white">IGD & Ambulans 24 Jam</h4>
                                    <p class="text-slate-400 text-[11px]">Siaga panggil darurat kapan saja</p>
                                </div>
                            </div>
                            <a href="tel:0215703000" class="bg-red-600 hover:bg-red-500 text-white font-bold px-3 py-1.5 rounded-lg text-[10px] uppercase">Panggil</a>
                        </div>

                        <div class="flex items-center justify-between p-3.5 bg-emerald-950/60 border border-emerald-800/40 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-950/80 border border-emerald-700/60 flex items-center justify-center text-emerald-400 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white">Customer Service</h4>
                                    <p class="text-slate-400 text-[11px]">Informasi jadwal &amp; konsultasi</p>
                                </div>
                            </div>
                            <span class="text-emerald-400 font-bold">0811-901-874</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ================= SECTION: TENTANG KAMI ================= -->
<section id="tentang" class="py-20 bg-slate-900 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Kolom Teks Deskripsi -->
            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-950/80 border border-emerald-800/60 text-emerald-400 text-xs font-bold rounded-full">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    Tentang RS Cipta Medika
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Memberikan Perawatan Medis <span class="text-emerald-400">Terbaik & Profesional</span>
                </h2>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    RS Cipta Medika hadir dengan fasilitas medis modern berstandar internasional, didukung oleh tim dokter spesialis berpengalaman, perawat siaga, serta sistem pelayanan digital terpadu untuk memastikan kenyamanan dan kesehatan Anda sekeluarga.
                </p>

                <!-- Poin Keunggulan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800 flex items-start gap-3">
                        <div class="p-2 bg-emerald-950 text-emerald-400 rounded-xl mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-sm">Dokter Spesialis</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Praktik setiap hari dengan jadwal fleksibel.</p>
                        </div>
                    </div>

                    <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800 flex items-start gap-3">
                        <div class="p-2 bg-emerald-950 text-emerald-400 rounded-xl mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-sm">IGD 24 Jam</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Siaga darurat dengan ambulans cepat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Visual Kotak Statistik / Info -->
            <div class="bg-slate-950 p-8 rounded-3xl border border-slate-800 shadow-2xl relative overflow-hidden space-y-6">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <h3 class="text-xl font-bold text-white border-b border-slate-800 pb-4">Komitmen Pelayanan Kesehatan</h3>
                <ul class="space-y-4 text-sm text-slate-300">
                    <li class="flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Pelayanan ramah berorientasi pada keselamatan pasien.
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Teknologi rekam medis dan antrean berbasis online real-time.
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Fasilitas penunjang farmasi dan laboratorium lengkap.
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- ================= SECTION: TIMELINE ALUR LAYANAN BERJALAN ================= -->
<section class="py-20 bg-slate-950 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="text-emerald-400 text-xs font-bold uppercase tracking-widest px-3 py-1 bg-emerald-950/80 border border-emerald-800/60 rounded-full">Alur Pemeriksaan</span>
            <h2 class="text-3xl font-extrabold text-white">Bagaimana Cara Berobat di RS Cipta Medika?</h2>
            <p class="text-xs text-slate-400">Ikuti 4 langkah mudah pendaftaran online hingga penanganan medis selesai.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <!-- Step 1 -->
            <div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 text-center space-y-4 relative group hover:border-emerald-500/50 transition">
                <div class="w-14 h-14 bg-emerald-950 text-emerald-400 border border-emerald-800/60 rounded-2xl flex items-center justify-center font-black text-xl mx-auto shadow-lg group-hover:scale-110 transition">
                    01
                </div>
                <h3 class="text-base font-bold text-white">Buat Akun / Login</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Daftar atau masuk ke portal pasien menggunakan NIK dan email aktif Anda.</p>
            </div>

            <!-- Step 2 -->
            <div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 text-center space-y-4 relative group hover:border-emerald-500/50 transition">
                <div class="w-14 h-14 bg-emerald-950 text-emerald-400 border border-emerald-800/60 rounded-2xl flex items-center justify-center font-black text-xl mx-auto shadow-lg group-hover:scale-110 transition">
                    02
                </div>
                <h3 class="text-base font-bold text-white">Pilih Poli & Dokter</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Tentukan poliklinik tujuan dan jadwal dokter spesialis yang diinginkan.</p>
            </div>

            <!-- Step 3 -->
            <div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 text-center space-y-4 relative group hover:border-emerald-500/50 transition">
                <div class="w-14 h-14 bg-emerald-950 text-emerald-400 border border-emerald-800/60 rounded-2xl flex items-center justify-center font-black text-xl mx-auto shadow-lg group-hover:scale-110 transition">
                    03
                </div>
                <h3 class="text-base font-bold text-white">Dapatkan Struk Antrean</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Nomor antrean dan kode booking otomatis terbit di dashboard portal Anda.</p>
            </div>

            <!-- Step 4 -->
            <div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 text-center space-y-4 relative group hover:border-emerald-500/50 transition">
                <div class="w-14 h-14 bg-emerald-950 text-emerald-400 border border-emerald-800/60 rounded-2xl flex items-center justify-center font-black text-xl mx-auto shadow-lg group-hover:scale-110 transition">
                    04
                </div>
                <h3 class="text-base font-bold text-white">Pemeriksaan & Obat</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Datang ke rumah sakit sesuai jadwal, lakukan pemeriksaan, lalu ambil obat.</p>
            </div>
        </div>
    </div>
</section>

    <!-- SECTION LAYANAN PENUNJANG MEDIS (IKON UNIK PER KARTU) -->
    <section id="fasilitas" class="py-16 px-6 max-w-7xl mx-auto space-y-10">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-emerald-400 text-xs font-bold uppercase tracking-widest">FASILITAS UTAMA</span>
            <h2 class="text-3xl font-extrabold text-white">Layanan Penunjang Medis</h2>
            <p class="text-slate-400 text-xs md:text-sm">Pilih fasilitas medis di bawah ini untuk melihat detail informasi dan jadwal pelayanan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($layanan as $item)
                <a href="{{ route('layanan-penunjang.detail', $item['slug']) }}" class="group bg-slate-900 border border-emerald-900/50 hover:border-emerald-500/80 rounded-2xl overflow-hidden shadow-lg transition duration-300 transform hover:-translate-y-1 block">
                    <div class="h-40 bg-cover bg-center relative" style="background-image: url('{{ $item['img'] }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                        <div class="absolute top-3 left-3 bg-slate-950/80 border border-emerald-700/50 p-2 rounded-xl text-emerald-400">
                            @if($item['slug'] == 'rawat-jalan')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            @elseif($item['slug'] == 'rawat-inap')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            @elseif($item['slug'] == 'medical-check-up')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            @elseif($item['slug'] == 'hemodialisa')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            @elseif($item['slug'] == 'laboratorium')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            @elseif($item['slug'] == 'kamar-operasi')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 0L4 4m5.121 5.121L4 14.243M12 12l2.879-2.879M12 12l-2.879 2.879"></path></svg>
                            @elseif($item['slug'] == 'fisioterapi')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                    </div>
                    <div class="p-5 flex items-center justify-between">
                        <h3 class="font-bold text-white text-sm group-hover:text-emerald-400 transition">{{ $item['nama'] }}</h3>
                        <span class="text-emerald-500 text-xs group-hover:translate-x-1 transition">→</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- SECTION POLIKLINIK DOKTER SPESIALIS (IKON UNIK PER POLI) -->
    <section id="dokter" class="py-16 px-6 bg-slate-900/60 border-t border-emerald-900/40 space-y-10">
        <div class="max-w-7xl mx-auto space-y-10">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-emerald-400 text-xs font-bold uppercase tracking-widest">SPESIALISASI DOKTER</span>
                <h2 class="text-3xl font-extrabold text-white">Poliklinik Spesialis</h2>
                <p class="text-slate-400 text-xs md:text-sm">Ditangani oleh tim dokter spesialis dan konsultan berpengalaman di bidangnya.</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($listPoli as $poli)
                    <a href="{{ route('spesialis.show', $poli['slug']) }}" class="bg-slate-950 border border-emerald-900/50 hover:border-emerald-500/60 hover:bg-slate-900 rounded-xl overflow-hidden text-center transition shadow-md block group">
                        <div class="h-28 bg-cover bg-center relative" style="background-image: url('{{ $poli['img'] }}');">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                            <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-8 h-8 rounded-lg bg-emerald-950/90 border border-emerald-700/60 flex items-center justify-center text-emerald-400 group-hover:bg-emerald-600 group-hover:text-white transition shadow-lg">
                                @if(str_contains($poli['slug'], 'anak'))
                                    <!-- Anak / Pediatric -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @elseif(str_contains($poli['slug'], 'gigi'))
                                    <!-- Gigi / Dental -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path></svg>
                                @elseif(str_contains($poli['slug'], 'jantung'))
                                    <!-- Jantung / Cardio -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                @elseif(str_contains($poli['slug'], 'mata'))
                                    <!-- Mata / Ophthalmology -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                @elseif(str_contains($poli['slug'], 'bedah'))
                                    <!-- Bedah / Surgery -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 0L4 4m5.121 5.121L4 14.243M12 12l2.879-2.879M12 12l-2.879 2.879"></path></svg>
                                @elseif(str_contains($poli['slug'], 'saraf') || str_contains($poli['slug'], 'jiwa'))
                                    <!-- Saraf & Jiwa / Neurology & Brain -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                                @elseif(str_contains($poli['slug'], 'gizi'))
                                    <!-- Gizi / Nutrition -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                @else
                                    <!-- Default Dokter Spesialis -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                @endif
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-bold text-slate-200 text-xs leading-tight group-hover:text-emerald-400 transition">{{ $poli['nama'] }}</h4>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FOOTER LENGKAP -->
    <footer style="background-color: #044e42;" class="text-white py-12 px-6 border-t border-emerald-900/80 relative z-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-xs">
            <div class="space-y-4">
                <h4 class="font-bold text-emerald-200 uppercase tracking-wider text-xs">Sosial Media Kami</h4>
                <div class="flex items-center space-x-3">
                    <a href="#" class="w-8 h-8 bg-emerald-900/80 rounded-lg flex items-center justify-center hover:bg-emerald-600 transition text-emerald-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0-3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </a>
                    <a href="#" class="w-8 h-8 bg-emerald-900/80 rounded-lg flex items-center justify-center hover:bg-emerald-600 transition text-emerald-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                    </a>
                </div>
            </div>

            <div class="space-y-3">
                <h4 class="font-bold text-emerald-200 uppercase tracking-wider text-xs">Hubungi Kami</h4>
                <p class="text-emerald-100">📍 Jl. Jend. Sudirman No. 10, Jakarta Selatan, DKI Jakarta 12740</p>
                <p class="text-emerald-100">📞 (021) 570-3000</p>
                <p class="text-emerald-100">✉️ rsciptamedika@ciptamedika.id</p>
            </div>

            <div class="space-y-3">
                <h4 class="font-bold text-emerald-200 uppercase tracking-wider text-xs">Layanan 24/7</h4>
                <div class="bg-emerald-900/60 p-3 rounded-xl border border-emerald-700/50 flex justify-between items-center">
                    <span>Customer Service</span>
                    <span class="font-bold text-emerald-300">0811-901-874</span>
                </div>
                <div class="bg-emerald-900/60 p-3 rounded-xl border border-emerald-700/50 flex justify-between items-center">
                    <span>IGD &amp; Ambulans</span>
                    <span class="font-bold text-emerald-300">(021) 570-3000</span>
                </div>
            </div>
        </div>

        <div class="border-t border-emerald-800/60 mt-8 pt-6 text-center text-[11px] text-emerald-200">
            Copyright &copy; {{ date('Y') }} RS CIPTA MEDIKA. All Rights Reserved.
        </div>
    </footer>

    <!-- TOMBOL MELAYANG IGD 24 JAM -->
    <a href="tel:0215703000" class="fixed bottom-6 right-6 bg-red-600 hover:bg-red-500 text-white font-black px-5 py-3.5 rounded-full shadow-2xl flex items-center gap-2.5 text-xs z-50 border-2 border-white/25 transition transform hover:scale-105">
        <span class="animate-pulse">🚨</span>
        <span>IGD 24 Jam</span>
    </a>

</body>
</html>