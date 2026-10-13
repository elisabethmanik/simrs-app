<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($namaPoli); ?> - RS Cipta Medika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: { 900: '#064e3b', 950: '#022c22' },
                        slate: { 900: '#0f172a', 950: '#020617' }
                    }
                }
            }
        }
    </script>
</head>
<body style="background-color: #020617; color: #f8fafc;" class="font-sans antialiased min-h-screen flex flex-col justify-between">

    <?php
        // Daftar Khusus Foto Dokter Profesional Asli Berpakaian Medis / Jas Dokter / Stetoskop
        $fotoDokterMedis = [
            'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=500&auto=format&fit=crop', // Dokter Pria Stetoskop
            'https://images.unsplash.com/photo-1594824813566-78a0d0a7a00d?w=500&auto=format&fit=crop', // Dokter Wanita Jas Putih
            'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=500&auto=format&fit=crop', // Dokter Pria Medis
            'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&auto=format&fit=crop', // Dokter Wanita Medis Stetoskop
            'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=500&auto=format&fit=crop', // Dokter Pria Senyum Medis
            'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=500&auto=format&fit=crop', // Dokter Senior Medis
            'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=500&auto=format&fit=crop', // Dokter Medis Klinis
            'https://images.unsplash.com/photo-1527613426441-4da17471b66d?w=500&auto=format&fit=crop', // Suster / Dokter Klinis
        ];
    ?>

    <!-- TOPBAR HIJAU TUA -->
    <div style="background-color: #022c22;" class="text-emerald-200 text-xs py-2.5 px-6 border-b border-emerald-900">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <span>📍 Jl. Jend. Sudirman No. 10, Jakarta Selatan</span>
                <span class="hidden md:inline">📞 Hotline: (021) 570-3000</span>
            </div>
            <div>
                <span>🕒 UGD & Ambulans 24 Jam Setia Melayani</span>
            </div>
        </div>
    </div>

    <!-- HEADER NAVBAR GELAP -->
    <header style="background-color: #020617;" class="border-b border-emerald-900/40 sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-emerald-700 text-white rounded-xl flex items-center justify-center font-bold text-2xl shadow-md">
                    +
                </div>
                <div>
                    <span class="text-xl font-extrabold tracking-tight text-white block leading-none">RS CIPTA MEDIKA</span>
                    <span class="text-[10px] font-bold text-emerald-400 tracking-wider uppercase">Care & Medical Center</span>
                </div>
            </a>

            <div class="flex items-center gap-4">
                <a href="/" class="text-sm font-semibold text-slate-300 hover:text-emerald-400 transition">← Kembali ke Beranda</a>
                <a href="<?php echo e(route('pendaftaran-online.index')); ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition shadow-md">
                    Buat Janji Temu
                </a>
            </div>
        </div>
    </header>

    <!-- BREADCRUMB BANNER -->
    <div style="background-color: #022c22;" class="text-emerald-300 py-3 px-6 border-b border-emerald-900/50 text-xs md:text-sm font-medium">
        <div class="max-w-7xl mx-auto flex items-center gap-2">
            <a href="/" class="hover:text-white transition">Beranda</a> 
            <span class="text-emerald-700">/</span> 
            <span class="text-slate-400">Dokter Spesialis</span> 
            <span class="text-emerald-700">/</span> 
            <span class="font-bold text-emerald-400"><?php echo e($namaPoli); ?></span>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main style="background-color: #020617;" class="flex-1 py-12">
        <div class="max-w-6xl mx-auto px-6 space-y-8">
            
            <!-- BANNER NAMA POLI -->
            <div style="background-color: #0f172a;" class="p-8 rounded-2xl border border-emerald-900/50 shadow-xl flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center space-x-5">
                    <div style="background-color: #022c22;" class="w-16 h-16 border border-emerald-600/50 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl shadow shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-white"><?php echo e($namaPoli); ?></h1>
                        <p class="text-emerald-400 text-xs font-semibold tracking-wider uppercase mt-1">Tim Dokter Spesialis & Subspesialis Berpengalaman</p>
                    </div>
                </div>

                <a href="<?php echo e(route('pendaftaran-online.index')); ?>" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-5 py-3 rounded-xl text-xs md:text-sm transition shadow-lg shrink-0">
                    Daftar Konsultasi Online →
                </a>
            </div>

            <!-- LIST DOKTER SPESIALIS DENGAN FOTO DOKTER MEDIS ASLI -->
            <div class="space-y-4">
                <div class="flex justify-between items-center border-b border-emerald-900/60 pb-3">
                    <h3 class="text-lg font-bold text-emerald-400 flex items-center gap-2">
                        <span>👨‍⚕️</span> Tim Dokter <?php echo e($namaPoli); ?>

                    </h3>
                    <span class="text-xs text-slate-400 bg-emerald-950 px-3 py-1 rounded-full border border-emerald-800">
                        Total: <?php echo e($dokters->count()); ?> Dokter
                    </span>
                </div>

                <?php if(isset($dokters) && $dokters->count() > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dokter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // Mengambil foto dari daftar foto dokter medis asli
                                $photoIndex = abs(crc32($dokter->name . $index)) % count($fotoDokterMedis);
                                $fotoUrl = $fotoDokterMedis[$photoIndex];
                            ?>
                            <div style="background-color: #0f172a;" class="rounded-2xl border border-emerald-900/40 p-6 shadow-xl hover:border-emerald-500 transition flex flex-col justify-between space-y-4 group">
                                <div class="flex items-center space-x-4">
                                    <!-- Foto Profil Dokter Medis -->
                                    <div class="relative shrink-0">
                                        <img src="<?php echo e($fotoUrl); ?>" 
                                             alt="<?php echo e($dokter->name); ?>" 
                                             class="w-16 h-16 rounded-2xl object-cover border-2 border-emerald-600/50 shadow-md group-hover:scale-105 transition duration-300">
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-2 border-slate-900" title="Aktif Praktik"></div>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-base text-white group-hover:text-emerald-400 transition leading-tight"><?php echo e($dokter->name); ?></h4>
                                        <p class="text-xs text-emerald-400 mt-1 font-medium"><?php echo e($dokter->poli); ?></p>
                                        <p class="text-[11px] text-slate-400 mt-2 flex items-center gap-1">
                                            <span>🕒</span> Senin - Sabtu (Praktik)
                                        </p>
                                    </div>
                                </div>

                                <a href="<?php echo e(route('pendaftaran-online.index')); ?>" style="background-color: #020617;" class="w-full text-center hover:bg-emerald-600 text-emerald-400 hover:text-white text-xs font-bold py-2.5 rounded-xl border border-emerald-900/50 hover:border-emerald-600 transition">
                                    Buat Janji Berobat
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div style="background-color: #0f172a;" class="p-8 rounded-2xl border border-emerald-900/30 text-center space-y-3">
                        <div class="text-emerald-500 flex justify-center">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h4 class="text-white font-bold text-base">Dokter Spesialis Belum Tersedia</h4>
                        <p class="text-slate-400 text-xs max-w-md mx-auto">Saat ini jadwal dokter spesialis untuk poli ini sedang diperbarui.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <!-- FOOTER GELAP -->
    <footer style="background-color: #020617;" class="text-slate-400 py-8 text-xs text-center border-t border-emerald-900/40">
        <p class="font-bold text-white text-sm">RS CIPTA MEDIKA</p>
        <p class="text-emerald-500 mt-1">&copy; <?php echo e(date('Y')); ?> RS Cipta Medika. Hak Cipta Dilindungi Undang-Undang.</p>
    </footer>

</body>
</html><?php /**PATH C:\laragon\www\simrs-app\resources\views/spesialis/show.blade.php ENDPATH**/ ?>