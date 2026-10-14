<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Header Bagian Atas Full Dark Theme & Jam Digital -->
     <?php $__env->slot('header', null, []); ?> 
        <div class="bg-slate-900 -mx-4 -my-6 px-6 py-4 border-b border-slate-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-emerald-950/80 border border-emerald-800/60 rounded-2xl text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-xl text-white tracking-tight">Portal Pasien RS Cipta Medika</h2>
                    <p class="text-xs text-slate-400">Sistem Informasi Manajemen Rumah Sakit Terpadu</p>
                </div>
            </div>

            <!-- Jam Real-Time Berjalan & Status Online -->
            <div class="flex items-center gap-4">
                <div class="bg-slate-950/90 border border-slate-800 px-4 py-2 rounded-2xl flex items-center gap-3 shadow-inner">
                    <svg class="w-5 h-5 text-emerald-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-right font-mono">
                        <div id="liveClock" class="text-sm font-bold text-emerald-400 tracking-wider">00:00:00 WIB</div>
                        <div id="liveDate" class="text-[10px] text-slate-400">Hari, 00 Bln 0000</div>
                    </div>
                </div>

                <span class="bg-emerald-950/90 text-emerald-400 text-xs font-semibold px-3.5 py-2 rounded-2xl border border-emerald-800/60 hidden md:flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    Sistem Terhubung
                </span>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <!-- Container Utama Layout Sidebar Kiri & Konten Kanan -->
    <div class="py-8 bg-slate-950 min-h-screen text-slate-100" x-data="{ activeTab: 'dashboard' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
                
                <!-- ================= SIDEBAR NAVIGASI KIRI ================= -->
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-2xl lg:sticky lg:top-6 space-y-6">
                    <?php
                        $words = explode(' ', auth()->user()->name);
                        $initials = count($words) >= 2 
                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) 
                            : strtoupper(substr(auth()->user()->name, 0, 2));
                    ?>

                    <!-- Foto Profil Inisial Otomatis -->
                    <div class="text-center pb-6 border-b border-slate-800/80">
                        <div class="w-20 h-20 bg-gradient-to-tr from-emerald-600 to-teal-400 rounded-full flex items-center justify-center text-white font-black text-2xl mx-auto shadow-lg shadow-emerald-950/50 border-2 border-emerald-400/30">
                            <?php echo e($initials); ?>

                        </div>
                        <h3 class="text-lg font-bold text-white mt-3"><?php echo e(auth()->user()->name); ?></h3>
                        <p class="text-xs text-emerald-400 font-mono mt-0.5">NIK: <?php echo e(auth()->user()->nik ?? 'Belum diisi'); ?></p>
                    </div>

                    <!-- Menu Navigasi Tab -->
                    <nav class="space-y-2">
                        <button @click="activeTab = 'profile'" 
                                :class="activeTab === 'profile' ? 'bg-emerald-950/80 text-emerald-400 border-emerald-500/50' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 border-transparent'"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl border text-sm font-semibold transition text-left">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            1. Profil Saya
                        </button>

                        <button @click="activeTab = 'dashboard'" 
                                :class="activeTab === 'dashboard' ? 'bg-emerald-950/80 text-emerald-400 border-emerald-500/50' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 border-transparent'"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl border text-sm font-semibold transition text-left">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            2. Status Antrean (Struk)
                        </button>

                        <button @click="activeTab = 'riwayat'" 
                                :class="activeTab === 'riwayat' ? 'bg-emerald-950/80 text-emerald-400 border-emerald-500/50' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 border-transparent'"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl border text-sm font-semibold transition text-left">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            3. Riwayat Kunjungan
                        </button>
                    </nav>
                </div>

                <!-- ================= KONTEN HALAMAN UTAMA (KANAN) ================= -->
                <div class="lg:col-span-3">

                    <!-- TAB 1: PROFIL PASIEN -->
                    <div x-show="activeTab === 'profile'" x-cloak class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="flex justify-between items-center border-b border-slate-800 pb-4">
                            <div>
                                <h3 class="text-xl font-bold text-white">Profil Pasien</h3>
                                <p class="text-xs text-slate-400">Data pribadi terdaftar di RS Cipta Medika.</p>
                            </div>
                            <a href="<?php echo e(route('profile.edit')); ?>" class="bg-slate-800 hover:bg-slate-700 text-emerald-400 border border-emerald-500/30 px-4 py-2 rounded-xl text-xs font-bold transition">
                                Edit Profil
                            </a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                            <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800/80">
                                <span class="text-slate-400 text-xs block mb-1">Nama Lengkap</span>
                                <strong class="text-white text-base"><?php echo e(auth()->user()->name); ?></strong>
                            </div>
                            <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800/80">
                                <span class="text-slate-400 text-xs block mb-1">NIK</span>
                                <strong class="text-emerald-400 text-base font-mono"><?php echo e(auth()->user()->nik ?? 'Belum diisi'); ?></strong>
                            </div>
                            <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800/80">
                                <span class="text-slate-400 text-xs block mb-1">Email</span>
                                <strong class="text-white text-base"><?php echo e(auth()->user()->email); ?></strong>
                            </div>
                            <div class="bg-slate-950 p-4 rounded-2xl border border-slate-800/80">
                                <span class="text-slate-400 text-xs block mb-1">Status Peran</span>
                                <strong class="text-emerald-400 text-base capitalize"><?php echo e(auth()->user()->role ?? 'Pasien'); ?></strong>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: DASHBOARD / STRUK TIKET & TIMELINE -->
                    <div x-show="activeTab === 'dashboard'" x-cloak class="space-y-6">
                        <?php if(isset($antreanAktif) &&$antreanAktif): ?>
                            <div class="bg-gradient-to-br from-slate-900 to-slate-950 border border-emerald-500/30 rounded-3xl p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                                <div class="flex justify-between items-center border-b border-slate-800 pb-4 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="p-3 bg-emerald-950 border border-emerald-800/50 rounded-2xl text-emerald-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-white">Struk Tiket Antrean Pemeriksaan</h3>
                                            <p class="text-xs text-slate-400">RS Cipta Medika - Rawat Jalan</p>
                                        </div>
                                    </div>
                                    <span class="bg-amber-950/80 text-amber-300 text-xs font-bold px-3 py-1.5 rounded-full border border-amber-800/60 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                                        <?php echo e(ucfirst($antreanAktif->status ?? 'Menunggu')); ?>

                                    </span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-center md:text-left">
                                    <div class="bg-slate-950/80 p-5 rounded-2xl border border-slate-800">
                                        <span class="text-xs text-slate-400 block uppercase tracking-wider mb-1">Kode Booking</span>
                                        <span class="text-xl font-black text-emerald-400 font-mono tracking-wider"><?php echo e($antreanAktif->kode_booking); ?></span>
                                    </div>
                                    <div class="bg-slate-950/80 p-5 rounded-2xl border border-slate-800">
                                        <span class="text-xs text-slate-400 block uppercase tracking-wider mb-1">Nomor Antrean Anda</span>
                                        <span class="text-3xl font-black text-emerald-400"><?php echo e($antreanAktif->no_antrean ?? '-'); ?></span>
                                    </div>
                                    <div class="bg-slate-950/80 p-5 rounded-2xl border border-slate-800">
                                        <span class="text-xs text-slate-400 block uppercase tracking-wider mb-1">Poli Tujuan</span>
                                        <span class="text-lg font-bold text-white"><?php echo e($antreanAktif->poli); ?></span>
                                    </div>
                                </div>

                                <!-- TIMELINE STATUS PROGRES -->
                                <div class="bg-slate-950 p-6 rounded-2xl border border-slate-800">
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-6">Timeline Progres Pemeriksaan</h4>
                                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 relative">
                                        <div class="flex items-center gap-3 z-10">
                                            <div class="w-10 h-10 rounded-full bg-emerald-500 text-slate-950 font-bold flex items-center justify-center text-sm">1</div>
                                            <div>
                                                <span class="text-xs font-bold text-white block">Terdaftar</span>
                                                <span class="text-[10px] text-slate-400"><?php echo e($antreanAktif->tanggal_daftar); ?></span>
                                            </div>
                                        </div>
                                        <div class="hidden md:block flex-1 h-1 bg-emerald-500/50"></div>

                                        <div class="flex items-center gap-3 z-10">
                                            <div class="w-10 h-10 rounded-full <?php echo e(in_array($antreanAktif->status, ['diproses', 'selesai']) ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800 text-slate-400'); ?> font-bold flex items-center justify-center text-sm">2</div>
                                            <div>
                                                <span class="text-xs font-bold text-white block">Pemeriksaan Dokter</span>
                                                <span class="text-[10px] text-slate-400">Panggilan Poliklinik</span>
                                            </div>
                                        </div>
                                        <div class="hidden md:block flex-1 h-1 <?php echo e($antreanAktif->status == 'selesai' ? 'bg-emerald-500/50' : 'bg-slate-800'); ?>"></div>

                                        <div class="flex items-center gap-3 z-10">
                                            <div class="w-10 h-10 rounded-full <?php echo e($antreanAktif->status == 'selesai' ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800 text-slate-400'); ?> font-bold flex items-center justify-center text-sm">3</div>
                                            <div>
                                                <span class="text-xs font-bold text-white block">Selesai</span>
                                                <span class="text-[10px] text-slate-400">Pengambilan Obat</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-12 text-center shadow-2xl">
                                <div class="w-16 h-16 bg-slate-800 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">Anda Belum Memiliki Antrean Aktif</h3>
                                <p class="text-sm text-slate-400 max-w-md mx-auto">Silakan melakukan pendaftaran melalui halaman Landing Page utama.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- TAB 3: RIWAYAT KUNJUNGAN -->
                    <div x-show="activeTab === 'riwayat'" x-cloak class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
                        <div class="border-b border-slate-800 pb-4">
                            <h3 class="text-xl font-bold text-white">Arsip Riwayat Kunjungan Medis</h3>
                            <p class="text-xs text-slate-400">Daftar rekam jejak pemeriksaan kesehatan Anda di RS Cipta Medika.</p>
                        </div>

                        <?php 
                            $riwayatList = isset($riwayatKunjungan) ?$riwayatKunjungan : []; 
                        ?>

                        <?php if(count($riwayatList) > 0): ?>
                            <div class="overflow-x-auto rounded-2xl border border-slate-800">
                                <table class="min-w-full divide-y divide-slate-800 text-sm text-left">
                                    <thead class="bg-slate-950 text-slate-400 uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-4 font-semibold">Kode Booking</th>
                                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                                            <th class="px-6 py-4 font-semibold">Poli</th>
                                            <th class="px-6 py-4 font-semibold">No Antrean</th>
                                            <th class="px-6 py-4 font-semibold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-800 bg-slate-900/50">
                                        <?php foreach($riwayatList as$item): ?>
                                            <tr class="hover:bg-slate-800/50 transition">
                                                <td class="px-6 py-4 font-bold text-emerald-400 font-mono"><?= $item->kode_booking ?? '-' ?></td>
                                                <td class="px-6 py-4 text-slate-300"><?= $item->tanggal_daftar ?? '-' ?></td>
                                                <td class="px-6 py-4 text-white font-medium"><?= $item->poli ?? '-' ?></td>
                                                <td class="px-6 py-4 text-slate-300 font-semibold"><?= $item->no_antrean ?? '-' ?></td>
                                                <td class="px-6 py-4">
                                                    <?php 
                                                        $status =$item->status ?? 'menunggu';
                                                        $badgeClass = 'bg-amber-950 text-amber-300 border-amber-800/60';
                                                        if ($status == 'selesai') {$badgeClass = 'bg-emerald-950 text-emerald-300 border-emerald-800/60';
                                                        } elseif ($status == 'diproses') {$badgeClass = 'bg-sky-950 text-sky-300 border-sky-800/60';
                                                        } elseif ($status == 'batal') {$badgeClass = 'bg-rose-950 text-rose-300 border-rose-800/60';
                                                        }
                                                    ?>
                                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border <?= $badgeClass ?>">
                                                        <?= $status ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-10 bg-slate-950/40 border border-dashed border-slate-800 rounded-2xl">
                                <p class="text-sm text-slate-400">Belum ada catatan riwayat kunjungan sebelumnya.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Jam Digital Real-time Berjalan Live -->
    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            document.getElementById('liveClock').innerText = `${hours}:${minutes}:${seconds} WIB`;

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const dayName = days[now.getDay()];
            const dateNum = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();

            document.getElementById('liveDate').innerText = `${dayName}, ${dateNum} ${monthName} ${year}`;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\simrs-app\resources\views/dashboard-pasien.blade.php ENDPATH**/ ?>