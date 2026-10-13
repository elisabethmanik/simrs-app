<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Online Pasien - RS Cipta Medika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: { 600: '#059669', 700: '#047857', 900: '#064e3b', 950: '#022c22' },
                        slate: { 800: '#1e293b', 900: '#0f172a', 950: '#020617' }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col justify-between relative bg-[#064e3b] selection:bg-emerald-500 selection:text-white">

    <!-- BACKGROUND FOTO GEDUNG RUMAH SAKIT REALISTIK DENGAN WATERMARK TEKS -->
    <div class="fixed inset-0 z-0 bg-cover bg-center bg-no-repeat opacity-40 pointer-events-none" 
         style="background-image: url('https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=1920&auto=format&fit=crop');">
    </div>
    
    <!-- OVERLAY WARNA HIJAU TUA STABIL -->
    <div class="fixed inset-0 z-0 bg-gradient-to-br from-[#022c22]/90 via-[#064e3b]/85 to-[#022c22]/95 pointer-events-none"></div>

    <!-- WATERMARK TEKS NAMA RS DI LATAR BELAKANG -->
    <div class="fixed inset-0 z-0 flex items-center justify-center pointer-events-none overflow-hidden select-none">
        <span class="text-white/[0.04] text-[10vw] font-black tracking-widest whitespace-nowrap uppercase">
            RS Cipta Medika
        </span>
    </div>

    <div class="relative z-10 flex flex-col min-h-screen justify-between">

        <!-- TOPBAR HIJAU TUA -->
        <div style="background-color: #022c22;" class="text-emerald-200 text-xs py-2.5 px-6 border-b border-emerald-900/60 shadow-md">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <span>📍 Jl. Jend. Sudirman No. 10, Jakarta Selatan</span>
                    <span class="hidden md:inline">📞 Hotline: (021) 570-3000</span>
                </div>
                <div>
                    <span>🕒 Pendaftaran Online 24 Jam Setia Melayani</span>
                </div>
            </div>
        </div>

        <!-- HEADER NAVBAR -->
        <header style="background-color: #020617;" class="border-b border-emerald-900/40 sticky top-0 z-50 shadow-xl backdrop-blur-md bg-opacity-90">
            <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl shadow-lg shadow-emerald-900/50 group-hover:bg-emerald-500 transition">
                        +
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight text-white block leading-none">RS CIPTA MEDIKA</span>
                        <span class="text-[10px] font-bold text-emerald-400 tracking-wider uppercase">Care & Medical Center</span>
                    </div>
                </a>

                <div class="flex items-center gap-4">
                    <a href="/" class="text-sm font-semibold text-slate-300 hover:text-emerald-400 transition flex items-center gap-1.5">
                        <span>←</span> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </header>

        <!-- BREADCRUMB -->
        <div style="background-color: #022c22;" class="text-emerald-300 py-3 px-6 border-b border-emerald-900/50 text-xs md:text-sm font-medium">
            <div class="max-w-7xl mx-auto flex items-center gap-2">
                <a href="/" class="hover:text-white transition">Beranda</a> 
                <span class="text-emerald-700">/</span> 
                <span class="font-bold text-emerald-400">Pendaftaran Berobat Online</span>
            </div>
        </div>

        <!-- MAIN FORM SECTION -->
        <main class="flex-1 py-10 px-4 sm:px-6">
            <div class="max-w-4xl mx-auto space-y-6">
                
                <!-- HEADER FORM -->
                <div class="text-white space-y-1 mb-2">
                    <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight drop-shadow-md">Form Pendaftaran Berobat Online</h1>
                    <p class="text-emerald-200 text-xs md:text-sm font-medium">Silakan isi data diri dan pilih jadwal kunjungan Anda.</p>
                </div>

                <!-- KOTAK FORMULIR UTAMA -->
                <div class="bg-white text-slate-800 p-8 md:p-10 rounded-2xl shadow-2xl border border-slate-100">
                    <form action="<?php echo e(route('pendaftaran-online.store')); ?>" method="POST" class="space-y-6">
                        <?php echo csrf_field(); ?>

                        <!-- APAKAH PASIEN PERNAH BEROBAT -->
                        <div class="bg-slate-50 border border-slate-200/80 p-5 rounded-xl space-y-2.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Apakah pasien pernah berobat di RS Cipta Medika?
                            </label>
                            <div class="flex items-center gap-8 text-sm">
                                <label class="flex items-center space-x-2.5 cursor-pointer text-slate-700">
                                    <input type="radio" name="status_pasien" value="lama" onclick="toggleForm(true)" class="w-4 h-4 accent-emerald-600">
                                    <span>Ya (Pasien Lama)</span>
                                </label>
                                <label class="flex items-center space-x-2.5 cursor-pointer text-slate-700">
                                    <input type="radio" name="status_pasien" value="baru" onclick="toggleForm(false)" checked class="w-4 h-4 accent-emerald-600">
                                    <span class="font-semibold text-emerald-700">Tidak (Pasien Baru)</span>
                                </label>
                            </div>
                        </div>

                        <!-- 1. FORM PASIEN LAMA -->
                        <div id="formPasienLama" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-5">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">No NIK (KTP) * (Maks 16 digit)</label>
                                    <input type="text" name="nik_lama" maxlength="16" placeholder="Masukkan 16 digit NIK" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Poliklinik Tujuan *</label>
                                    <select name="poli_lama" class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                        <option value="" disabled selected>-- Pilih Poliklinik --</option>
                                        <option value="Poli Umum">Poli Umum</option>
                                        <option value="Poli Anak">Poli Anak</option>
                                        <option value="Poli Jantung & Pembuluh Darah">Poli Jantung & Pembuluh Darah</option>
                                        <option value="Poli Bedah">Poli Bedah</option>
                                        <option value="Poli Gigi">Poli Gigi</option>
                                        <option value="Poli Mata">Poli Mata</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Pilih Dokter *</label>
                                    <select name="dokter_lama" class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                        <option value="" disabled selected>-- Pilih Dokter --</option>
                                        <option value="dr. Ahmad Dahlan">dr. Ahmad Dahlan</option>
                                        <option value="dr. Siska Putri">dr. Siska Putri</option>
                                        <option value="dr. Budi Santoso, Sp.A">dr. Budi Santoso, Sp.A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-5">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Tanggal Booking Kunjungan *</label>
                                    <input type="date" name="tanggal_booking_lama" value="2026-10-12" 
                                        class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Sesi Waktu Kunjungan *</label>
                                    <select name="sesi_waktu_lama" class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                        <option value="" disabled selected>Pilih Sesi Jam</option>
                                        <option value="Sesi Pagi (08:00 - 12:00 WIB)">Sesi Pagi (08:00 - 12:00 WIB)</option>
                                        <option value="Sesi Siang (13:00 - 16:00 WIB)">Sesi Siang (13:00 - 16:00 WIB)</option>
                                        <option value="Sesi Sore (16:30 - 20:00 WIB)">Sesi Sore (16:30 - 20:00 WIB)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- 2. FORM PASIEN BARU -->
                        <div id="formPasienBaru" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- KOLOM KIRI -->
                            <div class="space-y-5">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">No NIK (KTP) * (Maks 16 digit)</label>
                                    <input type="text" name="nik" maxlength="16" placeholder="Masukkan 16 digit NIK" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Nama Lengkap *</label>
                                    <input type="text" name="nama" placeholder="Sesuai KTP / Identitas" 
                                        class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" 
                                        class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                        <option value="" disabled selected>-- Pilih --</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">No. HP / WhatsApp * (Maks 13 digit)</label>
                                    <input type="text" name="no_hp" maxlength="13" placeholder="08xxxxxxxxxx" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                </div>
                            </div>

                            <!-- KOLOM KANAN -->
                            <div class="space-y-5">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Poliklinik Tujuan *</label>
                                    <select name="poli" class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                        <option value="" disabled selected>-- Pilih Poliklinik --</option>
                                        <option value="Poli Umum">Poli Umum</option>
                                        <option value="Poli Anak">Poli Anak</option>
                                        <option value="Poli Jantung & Pembuluh Darah">Poli Jantung & Pembuluh Darah</option>
                                        <option value="Poli Bedah">Poli Bedah</option>
                                        <option value="Poli Gigi">Poli Gigi</option>
                                        <option value="Poli Mata">Poli Mata</option>
                                    </select>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Pilih Dokter *</label>
                                    <select name="dokter" class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                        <option value="" disabled selected>-- Pilih Poli Terlebih Dahulu --</option>
                                        <option value="dr. Ahmad Dahlan">dr. Ahmad Dahlan</option>
                                        <option value="dr. Siska Putri">dr. Siska Putri</option>
                                        <option value="dr. Budi Santoso, Sp.A">dr. Budi Santoso, Sp.A</option>
                                    </select>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Tanggal Booking Kunjungan *</label>
                                    <input type="date" name="tanggal_booking" value="2026-10-12" 
                                        class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                </div>

                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Sesi Waktu Kunjungan *</label>
                                    <select name="sesi_waktu" class="w-full bg-white border border-slate-300 focus:border-emerald-600 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none transition shadow-sm">
                                        <option value="" disabled selected>Pilih Sesi Jam</option>
                                        <option value="Sesi Pagi (08:00 - 12:00 WIB)">Sesi Pagi (08:00 - 12:00 WIB)</option>
                                        <option value="Sesi Siang (13:00 - 16:00 WIB)">Sesi Siang (13:00 - 16:00 WIB)</option>
                                        <option value="Sesi Sore (16:30 - 20:00 WIB)">Sesi Sore (16:30 - 20:00 WIB)</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- SCRIPT TOGGLE & RESTRIKSI INPUT ANGKA -->
                        <script>
                            function toggleForm(isLama) {
                                const formBaru = document.getElementById('formPasienBaru');
                                const formLama = document.getElementById('formPasienLama');
                                if (isLama) {
                                    formBaru.style.display = 'none';
                                    formLama.style.display = 'grid';
                                } else {
                                    formBaru.style.display = 'grid';
                                    formLama.style.display = 'none';
                                }
                            }
                        </script>

                        <!-- SYARAT & KETENTUAN -->
                        <div class="pt-4 border-t border-slate-200">
                            <label class="flex items-start space-x-3 cursor-pointer">
                                <input type="checkbox" required class="w-4 h-4 mt-0.5 accent-emerald-600 rounded border-slate-300">
                                <span class="text-xs text-slate-600 leading-relaxed">
                                    Dengan ini, saya setuju untuk mengikuti <a href="#" class="text-emerald-700 font-semibold underline hover:text-emerald-800">Syarat & Ketentuan</a> yang berlaku di RS Cipta Medika.
                                </span>
                            </label>
                        </div>

                        <!-- TOMBOL BUAT JANJI -->
                        <div class="pt-2">
                            <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-xl transition duration-300 shadow-lg text-sm tracking-wide uppercase">
                                Buat Janji
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </main>

        <!-- FOOTER -->
        <footer style="background-color: #020617;" class="text-slate-400 py-8 text-xs text-center border-t border-emerald-900/40 relative z-20">
            <p class="font-bold text-white text-sm">RS CIPTA MEDIKA</p>
            <p class="text-emerald-500 mt-1">&copy; <?php echo e(date('Y')); ?> RS Cipta Medika. Hak Cipta Dilindungi Undang-Undang.</p>
        </footer>

    </div>

</body>
</html><?php /**PATH C:\laragon\www\simrs-app\resources\views/pendaftaran-online/index.blade.php ENDPATH**/ ?>