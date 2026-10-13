<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rekam Medis</h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ auth()->user()->role === 'admin' ? 'Admin dapat melihat dan mencari seluruh riwayat rekam medis.' : 'Riwayat pemeriksaan pasien yang pernah Anda tangani.' }}
                </p>
            </div>

            <div class="flex gap-2">
                @if(auth()->user()->role === 'dokter')
                    <a href="{{ route('pendaftarans.index') }}" class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm font-semibold">
                        Antrean Pasien →
                    </a>
                @endif

                <a href="{{ route('apotek.index') }}" class="inline-flex items-center justify-center bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-semibold">
                    Resep / Farmasi →
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">{{ session('error') }}</div>
            @endif

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <form method="GET" action="{{ route('rekam-medis.index') }}" class="flex flex-col md:flex-row gap-3">
                    <div class="flex-1">
                        <label class="block text-xs font-semibold text-gray-500 mb-1">Cari rekam medis</label>
                        <input type="text"
                               name="search"
                               value="{{ $search ?? '' }}"
                               placeholder="Nama, No RM, NIK, diagnosa, dokter, resep..."
                               class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        <p class="mt-1 text-xs text-gray-400">No RM boleh dicari dengan atau tanpa tanda hubung.</p>
                    </div>
                    <div class="flex items-end gap-2">
                        <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold">Cari</button>
                        @if(!empty($search))
                            <a href="{{ route('rekam-medis.index') }}" class="border border-gray-300 px-4 py-2.5 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Riwayat Rekam Medis</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnosa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Resep / Farmasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($historyMedis as $rm)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $rm->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-700">{{ $rm->pasien->no_rm ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $rm->pasien->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $rm->dokter->name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-emerald-700">{{ $rm->diagnosa }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 min-w-[230px]">
                                        @if($rm->resep_obat)
                                            <div class="whitespace-pre-line">{{ $rm->resep_obat }}</div>
                                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                                @if(in_array(optional($rm->pendaftaran)->status, ['menunggu_apotek', 'menunggu_obat']))
                                                    <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2 py-1 rounded">Menunggu Farmasi</span>
                                                @elseif(optional($rm->pendaftaran)->status === 'selesai')
                                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Obat selesai</span>
                                                @endif
                                                <a href="{{ route('apotek.index', ['search' => $rm->pasien->no_rm ?? '']) }}" class="text-xs font-semibold text-purple-700 hover:underline">Lihat Farmasi →</a>
                                            </div>
                                        @else
                                            <span class="text-gray-400">Tidak ada resep</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">Belum ada rekam medis yang sesuai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
