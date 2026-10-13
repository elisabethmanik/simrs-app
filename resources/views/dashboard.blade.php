@php
    $user = Auth::user();
    $role = $user->role;

    $roleLabel = match($role) {
        'admin' => 'Administrator',
        'dokter' => 'Dokter',
        'apoteker' => 'Farmasi',
        default => ucfirst($role),
    };

    $firstName = explode(' ', trim($user->name))[0];

    $totalPasien = $totalPasien ?? 0;
    $menungguPemeriksaan = $menungguPemeriksaan ?? 0;
    $menungguObat = $menungguObat ?? 0;
    $layananSelesai = $layananSelesai ?? 0;

    $antreanTerbaru = $antreanTerbaru ?? collect();
    $rekamMedisTerbaru = $rekamMedisTerbaru ?? collect();
@endphp


<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5">

            <div>

                <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[.16em] text-[#087f69]">
                    <span class="w-2 h-2 rounded-full bg-[#087f69]"></span>
                    {{ $roleLabel }} Portal
                </div>

                <h1 class="mt-3 text-3xl md:text-[38px]
                           leading-tight font-extrabold
                           tracking-[-1.5px] text-[#17332d]">

                    Selamat datang,
                    <span class="text-[#087f69]">{{ $firstName }}.</span>

                </h1>

                <p class="mt-2 text-[12px] text-[#748a83]">

                    @if($role === 'admin')
                        Pantau aktivitas dan operasional RS Cipta Medika Duby dari satu dashboard.
                    @elseif($role === 'dokter')
                        Pantau antrean pasien dan kelola pemeriksaan medis Anda hari ini.
                    @elseif($role === 'apoteker')
                        Kelola resep digital dan pelayanan farmasi dengan lebih terstruktur.
                    @endif

                </p>

            </div>

            <div class="flex items-center gap-2 text-[11px] text-[#6e847d]">

                <div class="px-4 py-2.5 bg-white
                            rounded-xl border border-[#dcebe6]">

                    {{ now()->translatedFormat('l, d F Y') }}

                </div>

            </div>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- ADMIN --}}
    {{-- ================================================= --}}

    @if($role === 'admin')

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

            {{-- TOTAL PASIEN --}}
            <div class="bg-white border border-[#dcebe6]
                        rounded-3xl p-5
                        shadow-[0_10px_40px_rgba(40,90,76,.05)]">

                <div class="flex justify-between items-start">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-[#80928c]">
                            Total Pasien
                        </p>

                        <p class="mt-3 text-3xl font-extrabold tracking-tight text-[#17332d]">
                            {{ number_format($totalPasien) }}
                        </p>

                        <p class="mt-1 text-[10px] text-[#93a39e]">
                            Pasien terdaftar
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl
                                bg-[#e4f6f0] text-[#087f69]
                                flex items-center justify-center">

                        <svg class="w-6 h-6"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M19 8v6M22 11h-6"/>
                        </svg>

                    </div>

                </div>
            </div>


            {{-- MENUNGGU DOKTER --}}
            <div class="bg-white border border-[#dcebe6]
                        rounded-3xl p-5
                        shadow-[0_10px_40px_rgba(40,90,76,.05)]">

                <div class="flex justify-between items-start">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-[#80928c]">
                            Menunggu Dokter
                        </p>

                        <p class="mt-3 text-3xl font-extrabold tracking-tight text-[#17332d]">
                            {{ $menungguPemeriksaan }}
                        </p>

                        <p class="mt-1 text-[10px] text-[#93a39e]">
                            Antrean pemeriksaan
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl
                                bg-[#fff6d9] text-[#c88b00]
                                flex items-center justify-center">

                        <svg class="w-6 h-6"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 7v5l3 2"/>
                        </svg>

                    </div>

                </div>
            </div>


            {{-- APOTEK --}}
            <div class="bg-white border border-[#dcebe6]
                        rounded-3xl p-5
                        shadow-[0_10px_40px_rgba(40,90,76,.05)]">

                <div class="flex justify-between items-start">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-[#80928c]">
                            Menunggu Farmasi
                        </p>

                        <p class="mt-3 text-3xl font-extrabold tracking-tight text-[#17332d]">
                            {{ $menungguObat }}
                        </p>

                        <p class="mt-1 text-[10px] text-[#93a39e]">
                            Resep belum selesai
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-2xl
                                bg-[#f2eaff] text-[#7c3aed]
                                flex items-center justify-center">

                        <svg class="w-6 h-6"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="M10 2h4v5l5 9a4 4 0 0 1-3.5 6h-7A4 4 0 0 1 5 16l5-9Z"/>
                            <path d="M8 14h8"/>
                        </svg>

                    </div>

                </div>
            </div>


            {{-- SELESAI --}}
            <div class="bg-white border border-[#dcebe6]
                        rounded-3xl p-5
                        shadow-[0_10px_40px_rgba(40,90,76,.05)]">

                <div class="flex justify-between items-start">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-[#80928c]">
                            Pelayanan Selesai
                        </p>

                        <p class="mt-3 text-3xl font-extrabold tracking-tight text-[#17332d]">
                            {{ $layananSelesai }}
                        </p>

                        <p class="mt-1 text-[10px] text-[#93a39e]">
                            Hari ini
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-2xl
                                bg-[#e4f6f0] text-[#087f69]
                                flex items-center justify-center">

                        <svg class="w-6 h-6"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2.5">
                            <path d="m5 12 4 4L19 6"/>
                        </svg>

                    </div>

                </div>
            </div>

        </div>


        {{-- QUICK ACTION --}}
        <div class="mt-6 bg-gradient-to-r from-[#087f69] to-[#055b4b]
                    rounded-[28px] p-6 md:p-7
                    text-white overflow-hidden relative">

            <div class="absolute -right-14 -top-16
                        w-52 h-52 rounded-full
                        border border-white/10"></div>

            <div class="absolute right-20 -bottom-20
                        w-40 h-40 rounded-full
                        bg-white/5"></div>

            <div class="relative flex flex-col lg:flex-row
                        lg:items-center lg:justify-between gap-5">

                <div>
                    <p class="text-[10px] uppercase tracking-[.15em] text-white/65 font-bold">
                        Quick Access
                    </p>

                    <h2 class="text-xl md:text-2xl font-bold mt-2">
                        Kelola layanan rumah sakit.
                    </h2>

                    <p class="text-[11px] text-white/70 mt-2">
                        Gunakan menu cepat untuk aktivitas operasional sehari hari.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">

                    <a href="{{ route('pasiens.index') }}"
                       class="px-4 py-3 bg-white text-[#087f69]
                              rounded-xl text-[11px] font-bold">
                        Data Pasien
                    </a>

                    <a href="{{ route('pendaftarans.index') }}"
                       class="px-4 py-3 bg-white/10 border border-white/15
                              rounded-xl text-[11px] font-bold">
                        Pendaftaran
                    </a>

                    <a href="{{ route('rekam-medis.index') }}"
                       class="px-4 py-3 bg-white/10 border border-white/15
                              rounded-xl text-[11px] font-bold">
                        Pemeriksaan
                    </a>

                    <a href="{{ route('apotek.index') }}"
                       class="px-4 py-3 bg-white/10 border border-white/15
                              rounded-xl text-[11px] font-bold">
                        Farmasi
                    </a>

                </div>

            </div>
        </div>

    @endif


    {{-- ================================================= --}}
    {{-- DOKTER --}}
    {{-- ================================================= --}}

    @if($role === 'dokter')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-white border border-[#dcebe6]
                        rounded-3xl p-6">

                <div class="w-11 h-11 rounded-2xl
                            bg-[#fff6d9] text-[#c88b00]
                            flex items-center justify-center">

                    <svg class="w-5 h-5"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 7v5l3 2"/>
                    </svg>

                </div>

                <p class="mt-5 text-[10px] font-bold uppercase tracking-wider text-[#82958f]">
                    Menunggu Pemeriksaan
                </p>

                <p class="mt-2 text-4xl font-extrabold text-[#17332d]">
                    {{ $menungguPemeriksaan }}
                </p>

            </div>


            <div class="bg-white border border-[#dcebe6]
                        rounded-3xl p-6">

                <div class="w-11 h-11 rounded-2xl
                            bg-[#e5f0ff] text-[#2563eb]
                            flex items-center justify-center">

                    <svg class="w-5 h-5"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <path d="M6 2h9l3 3v17H6z"/>
                        <path d="M9 11h6M9 15h6"/>
                    </svg>

                </div>

                <p class="mt-5 text-[10px] font-bold uppercase tracking-wider text-[#82958f]">
                    Pemeriksaan Tercatat
                </p>

                <p class="mt-2 text-4xl font-extrabold text-[#17332d]">
                    {{ $rekamMedisTerbaru->count() }}
                </p>

            </div>


            <div class="bg-gradient-to-br from-[#087f69] to-[#055b4b]
                        rounded-3xl p-6 text-white">

                <p class="text-[10px] uppercase tracking-wider text-white/60 font-bold">
                    Aksi Utama
                </p>

                <h2 class="text-xl font-bold mt-3">
                    Pemeriksaan Pasien
                </h2>

                <p class="text-[10px] text-white/70 mt-2">
                    Lihat antrean dan isi rekam medis pasien.
                </p>

                <a href="{{ route('rekam-medis.index') }}"
                   class="inline-flex mt-5 px-4 py-3
                          bg-white text-[#087f69]
                          rounded-xl text-[11px] font-bold">
                    Buka Pemeriksaan →
                </a>

            </div>

        </div>

    @endif


    {{-- ================================================= --}}
    {{-- FARMASI --}}
    {{-- ================================================= --}}

    @if($role === 'apoteker')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-white border border-[#dcebe6]
                        rounded-3xl p-6">

                <div class="w-11 h-11 rounded-2xl
                            bg-[#f2eaff] text-[#7c3aed]
                            flex items-center justify-center">

                    <svg class="w-5 h-5"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <path d="M10 2h4v5l5 9a4 4 0 0 1-3.5 6h-7A4 4 0 0 1 5 16l5-9Z"/>
                        <path d="M8 14h8"/>
                    </svg>

                </div>

                <p class="mt-5 text-[10px] font-bold uppercase tracking-wider text-[#82958f]">
                    Resep Menunggu
                </p>

                <p class="mt-2 text-4xl font-extrabold text-[#17332d]">
                    {{ $menungguObat }}
                </p>

            </div>


            <div class="bg-white border border-[#dcebe6]
                        rounded-3xl p-6">

                <div class="w-11 h-11 rounded-2xl
                            bg-[#e4f6f0] text-[#087f69]
                            flex items-center justify-center">

                    <svg class="w-5 h-5"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2.5">
                        <path d="m5 12 4 4L19 6"/>
                    </svg>

                </div>

                <p class="mt-5 text-[10px] font-bold uppercase tracking-wider text-[#82958f]">
                    Pelayanan Selesai
                </p>

                <p class="mt-2 text-4xl font-extrabold text-[#17332d]">
                    {{ $layananSelesai }}
                </p>

            </div>


            <div class="bg-gradient-to-br from-[#087f69] to-[#055b4b]
                        rounded-3xl p-6 text-white">

                <p class="text-[10px] uppercase tracking-wider text-white/60 font-bold">
                    Aksi Utama
                </p>

                <h2 class="text-xl font-bold mt-3">
                    Proses Resep
                </h2>

                <p class="text-[10px] text-white/70 mt-2">
                    Lihat resep digital yang dikirim dokter.
                </p>

                <a href="{{ route('apotek.index') }}"
                   class="inline-flex mt-5 px-4 py-3
                          bg-white text-[#087f69]
                          rounded-xl text-[11px] font-bold">
                    Buka Farmasi →
                </a>

            </div>

        </div>

    @endif


    {{-- ================================================= --}}
    {{-- TABEL OPERASIONAL --}}
    {{-- ================================================= --}}

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mt-6">

        {{-- ANTREAN --}}
        <div class="bg-white border border-[#dcebe6]
                    rounded-[26px] overflow-hidden">

            <div class="p-5 border-b border-[#edf4f1]
                        flex justify-between items-center">

                <div>
                    <h3 class="text-sm font-bold text-[#17332d]">
                        Antrean Pasien Hari Ini
                    </h3>

                    <p class="text-[9px] text-[#8a9b96] mt-1">
                        Aktivitas pelayanan terbaru.
                    </p>
                </div>

                @if($role === 'admin')
                    <a href="{{ route('pendaftarans.index') }}"
                       class="text-[10px] font-bold text-[#087f69]">
                        Lihat semua →
                    </a>
                @elseif($role === 'dokter')
                    <a href="{{ route('rekam-medis.index') }}"
                       class="text-[10px] font-bold text-[#087f69]">
                        Pemeriksaan →
                    </a>
                @elseif($role === 'apoteker')
                    <a href="{{ route('apotek.index') }}"
                       class="text-[10px] font-bold text-[#087f69]">
                        Farmasi →
                    </a>
                @endif

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>
                        <tr class="bg-[#f7fbf9]">
                            <th class="px-5 py-3 text-left text-[9px] uppercase tracking-wider text-[#82958f]">
                                No
                            </th>

                            <th class="px-5 py-3 text-left text-[9px] uppercase tracking-wider text-[#82958f]">
                                Pasien
                            </th>

                            <th class="px-5 py-3 text-left text-[9px] uppercase tracking-wider text-[#82958f]">
                                Poli
                            </th>

                            <th class="px-5 py-3 text-left text-[9px] uppercase tracking-wider text-[#82958f]">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#edf4f1]">

                        @forelse($antreanTerbaru as $item)

                            <tr class="hover:bg-[#fbfdfc]">

                                <td class="px-5 py-4 text-[11px] font-extrabold text-[#087f69]">
                                    {{ $item->no_antrean }}
                                </td>

                                <td class="px-5 py-4 text-[11px] font-semibold text-[#17332d]">
                                    {{ $item->pasien->nama ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-[10px] text-[#6d837c]">
                                    {{ $item->poli }}
                                </td>

                                <td class="px-5 py-4">

                                    @if($item->status === 'menunggu')

                                        <span class="inline-flex px-2.5 py-1 rounded-full
                                                     bg-[#fff6d9] text-[#ae7900]
                                                     text-[9px] font-bold">
                                            Menunggu
                                        </span>

                                    @elseif($item->status === 'diperiksa')

                                        <span class="inline-flex px-2.5 py-1 rounded-full
                                                     bg-blue-50 text-blue-600
                                                     text-[9px] font-bold">
                                            Diperiksa
                                        </span>

                                    @elseif($item->status === 'menunggu_obat')

                                        <span class="inline-flex px-2.5 py-1 rounded-full
                                                     bg-purple-50 text-purple-600
                                                     text-[9px] font-bold">
                                            Farmasi
                                        </span>

                                    @else

                                        <span class="inline-flex px-2.5 py-1 rounded-full
                                                     bg-[#e4f6f0] text-[#087f69]
                                                     text-[9px] font-bold">
                                            Selesai
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4"
                                    class="px-5 py-12 text-center
                                           text-[11px] text-[#91a29d]">

                                    Belum ada antrean hari ini.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>


        {{-- RME --}}
        <div class="bg-white border border-[#dcebe6]
                    rounded-[26px] overflow-hidden">

            <div class="p-5 border-b border-[#edf4f1]
                        flex justify-between items-center">

                <div>
                    <h3 class="text-sm font-bold text-[#17332d]">
                        Pemeriksaan Terbaru
                    </h3>

                    <p class="text-[9px] text-[#8a9b96] mt-1">
                        Riwayat rekam medis terbaru.
                    </p>
                </div>

                @if(in_array($role, ['admin', 'dokter']))
                    <a href="{{ route('rekam-medis.index') }}"
                       class="text-[10px] font-bold text-[#087f69]">
                        Lihat semua →
                    </a>
                @endif

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>
                        <tr class="bg-[#f7fbf9]">

                            <th class="px-5 py-3 text-left
                                       text-[9px] uppercase tracking-wider text-[#82958f]">
                                Waktu
                            </th>

                            <th class="px-5 py-3 text-left
                                       text-[9px] uppercase tracking-wider text-[#82958f]">
                                Pasien
                            </th>

                            <th class="px-5 py-3 text-left
                                       text-[9px] uppercase tracking-wider text-[#82958f]">
                                Diagnosa
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-[#edf4f1]">

                        @forelse($rekamMedisTerbaru as $rm)

                            <tr class="hover:bg-[#fbfdfc]">

                                <td class="px-5 py-4 text-[10px] text-[#899a95]">
                                    {{ optional($rm->created_at)->format('H:i') ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-[11px] font-semibold text-[#17332d]">
                                    {{ $rm->pasien->nama ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-[10px]
                                           font-semibold text-[#087f69]">
                                    {{ $rm->diagnosa ?? '-' }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3"
                                    class="px-5 py-12
                                           text-center text-[11px] text-[#91a29d]">

                                    Belum ada pemeriksaan medis.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>