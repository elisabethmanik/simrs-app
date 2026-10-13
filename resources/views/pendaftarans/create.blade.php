<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftarkan Pasien ke Poli</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <strong>Pendaftaran belum bisa disimpan.</strong>
                    <ul class="mt-2 list-disc ps-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('pendaftarans.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pilih Pasien</label>
                        <select name="pasien_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Pasien --</option>
                            @foreach($pasiens as $pasien)
                                <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                                    {{ $pasien->no_rm }} - {{ $pasien->nama }} (NIK: {{ $pasien->nik }})
                                </option>
                            @endforeach
                        </select>
                        @error('pasien_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Poli Tujuan</label>
                            <select id="poli" name="poli" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli }}" {{ old('poli') === $poli ? 'selected' : '' }}>{{ $poli }}</option>
                                @endforeach
                            </select>
                            @error('poli') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pilih Dokter</label>
                            <select id="dokter_id" name="dokter_id" required disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm disabled:bg-gray-100">
                                <option value="">-- Pilih poli terlebih dahulu --</option>
                            </select>
                            <p id="dokterInfo" class="mt-1 text-xs text-gray-500">Dokter akan difilter otomatis sesuai poli.</p>
                            @error('dokter_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('pendaftarans.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold">Daftarkan Antrean</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const poliSelect = document.getElementById('poli');
            const dokterSelect = document.getElementById('dokter_id');
            const dokterInfo = document.getElementById('dokterInfo');
            const oldDokter = @json(old('dokter_id'));

            async function loadDokter() {
                const poli = poliSelect.value;
                dokterSelect.innerHTML = '<option value="">-- Memuat dokter... --</option>';
                dokterSelect.disabled = true;

                if (!poli) {
                    dokterSelect.innerHTML = '<option value="">-- Pilih poli terlebih dahulu --</option>';
                    dokterInfo.textContent = 'Dokter akan difilter otomatis sesuai poli.';
                    return;
                }

                try {
                    const response = await fetch(`{{ url('/get-dokter') }}/${encodeURIComponent(poli)}`, {
                        headers: { 'Accept': 'application/json' }
                    });

                    if (!response.ok) throw new Error('Gagal mengambil data dokter.');
                    const dokters = await response.json();

                    dokterSelect.innerHTML = '<option value="">-- Pilih Dokter --</option>';

                    if (dokters.length === 0) {
                        dokterInfo.textContent = 'Belum ada dokter untuk poli ini.';
                        dokterInfo.className = 'mt-1 text-xs text-red-600';
                        return;
                    }

                    dokters.forEach(function (dokter) {
                        const option = document.createElement('option');
                        option.value = dokter.id;
                        option.textContent = dokter.name;
                        if (String(oldDokter) === String(dokter.id)) option.selected = true;
                        dokterSelect.appendChild(option);
                    });

                    dokterSelect.disabled = false;
                    dokterInfo.textContent = `${dokters.length} dokter tersedia di ${poli}.`;
                    dokterInfo.className = 'mt-1 text-xs text-green-600';
                } catch (error) {
                    dokterSelect.innerHTML = '<option value="">-- Gagal memuat dokter --</option>';
                    dokterInfo.textContent = error.message;
                    dokterInfo.className = 'mt-1 text-xs text-red-600';
                }
            }

            poliSelect.addEventListener('change', loadDokter);
            if (poliSelect.value) loadDokter();
        });
    </script>
</x-app-layout>
