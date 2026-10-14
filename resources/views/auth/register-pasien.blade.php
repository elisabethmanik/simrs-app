<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl border border-gray-100 my-6">
        <!-- HEADER FORM -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="text-2xl font-black text-gray-800">Pendaftaran Akun Pasien</h2>
            <p class="text-sm text-gray-500 mt-1">RS Cipta Medika - Care & Medical Center</p>
        </div>

        <form method="POST" action="{{ route('register.pasien.store') }}" class="space-y-4">
            @csrf

            <!-- NIK -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">NIK (16 Digit)</label>
                <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16" autofocus
                    class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm shadow-sm"
                    placeholder="3171xxxxxxxxxxxx">
                <x-input-error :messages="$errors->get('nik')" class="mt-1" />
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Nama Lengkap Pasien</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm shadow-sm"
                    placeholder="Masukkan nama lengkap">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Email Aktif</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm shadow-sm"
                    placeholder="nama@email.com">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm shadow-sm"
                    placeholder="Minimal 8 karakter">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm shadow-sm"
                    placeholder="Ulangi password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-md text-sm uppercase tracking-wider mt-2">
                Daftar Sekarang
            </button>

            <!-- Link Kembali ke Login -->
            <div class="text-center mt-6 pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-500">Sudah punya akun pasien? </span>
                <a href="{{ route('login') }}" class="text-xs font-bold text-emerald-600 hover:underline">
                    Masuk di Sini
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>