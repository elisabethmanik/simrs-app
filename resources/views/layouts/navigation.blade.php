@php
    $user = Auth::user();

    $roleLabel = match($user->role) {
        'admin' => 'Administrator',
        'dokter' => 'Dokter',
        'apoteker' => 'Farmasi',
        default => ucfirst($user->role),
    };

    $roleColor = match($user->role) {
        'admin' => '#0f766e',
        'dokter' => '#2563eb',
        'apoteker' => '#9333ea',
        default => '#087f69',
    };
@endphp

<nav
    x-data="{ open: false, profileOpen: false }"
    class="sticky top-0 z-50 border-b border-[#dcebe6] bg-white/90 backdrop-blur-xl"
>

    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">

        <div class="h-[78px] flex items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-10">

                {{-- BRAND --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 shrink-0">

                    <div
                        class="w-11 h-11 rounded-2xl bg-[#087f69] text-white
                               flex items-center justify-center
                               shadow-[0_10px_25px_rgba(8,127,105,.22)]"
                    >
                        <svg class="w-6 h-6"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="M12 21s-7-4.35-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.65-7 10-7 10Z"/>
                            <path d="M9 12h2l1-2 2 4 1-2h2"/>
                        </svg>
                    </div>

                    <div class="hidden sm:block leading-tight">
                        <p class="font-extrabold text-[15px] tracking-tight text-[#17332d]">
                            Cipta Medika Duby
                        </p>

                        <p class="text-[9px] uppercase tracking-[.15em] text-[#7e938c] mt-1">
                            Hospital Information System
                        </p>
                    </div>

                </a>

                {{-- DESKTOP MENU --}}
                <div class="hidden lg:flex items-center gap-2">

                    {{-- DASHBOARD --}}
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2.5 rounded-xl text-[12px] font-semibold transition
                       {{ request()->routeIs('dashboard')
                            ? 'bg-[#e4f6f0] text-[#087f69]'
                            : 'text-[#667d76] hover:bg-[#f1f8f5] hover:text-[#087f69]' }}">
                        Dashboard
                    </a>

                    {{-- ADMIN --}}
                    @if($user->role === 'admin')

                        <a href="{{ route('pasiens.index') }}"
                           class="px-4 py-2.5 rounded-xl text-[12px] font-semibold transition
                           {{ request()->routeIs('pasiens.*')
                                ? 'bg-[#e4f6f0] text-[#087f69]'
                                : 'text-[#667d76] hover:bg-[#f1f8f5] hover:text-[#087f69]' }}">
                            Data Pasien
                        </a>

                        <a href="{{ route('pendaftarans.index') }}"
                           class="px-4 py-2.5 rounded-xl text-[12px] font-semibold transition
                           {{ request()->routeIs('pendaftarans.*')
                                ? 'bg-[#e4f6f0] text-[#087f69]'
                                : 'text-[#667d76] hover:bg-[#f1f8f5] hover:text-[#087f69]' }}">
                            Pendaftaran
                        </a>

                    @endif

                    {{-- DOKTER --}}
                    @if(in_array($user->role, ['admin', 'dokter']))

                        <a href="{{ route('rekam-medis.index') }}"
                           class="px-4 py-2.5 rounded-xl text-[12px] font-semibold transition
                           {{ request()->routeIs('rekam-medis.*')
                                ? 'bg-[#e4f6f0] text-[#087f69]'
                                : 'text-[#667d76] hover:bg-[#f1f8f5] hover:text-[#087f69]' }}">
                            Pemeriksaan / RME
                        </a>

                    @endif

                    {{-- FARMASI --}}
                    @if(in_array($user->role, ['admin', 'apoteker']))

                        <a href="{{ route('apotek.index') }}"
                           class="px-4 py-2.5 rounded-xl text-[12px] font-semibold transition
                           {{ request()->routeIs('apotek.*')
                                ? 'bg-[#e4f6f0] text-[#087f69]'
                                : 'text-[#667d76] hover:bg-[#f1f8f5] hover:text-[#087f69]' }}">
                            Farmasi
                        </a>

                    @endif

                </div>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-3">

                {{-- BACK TO PUBLIC WEBSITE --}}
                <a href="{{ url('/') }}"
                   class="hidden md:inline-flex items-center gap-2
                          px-4 py-2.5 rounded-xl
                          border border-[#dcebe6]
                          text-[11px] font-semibold text-[#60766f]
                          hover:bg-[#f3faf7]
                          transition">
                    <svg class="w-4 h-4"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <path d="M3 11 12 4l9 7"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>

                    Website
                </a>

                {{-- PROFILE --}}
                <div class="relative hidden sm:block">

                    <button
                        @click="profileOpen = !profileOpen"
                        class="flex items-center gap-3
                               pl-2 pr-3 py-2
                               rounded-2xl
                               hover:bg-[#f2f9f6]
                               transition"
                    >

                        <div class="w-10 h-10 rounded-xl bg-[#e4f6f0]
                                    flex items-center justify-center
                                    text-[#087f69] font-extrabold text-sm">

                            {{ strtoupper(substr($user->name, 0, 1)) }}

                        </div>

                        <div class="text-left hidden md:block">
                            <p class="text-[11px] font-bold text-[#17332d] max-w-[140px] truncate">
                                {{ $user->name }}
                            </p>

                            <p class="text-[9px] font-bold mt-1"
                               style="color: {{ $roleColor }}">
                                {{ $roleLabel }}
                            </p>
                        </div>

                        <svg class="w-4 h-4 text-[#849890]"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>

                    </button>

                    {{-- DROPDOWN --}}
                    <div
                        x-cloak
                        x-show="profileOpen"
                        @click.outside="profileOpen = false"
                        x-transition
                        class="absolute right-0 mt-3 w-56
                               bg-white rounded-2xl border border-[#dcebe6]
                               shadow-[0_20px_60px_rgba(28,74,63,.13)]
                               overflow-hidden"
                    >

                        <div class="p-4 border-b border-[#eef4f2]">
                            <p class="text-xs font-bold text-[#17332d]">
                                {{ $user->name }}
                            </p>

                            <p class="text-[10px] text-[#82958f] mt-1 truncate">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div class="p-2">

                            <a href="{{ route('profile.edit') }}"
                               class="block px-3 py-2.5 rounded-xl
                                      text-[11px] font-semibold text-[#526b64]
                                      hover:bg-[#f0f8f5]">
                                Profile Saya
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                        class="w-full text-left px-3 py-2.5 rounded-xl
                                               text-[11px] font-semibold text-red-500
                                               hover:bg-red-50">
                                    Logout
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

                {{-- MOBILE HAMBURGER --}}
                <button
                    @click="open = !open"
                    class="lg:hidden w-10 h-10 rounded-xl border border-[#dcebe6]
                           flex items-center justify-center text-[#527068]"
                >

                    <svg x-show="!open"
                         class="w-5 h-5"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <svg x-cloak
                         x-show="open"
                         class="w-5 h-5"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <path d="M6 6l12 12M18 6 6 18"/>
                    </svg>

                </button>

            </div>

        </div>
    </div>

    {{-- MOBILE --}}
    <div
        x-cloak
        x-show="open"
        x-transition
        class="lg:hidden border-t border-[#edf3f1] bg-white"
    >

        <div class="px-4 py-4 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl
                      text-sm font-semibold
                      {{ request()->routeIs('dashboard')
                        ? 'bg-[#e4f6f0] text-[#087f69]'
                        : 'text-[#5d756e]' }}">
                Dashboard
            </a>

            @if($user->role === 'admin')

                <a href="{{ route('pasiens.index') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-semibold text-[#5d756e]">
                    Data Pasien
                </a>

                <a href="{{ route('pendaftarans.index') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-semibold text-[#5d756e]">
                    Pendaftaran Poli
                </a>

            @endif

            @if(in_array($user->role, ['admin', 'dokter']))

                <a href="{{ route('rekam-medis.index') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-semibold text-[#5d756e]">
                    Pemeriksaan / RME
                </a>

            @endif

            @if(in_array($user->role, ['admin', 'apoteker']))

                <a href="{{ route('apotek.index') }}"
                   class="block px-4 py-3 rounded-xl text-sm font-semibold text-[#5d756e]">
                    Farmasi / Apotek
                </a>

            @endif

            <div class="border-t border-[#edf3f1] pt-3 mt-3">

                <p class="px-4 text-xs font-bold text-[#17332d]">
                    {{ $user->name }}
                </p>

                <p class="px-4 mt-1 text-[10px] text-[#80938d]">
                    {{ $user->email }}
                </p>

                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-3 mt-2 rounded-xl text-sm text-[#5d756e]">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="w-full text-left px-4 py-3 rounded-xl
                               text-sm font-semibold text-red-500"
                    >
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</nav>