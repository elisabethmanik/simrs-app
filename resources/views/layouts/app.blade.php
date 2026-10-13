<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RS Cipta Medika Duby') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #087f69;
            --primary-dark: #056653;
            --primary-soft: #e4f6f0;
            --surface: #f5faf8;
            --text: #17332d;
            --muted: #758a84;
            --border: #dcebe6;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background: var(--surface);
            color: var(--text);
        }

        [x-cloak] {
            display: none !important;
        }

        .simrs-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at 92% 0%, rgba(185, 234, 219, .35), transparent 27rem),
                #f5faf8;
        }

        .simrs-main {
            max-width: 1280px;
            margin: 0 auto;
            padding: 34px 24px 55px;
        }

        .simrs-header {
            max-width: 1280px;
            margin: 0 auto;
            padding: 30px 24px 0;
        }

        .simrs-header > div {
            background: transparent;
        }

        @media (max-width: 640px) {
            .simrs-main {
                padding: 24px 16px 40px;
            }

            .simrs-header {
                padding: 22px 16px 0;
            }
        }
    </style>
</head>

<body class="antialiased">

    <div class="simrs-page">

        @include('layouts.navigation')

        @isset($header)
            <header class="simrs-header">
                {{ $header }}
            </header>
        @endisset

        <main class="simrs-main">
            {{ $slot }}
        </main>

    </div>

</body>
</html>