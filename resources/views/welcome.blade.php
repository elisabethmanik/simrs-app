<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RS Cipta Medika Duby</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fcfa;
            color: #17332d;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            display: block;
            width: 100%;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        :root {
            --primary: #087f69;
            --primary-dark: #046653;
            --primary-light: #dff5ed;
            --secondary: #b8eadb;
            --dark: #17332d;
            --muted: #668078;
            --border: #dfece7;
            --white: #ffffff;
            --surface: #f8fcfa;
            --shadow: 0 24px 70px rgba(20, 91, 73, .11);
        }

        .container {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }

        /* ==================== NAVBAR ==================== */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(248, 252, 250, .88);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(223, 236, 231, .8);
        }

        .nav-inner {
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 14px;
            background: var(--primary);
            display: grid;
            place-items: center;
            color: white;
            box-shadow: 0 12px 28px rgba(8, 127, 105, .25);
        }

        .brand-icon svg {
            width: 23px;
            height: 23px;
        }

        .brand-text strong {
            display: block;
            font-size: 16px;
            letter-spacing: -.4px;
        }

        .brand-text span {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-top: 2px;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            font-size: 13px;
            font-weight: 600;
            color: #536d66;
        }

        .nav-links a {
            transition: .2s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 19px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            transition: .25s ease;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 12px 26px rgba(8, 127, 105, .22);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: white;
            border-color: var(--border);
            color: var(--dark);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* ==================== HERO ==================== */

        .hero {
            position: relative;
            padding: 72px 0 36px;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: #dff5ed;
            filter: blur(10px);
            top: 40px;
            right: -180px;
            opacity: .55;
            z-index: -1;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.02fr .98fr;
            align-items: center;
            gap: 62px;
        }

        .eyebrow {
            width: fit-content;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            border-radius: 999px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 24px;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--primary);
            box-shadow: 0 0 0 5px rgba(8,127,105,.09);
        }

        .hero h1 {
            font-size: clamp(44px, 5vw, 72px);
            line-height: 1.03;
            letter-spacing: -3.2px;
            margin-bottom: 24px;
            max-width: 690px;
        }

        .hero h1 span {
            color: var(--primary);
        }

        .hero-copy {
            color: var(--muted);
            line-height: 1.9;
            max-width: 590px;
            font-size: 14px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 31px;
        }

        .hero-buttons .btn {
            min-height: 50px;
            padding-inline: 24px;
        }

        .hero-mini-stats {
            display: flex;
            align-items: center;
            gap: 26px;
            margin-top: 38px;
            flex-wrap: wrap;
        }

        .mini-stat {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mini-stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: white;
            border: 1px solid var(--border);
            display: grid;
            place-items: center;
            color: var(--primary);
        }

        .mini-stat-icon svg {
            width: 18px;
        }

        .mini-stat strong {
            display: block;
            font-size: 12px;
        }

        .mini-stat span {
            display: block;
            font-size: 10px;
            color: var(--muted);
            margin-top: 2px;
        }

        .hero-visual {
    position: relative;
    min-height: 570px;
}

.hero-blob {
    position: absolute;
    width: 92%;
    height: 88%;
    left: 50%;
    bottom: 0;
    transform: translateX(-50%);
    background:
        radial-gradient(circle at 30% 30%, rgba(255,255,255,.86), transparent 25%),
        linear-gradient(145deg, #a9e7d4, #dff7ef);
    border-radius: 46% 46% 28% 28% / 36% 38% 28% 28%;
    overflow: hidden;
}

.hero-blob::before,
.hero-blob::after {
    content: "";
    position: absolute;
    border: 1px solid rgba(8,127,105,.12);
    border-radius: 50%;
}

.hero-blob::before {
    width: 360px;
    height: 360px;
    right: -110px;
    top: -80px;
}

.hero-blob::after {
    width: 220px;
    height: 220px;
    left: -90px;
    bottom: 10px;
}

.hero-doctor {
    position: absolute;
    z-index: 2;
    width: 78%;
    height: 88%;
    left: 50%;
    bottom: 0;
    transform: translateX(-50%);
    object-fit: cover;
    object-position: center 18%;
    border-radius: 32px 32px 45px 45px;
    filter: drop-shadow(0 28px 32px rgba(35, 92, 76, .18));
}

        .floating-card {
            position: absolute;
            z-index: 3;
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.85);
            box-shadow: var(--shadow);
            border-radius: 18px;
            padding: 14px 16px;
        }

        .floating-card.one {
            left: -15px;
            bottom: 92px;
        }

        .floating-card.two {
            right: -10px;
            top: 105px;
        }

        .floating-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .floating-icon {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            background: var(--primary-light);
            color: var(--primary);
        }

        .floating-icon svg {
            width: 17px;
        }

        .floating-card strong {
            display: block;
            font-size: 11px;
        }

        .floating-card span {
            display: block;
            font-size: 9px;
            color: var(--muted);
            margin-top: 3px;
        }

        /* ==================== SECTION ==================== */

        section {
            padding: 90px 0;
        }

        .section-label {
            color: var(--primary);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: clamp(30px, 3vw, 44px);
            letter-spacing: -1.7px;
            line-height: 1.12;
        }

        .section-copy {
            color: var(--muted);
            line-height: 1.85;
            font-size: 13px;
        }

        /* ==================== ABOUT ==================== */

        .about-grid {
            display: grid;
            grid-template-columns: .92fr 1.08fr;
            gap: 70px;
            align-items: center;
        }

        .about-image-wrap {
            position: relative;
        }

        .about-image {
            border-radius: 28px;
            overflow: hidden;
            min-height: 380px;
            box-shadow: var(--shadow);
        }

        .about-image img {
            height: 100%;
            min-height: 380px;
            object-fit: cover;
        }

        .experience-badge {
            position: absolute;
            bottom: -25px;
            right: -25px;
            background: var(--primary);
            color: white;
            padding: 24px;
            border-radius: 22px;
            min-width: 155px;
            box-shadow: 0 24px 50px rgba(8,127,105,.28);
        }

        .experience-badge strong {
            font-size: 30px;
            display: block;
        }

        .experience-badge span {
            font-size: 10px;
            opacity: .85;
            line-height: 1.5;
        }

        .about-content .section-title {
            margin-bottom: 20px;
        }

        .about-content .section-copy {
            max-width: 580px;
        }

        .feature-checks {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 26px;
        }

        .check-item {
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: 12px;
            font-weight: 600;
        }

        .check {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .check svg {
            width: 13px;
        }

        /* ==================== STATS ==================== */

        .stats-section {
            padding: 30px 0 20px;
        }

        .stats-grid {
            background: white;
            border: 1px solid var(--border);
            border-radius: 26px;
            padding: 28px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            box-shadow: 0 16px 45px rgba(35, 92, 76, .06);
        }

        .stat-box {
            text-align: center;
            padding: 16px;
            border-right: 1px solid var(--border);
        }

        .stat-box:last-child {
            border-right: 0;
        }

        .stat-box strong {
            display: block;
            font-size: 27px;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .stat-box span {
            color: var(--muted);
            font-size: 11px;
        }

        /* ==================== DOCTORS ==================== */

        .doctors {
            background: #f1faf6;
        }

        .section-heading-row {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 38px;
        }

        .section-heading-row .section-copy {
            max-width: 470px;
        }

        .doctor-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .doctor-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            transition: .3s ease;
        }

        .doctor-card:hover {
            transform: translateY(-7px);
            box-shadow: var(--shadow);
        }

        .doctor-photo {
            height: 270px;
            background: var(--primary-light);
            overflow: hidden;
        }

        .doctor-photo img {
            height: 100%;
            object-fit: cover;
            object-position: center top;
            transition: .35s ease;
        }

        .doctor-card:hover img {
            transform: scale(1.035);
        }

        .doctor-content {
            padding: 18px;
        }

        .doctor-content h3 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .doctor-content p {
            color: var(--primary);
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 13px;
        }

        .doctor-meta {
            padding-top: 13px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 9px;
            color: var(--muted);
        }

        /* ==================== SERVICES ==================== */

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 40px;
        }

        .service-card {
            position: relative;
            padding: 28px;
            border: 1px solid var(--border);
            border-radius: 22px;
            background: white;
            transition: .3s ease;
            overflow: hidden;
        }

        .service-card::after {
            content: "";
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--primary-light);
            right: -50px;
            bottom: -50px;
            transition: .3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            border-color: #a8dacc;
            box-shadow: 0 18px 50px rgba(35,92,76,.08);
        }

        .service-icon {
            width: 48px;
            height: 48px;
            border-radius: 15px;
            display: grid;
            place-items: center;
            background: var(--primary-light);
            color: var(--primary);
            margin-bottom: 20px;
        }

        .service-icon svg {
            width: 22px;
        }

        .service-card h3 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .service-card p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
            max-width: 260px;
        }

        /* ==================== CTA ==================== */

        .cta {
            padding-top: 45px;
            padding-bottom: 95px;
        }

        .cta-box {
            position: relative;
            overflow: hidden;
            background: linear-gradient(130deg, #087f69, #045846);
            border-radius: 30px;
            padding: 54px 58px;
            color: white;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 40px;
        }

        .cta-box::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.15);
            right: -80px;
            top: -100px;
        }

        .cta-box::after {
            content: "";
            position: absolute;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
            left: 35%;
            bottom: -90px;
        }

        .cta-box h2 {
            font-size: clamp(28px, 3vw, 42px);
            letter-spacing: -1.5px;
            max-width: 620px;
            line-height: 1.15;
        }

        .cta-box p {
            font-size: 12px;
            opacity: .75;
            margin-top: 12px;
            max-width: 580px;
            line-height: 1.8;
        }

        .cta-box .btn {
            position: relative;
            z-index: 2;
            background: white;
            color: var(--primary);
            padding-inline: 26px;
            min-height: 51px;
        }

        /* ==================== FOOTER ==================== */

        footer {
            background: #12332c;
            color: white;
            padding: 56px 0 30px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr .7fr .7fr 1fr;
            gap: 50px;
        }

        .footer-brand p {
            margin-top: 16px;
            max-width: 360px;
            font-size: 11px;
            opacity: .65;
            line-height: 1.8;
        }

        .footer-col h4 {
            font-size: 12px;
            margin-bottom: 18px;
        }

        .footer-col a,
        .footer-col p {
            display: block;
            font-size: 10px;
            opacity: .65;
            margin-bottom: 11px;
            line-height: 1.7;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.1);
            margin-top: 42px;
            padding-top: 25px;
            font-size: 9px;
            opacity: .55;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        /* ==================== RESPONSIVE ==================== */

        @media (max-width: 960px) {
            .nav-links {
                display: none;
            }

            .hero-grid,
            .about-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                padding-top: 48px;
            }

            .hero-copy {
                max-width: 700px;
            }

            .hero-visual {
                min-height: 500px;
                margin-top: 15px;
            }

            .doctor-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat-box:nth-child(2) {
                border-right: 0;
            }

            .stat-box:nth-child(-n+2) {
                border-bottom: 1px solid var(--border);
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 650px) {
            .container {
                width: min(100% - 28px, 1180px);
            }

            .navbar {
                position: relative;
            }

            .nav-inner {
                min-height: 72px;
            }

            .brand-text span {
                display: none;
            }

            /*.nav-actions .btn-outline {
                display: none;
            }*/

            .hero {
                padding-top: 36px;
            }

            .hero h1 {
                font-size: 43px;
                letter-spacing: -2px;
            }

            .hero-visual {
                min-height: 420px;
            }

            .floating-card.one {
                left: 0;
            }

            .floating-card.two {
                right: 0;
            }

            section {
                padding: 70px 0;
            }

            .experience-badge {
                right: 12px;
            }

            .feature-checks,
            .doctor-grid,
            .services-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                padding: 14px;
            }

            .stat-box {
                border-right: 0;
                border-bottom: 1px solid var(--border);
            }

            .stat-box:last-child {
                border-bottom: 0;
            }

            .section-heading-row {
                display: block;
            }

            .section-heading-row .section-copy {
                margin-top: 15px;
            }

            .cta-box {
                grid-template-columns: 1fr;
                padding: 38px 28px;
            }

            .footer-bottom {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    {{-- ==================== NAVBAR ==================== --}}
    <header class="navbar">
        <div class="container nav-inner">

            <a href="{{ url('/') }}" class="brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 21s-7-4.35-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.65-7 10-7 10Z"/>
                        <path d="M9 12h2l1-2 2 4 1-2h2"/>
                    </svg>
                </div>

                <div class="brand-text">
                    <strong>Cipta Medika Duby</strong>
                    <span>Hospital & Medical Center</span>
                </div>
            </a>

            <nav class="nav-links">
                <a href="#home">Home</a>
                <a href="#about">Tentang Kami</a>
                <a href="#doctors">Dokter</a>
                <a href="#services">Layanan</a>
                <a href="#contact">Kontak</a>
            </nav>

            <div class="nav-actions">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-outline">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline">
                    Login
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline">
                        Register
                    </a>
                @endif
            @endauth

            <a href="{{ url('/pendaftaran-online') }}" class="btn btn-primary">
                Buat Appointment →
            </a>
        </div>

        </div>
    </header>

    <main>

        {{-- ==================== HERO ==================== --}}
        <section class="hero" id="home">
            <div class="container hero-grid">

                <div class="hero-content">
                    <div class="eyebrow">
                        <span class="eyebrow-dot"></span>
                        Pelayanan Kesehatan Terintegrasi
                    </div>

                    <h1>
                        Trusted Medical Care for a
                        <span>Healthier Tomorrow.</span>
                    </h1>

                    <p class="hero-copy">
                        RS Cipta Medika Duby hadir dengan pelayanan kesehatan modern
                        yang mengutamakan kenyamanan pasien, tenaga medis profesional,
                        serta sistem pelayanan terintegrasi untuk pengalaman kesehatan
                        yang lebih cepat dan efisien.
                    </p>

                    <div class="hero-buttons">
                        <a href="{{ url('/pendaftaran-online') }}" class="btn btn-primary">
                            Buat Appointment
                            <span>→</span>
                        </a>

                        <a href="#services" class="btn btn-outline">
                            Lihat Layanan
                        </a>
                    </div>

                    <div class="hero-mini-stats">

                        <div class="mini-stat">
                            <div class="mini-stat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M19 8v6M22 11h-6"/>
                                </svg>
                            </div>
                            <div>
                                <strong>Dokter Profesional</strong>
                                <span>Tenaga medis terpercaya</span>
                            </div>
                        </div>

                        <div class="mini-stat">
                            <div class="mini-stat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2v20M2 12h20"/>
                                </svg>
                            </div>
                            <div>
                                <strong>Layanan Terintegrasi</strong>
                                <span>Satu sistem pelayanan</span>
                            </div>
                        </div>

                        <div class="mini-stat">
                            <div class="mini-stat-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </div>
                            <div>
                                <strong>Pelayanan Efisien</strong>
                                <span>Lebih cepat & terstruktur</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="hero-visual">
                    <div class="hero-blob"></div>

                    <img
                        class="hero-doctor"
                        src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=1000&q=90"
                        alt="Dokter RS Cipta Medika Duby"
                    >

                    <div class="floating-card one">
                        <div class="floating-row">
                            <div class="floating-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 7 9 18l-5-5"/>
                                </svg>
                            </div>
                            <div>
                                <strong>Pelayanan Terpercaya</strong>
                                <span>Untuk pasien & keluarga</span>
                            </div>
                        </div>
                    </div>

                    <div class="floating-card two">
                        <div class="floating-row">
                            <div class="floating-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 8v4l3 2"/>
                                    <circle cx="12" cy="12" r="9"/>
                                </svg>
                            </div>
                            <div>
                                <strong>Online Booking</strong>
                                <span>Daftar lebih praktis</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- ==================== STATS ==================== --}}
        <section class="stats-section">
            <div class="container">
                <div class="stats-grid">

                    <div class="stat-box">
                        <strong>5.000+</strong>
                        <span>Pasien Terlayani</span>
                    </div>

                    <div class="stat-box">
                        <strong>30+</strong>
                        <span>Tenaga Medis</span>
                    </div>

                    <div class="stat-box">
                        <strong>98%</strong>
                        <span>Kepuasan Pasien</span>
                    </div>

                    <div class="stat-box">
                        <strong>15+</strong>
                        <span>Layanan Kesehatan</span>
                    </div>

                </div>
            </div>
        </section>

        {{-- ==================== ABOUT ==================== --}}
        <section id="about">
            <div class="container about-grid">

                <div class="about-image-wrap">
                    <div class="about-image">
                        <img
                            src="https://images.unsplash.com/photo-1516841273335-e39b37888115?auto=format&fit=crop&w=1000&q=90"
                            alt="Rumah Sakit"
                        >
                    </div>

                    <div class="experience-badge">
                        <strong>24/7</strong>
                        <span>Pelayanan medis untuk kebutuhan kesehatan Anda.</span>
                    </div>
                </div>

                <div class="about-content">
                    <div class="section-label">Tentang Kami</div>

                    <h2 class="section-title">
                        Pelayanan kesehatan modern yang lebih dekat dengan Anda.
                    </h2>

                    <p class="section-copy" style="margin-top:20px;">
                        RS Cipta Medika Duby mengembangkan pelayanan medis yang
                        terintegrasi melalui dukungan teknologi informasi rumah sakit.
                        Mulai dari pendaftaran pasien, pemeriksaan dokter, rekam medis,
                        hingga farmasi dikelola dalam satu alur pelayanan.
                    </p>

                    <div class="feature-checks">

                        <div class="check-item">
                            <span class="check">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <path d="m5 12 4 4L19 6"/>
                                </svg>
                            </span>
                            Pelayanan terintegrasi
                        </div>

                        <div class="check-item">
                            <span class="check">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <path d="m5 12 4 4L19 6"/>
                                </svg>
                            </span>
                            Rekam medis digital
                        </div>

                        <div class="check-item">
                            <span class="check">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <path d="m5 12 4 4L19 6"/>
                                </svg>
                            </span>
                            Pendaftaran online
                        </div>

                        <div class="check-item">
                            <span class="check">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <path d="m5 12 4 4L19 6"/>
                                </svg>
                            </span>
                            Farmasi terintegrasi
                        </div>

                    </div>

                    <a href="#services" class="btn btn-primary" style="margin-top:28px;">
                        Selengkapnya →
                    </a>
                </div>

            </div>
        </section>

        {{-- ==================== DOCTORS ==================== --}}
        <section class="doctors" id="doctors">
            <div class="container">

                <div class="section-heading-row">
                    <div>
                        <div class="section-label">Tim Medis Kami</div>
                        <h2 class="section-title">Meet Our Expert Doctors.</h2>
                    </div>

                    <p class="section-copy">
                        Didukung tenaga medis profesional yang siap memberikan
                        pelayanan terbaik sesuai kebutuhan setiap pasien.
                    </p>
                </div>

                <div class="doctor-grid">

                    <article class="doctor-card">
                        <div class="doctor-photo">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=700&q=85" alt="">
                        </div>
                        <div class="doctor-content">
                            <h3>dr. Andi Pratama</h3>
                            <p>Dokter Umum</p>
                            <div class="doctor-meta">
                                <span>Senin - Jumat</span>
                                <span>08.00 - 15.00</span>
                            </div>
                        </div>
                    </article>

                    <article class="doctor-card">
                        <div class="doctor-photo">
                            <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&w=700&q=85" alt="">
                        </div>
                        <div class="doctor-content">
                            <h3>dr. Sarah Amelia</h3>
                            <p>Dokter Penyakit Dalam</p>
                            <div class="doctor-meta">
                                <span>Senin - Sabtu</span>
                                <span>09.00 - 16.00</span>
                            </div>
                        </div>
                    </article>

                    <article class="doctor-card">
                        <div class="doctor-photo">
                            <img src="https://images.unsplash.com/photo-1538108149393-fbbd81895907?auto=format&fit=crop&w=700&q=85" alt="">
                        </div>
                        <div class="doctor-content">
                            <h3>dr. Maya Kusuma</h3>
                            <p>Dokter Anak</p>
                            <div class="doctor-meta">
                                <span>Selasa - Sabtu</span>
                                <span>08.00 - 14.00</span>
                            </div>
                        </div>
                    </article>

                    <article class="doctor-card">
                        <div class="doctor-photo">
                            <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?auto=format&fit=crop&w=700&q=85" alt="">
                        </div>
                        <div class="doctor-content">
                            <h3>dr. Rizky Mahendra</h3>
                            <p>Dokter Spesialis</p>
                            <div class="doctor-meta">
                                <span>Senin - Jumat</span>
                                <span>10.00 - 17.00</span>
                            </div>
                        </div>
                    </article>

                </div>

            </div>
        </section>

        {{-- ==================== SERVICES ==================== --}}
        <section id="services">
            <div class="container">

                <div style="text-align:center; max-width:680px; margin:0 auto;">
                    <div class="section-label">Layanan Medis</div>
                    <h2 class="section-title">Comprehensive Medical Services.</h2>
                    <p class="section-copy" style="margin-top:15px;">
                        Layanan kesehatan terintegrasi untuk mendukung perjalanan
                        kesehatan pasien dari awal hingga selesai.
                    </p>
                </div>

                <div class="services-grid">

                    <article class="service-card">
                        <div class="service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2v20M2 12h20"/>
                            </svg>
                        </div>
                        <h3>Poliklinik</h3>
                        <p>Pemeriksaan medis dan konsultasi dokter sesuai kebutuhan pasien.</p>
                    </article>

                    <article class="service-card">
                        <div class="service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 7h18v12H3z"/>
                                <path d="M7 7V4h10v3"/>
                            </svg>
                        </div>
                        <h3>Rawat Inap</h3>
                        <p>Pelayanan rawat inap yang terhubung dengan data medis pasien.</p>
                    </article>

                    <article class="service-card">
                        <div class="service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 3h6v4H9z"/>
                                <path d="M7 7h10v14H7z"/>
                            </svg>
                        </div>
                        <h3>Farmasi & Apotek</h3>
                        <p>Pengelolaan resep digital dan pelayanan obat yang lebih terstruktur.</p>
                    </article>

                    <article class="service-card">
                        <div class="service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 2h9l3 3v17H6z"/>
                                <path d="M9 11h6M9 15h6"/>
                            </svg>
                        </div>
                        <h3>Rekam Medis Elektronik</h3>
                        <p>Riwayat pelayanan pasien tersimpan aman dan terintegrasi.</p>
                    </article>

                    <article class="service-card">
                        <div class="service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </div>
                        <h3>Online Booking</h3>
                        <p>Pendaftaran pasien lebih mudah tanpa harus antre lama di rumah sakit.</p>
                    </article>

                    <article class="service-card">
                        <div class="service-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 19V9M10 19V5M16 19v-7M22 19H2"/>
                            </svg>
                        </div>
                        <h3>Sistem Terintegrasi</h3>
                        <p>Data pelayanan terhubung antar unit dalam satu sistem informasi.</p>
                    </article>

                </div>
            </div>
        </section>

        {{-- ==================== CTA ==================== --}}
        <section class="cta" id="contact">
            <div class="container">
                <div class="cta-box">

                    <div>
                        <h2>
                            Better Health Starts With Better Care.
                        </h2>

                        <p>
                            Daftarkan kunjungan Anda secara online dan dapatkan
                            pelayanan kesehatan yang lebih nyaman, cepat, dan terintegrasi.
                        </p>
                    </div>

                    <a href="{{ url('/pendaftaran-online') }}" class="btn">
                        Buat Appointment →
                    </a>

                </div>
            </div>
        </section>

    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer>
        <div class="container">

            <div class="footer-grid">

                <div class="footer-brand">
                    <div class="brand">
                        <div class="brand-icon" style="background:white;color:#087f69;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 21s-7-4.35-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.65-7 10-7 10Z"/>
                                <path d="M9 12h2l1-2 2 4 1-2h2"/>
                            </svg>
                        </div>

                        <div class="brand-text">
                            <strong>RS Cipta Medika Duby</strong>
                            <span style="color:#a9cfc4;">Hospital & Medical Center</span>
                        </div>
                    </div>

                    <p>
                        Memberikan pelayanan kesehatan yang lebih modern melalui
                        tenaga medis profesional dan dukungan sistem informasi
                        rumah sakit terintegrasi.
                    </p>
                </div>

                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <a href="#home">Home</a>
                    <a href="#about">Tentang Kami</a>
                    <a href="#doctors">Dokter</a>
                    <a href="#services">Layanan</a>
                </div>

                <div class="footer-col">
                    <h4>Layanan</h4>
                    <a href="#">Poliklinik</a>
                    <a href="#">Rawat Inap</a>
                    <a href="#">Farmasi</a>
                    <a href="#">Online Booking</a>
                </div>

                <div class="footer-col">
                    <h4>Kontak</h4>
                    <p>Tangerang Selatan, Banten</p>
                    <p>Tel. (021) 0000 0000</p>
                    <p>Email: info@ciptamedikaduby.id</p>
                </div>

            </div>

            <div class="footer-bottom">
                <span>
                    © {{ date('Y') }} RS Cipta Medika Duby. All rights reserved.
                </span>

                <span>
                    Developed by THREESULA Indonesia — Three Minds, One System.
                </span>
            </div>

        </div>
    </footer>

</body>
</html>