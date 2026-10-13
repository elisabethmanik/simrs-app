<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-2xl border border-gray-100">
            
            <!-- Logo & Judul -->
            <div class="text-center mb-6">
                <a href="/" class="inline-block">
                    <x-application-logo class="w-16 h-16 fill-current text-blue-600 mx-auto" />
                </a>
                <h2 class="text-2xl font-bold text-gray-800 mt-3">SIMRS Cipta Medika</h2>
                <p class="text-sm text-gray-500">Silakan login untuk mengakses sistem</p>
            </div>

            <!-- Session Status Alert -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email / Username Address -->
                <div>
                    <x-input-label for="email" value="Email / Username" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                                  type="email" 
                                  name="email" 
                                  :value="old('email')" 
                                  required autofocus autocomplete="username" 
                                  placeholder="contoh: admin@simrs.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" 
                                  placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 flex justify-between items-center">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Tombol Submit -->
                <div class="mt-6">
                    <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 rounded-xl font-bold transition duration-200">
                        {{ __('Masuk Sistem') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Informasi Akun Uji Coba -->
            <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-gray-500">
                <p class="font-semibold text-gray-700 mb-1">Akun Akses Cepat:</p>
                <ul class="space-y-1 text-gray-500">
                    <li>👨‍⚕️ Dokter: <span class="font-mono text-gray-700">budi@simrs.com</span> (Pass: <span class="font-mono">password</span>)</li>
                    <li>🔑 Admin: <span class="font-mono text-gray-700">admin@simrs.com</span> (Pass: <span class="font-mono">password</span>)</li>
                </ul>
            </div>

        </div>
    </div>
</x-guest-layout>