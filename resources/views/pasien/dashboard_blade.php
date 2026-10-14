<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pasien - RS Cipta Medika') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-sm text-gray-600 mt-1">NIK: {{ auth()->user()->nik ?? '-' }} | Email: {{ auth()->user()->email }}</p>
            </div>

            <!-- Antrean Aktif / Pendaftaran Berobat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4 class="text-md font-bold text-gray-700 mb-4">Status Antrean & Pendaftaran Aktif</h4>

                @if(isset($antreanAktif) && $antreanAktif)
                    <div class="bg-emerald-50 border border-emerald-200 p-5 rounded-xl space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Kode Booking</span>
                            <span class="bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $antreanAktif->kode_booking ?? '-' }}</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                            <div><strong>Poli Tujuan:</strong> {{ $antreanAktif->poli ?? '-' }}</div>
                            <div><strong>Nomor Antrean:</strong> <span class="text-lg font-black text-emerald-700">{{ $antreanAktif->no_antrean ?? '-' }}</span></div>
                            <div><strong>Tanggal Daftar:</strong> {{ $antreanAktif->tanggal_daftar ?? '-' }}</div>
                            <div><strong>Status:</strong> <span class="capitalize font-semibold text-amber-600">{{ $antreanAktif->status ?? '-' }}</span></div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-6 border-2 border-dashed border-gray-200 rounded-xl">
                        <p class="text-sm text-gray-500 mb-3">Anda belum memiliki antrean pemeriksaan aktif saat ini.</p>
                        <a href="{{ route('pendaftaran-online.index') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2 rounded-xl text-xs transition uppercase tracking-wider">
                            Daftar Berobat Sekarang
                        </a>
                    </div>
                @endif
            </div>

            <!-- Riwayat Kunjungan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4 class="text-md font-bold text-gray-700 mb-4">Riwayat Kunjungan & Pemeriksaan Medis</h4>

                @if(isset($riwayatKunjungan) && $riwayatKunjungan->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3 text-left">Kode Booking</th>
                                    <th class="px-4 py-3 text-left">Tanggal</th>
                                    <th class="px-4 py-3 text-left">Poli</th>
                                    <th class="px-4 py-3 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($riwayatKunjungan as $riwayat)
                                    <tr>
                                        <td class="px-4 py-3 font-semibold text-emerald-600">{{ $riwayat->kode_booking }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $riwayat->tanggal_daftar }}</td>
                                        <td class="px-4 py-3 text-gray-800">{{ $riwayat->poli }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 capitalize">
                                                {{ $riwayat->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada riwayat kunjungan pemeriksaan sebelumnya.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>