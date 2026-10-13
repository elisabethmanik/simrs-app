<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pendaftaran Pasien Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <strong>Data belum bisa disimpan.</strong>
                    <ul class="mt-2 list-disc ps-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form id="formPasien" action="{{ route('pasiens.store') }}" method="POST" class="space-y-4" novalidate>
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Rekam Medis (Auto)</label>
                            <input type="text" name="no_rm" value="{{ $noRmAuto }}" readonly class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm font-bold text-blue-600">
                            @error('no_rm') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK (wajib tepat 16 digit angka)</label>
                            <input id="nik" type="text" name="nik" value="{{ old('nik') }}" inputmode="numeric" autocomplete="off" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <p id="nikWarning" class="mt-1 text-xs"></p>
                            @error('nik') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap Pasien</label>
                        <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <p id="namaWarning" class="mt-1 text-xs"></p>
                        @error('nama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                                <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                            </select>
                            @error('jenis_kelamin') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" max="{{ now()->toDateString() }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <p id="tanggalWarning" class="mt-1 text-xs"></p>
                            @error('tanggal_lahir') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor HP / WA (10-13 digit)</label>
                            <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp') }}" inputmode="numeric" autocomplete="off" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <p id="hpWarning" class="mt-1 text-xs"></p>
                            @error('no_hp') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat') }}</textarea>
                        @error('alamat') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('pasiens.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Batal</a>
                        <button id="submitBtn" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold">Simpan Data Pasien</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formPasien');
            const nik = document.getElementById('nik');
            const hp = document.getElementById('no_hp');
            const nama = document.getElementById('nama');
            const tanggal = document.getElementById('tanggal_lahir');

            function showMessage(el, message, valid = false) {
                el.textContent = message;
                el.className = 'mt-1 text-xs ' + (valid ? 'text-green-600' : 'text-red-600');
            }

            function validateNik() {
                const value = nik.value.trim();
                if (!value) { showMessage(document.getElementById('nikWarning'), 'NIK wajib diisi.'); return false; }
                if (!/^\d+$/.test(value)) { showMessage(document.getElementById('nikWarning'), 'NIK hanya boleh berisi angka, tidak boleh ada huruf.'); return false; }
                if (value.length < 16) { showMessage(document.getElementById('nikWarning'), `NIK kurang ${16 - value.length} digit. NIK harus tepat 16 digit.`); return false; }
                if (value.length > 16) { showMessage(document.getElementById('nikWarning'), `NIK lebih ${value.length - 16} digit. NIK harus tepat 16 digit.`); return false; }
                showMessage(document.getElementById('nikWarning'), 'NIK valid: 16 digit.', true); return true;
            }

            function validateHp() {
                const value = hp.value.trim();
                if (!/^\d+$/.test(value)) { showMessage(document.getElementById('hpWarning'), 'Nomor HP hanya boleh berisi angka.'); return false; }
                if (value.length < 10 || value.length > 13) { showMessage(document.getElementById('hpWarning'), 'Nomor HP harus 10 sampai 13 digit.'); return false; }
                showMessage(document.getElementById('hpWarning'), 'Nomor HP valid.', true); return true;
            }

            function validateNama() {
                const value = nama.value.trim();
                if (value.length < 3) { showMessage(document.getElementById('namaWarning'), 'Nama minimal 3 karakter.'); return false; }
                if (/\d/.test(value)) { showMessage(document.getElementById('namaWarning'), 'Nama tidak boleh mengandung angka.'); return false; }
                showMessage(document.getElementById('namaWarning'), 'Nama valid.', true); return true;
            }

            function validateTanggal() {
                if (!tanggal.value) { showMessage(document.getElementById('tanggalWarning'), 'Tanggal lahir wajib diisi.'); return false; }
                const picked = new Date(tanggal.value + 'T00:00:00');
                const today = new Date(); today.setHours(0,0,0,0);
                if (picked > today) { showMessage(document.getElementById('tanggalWarning'), 'Tanggal lahir tidak boleh melebihi hari ini.'); return false; }
                showMessage(document.getElementById('tanggalWarning'), 'Tanggal lahir valid.', true); return true;
            }

            nik.addEventListener('input', validateNik);
            hp.addEventListener('input', validateHp);
            nama.addEventListener('input', validateNama);
            tanggal.addEventListener('change', validateTanggal);

            form.addEventListener('submit', function (event) {
                const valid = validateNik() & validateHp() & validateNama() & validateTanggal();
                if (!valid) {
                    event.preventDefault();
                    alert('Masih ada data yang tidak sesuai. Periksa pesan berwarna merah.');
                }
            });
        });
    </script>
</x-app-layout>
