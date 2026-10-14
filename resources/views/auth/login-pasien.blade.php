<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl border border-gray-100 my-6">
        <!-- HEADER FORM -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h2 class="text-2xl font-black text-gray-800">Portal Pasien</h2>
            <p class="text-sm text-gray-500 mt-1">RS Cipta Medika - Care & Medical Center</p>
        </div>

        <!-- Session Status (Notifikasi) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- FORM LOGIN PASIEN -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Email Pasien</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm shadow-sm"
                    placeholder="nama@email.com">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-sm shadow-sm"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-md text-sm uppercase tracking-wider mt-2">
                Masuk ke Portal Pasien
            </button>

            <!-- Opsi Daftar untuk Pasien Baru -->
            <div class="text-center mt-6 pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-500">Belum memiliki akun berobat? </span>
                <a href="{{ route('register.pasien') }}" class="text-xs font-bold text-emerald-600 hover:underline">
                    Daftar Akun Baru
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>