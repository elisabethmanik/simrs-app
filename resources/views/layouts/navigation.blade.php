<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link :href="route('pasiens.index')" :active="request()->routeIs('pasiens.*')">
                            {{ __('Data Pasien') }}
                        </x-nav-link>

                        <x-nav-link :href="route('pendaftarans.create')" :active="request()->routeIs('pendaftarans.create')">
                            {{ __('Pendaftaran') }}
                        </x-nav-link>

                        <x-nav-link :href="route('pendaftarans.index')" :active="request()->routeIs('pendaftarans.index')">
                            {{ __('Antrean') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->role === 'dokter')
                        <x-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')">
                            {{ __('Dashboard Dokter') }}
                        </x-nav-link>

                        <x-nav-link :href="route('pendaftarans.index')" :active="request()->routeIs('pendaftarans.index')">
                            {{ __('Antrean Pasien') }}
                        </x-nav-link>
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'dokter']))
                        <x-nav-link :href="route('rekam-medis.index')" :active="request()->routeIs('rekam-medis.*')">
                            {{ __('Rekam Medis') }}
                        </x-nav-link>
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'dokter', 'apoteker', 'farmasi']))
                        <x-nav-link :href="route('apotek.index')" :active="request()->routeIs('apotek.*')">
                            {{ in_array(auth()->user()->role, ['apoteker', 'farmasi']) ? __('Apotek / Resep') : __('Resep / Farmasi') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-2">
                <button type="button"
                        onclick="toggleSimrsTheme()"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-gray-200 text-gray-600 bg-white hover:bg-gray-50 transition"
                        title="Dark mode / Light mode">
                    <span class="text-lg">◐</span>
                </button>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <span>{{ Auth::user()->name }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded uppercase">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center gap-2 sm:hidden">
                <button type="button" onclick="toggleSimrsTheme()"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-md text-gray-500 hover:bg-gray-100">
                    ◐
                </button>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pasiens.index')" :active="request()->routeIs('pasiens.*')">Data Pasien</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pendaftarans.create')" :active="request()->routeIs('pendaftarans.create')">Pendaftaran</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pendaftarans.index')" :active="request()->routeIs('pendaftarans.index')">Antrean</x-responsive-nav-link>
            @endif

            @if(auth()->user()->role === 'dokter')
                <x-responsive-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')">Dashboard Dokter</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pendaftarans.index')" :active="request()->routeIs('pendaftarans.index')">Antrean Pasien</x-responsive-nav-link>
            @endif

            @if(in_array(auth()->user()->role, ['admin', 'dokter']))
                <x-responsive-nav-link :href="route('rekam-medis.index')" :active="request()->routeIs('rekam-medis.*')">
                    Rekam Medis
                </x-responsive-nav-link>
            @endif

            @if(in_array(auth()->user()->role, ['admin', 'dokter', 'apoteker', 'farmasi']))
                <x-responsive-nav-link :href="route('apotek.index')" :active="request()->routeIs('apotek.*')">Resep / Farmasi</x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 flex items-center justify-between">
                    <span>{{ Auth::user()->name }}</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded uppercase">{{ Auth::user()->role }}</span>
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
