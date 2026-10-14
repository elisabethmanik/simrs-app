<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl border border-gray-100 my-6">
        <!-- HEADER FORM -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h2 class="text-2xl font-black text-gray-800">SIMRS Cipta Medika</h2>
            <p class="text-sm text-gray-500 mt-1">Silakan masuk menggunakan akun Anda</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Input NIK -->
<div class="mt-4">
    <x-input-label for="nik" :value="__('NIK')" />
    <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required autofocus autocomplete="nik" />
    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
</div>
            <!-- Email / Username -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Email / Username</label>
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

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-xs">
                <label class="inline-flex items-center text-gray-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="ml-2">Ingat Saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-emerald-600 font-semibold hover:underline">Lupa Password?</a>
                @endif
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-md text-sm uppercase tracking-wider mt-2">
                Masuk Sistem
            </button>
        </form>

        <!-- Link Pendaftaran Khusus Pasien Baru (Di luar tag form utama agar tidak bentrok) -->
        <div class="text-center mt-6 pt-4 border-t border-gray-100">
            <span class="text-xs text-gray-500">Pasien baru belum punya akun? </span>
            <a href="{{ route('register.pasien') }}" class="text-xs font-bold text-emerald-600 hover:underline">
                Daftar Akun Berobat
            </a>
        </div>
    </div>
</x-guest-layout>