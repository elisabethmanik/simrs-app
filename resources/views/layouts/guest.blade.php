<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIMRS Cipta Medika') }}</title>

    <script>
        (function () {
            if (localStorage.getItem('simrs-theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();

        function toggleSimrsTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('simrs-theme', isDark ? 'dark' : 'light');
        }
    </script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html.dark body { background:#0f172a !important; color:#e5e7eb !important; }
        html.dark .bg-gray-100 { background:#0f172a !important; }
        html.dark .bg-white { background:#111827 !important; }
        html.dark .text-gray-900,
        html.dark .text-gray-800,
        html.dark .text-gray-700 { color:#f8fafc !important; }
        html.dark .text-gray-600,
        html.dark .text-gray-500 { color:#94a3b8 !important; }
        html.dark .border-gray-100,
        html.dark .border-gray-300 { border-color:#334155 !important; }
        html.dark input { background:#0f172a !important; color:#f8fafc !important; border-color:#475569 !important; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <button type="button" onclick="toggleSimrsTheme()"
            class="fixed top-4 right-4 z-50 w-10 h-10 rounded-full bg-white border border-gray-200 shadow flex items-center justify-center text-gray-700"
            title="Ganti mode terang / gelap">
        <span class="text-lg">◐</span>
    </button>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
