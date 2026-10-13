<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Pemeriksaan Pasien</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <strong>Pemeriksaan belum bisa disimpan.</strong>
                    <ul class="mt-2 list-disc ps-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">
                <div class="bg-gray-50 p-4 rounded-md border border-gray-200 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="block text-gray-500">No RM:</span>
                        <strong class="text-blue-600">{{ $pendaftaran->pasien->no_rm }}</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Nama Pasien:</span>
                        <strong>{{ $pendaftaran->pasien->nama }}</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Poli / Dokter:</span>
                        <strong>{{ $pendaftaran->poli }} ({{ $pendaftaran->dokter->name }})</strong>
                    </div>
                    <div>
                        <span class="block text-gray-500">Jenis Kelamin:</span>
                        <strong>{{ $pendaftaran->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</strong>
                    </div>
                </div>

                <form action="{{ route('rekam-medis.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tekanan Darah (mmHg)</label>
                            <input type="text" name="tensi_darah" value="{{ old('tensi_darah') }}" placeholder="Contoh: 120/80" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('tensi_darah') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Suhu Tubuh (°C)</label>
                            <input type="number" step="0.1" min="30" max="45" name="suhu_tubuh" value="{{ old('suhu_tubuh') }}" placeholder="Contoh: 36.5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('suhu_tubuh') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Keluhan Utama (Anamnesa) *</label>
                        <textarea name="keluhan_utama" rows="3" required maxlength="2000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Isi keluhan pasien...">{{ old('keluhan_utama') }}</textarea>
                        @error('keluhan_utama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Diagnosa Dokter *</label>
                        <textarea name="diagnosa" rows="3" required maxlength="2000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Isi hasil diagnosa...">{{ old('diagnosa') }}</textarea>
                        @error('diagnosa') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tindakan Medis (Opsional)</label>
                        <textarea name="tindakan" rows="2" maxlength="2000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Pembersihan luka, observasi, dll.">{{ old('tindakan') }}</textarea>
                        @error('tindakan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="rounded-lg border border-purple-200 bg-purple-50 p-4">
                        <label class="block text-sm font-semibold text-purple-900">Resep Obat (Opsional)</label>
                        <p class="text-xs text-purple-700 mt-1 mb-2">Jika resep diisi, pasien otomatis masuk antrean Farmasi setelah rekam medis disimpan.</p>
                        <textarea name="resep_obat" rows="4" maxlength="3000" class="mt-1 block w-full border-purple-300 rounded-md shadow-sm" placeholder="Contoh: Paracetamol 500 mg, 3x1 sesudah makan">{{ old('resep_obat') }}</textarea>
                        @error('resep_obat') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('rekam-medis.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold">Simpan Rekam Medis</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
