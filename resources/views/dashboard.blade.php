<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard SIMRS') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Ringkasan Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Total Pasien -->
                <div class="bg-white p-5 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Total Pasien Terdaftar</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalPasien }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Antrean Hari Ini -->
                <div class="bg-white p-5 rounded-lg shadow-sm border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Menunggu Dokter</p>
                            <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $menungguPemeriksaan }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Menunggu Obat -->
                <div class="bg-white p-5 rounded-lg shadow-sm border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Menunggu Apotek</p>
                            <p class="text-2xl font-bold text-orange-600 mt-1">{{ $menungguObat }}</p>
                        </div>
                        <div class="p-3 bg-orange-100 rounded-full text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Pelayanan Selesai -->
                <div class="bg-white p-5 rounded-lg shadow-sm border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Pelayanan Selesai</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">{{ $layananSelesai }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Konten Terkini -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Tabel Antrean Terkini Hari Ini -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-bold text-gray-800">Antrean Pasien Hari Ini</h3>
                        <a href="{{ route('pendaftarans.index') }}" class="text-xs text-blue-600 hover:underline">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">No</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Pasien</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Poli</th>
                                    <th class="px-3 py-2 text-center text-xs font-medium text-gray-500">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($antreanTerbaru as $item)
                                    <tr>
                                        <td class="px-3 py-2 text-xs font-bold text-blue-600">{{ $item->no_antrean }}</td>
                                        <td class="px-3 py-2 text-xs font-semibold text-gray-800">{{ $item->pasien->nama }}</td>
                                        <td class="px-3 py-2 text-xs text-gray-600">{{ $item->poli }}</td>
                                        <td class="px-3 py-2 text-xs text-center">
                                            @if($item->status == 'menunggu')
                                                <span class="bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded">Menunggu</span>
                                            @elseif($item->status == 'diperiksa')
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded">Diperiksa</span>
                                            @elseif(in_array($item->status, ['menunggu_apotek', 'menunggu_obat']))
                                                <span class="bg-orange-100 text-orange-800 px-2 py-0.5 rounded">Apotek</span>
                                            @else
                                                <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-3 py-3 text-center text-xs text-gray-500">Belum ada antrean pendaftaran hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tabel Rekam Medis Terkini -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-bold text-gray-800">Pemeriksaan Medis Terbaru</h3>
                        <a href="{{ route('rekam-medis.index') }}" class="text-xs text-blue-600 hover:underline">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Waktu</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Pasien</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($rekamMedisTerbaru as $rm)
                                    <tr>
                                        <td class="px-3 py-2 text-xs text-gray-500">{{ $rm->created_at->format('H:i') }}</td>
                                        <td class="px-3 py-2 text-xs font-semibold text-gray-800">{{ $rm->pasien->nama }}</td>
                                        <td class="px-3 py-2 text-xs text-blue-700 font-medium">{{ $rm->diagnosa }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-3 py-3 text-center text-xs text-gray-500">Belum ada pemeriksaan medis.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>