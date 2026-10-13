<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIMRS Cipta Medika') }}</title>

    <script>
        (function () {
            const savedTheme = localStorage.getItem('simrs-theme');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();

        function toggleSimrsTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('simrs-theme', isDark ? 'dark' : 'light');
            window.dispatchEvent(new CustomEvent('simrs-theme-changed', { detail: { isDark } }));
        }
    </script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html.dark body,
        html.dark .simrs-root,
        html.dark .min-h-screen.bg-gray-100 {
            background: #0f172a !important;
            color: #e5e7eb !important;
        }

        html.dark .bg-white { background-color: #111827 !important; }
        html.dark .bg-gray-50 { background-color: #1f2937 !important; }
        html.dark .bg-gray-100 { background-color: #0f172a !important; }
        html.dark .border-gray-100,
        html.dark .border-gray-200,
        html.dark .border-gray-300 { border-color: #334155 !important; }

        html.dark .text-gray-900,
        html.dark .text-gray-800,
        html.dark .text-gray-700 { color: #f1f5f9 !important; }
        html.dark .text-gray-600,
        html.dark .text-gray-500,
        html.dark .text-gray-400 { color: #94a3b8 !important; }

        html.dark input,
        html.dark select,
        html.dark textarea {
            background-color: #0f172a !important;
            border-color: #475569 !important;
            color: #f8fafc !important;
        }

        html.dark input::placeholder,
        html.dark textarea::placeholder { color: #64748b !important; }

        html.dark table tbody tr:hover { background-color: #172033 !important; }
        html.dark .shadow,
        html.dark .shadow-sm,
        html.dark .shadow-md { box-shadow: none !important; }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="simrs-root min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
