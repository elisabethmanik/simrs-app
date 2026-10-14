<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RS Cipta Medika Duby - Care & Medical Center</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',

            theme: {
                extend: {
                    colors: {
                        emerald: {
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22'
                        },

                        slate: {
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617'
                        }
                    }
                }
            }
        }
    </script>

    {{-- DARK MODE --}}
    <script>
        (function () {
            const savedTheme = localStorage.getItem('simrs-theme');

            document.documentElement.classList.toggle(
                'dark',
                savedTheme === 'dark'
            );
        })();

        function updateSimrsThemeButton() {
            const isDark =
                document.documentElement.classList.contains('dark');

            document.querySelectorAll('[data-theme-icon]')
                .forEach((icon) => {
                    icon.textContent = isDark ? '☀' : '☾';
                });
        }

        function toggleSimrsTheme() {
            const html = document.documentElement;

            const isDark = html.classList.toggle('dark');

            localStorage.setItem(
                'simrs-theme',
                isDark ? 'dark' : 'light'
            );

            updateSimrsThemeButton();
        }

        document.addEventListener(
            'DOMContentLoaded',
            updateSimrsThemeButton
        );
    </script>

    <style>
        html,
        body {
            transition:
                background-color .2s ease,
                color .2s ease;
        }

        html.dark {
            color-scheme: dark;
        }
    </style>
</head>


<body
    class="
        min-h-screen
        flex flex-col justify-between
        font-sans antialiased
        bg-[#f8fbfa]
        text-slate-900
        dark:bg-slate-950
        dark:text-slate-100
        selection:bg-emerald-500
        selection:text-white
    "
>


    {{-- ========================================================= --}}
    {{-- TOP BAR --}}
    {{-- ========================================================= --}}

    <div
        class="
            relative z-20
            border-b
            border-emerald-100
            bg-emerald-50
            px-6 py-2.5
            text-xs
            text-emerald-800

            dark:border-emerald-900/60
            dark:bg-[#022c22]
            dark:text-emerald-200
        "
    >

        <div
            class="
                mx-auto
                flex max-w-7xl
                items-center justify-between
                gap-6
            "
        >

            <div class="flex items-center space-x-6">

                {{-- ADDRESS --}}
                <span class="flex items-center gap-1.5">

                    <svg
                        class="h-3.5 w-3.5 text-emerald-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998
                               1.998 0 01-2.827 0l-4.244-4.243a8
                               8 0 1111.314 0z"
                        ></path>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3
                               3 0 016 0z"
                        ></path>
                    </svg>

                    Jl. Jend. Sudirman No. 10, Jakarta Selatan

                </span>


                {{-- HOTLINE --}}
                <span
                    class="
                        hidden
                        items-center gap-1.5
                        md:flex
                    "
                >

                    <svg
                        class="h-3.5 w-3.5 text-emerald-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1
                               1 0 01.948.684l1.498 4.493a1
                               1 0 01-.502 1.21l-2.257
                               1.13a11.042 11.042 0 005.516
                               5.516l1.13-2.257a1 1 0
                               011.21-.502l4.493 1.498a1
                               1 0 01.684.949V19a2 2 0
                               01-2 2h-1C9.716 21 3 14.284
                               3 6V5z"
                        ></path>
                    </svg>

                    Hotline: (021) 570-3000

                </span>


                {{-- EMAIL --}}
                <span
                    class="
                        hidden
                        items-center gap-1.5
                        lg:flex
                    "
                >

                    <svg
                        class="h-3.5 w-3.5 text-emerald-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0
                               002.22 0L21 8M5 19h14a2
                               2 0 002-2V7a2 2 0 00-2-2H5a2
                               2 0 00-2 2v10a2 2 0 002 2z"
                        ></path>
                    </svg>

                    rsciptamedika@ciptamedika.id

                </span>

            </div>


            <div class="flex items-center gap-4">

                <span class="hidden sm:inline">
                    Selamat datang di RS Cipta Medika Duby
                </span>

                <span
                    class="
                        rounded
                        bg-emerald-700
                        px-2 py-0.5
                        text-[10px]
                        font-bold
                        text-white

                        dark:bg-emerald-800/80
                    "
                >
                    🇮🇩 ID
                </span>

            </div>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <header
        class="
            sticky top-0 z-50
            border-b
            border-emerald-100
            bg-white/95
            shadow-lg
            backdrop-blur-md

            dark:border-emerald-900/40
            dark:bg-slate-950/95
            dark:shadow-xl
        "
    >

        <div
            class="
                mx-auto flex
                h-20 max-w-7xl
                items-center justify-between
                px-6
            "
        >


            {{-- LOGO --}}
            <a
                href="{{ route('home') }}"
                class="group flex items-center space-x-3"
            >

                <div
                    class="
                        flex h-10 w-10
                        items-center justify-center
                        rounded-xl
                        bg-emerald-600
                        font-bold
                        text-2xl
                        text-white
                        shadow-lg
                        transition

                        group-hover:bg-emerald-500
                    "
                >

                    <svg
                        class="h-6 w-6 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2.5"
                            d="M12 4v16m8-8H4"
                        ></path>
                    </svg>

                </div>


                <div>

                    <span
                        class="
                            block
                            text-xl
                            font-extrabold
                            leading-none
                            tracking-tight
                            text-slate-900

                            dark:text-white
                        "
                    >
                        RS CIPTA MEDIKA DUBY
                    </span>

                    <span
                        class="
                            text-[10px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-emerald-500
                        "
                    >
                        Care & Medical Center
                    </span>

                </div>

            </a>



            {{-- NAVIGATION --}}
            <nav
                class="
                    hidden
                    items-center
                    space-x-8
                    text-sm
                    font-medium
                    md:flex
                "
            >

                <a
                    href="{{ route('home') }}"
                    class="
                        font-bold
                        text-emerald-600
                        transition
                        hover:text-emerald-500
                    "
                >
                    Beranda
                </a>


                {{-- FASILITAS DROPDOWN --}}
                <div class="group relative py-6">

                    <button
                        class="
                            flex items-center gap-1.5
                            text-slate-600
                            transition
                            hover:text-emerald-600
                            focus:outline-none

                            dark:text-slate-300
                            dark:hover:text-emerald-400
                        "
                    >

                        <span>
                            Fasilitas & Layanan
                        </span>

                        <svg
                            class="
                                h-4 w-4
                                transition-transform
                                duration-200
                                group-hover:rotate-180
                            "
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            ></path>
                        </svg>

                    </button>


                    {{-- MEGA MENU --}}
                    <div
                        class="
                            absolute left-1/2 top-full
                            z-50 hidden
                            -translate-x-1/2
                            pt-2
                            group-hover:block
                        "
                    >

                        <div
                            class="
                                grid w-[850px]
                                grid-cols-3 gap-6
                                rounded-2xl
                                border
                                border-emerald-700/60
                                bg-[#064e3b]
                                p-6
                                shadow-2xl
                            "
                        >


                            {{-- LAYANAN --}}
                            <div
                                class="
                                    col-span-2
                                    grid
                                    grid-cols-3
                                    gap-3
                                    text-xs
                                "
                            >

                                @foreach($layanan as $item)

                                    <a
                                        href="{{ route('layanan-penunjang.detail', $item['slug']) }}"
                                        class="
                                            group/item
                                            flex items-center
                                            gap-3
                                            rounded-xl
                                            border
                                            border-transparent
                                            p-2.5
                                            text-emerald-100
                                            transition

                                            hover:border-emerald-600/50
                                            hover:bg-emerald-900/90
                                            hover:text-white
                                        "
                                    >

                                        <div
                                            class="
                                                flex h-8 w-8
                                                shrink-0
                                                items-center justify-center
                                                rounded-lg
                                                border
                                                border-emerald-700/60
                                                bg-emerald-950/80
                                                text-emerald-400

                                                group-hover/item:text-emerald-300
                                            "
                                        >

                                            @if($item['slug'] == 'rawat-jalan')

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0
                                                           018 0zM12 14a7 7 0 00-7
                                                           7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg>

                                            @elseif($item['slug'] == 'rawat-inap')

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2
                                                           2 0 00-2 2v16m14 0h2m-2
                                                           0h-5m-9 0H3m2 0h5M9 7h1m-1
                                                           4h1m4-4h1m-1 4h1m-5
                                                           10v-5a1 1 0 011-1h2a1 1
                                                           0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>

                                            @elseif($item['slug'] == 'medical-check-up')

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2
                                                           2 0 002 2h10a2 2 0
                                                           002-2V7a2 2 0 00-2-2h-2M9
                                                           5a2 2 0 002 2h2a2 2 0
                                                           002-2M9 5a2 2 0 012-2h2a2
                                                           2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9
                                                           16h.01">
                                                    </path>
                                                </svg>

                                            @elseif($item['slug'] == 'hemodialisa')

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0
                                                           000 6.364L12
                                                           20.364l7.682-7.682a4.5
                                                           4.5 0
                                                           00-6.364-6.364L12
                                                           7.636l-1.318-1.318a4.5
                                                           4.5 0 00-6.364 0z">
                                                    </path>
                                                </svg>

                                            @elseif($item['slug'] == 'laboratorium')

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19.428 15.428a2 2 0
                                                           00-1.022-.547l-2.387-.477a6
                                                           6 0 00-3.86.517l-.318.158a6
                                                           6 0
                                                           01-3.86.517L6.05
                                                           15.21a2 2 0
                                                           00-1.806.547M8
                                                           4h8l-1
                                                           1v5.172a2 2 0
                                                           00.586 1.414l5
                                                           5c1.26 1.26.367
                                                           3.414-1.415
                                                           3.414H4.828c-1.782
                                                           0-2.674-2.154-1.414-3.414l5-5A2
                                                           2 0 009
                                                           10.172V5L8 4z">
                                                    </path>
                                                </svg>

                                            @elseif($item['slug'] == 'kamar-operasi')

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14.121
                                                           14.121L19 19m-7-7
                                                           7-7m-7 7l-2.879
                                                           2.879M12
                                                           12L9.121
                                                           9.121m0 0L4
                                                           4m5.121
                                                           5.121L4
                                                           14.243M12
                                                           12l2.879-2.879M12
                                                           12l-2.879 2.879">
                                                    </path>
                                                </svg>

                                            @elseif($item['slug'] == 'fisioterapi')

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 10V3L4 14h7v7l9-11h-7z">
                                                    </path>
                                                </svg>

                                            @else

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 18h.01M8 21h8a2
                                                           2 0 002-2V5a2 2 0
                                                           00-2-2H8a2 2 0
                                                           00-2 2v14a2 2 0
                                                           002 2z">
                                                    </path>
                                                </svg>

                                            @endif

                                        </div>

                                        <span class="font-semibold">
                                            {{ $item['nama'] }}
                                        </span>

                                    </a>

                                @endforeach

                            </div>


                            {{-- PREVIEW --}}
                            <div
                                class="
                                    flex flex-col justify-between
                                    rounded-xl
                                    border
                                    border-emerald-800/60
                                    bg-slate-900/90
                                    p-4
                                    shadow-inner
                                "
                            >

                                <div>

                                    <div
                                        class="
                                            mb-3 h-28
                                            overflow-hidden
                                            rounded-lg
                                            border
                                            border-emerald-700/40
                                            bg-cover
                                            bg-center
                                        "
                                        style="
                                            background-image:
                                            url('{{ $layanan[0]['img'] ?? 'https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=600&auto=format&fit=crop' }}');
                                        "
                                    >
                                    </div>

                                    <h4
                                        class="
                                            mb-2
                                            text-xs
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-white
                                        "
                                    >
                                        Fasilitas Penunjang
                                    </h4>

                                    <ul
                                        class="
                                            space-y-1
                                            text-[11px]
                                            text-slate-300
                                        "
                                    >
                                        <li>• Operating Theatre Modern</li>
                                        <li>• CT-Scan 128 Slice</li>
                                        <li>• NICU - PICU - ICU</li>
                                    </ul>

                                </div>


                                <a
                                    href="{{ route('pendaftaran-online.index') }}"
                                    class="
                                        mt-3 block
                                        border-t
                                        border-emerald-900/60
                                        pt-2
                                        text-xs
                                        font-bold
                                        text-emerald-400
                                        hover:underline
                                    "
                                >
                                    Buat Janji Online →
                                </a>

                            </div>

                        </div>

                    </div>

                </div>


                <a
                    href="#tentang"
                    class="
                        text-slate-600
                        transition
                        hover:text-emerald-600

                        dark:text-slate-300
                        dark:hover:text-emerald-400
                    "
                >
                    Tentang Kami
                </a>


                <a
                    href="#dokter"
                    class="
                        text-slate-600
                        transition
                        hover:text-emerald-600

                        dark:text-slate-300
                        dark:hover:text-emerald-400
                    "
                >
                    Jadwal Dokter
                </a>

            </nav>



            {{-- LOGIN + DARK MODE --}}
            <div class="flex items-center gap-2">

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="
                            rounded-xl
                            border
                            border-emerald-600
                            px-4 py-2.5
                            text-xs
                            font-bold
                            uppercase
                            tracking-wider
                            text-emerald-700
                            transition

                            hover:bg-emerald-700
                            hover:text-white

                            dark:border-emerald-700
                            dark:text-emerald-300
                            dark:hover:bg-emerald-800
                        "
                    >
                        Dashboard
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="
                            rounded-xl
                            border
                            border-emerald-600
                            px-4 py-2.5
                            text-xs
                            font-bold
                            uppercase
                            tracking-wider
                            text-emerald-700
                            transition

                            hover:bg-emerald-700
                            hover:text-white

                            dark:border-emerald-700
                            dark:text-emerald-300
                            dark:hover:bg-emerald-800
                        "
                    >
                        Login
                    </a>

                @endauth


                <button
                    type="button"
                    onclick="toggleSimrsTheme()"
                    class="
                        flex h-10 w-10
                        items-center justify-center
                        rounded-xl
                        border
                        border-emerald-200
                        bg-emerald-50
                        text-emerald-700
                        transition

                        hover:bg-emerald-100

                        dark:border-emerald-800
                        dark:bg-emerald-950/70
                        dark:text-emerald-300
                        dark:hover:bg-emerald-900
                    "
                    title="Dark mode / Light mode"
                    aria-label="Ganti mode tampilan"
                >
                    <span
                        data-theme-icon
                        class="text-lg leading-none"
                    >
                        ☾
                    </span>
                </button>

            </div>

        </div>

    </header>



    {{-- ========================================================= --}}
    {{-- HERO --}}
    {{-- ========================================================= --}}

    <section
        class="
            relative
            overflow-hidden
            border-b
            border-emerald-100
            bg-gradient-to-br
            from-emerald-50
            via-white
            to-teal-50
            px-6 py-20

            dark:border-emerald-900/30
            dark:from-slate-950
            dark:via-slate-900
            dark:to-[#032a23]
        "
    >

        {{-- DECORATION --}}
        <div
            class="
                pointer-events-none
                absolute -right-32 -top-32
                h-96 w-96
                rounded-full
                bg-emerald-200/40
                blur-3xl

                dark:bg-emerald-900/20
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute -bottom-32 left-20
                h-80 w-80
                rounded-full
                bg-teal-100/60
                blur-3xl

                dark:bg-emerald-950/30
            "
        ></div>


        <div
            class="
                relative z-10
                mx-auto
                grid max-w-7xl
                grid-cols-1
                items-center
                gap-12
                lg:grid-cols-12
            "
        >


            {{-- LEFT HERO --}}
            <div class="space-y-6 lg:col-span-7">

                {{-- FIX BADGE --}}
                <span
                    class="
                        inline-flex
                        items-center gap-2
                        rounded-full
                        border
                        border-emerald-200
                        bg-white/90
                        px-4 py-2
                        text-xs
                        font-bold
                        uppercase
                        tracking-wider
                        text-emerald-700
                        shadow-sm
                        backdrop-blur

                        dark:border-emerald-700/60
                        dark:bg-emerald-950/70
                        dark:text-emerald-300
                    "
                >

                    <span
                        class="
                            flex h-6 w-6
                            items-center justify-center
                            rounded-full
                            bg-emerald-600
                            text-[11px]
                            text-white
                        "
                    >
                        ✚
                    </span>

                    Rumah Sakit Standar Internasional

                </span>


                <h1
                    class="
                        max-w-4xl
                        text-4xl
                        font-black
                        leading-tight
                        tracking-tight
                        text-slate-900

                        md:text-6xl
                        dark:text-white
                    "
                >
                    Layanan Kesehatan
                    Terpadu

                    <span class="text-emerald-500">
                        &amp; Segenap Hati
                    </span>
                </h1>


                <p
                    class="
                        max-w-2xl
                        text-sm
                        leading-relaxed
                        text-slate-600

                        md:text-base
                        dark:text-slate-300
                    "
                >
                    RS Cipta Medika Duby menghadirkan fasilitas medis modern,
                    teknologi mutakhir, serta tim dokter spesialis berpengalaman
                    untuk memberikan pelayanan kesehatan terbaik bagi Anda dan keluarga.
                </p>


                <div
                    class="
                        flex flex-wrap
                        items-center
                        gap-4
                        pt-4
                    "
                >

                    <a
                        href="{{ route('pendaftaran-online.index') }}"
                        class="
                            rounded-xl
                            bg-emerald-600
                            px-8 py-4
                            text-sm
                            font-bold
                            uppercase
                            tracking-wide
                            text-white
                            shadow-xl
                            shadow-emerald-600/20
                            transition

                            hover:-translate-y-0.5
                            hover:bg-emerald-500
                            hover:shadow-emerald-500/30
                        "
                    >
                        Pendaftaran Online Pasien
                    </a>


                    {{-- FIX WHATSAPP LIGHT MODE --}}
                    <a
                        href="https://wa.me/62811901874"
                        target="_blank"
                        class="
                            flex items-center
                            gap-2
                            rounded-xl
                            border
                            border-emerald-300
                            bg-white/80
                            px-6 py-4
                            text-sm
                            font-bold
                            text-emerald-700
                            shadow-sm
                            transition

                            hover:bg-emerald-50
                            hover:text-emerald-800

                            dark:border-emerald-700/80
                            dark:bg-transparent
                            dark:text-emerald-300
                            dark:hover:bg-emerald-950
                        "
                    >

                        <svg
                            class="h-4 w-4 text-emerald-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 12h.01M12 12h.01M16
                                   12h.01M21 12c0 4.418-4.03
                                   8-9 8a9.863 9.863 0
                                   01-4.255-.949L3
                                   20l1.395-3.72C3.512
                                   15.042 3 13.574 3
                                   12c0-4.418 4.03-8
                                   9-8s9 3.582 9 8z"
                            ></path>
                        </svg>

                        Chat WhatsApp

                    </a>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- LAYANAN CEPAT --}}
            {{-- ================================================= --}}

            <div class="lg:col-span-5">

                <div
                    class="
                        rounded-[30px]
                        border
                        border-emerald-100
                        bg-white/95
                        p-6
                        shadow-[0_24px_60px_rgba(15,118,110,0.12)]
                        backdrop-blur

                        md:p-8

                        dark:border-emerald-800/60
                        dark:bg-slate-900/95
                        dark:shadow-2xl
                    "
                >


                    <div
                        class="
                            mb-6
                            border-b
                            border-emerald-100
                            pb-4

                            dark:border-emerald-900/60
                        "
                    >

                        <h3
                            class="
                                text-lg
                                font-extrabold
                                tracking-tight
                                text-slate-900

                                dark:text-white
                            "
                        >
                            Layanan Cepat Tanggap
                        </h3>

                        <p
                            class="
                                mt-1
                                text-[11px]
                                text-slate-500

                                dark:text-slate-400
                            "
                        >
                            Akses bantuan medis dan informasi rumah sakit dengan cepat.
                        </p>

                    </div>


                    <div class="space-y-4 text-xs">


                        {{-- IGD --}}
                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                gap-4
                                rounded-2xl
                                border
                                border-red-100
                                bg-red-50/80
                                p-4
                                transition

                                hover:border-red-200
                                hover:bg-red-50

                                dark:border-red-900/40
                                dark:bg-red-950/20
                            "
                        >

                            <div
                                class="
                                    flex items-center gap-3
                                "
                            >

                                <div
                                    class="
                                        flex h-10 w-10
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-xl
                                        bg-red-100
                                        text-red-600

                                        dark:bg-red-950/80
                                        dark:text-red-400
                                    "
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032
                                               2.032 0 0118
                                               14.158V11a6.002
                                               6.002 0
                                               00-4-5.659V5a2
                                               2 0
                                               10-4
                                               0v.341C7.67
                                               6.165 6
                                               8.388 6
                                               11v3.159c0
                                               .538-.214
                                               1.055-.595
                                               1.436L4
                                               17h5m6 0v1a3
                                               3 0 11-6
                                               0v-1m6 0H9"
                                        ></path>
                                    </svg>

                                </div>


                                <div>

                                    <h4
                                        class="
                                            font-bold
                                            text-slate-900

                                            dark:text-white
                                        "
                                    >
                                        IGD & Ambulans 24 Jam
                                    </h4>

                                    <p
                                        class="
                                            mt-0.5
                                            text-[11px]
                                            text-slate-500

                                            dark:text-slate-400
                                        "
                                    >
                                        Siaga panggil darurat kapan saja
                                    </p>

                                </div>

                            </div>


                            <a
                                href="tel:0215703000"
                                class="
                                    shrink-0
                                    rounded-xl
                                    bg-red-600
                                    px-4 py-2
                                    text-[10px]
                                    font-bold
                                    uppercase
                                    text-white
                                    shadow-sm
                                    transition

                                    hover:bg-red-500
                                "
                            >
                                Panggil
                            </a>

                        </div>



                        {{-- CUSTOMER SERVICE --}}
                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                gap-4
                                rounded-2xl
                                border
                                border-emerald-100
                                bg-emerald-50/70
                                p-4
                                transition

                                hover:border-emerald-200
                                hover:bg-emerald-50

                                dark:border-emerald-800/40
                                dark:bg-emerald-950/30
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-3
                                "
                            >

                                <div
                                    class="
                                        flex h-10 w-10
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-xl
                                        bg-emerald-100
                                        text-emerald-700

                                        dark:bg-emerald-950/80
                                        dark:text-emerald-400
                                    "
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16
                                               10h.01M9 16H5a2
                                               2 0 01-2-2V6a2
                                               2 0 012-2h14a2
                                               2 0 012 2v8a2
                                               2 0 01-2
                                               2h-5l-5 5v-5z"
                                        ></path>
                                    </svg>

                                </div>


                                <div>

                                    <h4
                                        class="
                                            font-bold
                                            text-slate-900

                                            dark:text-white
                                        "
                                    >
                                        Customer Service
                                    </h4>

                                    <p
                                        class="
                                            mt-0.5
                                            text-[11px]
                                            text-slate-500

                                            dark:text-slate-400
                                        "
                                    >
                                        Informasi jadwal &amp; konsultasi
                                    </p>

                                </div>

                            </div>


                            <a
                                href="https://wa.me/62811901874"
                                target="_blank"
                                class="
                                    shrink-0
                                    font-bold
                                    text-emerald-600
                                    transition

                                    hover:text-emerald-700

                                    dark:text-emerald-400
                                    dark:hover:text-emerald-300
                                "
                            >
                                0811-901-874
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- LAYANAN PENUNJANG --}}
    {{-- ========================================================= --}}

    <section
        id="fasilitas"
        class="
            mx-auto
            max-w-7xl
            space-y-10
            px-6 py-16
        "
    >

        <div
            class="
                mx-auto
                max-w-2xl
                space-y-2
                text-center
            "
        >

            <span
                class="
                    text-xs
                    font-bold
                    uppercase
                    tracking-widest
                    text-emerald-500
                "
            >
                FASILITAS UTAMA
            </span>

            <h2
                class="
                    text-3xl
                    font-extrabold
                    text-slate-900

                    dark:text-white
                "
            >
                Layanan Penunjang Medis
            </h2>

            <p
                class="
                    text-xs
                    text-slate-500

                    md:text-sm
                    dark:text-slate-400
                "
            >
                Pilih fasilitas medis di bawah ini untuk melihat detail
                informasi dan jadwal pelayanan.
            </p>

        </div>



        <div
            class="
                grid
                grid-cols-1
                gap-6
                sm:grid-cols-2
                lg:grid-cols-4
            "
        >

            @foreach($layanan as $item)

                <a
                    href="{{ route('layanan-penunjang.detail', $item['slug']) }}"
                    class="
                        group
                        block
                        overflow-hidden
                        rounded-2xl
                        border
                        border-emerald-100
                        bg-white
                        shadow-lg
                        transition
                        duration-300

                        hover:-translate-y-1
                        hover:border-emerald-500/80
                        hover:shadow-xl

                        dark:border-emerald-900/50
                        dark:bg-slate-900
                    "
                >

                    <div
                        class="
                            relative
                            h-40
                            bg-cover
                            bg-center
                        "
                        style="
                            background-image:
                            url('{{ $item['img'] }}');
                        "
                    >

                        <div
                            class="
                                absolute inset-0
                                bg-gradient-to-t
                                from-slate-950
                                via-slate-950/40
                                to-transparent
                            "
                        ></div>


                        <div
                            class="
                                absolute left-3 top-3
                                rounded-xl
                                border
                                border-emerald-700/50
                                bg-slate-950/80
                                p-2
                                text-emerald-400
                            "
                        >

                            @if($item['slug'] == 'rawat-jalan')

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0
                                           018 0zM12 14a7 7 0 00-7
                                           7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>

                            @elseif($item['slug'] == 'rawat-inap')

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2
                                           2 0 00-2 2v16m14 0h2m-2
                                           0h-5m-9 0H3m2 0h5M9
                                           7h1m-1 4h1m4-4h1m-1
                                           4h1m-5 10v-5a1 1
                                           0 011-1h2a1 1 0
                                           011 1v5m-4 0h4">
                                    </path>
                                </svg>

                            @elseif($item['slug'] == 'medical-check-up')

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2
                                           2v12a2 2 0 002
                                           2h10a2 2 0 002-2V7a2
                                           2 0 00-2-2h-2M9 5a2
                                           2 0 002 2h2a2 2 0
                                           002-2M9 5a2 2 0
                                           012-2h2a2 2 0
                                           012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>

                            @elseif($item['slug'] == 'hemodialisa')

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0
                                           000 6.364L12
                                           20.364l7.682-7.682a4.5
                                           4.5 0 00-6.364-6.364L12
                                           7.636l-1.318-1.318a4.5
                                           4.5 0 00-6.364 0z">
                                    </path>
                                </svg>

                            @elseif($item['slug'] == 'laboratorium')

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.428 15.428a2 2 0
                                           00-1.022-.547l-2.387-.477a6
                                           6 0 00-3.86.517l-.318.158a6
                                           6 0
                                           01-3.86.517L6.05
                                           15.21a2 2 0
                                           00-1.806.547M8
                                           4h8l-1
                                           1v5.172a2 2 0
                                           00.586 1.414l5
                                           5c1.26 1.26.367
                                           3.414-1.415
                                           3.414H4.828c-1.782
                                           0-2.674-2.154-1.414-3.414l5-5A2
                                           2 0 009
                                           10.172V5L8 4z">
                                    </path>
                                </svg>

                            @elseif($item['slug'] == 'kamar-operasi')

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.121 14.121L19
                                           19m-7-7 7-7m-7
                                           7l-2.879
                                           2.879M12
                                           12L9.121
                                           9.121m0 0L4
                                           4m5.121
                                           5.121L4
                                           14.243M12
                                           12l2.879-2.879M12
                                           12l-2.879 2.879">
                                    </path>
                                </svg>

                            @elseif($item['slug'] == 'fisioterapi')

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z">
                                    </path>
                                </svg>

                            @else

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2
                                           2 0 002-2V5a2
                                           2 0 00-2-2H8a2
                                           2 0 00-2
                                           2v14a2 2 0 002
                                           2z">
                                    </path>
                                </svg>

                            @endif

                        </div>

                    </div>


                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            p-5
                        "
                    >

                        <h3
                            class="
                                text-sm
                                font-bold
                                text-slate-900
                                transition

                                group-hover:text-emerald-600

                                dark:text-white
                                dark:group-hover:text-emerald-400
                            "
                        >
                            {{ $item['nama'] }}
                        </h3>

                        <span
                            class="
                                text-xs
                                text-emerald-500
                                transition
                                group-hover:translate-x-1
                            "
                        >
                            →
                        </span>

                    </div>

                </a>

            @endforeach

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- POLIKLINIK --}}
    {{-- ========================================================= --}}

    <section
        id="dokter"
        class="
            space-y-10
            border-t
            border-emerald-100
            bg-emerald-50/60
            px-6 py-16

            dark:border-emerald-900/40
            dark:bg-slate-900/60
        "
    >

        <div
            class="
                mx-auto
                max-w-7xl
                space-y-10
            "
        >

            <div
                class="
                    mx-auto
                    max-w-2xl
                    space-y-2
                    text-center
                "
            >

                <span
                    class="
                        text-xs
                        font-bold
                        uppercase
                        tracking-widest
                        text-emerald-500
                    "
                >
                    SPESIALISASI DOKTER
                </span>


                <h2
                    class="
                        text-3xl
                        font-extrabold
                        text-slate-900

                        dark:text-white
                    "
                >
                    Poliklinik Spesialis
                </h2>


                <p
                    class="
                        text-xs
                        text-slate-500

                        md:text-sm
                        dark:text-slate-400
                    "
                >
                    Ditangani oleh tim dokter spesialis dan konsultan
                    berpengalaman di bidangnya.
                </p>

            </div>


            <div
                class="
                    grid
                    grid-cols-2
                    gap-4
                    sm:grid-cols-3
                    md:grid-cols-4
                    lg:grid-cols-6
                "
            >

                @foreach($listPoli as $poli)

                    <a
                        href="{{ route('spesialis.show', $poli['slug']) }}"
                        class="
                            group
                            block
                            overflow-hidden
                            rounded-xl
                            border
                            border-emerald-100
                            bg-white
                            text-center
                            shadow-md
                            transition

                            hover:border-emerald-500/60
                            hover:bg-emerald-50

                            dark:border-emerald-900/50
                            dark:bg-slate-950
                            dark:hover:bg-slate-900
                        "
                    >

                        <div
                            class="
                                relative
                                h-28
                                bg-cover
                                bg-center
                            "
                            style="
                                background-image:
                                url('{{ $poli['img'] }}');
                            "
                        >

                            <div
                                class="
                                    absolute inset-0
                                    bg-gradient-to-t
                                    from-slate-950
                                    via-slate-950/40
                                    to-transparent
                                "
                            ></div>


                            <div
                                class="
                                    absolute
                                    bottom-2 left-1/2
                                    flex h-8 w-8
                                    -translate-x-1/2
                                    items-center justify-center
                                    rounded-lg
                                    border
                                    border-emerald-700/60
                                    bg-emerald-950/90
                                    text-emerald-400
                                    shadow-lg
                                    transition

                                    group-hover:bg-emerald-600
                                    group-hover:text-white
                                "
                            >

                                @if(str_contains($poli['slug'], 'anak'))

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.828 14.828a4 4 0
                                               01-5.656 0M9
                                               10h.01M15
                                               10h.01M21
                                               12a9 9 0
                                               11-18 0 9
                                               9 0 0118 0z">
                                        </path>
                                    </svg>

                                @elseif(str_contains($poli['slug'], 'gigi'))

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5z">
                                        </path>
                                    </svg>

                                @elseif(str_contains($poli['slug'], 'jantung'))

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5
                                               0 000 6.364L12
                                               20.364l7.682-7.682a4.5
                                               4.5 0
                                               00-6.364-6.364L12
                                               7.636l-1.318-1.318a4.5
                                               4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>

                                @elseif(str_contains($poli['slug'], 'mata'))

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0
                                               11-6 0 3 3
                                               0 016 0z">
                                        </path>

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732
                                               7.943 7.523
                                               5 12 5c4.478
                                               0 8.268
                                               2.943 9.542
                                               7-1.274 4.057-5.064
                                               7-9.542 7-4.477
                                               0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>

                                @elseif(str_contains($poli['slug'], 'bedah'))

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.121
                                               14.121L19
                                               19m-7-7
                                               7-7m-7
                                               7l-2.879
                                               2.879M12
                                               12L9.121
                                               9.121m0 0L4
                                               4m5.121
                                               5.121L4
                                               14.243M12
                                               12l2.879-2.879M12
                                               12l-2.879 2.879">
                                        </path>
                                    </svg>

                                @elseif(
                                    str_contains($poli['slug'], 'saraf')
                                    || str_contains($poli['slug'], 'jiwa')
                                )

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.663 17h4.673M12
                                               3v1m6.364
                                               1.636l-.707.707M21
                                               12h-1M4
                                               12H3m3.343-5.657l-.707-.707m2.828
                                               9.9a5 5 0
                                               117.072
                                               0l-.548.547A3.374
                                               3.374 0
                                               0014
                                               18.469V19a2
                                               2 0
                                               11-4
                                               0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                        </path>
                                    </svg>

                                @elseif(str_contains($poli['slug'], 'gizi'))

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 6l3 1m0
                                               0l-3 9a5.002
                                               5.002 0
                                               006.001 0M6
                                               7l3 9M6
                                               7l6-2m6
                                               2l3-1m-3
                                               1l-3 9a5.002
                                               5.002 0
                                               006.001 0M18
                                               7l3 9m-3-9l-6-2m0-2v2m0
                                               16V5m0
                                               16H9m3
                                               0h3">
                                        </path>
                                    </svg>

                                @else

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0
                                               11-8 0 4 4
                                               0 018
                                               0zM12
                                               14a7 7 0
                                               00-7
                                               7h14a7 7
                                               0 00-7-7z">
                                        </path>
                                    </svg>

                                @endif

                            </div>

                        </div>


                        <div class="p-3">

                            <h4
                                class="
                                    text-xs
                                    font-bold
                                    leading-tight
                                    text-slate-800
                                    transition

                                    group-hover:text-emerald-600

                                    dark:text-slate-200
                                    dark:group-hover:text-emerald-400
                                "
                            >
                                {{ $poli['nama'] }}
                            </h4>

                        </div>

                    </a>

                @endforeach

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer
        class="
            relative z-10
            border-t
            border-emerald-900/80
            bg-[#044e42]
            px-6 py-12
            text-white
        "
    >

        <div
            class="
                mx-auto
                grid max-w-7xl
                grid-cols-1
                gap-8
                text-xs
                md:grid-cols-3
            "
        >


            {{-- SOCIAL --}}
            <div class="space-y-4">

                <h4
                    class="
                        text-xs
                        font-bold
                        uppercase
                        tracking-wider
                        text-emerald-200
                    "
                >
                    Sosial Media Kami
                </h4>


                <div
                    class="
                        flex
                        items-center
                        space-x-3
                    "
                >

                    <a
                        href="#"
                        class="
                            flex h-8 w-8
                            items-center
                            justify-center
                            rounded-lg
                            bg-emerald-900/80
                            text-emerald-300
                            transition

                            hover:bg-emerald-600
                        "
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 12a9 9 0
                                   01-9 9m9-9a9
                                   9 0 00-9-9m9
                                   9H3m9 9a9
                                   9 0 01-9-9m9
                                   9c1.657 0-3-4.03
                                   3-9s-1.343-9-3-9m0
                                   18c-1.657
                                   0-3-4.03-3-9s1.343-9
                                   3-9m-9 9a9
                                   9 0 019-9"
                            ></path>
                        </svg>

                    </a>


                    <a
                        href="#"
                        class="
                            flex h-8 w-8
                            items-center
                            justify-center
                            rounded-lg
                            bg-emerald-900/80
                            text-emerald-300
                            transition

                            hover:bg-emerald-600
                        "
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 9a2 2 0
                                   012-2h.93a2
                                   2 0 001.664-.89l.812-1.22A2
                                   2 0 0110.07
                                   4h3.86a2 2 0
                                   011.664.89l.812
                                   1.22A2 2 0
                                   0018.07
                                   7H19a2 2 0
                                   012 2v9a2 2
                                   0 01-2 2H5a2
                                   2 0 01-2-2V9z"
                            ></path>
                        </svg>

                    </a>

                </div>

            </div>



            {{-- CONTACT --}}
            <div class="space-y-3">

                <h4
                    class="
                        text-xs
                        font-bold
                        uppercase
                        tracking-wider
                        text-emerald-200
                    "
                >
                    Hubungi Kami
                </h4>

                <p class="text-emerald-100">
                    📍 Jl. Jend. Sudirman No. 10,
                    Jakarta Selatan, DKI Jakarta 12740
                </p>

                <p class="text-emerald-100">
                    📞 (021) 570-3000
                </p>

                <p class="text-emerald-100">
                    ✉️ rsciptamedika@ciptamedika.id
                </p>

            </div>



            {{-- 24/7 --}}
            <div class="space-y-3">

                <h4
                    class="
                        text-xs
                        font-bold
                        uppercase
                        tracking-wider
                        text-emerald-200
                    "
                >
                    Layanan 24/7
                </h4>


                <div
                    class="
                        flex
                        items-center
                        justify-between
                        rounded-xl
                        border
                        border-emerald-700/50
                        bg-emerald-900/60
                        p-3
                    "
                >

                    <span>
                        Customer Service
                    </span>

                    <span
                        class="
                            font-bold
                            text-emerald-300
                        "
                    >
                        0811-901-874
                    </span>

                </div>


                <div
                    class="
                        flex
                        items-center
                        justify-between
                        rounded-xl
                        border
                        border-emerald-700/50
                        bg-emerald-900/60
                        p-3
                    "
                >

                    <span>
                        IGD &amp; Ambulans
                    </span>

                    <span
                        class="
                            font-bold
                            text-emerald-300
                        "
                    >
                        (021) 570-3000
                    </span>

                </div>

            </div>

        </div>


        <div
            class="
                mt-8
                border-t
                border-emerald-800/60
                pt-6
                text-center
                text-[11px]
                text-emerald-200
            "
        >
            Copyright &copy; {{ date('Y') }}
            RS CIPTA MEDIKA DUBY.
            All Rights Reserved.
        </div>

    </footer>



    {{-- ========================================================= --}}
    {{-- FLOATING IGD --}}
    {{-- ========================================================= --}}

    <a
        href="tel:0215703000"
        class="
            fixed
            bottom-6 right-6
            z-50
            flex
            items-center
            gap-2.5
            rounded-full
            border-2
            border-white/25
            bg-red-600
            px-5 py-3.5
            text-xs
            font-black
            text-white
            shadow-2xl
            transition
            transform

            hover:scale-105
            hover:bg-red-500
        "
    >

        <span class="animate-pulse">
            🚨
        </span>

        <span>
            IGD 24 Jam
        </span>

    </a>

</body>
</html>