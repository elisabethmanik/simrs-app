<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Online - RS Cipta Medika</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .form-label {
            display: block;
            font-size: 11px;
            line-height: 1.2;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .035em;
            margin-bottom: 8px;
        }

        .form-control {
            display: block;
            width: 100%;
            min-height: 48px;
            border: 1px solid #dbe5e1;
            background: #ffffff;
            color: #172c27;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.4;
            transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
        }

        .form-control::placeholder { color: #a4b0ac; }

        .form-control:hover { border-color: #b9ccc5; }

        .form-control:focus {
            outline: none;
            border-color: #0f9f7f;
            box-shadow: 0 0 0 4px rgba(15, 159, 127, .10);
        }

        .form-control:disabled {
            background: #f6f9f8;
            color: #94a3b8;
            cursor: not-allowed;
        }

        textarea.form-control {
            min-height: 104px;
            resize: vertical;
        }

        .section-card {
            border: 1px solid #e3ece8;
            border-radius: 22px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfdfc 100%);
            padding: 22px;
        }

        .section-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-number {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: #e8f7f2;
            color: #087f69;
            font-size: 12px;
            font-weight: 800;
            flex: 0 0 auto;
        }

        .mode-btn {
            min-height: 44px;
            border-radius: 13px;
            padding: 0 18px;
            font-size: 13px;
            font-weight: 800;
            transition: .18s ease;
        }

        .mode-btn-active {
            background: #087f69;
            color: white;
            border: 1px solid #087f69;
            box-shadow: 0 8px 22px rgba(8,127,105,.16);
        }

        .mode-btn-idle {
            background: #ffffff;
            color: #475569;
            border: 1px solid #d8e2de;
        }

        .mode-btn-idle:hover {
            border-color: #9dc6b9;
            color: #087f69;
            background: #f6fbf9;
        }

        .helper {
            margin-top: 7px;
            font-size: 11px;
            line-height: 1.5;
            color: #7b8f88;
        }

        .page-shell {
            background:
                radial-gradient(circle at 15% 10%, rgba(16,185,129,.14), transparent 26rem),
                radial-gradient(circle at 90% 10%, rgba(45,212,191,.10), transparent 24rem),
                #08211d;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 page-shell">
    <div class="fixed inset-0 bg-cover bg-center opacity-[.10] pointer-events-none"
         style="background-image:url('https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=1920&auto=format&fit=crop')"></div>

    <div class="relative z-10 min-h-screen">
        <header class="sticky top-0 z-50 border-b border-white/10 bg-[#08211d]/90 backdrop-blur-xl">
            <div class="max-w-6xl mx-auto px-5 h-[74px] flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3 text-white">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-950/30">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                            <path d="M12 21s-7-4.35-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.65-7 10-7 10Z"/>
                            <path d="M9 12h2l1-2 2 4 1-2h2"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-extrabold tracking-tight text-sm">RS CIPTA MEDIKA DUBY</div>
                        <div class="text-[9px] uppercase tracking-[.17em] text-emerald-300 mt-0.5">Online Registration</div>
                    </div>
                </a>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-xs font-semibold text-slate-200 hover:bg-white/10 transition">
                    ← Kembali
                </a>
            </div>
        </header>

        <main class="max-w-5xl mx-auto px-4 py-10 md:py-12">
            <div class="grid lg:grid-cols-[.82fr_1.18fr] gap-6 lg:gap-8 items-start">
                <aside class="text-white lg:sticky lg:top-28">
                    <div class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-2 text-[10px] font-bold uppercase tracking-[.12em] text-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Pendaftaran Mandiri
                    </div>

                    <h1 class="mt-5 text-3xl md:text-4xl font-extrabold tracking-[-1.7px] leading-tight">
                        Daftar berobat lebih cepat, tanpa antre lama.
                    </h1>

                    <p class="mt-4 text-sm leading-7 text-slate-300 max-w-md">
                        Isi data pasien, pilih poliklinik, dokter, tanggal, dan jam yang tersedia sesuai jadwal praktik.
                    </p>

                    <div class="mt-7 space-y-3">
                        <div class="flex gap-3 rounded-2xl border border-white/10 bg-white/[.05] p-4">
                            <div class="w-9 h-9 rounded-xl bg-emerald-400/10 text-emerald-300 grid place-items-center font-bold">1</div>
                            <div>
                                <p class="text-xs font-bold">Data Pasien</p>
                                <p class="text-[10px] text-slate-400 mt-1">Pasien baru atau pasien lama.</p>
                            </div>
                        </div>
                        <div class="flex gap-3 rounded-2xl border border-white/10 bg-white/[.05] p-4">
                            <div class="w-9 h-9 rounded-xl bg-emerald-400/10 text-emerald-300 grid place-items-center font-bold">2</div>
                            <div>
                                <p class="text-xs font-bold">Pilih Jadwal</p>
                                <p class="text-[10px] text-slate-400 mt-1">Dokter otomatis mengikuti poli dan hari praktik.</p>
                            </div>
                        </div>
                        <div class="flex gap-3 rounded-2xl border border-white/10 bg-white/[.05] p-4">
                            <div class="w-9 h-9 rounded-xl bg-emerald-400/10 text-emerald-300 grid place-items-center font-bold">3</div>
                            <div>
                                <p class="text-xs font-bold">Konfirmasi</p>
                                <p class="text-[10px] text-slate-400 mt-1">Sistem memvalidasi jadwal sebelum pendaftaran tersimpan.</p>
                            </div>
                        </div>
                    </div>
                </aside>

                <div>
                    @if($errors->any())
                        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-sm">
                            <div class="font-extrabold mb-2">Periksa kembali data berikut:</div>
                            <ul class="list-disc pl-5 space-y-1 text-xs leading-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form id="bookingForm" action="{{ route('pendaftaran-online.store') }}" method="POST"
                          class="bg-[#f8fbfa] rounded-[28px] border border-white/70 shadow-[0_28px_80px_rgba(0,0,0,.22)] p-5 md:p-7 space-y-5">
                        @csrf
                        <input type="hidden" name="is_pasien_baru" id="is_pasien_baru" value="{{ old('is_pasien_baru', '1') }}">
                        <input type="hidden" name="pasien_id" id="pasien_id" value="{{ old('pasien_id') }}">

                        <section class="section-card">
                            <div class="section-head mb-4">
                                <div class="section-number">1</div>
                                <div>
                                    <h2 class="text-[15px] font-extrabold text-slate-800">Status Pasien</h2>
                                    <p class="text-[10px] text-slate-500 mt-1">Pilih apakah Anda pasien baru atau sudah pernah terdaftar.</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2.5">
                                <button type="button" id="btnBaru" class="mode-btn mode-btn-active">Pasien Baru</button>
                                <button type="button" id="btnLama" class="mode-btn mode-btn-idle">Pasien Lama</button>
                            </div>
                        </section>

                        <section id="pasienLamaSection" class="hidden section-card">
                            <div class="section-head">
                                <div class="section-number">2</div>
                                <div>
                                    <h2 class="text-[15px] font-extrabold text-slate-800">Cari Data Pasien Lama</h2>
                                    <p class="text-[10px] text-slate-500 mt-1">Gunakan NIK atau Nomor Rekam Medis.</p>
                                </div>
                            </div>

                            <label class="form-label" for="keywordPasien">NIK / No RM</label>
                            <div class="flex flex-col sm:flex-row gap-2.5">
                                <input id="keywordPasien" type="text" class="form-control flex-1" placeholder="Contoh: 3273... atau RM-20261014-001">
                                <button type="button" id="cariPasienBtn"
                                        class="rounded-[14px] bg-slate-900 hover:bg-slate-800 text-white px-5 min-h-[48px] text-xs font-bold transition">
                                    Cari Pasien
                                </button>
                            </div>
                            <div id="hasilPasien" class="hidden mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-xs leading-6 text-emerald-900"></div>
                            <div id="errorPasien" class="hidden mt-3 text-xs font-semibold text-red-600"></div>
                        </section>

                        <section id="pasienBaruSection" class="section-card">
                            <div class="section-head">
                                <div class="section-number">2</div>
                                <div>
                                    <h2 class="text-[15px] font-extrabold text-slate-800">Data Pasien Baru</h2>
                                    <p class="text-[10px] text-slate-500 mt-1">Isi data sesuai identitas untuk menghindari kesalahan pencatatan.</p>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-x-5 gap-y-5">
                                <div>
                                    <label class="form-label" for="nik">NIK *</label>
                                    <input id="nik" name="nik" value="{{ old('nik') }}" maxlength="16" inputmode="numeric" class="form-control" placeholder="16 digit NIK">
                                    <p id="nikWarning" class="mt-2 text-[11px] font-semibold text-red-600 hidden"></p>
                                </div>

                                <div>
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Sesuai identitas">
                                </div>

                                <div>
                                    <label class="form-label">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-Laki</option>
                                        <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="form-label">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" max="{{ now()->toDateString() }}" class="form-control">
                                </div>

                                <div>
                                    <label class="form-label" for="noHp">No HP / WhatsApp *</label>
                                    <input id="noHp" name="no_hp" value="{{ old('no_hp') }}" maxlength="13" inputmode="numeric" class="form-control" placeholder="10-13 digit angka">
                                    <p id="hpWarning" class="mt-2 text-[11px] font-semibold text-red-600 hidden"></p>
                                </div>

                                <div>
                                    <label class="form-label">Alamat *</label>
                                    <textarea name="alamat" rows="3" class="form-control" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </section>

                        <section class="section-card">
                            <div class="section-head">
                                <div class="section-number">3</div>
                                <div>
                                    <h2 class="text-[15px] font-extrabold text-slate-800">Jadwal Kunjungan</h2>
                                    <p class="text-[10px] text-slate-500 mt-1">Pilih poli, tanggal, dokter, lalu jam praktik yang tersedia.</p>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-x-5 gap-y-5">
                                <div>
                                    <label class="form-label">Poliklinik *</label>
                                    <select id="poli" name="poli" class="form-control">
                                        <option value="">-- Pilih Poliklinik --</option>
                                        @foreach($polis as $poli)
                                            <option value="{{ $poli }}" @selected(old('poli') === $poli)>{{ $poli }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="form-label">Tanggal Kunjungan *</label>
                                    <input id="tanggal" type="date" name="tanggal_daftar" value="{{ old('tanggal_daftar') }}" min="{{ now()->toDateString() }}" class="form-control">
                                </div>

                                <div>
                                    <label class="form-label">Dokter *</label>
                                    <select id="dokter" name="dokter_id" class="form-control" disabled>
                                        <option value="">Pilih poli dan tanggal dahulu</option>
                                    </select>
                                    <p id="dokterInfo" class="helper"></p>
                                </div>

                                <div>
                                    <label class="form-label">Jam Praktik Tersedia *</label>
                                    <select id="jam" name="jam_daftar" class="form-control" disabled>
                                        <option value="">Pilih dokter dahulu</option>
                                    </select>
                                    <p id="jamInfo" class="helper">Jam di luar jadwal praktik otomatis tidak dapat dipilih.</p>
                                </div>
                            </div>
                        </section>

                        <label class="flex items-start gap-3 rounded-2xl border border-[#e3ece8] bg-white px-4 py-4 text-xs leading-5 text-slate-600">
                            <input type="checkbox" required class="mt-0.5 h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span>Saya memastikan data yang diisi benar dan bersedia mengikuti jadwal praktik dokter yang dipilih.</span>
                        </label>

                        <button type="submit"
                                class="w-full rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-4 text-sm shadow-[0_12px_30px_rgba(5,150,105,.20)] transition hover:-translate-y-0.5">
                            Buat Janji Sekarang →
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;
const baseDokterUrl = @json(url('/pendaftaran-online/dokter'));
const checkPasienUrl = @json(route('pendaftaran-online.check-pasien'));
const oldDokter = @json((string) old('dokter_id', ''));
const oldJam = @json((string) old('jam_daftar', ''));
let doctorsData = [];

const btnBaru = document.getElementById('btnBaru');
const btnLama = document.getElementById('btnLama');
const pasienBaru = document.getElementById('pasienBaruSection');
const pasienLama = document.getElementById('pasienLamaSection');
const isBaru = document.getElementById('is_pasien_baru');
const pasienId = document.getElementById('pasien_id');

function setPatientMode(mode) {
    const baru = mode === 'baru';
    isBaru.value = baru ? '1' : '0';
    pasienBaru.classList.toggle('hidden', !baru);
    pasienLama.classList.toggle('hidden', baru);

    btnBaru.className = baru ? 'mode-btn mode-btn-active' : 'mode-btn mode-btn-idle';
    btnLama.className = !baru ? 'mode-btn mode-btn-active' : 'mode-btn mode-btn-idle';

    if (baru) pasienId.value = '';
}

btnBaru.addEventListener('click', () => setPatientMode('baru'));
btnLama.addEventListener('click', () => setPatientMode('lama'));
setPatientMode(isBaru.value === '0' ? 'lama' : 'baru');

document.getElementById('cariPasienBtn').addEventListener('click', async () => {
    const keyword = document.getElementById('keywordPasien').value.trim();
    const hasil = document.getElementById('hasilPasien');
    const err = document.getElementById('errorPasien');

    hasil.classList.add('hidden');
    err.classList.add('hidden');
    pasienId.value = '';

    if (!keyword) {
        err.textContent = 'Masukkan NIK atau No RM.';
        err.classList.remove('hidden');
        return;
    }

    try {
        const res = await fetch(checkPasienUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ keyword })
        });

        const data = await res.json();
        if (!res.ok || !data.success) throw new Error(data.message || 'Pasien tidak ditemukan.');

        pasienId.value = data.pasien.id;
        hasil.innerHTML = `<b>${data.pasien.nama}</b><br>No RM: ${data.pasien.no_rm}<br>NIK: ${data.pasien.nik}`;
        hasil.classList.remove('hidden');
    } catch (e) {
        err.textContent = e.message;
        err.classList.remove('hidden');
    }
});

const nik = document.getElementById('nik');
const nikWarning = document.getElementById('nikWarning');

nik.addEventListener('input', () => {
    const raw = nik.value;
    const cleaned = raw.replace(/\D/g, '').slice(0, 16);
    nik.value = cleaned;

    if (raw !== cleaned && /\D/.test(raw)) {
        nikWarning.textContent = 'NIK hanya boleh berisi angka.';
        nikWarning.classList.remove('hidden');
        return;
    }

    if (!cleaned.length || cleaned.length === 16) {
        nikWarning.classList.add('hidden');
    } else {
        nikWarning.textContent = `NIK harus 16 digit. Saat ini ${cleaned.length} digit.`;
        nikWarning.classList.remove('hidden');
    }
});

const hp = document.getElementById('noHp');
const hpWarning = document.getElementById('hpWarning');

hp.addEventListener('input', () => {
    const raw = hp.value;
    const cleaned = raw.replace(/\D/g, '').slice(0, 13);
    hp.value = cleaned;

    if (raw !== cleaned && /\D/.test(raw)) {
        hpWarning.textContent = 'Nomor HP hanya boleh berisi angka.';
        hpWarning.classList.remove('hidden');
        return;
    }

    if (!cleaned.length || (cleaned.length >= 10 && cleaned.length <= 13)) {
        hpWarning.classList.add('hidden');
    } else {
        hpWarning.textContent = `Nomor HP harus 10-13 digit. Saat ini ${cleaned.length} digit.`;
        hpWarning.classList.remove('hidden');
    }
});

const poli = document.getElementById('poli');
const tanggal = document.getElementById('tanggal');
const dokter = document.getElementById('dokter');
const jam = document.getElementById('jam');
const dokterInfo = document.getElementById('dokterInfo');

async function loadDoctors() {
    doctorsData = [];
    dokter.innerHTML = '<option value="">Memuat dokter...</option>';
    dokter.disabled = true;
    jam.innerHTML = '<option value="">Pilih dokter dahulu</option>';
    jam.disabled = true;
    dokterInfo.textContent = '';

    if (!poli.value || !tanggal.value) {
        dokter.innerHTML = '<option value="">Pilih poli dan tanggal dahulu</option>';
        return;
    }

    try {
        const res = await fetch(`${baseDokterUrl}/${encodeURIComponent(poli.value)}?tanggal=${encodeURIComponent(tanggal.value)}`, {
            headers: { 'Accept': 'application/json' }
        });

        const data = await res.json();
        if (!res.ok) throw new Error(data.message || 'Gagal memuat dokter.');

        doctorsData = data.dokters || [];
        dokter.innerHTML = '<option value="">-- Pilih Dokter --</option>';

        doctorsData.forEach(d => {
            const opt = document.createElement('option');
            opt.value = d.id;
            opt.textContent = d.tersedia
                ? `${d.name} (${d.jam_mulai}-${d.jam_selesai})`
                : `${d.name} - ${d.keterangan}`;
            opt.disabled = !d.tersedia;
            if (String(d.id) === oldDokter) opt.selected = true;
            dokter.appendChild(opt);
        });

        dokter.disabled = false;

        if (!doctorsData.some(d => d.tersedia)) {
            dokterInfo.textContent = `Tidak ada dokter yang praktik pada ${data.hari}.`;
        }

        if (dokter.value) loadSlots();
    } catch (e) {
        dokter.innerHTML = '<option value="">Gagal memuat dokter</option>';
        dokterInfo.textContent = e.message;
    }
}

function loadSlots() {
    const d = doctorsData.find(x => String(x.id) === dokter.value);
    jam.innerHTML = '<option value="">-- Pilih Jam --</option>';

    if (!d) {
        jam.disabled = true;
        return;
    }

    dokterInfo.textContent = `Jadwal: ${d.hari_praktik.join(', ')} | ${d.jam_mulai}-${d.jam_selesai} WIB`;

    d.slots.forEach(slot => {
        const opt = document.createElement('option');
        opt.value = slot;
        opt.textContent = `${slot} WIB`;
        if (slot === oldJam) opt.selected = true;
        jam.appendChild(opt);
    });

    jam.disabled = d.slots.length === 0;
}

poli.addEventListener('change', loadDoctors);
tanggal.addEventListener('change', loadDoctors);
dokter.addEventListener('change', loadSlots);

if (poli.value && tanggal.value) loadDoctors();
</script>
</body>
</html>
