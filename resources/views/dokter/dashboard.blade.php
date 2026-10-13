<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Banner Selamat Datang -->
            <div class="bg-blue-600 rounded-2xl p-6 text-white shadow-lg flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Selamat Datang, dr. {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-blue-100 text-sm mt-1">Poli Tugas: <span class="font-semibold uppercase">{{ Auth::user()->poli ?? 'Poli Umum' }}</span></p>
                </div>
                <a href="{{ route('rekam-medis.index') }}" class="bg-white text-blue-600 font-bold px-4 py-2.5 rounded-lg shadow hover:bg-blue-50 transition text-sm">
                    Mulai Pemeriksaan →
                </a>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Antrean Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalAntrean }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pasien Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pasienMenunggu }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Selesai Diperiksa</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $pasienSelesai }}</p>
                </div>
            </div>

            <!-- Tabel Antrean Pasien Hari Ini -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Antrean Pasien Menunggu Hari Ini</h3>
                    <a href="{{ route('rekam-medis.index') }}" class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua Pasien →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="p-3">No. Antrean</th>
                                <th class="p-3">Nama Pasien</th>
                                <th class="p-3">No. RM</th>
                                <th class="p-3">Keluhan</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($antreans as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 font-bold text-blue-600">#{{ sprintf('%03d', $item->no_antrean) }}</td>
                                    <td class="p-3 font-semibold text-gray-800">{{ $item->pasien->nama ?? '-' }}</td>
                                    <td class="p-3 text-gray-500">{{ $item->pasien->no_rm ?? '-' }}</td>
                                    <td class="p-3 text-gray-500">{{ $item->keluhan ?? '-' }}</td>
                                    <td class="p-3">
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full uppercase">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <form action="{{ route('rekam-medis.panggil', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-3 py-1.5 rounded-lg text-xs transition shadow">
                                                Panggil & Periksa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-gray-400">Belum ada antrean pasien untuk diperiksa hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>