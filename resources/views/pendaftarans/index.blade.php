<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Antrean Pasien Hari Ini</h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ auth()->user()->role === 'dokter' ? 'Antrean pasien yang ditugaskan kepada Anda.' : 'Pantau seluruh antrean pasien hari ini.' }}
                </p>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('pendaftarans.create') }}"
                   class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition">
                    + Pendaftaran Baru
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <form method="GET" action="{{ route('pendaftarans.index') }}" class="flex flex-col md:flex-row gap-3">
                    <div class="flex-1">
                        <label class="block text-xs font-semibold text-gray-500 mb-1">Cari antrean</label>
                        <input type="text"
                               name="search"
                               value="{{ $search ?? '' }}"
                               placeholder="Nama pasien, No RM, NIK, dokter, poli, status..."
                               class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    </div>
                    <div class="flex items-end gap-2">
                        <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold">Cari</button>
                        @if(!empty($search))
                            <a href="{{ route('pendaftarans.index') }}" class="border border-gray-300 px-4 py-2.5 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Antrean</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No RM</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poli</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status / Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($pendaftarans as $pendaftaran)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm font-bold text-emerald-700">{{ $pendaftaran->no_antrean }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pendaftaran->pasien->no_rm ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $pendaftaran->pasien->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pendaftaran->poli }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $pendaftaran->dokter->name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $pendaftaran->jam_daftar ? substr((string) $pendaftaran->jam_daftar, 0, 5) . ' WIB' : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        @if(auth()->user()->role === 'dokter' && in_array($pendaftaran->status, ['menunggu', 'diperiksa']))
                                            <form action="{{ route('rekam-medis.panggil', $pendaftaran->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                                    {{ $pendaftaran->status === 'diperiksa' ? 'Lanjut Periksa' : 'Panggil & Periksa' }}
                                                </button>
                                            </form>
                                        @else
                                            @php
                                                $statusClass = match($pendaftaran->status) {
                                                    'menunggu' => 'bg-yellow-100 text-yellow-800',
                                                    'diperiksa' => 'bg-blue-100 text-blue-800',
                                                    'menunggu_apotek', 'menunggu_obat' => 'bg-purple-100 text-purple-800',
                                                    'selesai' => 'bg-green-100 text-green-800',
                                                    default => 'bg-gray-100 text-gray-700',
                                                };
                                            @endphp
                                            <span class="{{ $statusClass }} text-xs font-semibold px-2.5 py-1 rounded-full uppercase">
                                                {{ str_replace('_', ' ', $pendaftaran->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-sm text-gray-500">Belum ada antrean pasien yang sesuai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
