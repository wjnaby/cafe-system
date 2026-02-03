<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['cafe_name'] ?? 'Cafe System' }} - Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Outfit:wght@300;400;500;600&display=swap');

        :root {
            --brown-dark: #3D2314;
            --brown-medium: #5C3A21;
            --cream: #FAF7F2;
            --cream-dark: #F0EBE0;
            --amber: #D4A574;
            --amber-dark: #B8956A;
            --text-dark: #2D1810;
            --text-muted: #6B5B4F;
            --border: #E4DED5;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }

        /* ── Global grain ── */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 9999;
            pointer-events: none;
            opacity: .03;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        /* ═══════════════════════════════
           NAV
           ═══════════════════════════════ */
        .nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(250, 247, 242, .88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            transition: box-shadow .3s;
        }
        .nav.scrolled { box-shadow: 0 2px 24px rgba(61,35,20,.07); }

        .nav__inner {
            max-width: 1160px;
            margin: 0 auto;
            padding: 0 32px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .nav__logo {
            font-family: 'DM Serif Display', serif;
            font-size: 1.35rem;
            color: var(--brown-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }
        .nav__logo-mark {
            width: 32px; height: 32px;
            background: var(--brown-dark);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .nav__logo-mark svg { width: 18px; height: 18px; color: var(--amber); }
        .nav__logo span { color: var(--amber-dark); }

        .nav__links {
            display: flex;
            align-items: center;
            gap: 32px;
        }
        .nav__link {
            font-size: .87rem;
            font-weight: 400;
            color: var(--text-muted);
            text-decoration: none;
            letter-spacing: .02em;
            transition: color .25s;
            position: relative;
        }
        .nav__link::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0;
            width: 0; height: 1px;
            background: var(--amber-dark);
            transition: width .3s;
        }
        .nav__link:hover { color: var(--brown-dark); }
        .nav__link:hover::after { width: 100%; }

        .nav__actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: .86rem;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background .25s, color .25s, transform .15s, box-shadow .25s;
            white-space: nowrap;
        }
        .btn--outline {
            padding: 9px 22px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--brown-dark);
        }
        .btn--outline:hover { border-color: var(--brown-dark); background: rgba(61,35,20,.04); }

        .btn--dark {
            padding: 9px 22px;
            border-radius: 8px;
            background: var(--brown-dark);
            color: #fff;
        }
        .btn--dark:hover { background: var(--brown-medium); transform: translateY(-1px); }

        .btn--amber {
            padding: 13px 28px;
            border-radius: 8px;
            background: var(--amber);
            color: var(--brown-dark);
            font-weight: 600;
            box-shadow: 0 4px 18px rgba(212,165,116,.35);
        }
        .btn--amber:hover { background: var(--amber-dark); transform: translateY(-2px); box-shadow: 0 6px 24px rgba(212,165,116,.4); }
        .btn--amber svg { width: 18px; height: 18px; }

        .btn--dark-lg {
            padding: 13px 28px;
            border-radius: 8px;
            background: var(--brown-dark);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 18px rgba(61,35,20,.25);
        }
        .btn--dark-lg:hover { background: var(--brown-medium); transform: translateY(-2px); }
        .btn--dark-lg svg { width: 18px; height: 18px; }

        /* Mobile toggle */
        .nav__toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
        }
        .nav__toggle svg { width: 24px; height: 24px; color: var(--brown-dark); }

        /* ═══════════════════════════════
           HERO
           ═══════════════════════════════ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--brown-dark);
            position: relative;
            overflow: hidden;
            padding: 100px 32px 80px;
        }

        /* Ambient blobs */
        .hero__blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
        }
        .hero__blob--1 { width: 600px; height: 600px; background: var(--amber); opacity: .12; top: -200px; right: -180px; }
        .hero__blob--2 { width: 380px; height: 380px; background: var(--brown-medium); opacity: .3; bottom: -120px; left: -100px; }
        .hero__blob--3 { width: 200px; height: 200px; background: var(--amber-dark); opacity: .08; top: 55%; left: 40%; }

        .hero__inner {
            max-width: 1160px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 80px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        /* Tag */
        .hero__tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }
        .hero__tag-line { width: 28px; height: 1px; background: var(--amber); }
        .hero__tag-text {
            font-size: .75rem;
            font-weight: 500;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--amber);
        }

        .hero__title {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2.8rem, 5.5vw, 4.6rem);
            font-weight: 400;
            color: #fff;
            line-height: 1.07;
            margin-bottom: 24px;
        }
        .hero__title em { font-style: italic; color: var(--amber); }

        .hero__sub {
            font-size: 1.02rem;
            color: rgba(255,255,255,.5);
            line-height: 1.8;
            max-width: 480px;
            margin-bottom: 40px;
            font-weight: 300;
        }

        .hero__actions { display: flex; gap: 14px; flex-wrap: wrap; }

        /* Right: image collage */
        .hero__visual {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 14px;
            height: 420px;
        }
        .hero__vis-item {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }
        .hero__vis-item--tall { grid-row: span 2; }

        .hero__vis-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform .6s ease;
        }
        .hero__vis-item:hover img { transform: scale(1.05); }

        /* Placeholder fill when no image */
        .hero__vis-placeholder {
            width: 100%; height: 100%;
            background: linear-gradient(145deg, rgba(255,255,255,.06) 0%, transparent 70%);
            border: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero__vis-placeholder svg { width: 48px; height: 48px; color: rgba(255,255,255,.15); }

        /* Floating info pill on the collage */
        .hero__float {
            position: absolute;
            bottom: 16px; left: 16px;
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 12px;
            padding: 12px 16px;
            z-index: 2;
        }
        .hero__float-label { font-size: .68rem; letter-spacing: .1em; text-transform: uppercase; color: rgba(255,255,255,.45); }
        .hero__float-val { font-size: .92rem; font-weight: 600; color: #fff; margin-top: 2px; }

        /* ═══════════════════════════════
           FEATURES / WHY US
           ═══════════════════════════════ */
        .features {
            padding: 110px 32px;
            background: #fff;
        }
        .features__inner { max-width: 1160px; margin: 0 auto; }

        /* Section head – editorial style */
        .sec-head {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: end;
            margin-bottom: 64px;
        }
        .sec-head__left .sec-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }
        .sec-tag__line { width: 24px; height: 1px; background: var(--amber); }
        .sec-tag__text { font-size: .73rem; font-weight: 500; letter-spacing: .16em; text-transform: uppercase; color: var(--text-muted); }

        .sec-head__title {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            font-weight: 400;
            color: var(--brown-dark);
            line-height: 1.15;
        }
        .sec-head__title em { font-style: italic; color: var(--amber-dark); }

        .sec-head__right {
            font-size: .95rem;
            color: var(--text-muted);
            line-height: 1.8;
            font-weight: 300;
            max-width: 420px;
            justify-self: end;
        }

        .features__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feat-card {
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            background: var(--cream);
            transition: box-shadow .35s, transform .35s;
        }
        .feat-card:hover { transform: translateY(-4px); box-shadow: 0 14px 44px rgba(61,35,20,.1); }

        .feat-card__img {
            height: 210px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(140deg, var(--cream-dark) 0%, #E0D8CC 100%);
        }
        .feat-card__img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
        .feat-card:hover .feat-card__img img { transform: scale(1.06); }

        .feat-card__img--ph {
            display: flex; align-items: center; justify-content: center;
        }
        .feat-card__img--ph svg { width: 48px; height: 48px; color: var(--amber-dark); opacity: .35; }

        .feat-card__body { padding: 26px; }
        .feat-card__title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            font-weight: 400;
            color: var(--brown-dark);
            margin-bottom: 8px;
        }
        .feat-card__desc {
            font-size: .84rem;
            color: var(--text-muted);
            line-height: 1.65;
            font-weight: 300;
            margin-bottom: 18px;
        }
        .feat-card__link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--amber-dark);
            font-size: .84rem;
            font-weight: 500;
            text-decoration: none;
            transition: gap .25s;
        }
        .feat-card__link:hover { gap: 10px; }
        .feat-card__link svg { width: 15px; height: 15px; }

        /* ═══════════════════════════════
           VISIT US
           ═══════════════════════════════ */
        .visit {
            padding: 110px 32px;
            background: var(--cream);
        }
        .visit__inner {
            max-width: 1160px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 72px;
            align-items: center;
        }

        .visit__img {
            border-radius: 20px;
            overflow: hidden;
            height: 440px;
            position: relative;
        }
        .visit__img img { width: 100%; height: 100%; object-fit: cover; }
        .visit__img--ph {
            width: 100%; height: 100%;
            background: linear-gradient(145deg, var(--cream-dark) 0%, #DDD5C6 100%);
            display: flex; align-items: center; justify-content: center;
        }
        .visit__img--ph svg { width: 72px; height: 72px; color: var(--amber-dark); opacity: .3; }

        /* Floating card on image */
        .visit__badge {
            position: absolute;
            bottom: 24px; right: 24px;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(8px);
            border-radius: 14px;
            padding: 18px 22px;
            box-shadow: 0 8px 32px rgba(0,0,0,.08);
            z-index: 2;
        }
        .visit__badge-label { font-size: .7rem; letter-spacing: .1em; text-transform: uppercase; color: var(--text-muted); }
        .visit__badge-val { font-family: 'DM Serif Display', serif; font-size: 1.3rem; color: var(--brown-dark); margin-top: 2px; }

        .visit__content .sec-tag { margin-bottom: 18px; display: inline-flex; align-items: center; gap: 10px; }
        .visit__content h2 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2rem, 3.2vw, 2.6rem);
            font-weight: 400;
            color: var(--brown-dark);
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .visit__content h2 em { font-style: italic; color: var(--amber-dark); }
        .visit__content > p {
            font-size: .95rem;
            color: var(--text-muted);
            line-height: 1.8;
            font-weight: 300;
            margin-bottom: 32px;
        }

        .visit__info { display: flex; flex-direction: column; gap: 18px; margin-bottom: 36px; }
        .visit__info-row { display: flex; align-items: center; gap: 16px; }
        .visit__info-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: var(--cream-dark);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .visit__info-icon svg { width: 20px; height: 20px; color: var(--amber-dark); }
        .visit__info-text { font-size: .9rem; color: var(--text-dark); font-weight: 400; }
        .visit__info-label { font-size: .72rem; letter-spacing: .1em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 1px; }

        /* ═══════════════════════════════
           MENU PREVIEW
           ═══════════════════════════════ */
        .menu-preview {
            padding: 110px 32px;
            background: #fff;
        }
        .menu-preview__inner { max-width: 1160px; margin: 0 auto; }

        .menu-preview__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-bottom: 52px;
        }

        .menu-card {
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            background: var(--cream);
            transition: box-shadow .35s, transform .35s;
            display: flex;
            flex-direction: column;
        }
        .menu-card:hover { transform: translateY(-4px); box-shadow: 0 14px 44px rgba(61,35,20,.1); }

        .menu-card__img {
            height: 195px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(140deg, var(--cream-dark) 0%, #E0D8CC 100%);
        }
        .menu-card__img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
        .menu-card:hover .menu-card__img img { transform: scale(1.06); }

        .menu-card__img--ph { display: flex; align-items: center; justify-content: center; }
        .menu-card__img--ph svg { width: 44px; height: 44px; color: var(--amber-dark); opacity: .3; }

        .menu-card__cat {
            position: absolute;
            top: 14px; left: 14px;
            background: var(--brown-dark);
            color: var(--amber);
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 5px 11px;
            border-radius: 6px;
            z-index: 2;
        }

        .menu-card__body { padding: 22px; flex: 1; display: flex; flex-direction: column; }
        .menu-card__name {
            font-family: 'DM Serif Display', serif;
            font-size: 1.15rem;
            font-weight: 400;
            color: var(--brown-dark);
            margin-bottom: 6px;
        }
        .menu-card__desc {
            font-size: .83rem;
            color: var(--text-muted);
            line-height: 1.6;
            font-weight: 300;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: auto;
        }

        .menu-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 18px;
            margin-top: 16px;
            border-top: 1px solid var(--border);
        }
        .menu-card__price {
            font-family: 'DM Serif Display', serif;
            font-size: 1.35rem;
            color: var(--brown-dark);
        }
        .menu-card__price sup { font-size: .7rem; font-family: 'Outfit', sans-serif; font-weight: 500; vertical-align: super; margin-right: 1px; }

        .btn--card {
            padding: 9px 18px;
            border-radius: 8px;
            background: var(--brown-dark);
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: .82rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background .25s, transform .15s;
        }
        .btn--card:hover { background: var(--brown-medium); transform: scale(1.04); }

        /* empty state */
        .menu-preview__empty {
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 72px 40px;
            text-align: center;
            background: var(--cream);
        }
        .menu-preview__empty svg { width: 52px; height: 52px; color: var(--amber); margin-bottom: 18px; }
        .menu-preview__empty h3 { font-family: 'DM Serif Display', serif; font-size: 1.4rem; font-weight: 400; color: var(--brown-dark); margin-bottom: 6px; }
        .menu-preview__empty p { color: var(--text-muted); font-size: .88rem; }

        .menu-preview__cta { text-align: center; }

        /* ═══════════════════════════════
           FOOTER
           ═══════════════════════════════ */
        .footer {
            background: var(--brown-dark);
            color: #fff;
            padding: 72px 32px 32px;
        }
        .footer__inner { max-width: 1160px; margin: 0 auto; }

        .footer__grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            padding-bottom: 48px;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }

        .footer__brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }
        .footer__brand-mark {
            width: 34px; height: 34px;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .footer__brand-mark svg { width: 18px; height: 18px; color: var(--amber); }
        .footer__brand-name { font-family: 'DM Serif Display', serif; font-size: 1.2rem; }
        .footer__brand-name span { color: var(--amber); }

        .footer__brand p {
            font-size: .85rem;
            color: rgba(255,255,255,.5);
            line-height: 1.75;
            font-weight: 300;
            max-width: 320px;
        }

        .footer__col h4 {
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 20px;
        }
        .footer__col ul { list-style: none; }
        .footer__col li { margin-bottom: 12px; }
        .footer__col a {
            color: rgba(255,255,255,.5);
            text-decoration: none;
            font-size: .87rem;
            font-weight: 300;
            transition: color .25s;
        }
        .footer__col a:hover { color: #fff; }
        .footer__col li:not(:has(a)) {
            color: rgba(255,255,255,.5);
            font-size: .87rem;
            font-weight: 300;
        }

        .footer__bottom {
            padding-top: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer__bottom p {
            color: rgba(255,255,255,.3);
            font-size: .8rem;
        }

        /* ═══════════════════════════════
           RESPONSIVE
           ═══════════════════════════════ */
        @media (max-width: 1024px) {
            .hero__inner { grid-template-columns: 1fr; gap: 48px; }
            .hero__visual { max-width: 480px; margin: 0 auto; height: 340px; }
            .hero { text-align: center; }
            .hero__tag { justify-content: center; }
            .hero__sub { margin-left: auto; margin-right: auto; }
            .hero__actions { justify-content: center; }

            .sec-head { grid-template-columns: 1fr; gap: 16px; }
            .sec-head__right { justify-self: start; max-width: 100%; }

            .features__grid,
            .menu-preview__grid { grid-template-columns: repeat(2, 1fr); }

            .visit__inner { grid-template-columns: 1fr; }
            .visit__img { order: -1; height: 320px; }

            .footer__grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .nav__links { display: none; }
            .nav__toggle { display: block; }

            .hero { padding: 100px 24px 70px; }
            .hero__visual { height: 280px; }
            .hero__title { font-size: 2.4rem; }

            .features, .visit, .menu-preview { padding: 80px 24px; }
            .features__grid,
            .menu-preview__grid { grid-template-columns: 1fr; max-width: 440px; margin-left: auto; margin-right: auto; }

            .footer__grid { grid-template-columns: 1fr; text-align: center; }
            .footer__brand p { max-width: 100%; }
            .footer__bottom { flex-direction: column; gap: 8px; text-align: center; }
        }

        @media (max-width: 480px) {
            .hero__actions { flex-direction: column; width: 100%; }
            .hero__actions .btn { width: 100%; justify-content: center; }
            .nav__actions .btn--outline { display: none; }
        }
    </style>
</head>
<body>

<!-- ── Nav ── -->
<nav class="nav" id="mainNav">
    <div class="nav__inner">
        <a href="{{ url('/') }}" class="nav__logo">
            <div class="nav__logo-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 8h1a4 4 0 110 8h-1"/>
                    <path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                </svg>
            </div>
            {{ $settings['cafe_name'] ?? 'Cafe <span>System</span>' }}
        </a>

        <div class="nav__links">
            <a href="#features" class="nav__link">About</a>
            <a href="#menu" class="nav__link">Menu</a>
            <a href="#visit" class="nav__link">Visit</a>
        </div>

        <div class="nav__actions">
            @auth
                <a href="{{ route('menu.index') }}" class="btn btn--dark">Go to Menu</a>
            @else
                <a href="{{ route('login') }}" class="btn btn--outline">Login</a>
                <a href="{{ route('menu.index') }}" class="btn btn--dark">Browse Menu</a>
            @endauth
        </div>

        <button class="nav__toggle" onclick="document.querySelector('.nav__links').classList.toggle('show')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>
</nav>

<!-- ── Hero ── -->
@if(($settings['hero_enabled'] ?? '1') == '1')
<section class="hero">
    <div class="hero__blob hero__blob--1"></div>
    <div class="hero__blob hero__blob--2"></div>
    <div class="hero__blob hero__blob--3"></div>

    <div class="hero__inner">
        <div class="hero__content">
            <div class="hero__tag">
                <span class="hero__tag-line"></span>
                <span class="hero__tag-text">Welcome to our cafe</span>
            </div>
            <h1 class="hero__title">
                {!! nl2br(e($settings['hero_title'] ?? 'Freshly Baked,')) !!}<br><em>Just for You</em>
            </h1>
            <p class="hero__sub">
                {{ $settings['hero_subtitle'] ?? 'Experience the finest selection of artisan breads, sweet pastries, and custom cakes made with love and the finest ingredients.' }}
            </p>
            <div class="hero__actions">
                @auth
                    <a href="{{ route('menu.index') }}" class="btn btn--amber">
                        Order Now
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn--outline" style="padding:13px 28px; font-size:.9rem; font-weight:600; border-width:1.5px; border-color:rgba(255,255,255,.3); color:#fff;">
                        Login
                    </a>
                    <a href="{{ route('menu.index') }}" class="btn btn--amber">
                        Browse Menu
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                @endauth
            </div>
        </div>

        <!-- Visual collage -->
        <div class="hero__visual">
            <!-- Tall left -->
            <div class="hero__vis-item hero__vis-item--tall">
                @if(!empty($settings['hero_image']))
                    <img src="{{ asset('images/settings/' . $settings['hero_image']) }}" alt="Hero">
                @else
                    <div class="hero__vis-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                            <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/>
                        </svg>
                    </div>
                @endif
                <div class="hero__float">
                    <div class="hero__float-label">Est.</div>
                    <div class="hero__float-val">Since 2020</div>
                </div>
            </div>
            <!-- Top right -->
            <div class="hero__vis-item">
                @if(!empty($settings['feature_1_image']))
                    <img src="{{ asset('images/settings/' . $settings['feature_1_image']) }}" alt="Feature">
                @else
                    <div class="hero__vis-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                @endif
            </div>
            <!-- Bottom right -->
            <div class="hero__vis-item">
                @if(!empty($settings['feature_2_image']))
                    <img src="{{ asset('images/settings/' . $settings['feature_2_image']) }}" alt="Feature">
                @else
                    <div class="hero__vis-placeholder">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- ── Features ── -->
@if(($settings['features_enabled'] ?? '1') == '1')
<section class="features" id="features">
    <div class="features__inner">
        <div class="sec-head">
            <div class="sec-head__left">
                <div class="sec-tag">
                    <span class="sec-tag__line"></span>
                    <span class="sec-tag__text">Why Choose Us</span>
                </div>
                <h2 class="sec-head__title">{{ $settings['about_title'] ?? 'What makes us <em>different</em>' }}</h2>
            </div>
            <p class="sec-head__right">{{ $settings['about_description'] ?? 'We pride ourselves on using only the finest ingredients, traditional recipes passed down through generations, and a passion for creating memorable experiences.' }}</p>
        </div>

        <div class="features__grid">
            <!-- Card 1 -->
            <div class="feat-card">
                <div class="feat-card__img {{ empty($settings['feature_1_image']) ? 'feat-card__img--ph' : '' }}">
                    @if(!empty($settings['feature_1_image']))
                        <img src="{{ asset('images/settings/' . $settings['feature_1_image']) }}" alt="{{ $settings['feature_1_title'] ?? 'Feature' }}">
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    @endif
                </div>
                <div class="feat-card__body">
                    <h3 class="feat-card__title">{{ $settings['feature_1_title'] ?? 'Artisan Breads' }}</h3>
                    <p class="feat-card__desc">{{ $settings['feature_1_description'] ?? 'Handcrafted daily using traditional methods and the finest flour sourced from local farms.' }}</p>
                    <a href="{{ route('menu.index') }}" class="feat-card__link">
                        View Menu
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="feat-card">
                <div class="feat-card__img {{ empty($settings['feature_2_image']) ? 'feat-card__img--ph' : '' }}">
                    @if(!empty($settings['feature_2_image']))
                        <img src="{{ asset('images/settings/' . $settings['feature_2_image']) }}" alt="{{ $settings['feature_2_title'] ?? 'Feature' }}">
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                        </svg>
                    @endif
                </div>
                <div class="feat-card__body">
                    <h3 class="feat-card__title">{{ $settings['feature_2_title'] ?? 'Sweet Pastries' }}</h3>
                    <p class="feat-card__desc">{{ $settings['feature_2_description'] ?? 'Delightful treats made fresh every morning with premium ingredients and a touch of love.' }}</p>
                    <a href="{{ route('menu.index') }}" class="feat-card__link">
                        View Menu
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="feat-card">
                <div class="feat-card__img {{ empty($settings['feature_3_image']) ? 'feat-card__img--ph' : '' }}">
                    @if(!empty($settings['feature_3_image']))
                        <img src="{{ asset('images/settings/' . $settings['feature_3_image']) }}" alt="{{ $settings['feature_3_title'] ?? 'Feature' }}">
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    @endif
                </div>
                <div class="feat-card__body">
                    <h3 class="feat-card__title">{{ $settings['feature_3_title'] ?? 'Custom Cakes' }}</h3>
                    <p class="feat-card__desc">{{ $settings['feature_3_description'] ?? 'Beautiful custom cakes for every occasion, designed and made to order with care.' }}</p>
                    <a href="{{ route('menu.index') }}" class="feat-card__link">
                        View Menu
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ── Visit Us ── -->
@if(($settings['visit_enabled'] ?? '1') == '1')
<section class="visit" id="visit">
    <div class="visit__inner">
        <!-- Image side -->
        <div class="visit__img">
            @if(!empty($settings['visit_image']))
                <img src="{{ asset('images/settings/' . $settings['visit_image']) }}" alt="Visit Us">
            @else
                <div class="visit__img--ph">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
            @endif
            <div class="visit__badge">
                <div class="visit__badge-label">Open Today</div>
                <div class="visit__badge-val">{{ $settings['opening_hours'] ?? '7AM – 9PM' }}</div>
            </div>
        </div>

        <!-- Content side -->
        <div class="visit__content">
            <div class="sec-tag">
                <span class="sec-tag__line"></span>
                <span class="sec-tag__text">Visit Us</span>
            </div>
            <h2>{{ $settings['visit_title'] ?? 'Come say <em>hello</em>' }}</h2>
            <p>{{ $settings['visit_description'] ?? "Come experience the aroma of freshly baked goods and the warmth of our welcoming cafe. We're open daily to serve you the best." }}</p>

            @if(($settings['contact_enabled'] ?? '1') == '1')
            <div class="visit__info">
                @if(!empty($settings['address']))
                <div class="visit__info-row">
                    <div class="visit__info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <div class="visit__info-label">Address</div>
                        <div class="visit__info-text">{{ $settings['address'] }}</div>
                    </div>
                </div>
                @endif

                @if(!empty($settings['phone']))
                <div class="visit__info-row">
                    <div class="visit__info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <div>
                        <div class="visit__info-label">Phone</div>
                        <div class="visit__info-text">{{ $settings['phone'] }}</div>
                    </div>
                </div>
                @endif

                @if(!empty($settings['opening_hours']))
                <div class="visit__info-row">
                    <div class="visit__info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <div class="visit__info-label">Hours</div>
                        <div class="visit__info-text">{{ $settings['opening_hours'] }}</div>
                    </div>
                </div>
                @endif
            </div>
            @endif

            <a href="{{ route('menu.index') }}" class="btn btn--amber">
                Order Now
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- ── Menu Preview ── -->
@if(($settings['menu_preview_enabled'] ?? '1') == '1')
<section class="menu-preview" id="menu">
    <div class="menu-preview__inner">
        <div class="sec-head">
            <div class="sec-head__left">
                <div class="sec-tag">
                    <span class="sec-tag__line"></span>
                    <span class="sec-tag__text">Menu</span>
                </div>
                <h2 class="sec-head__title">A taste of <em>what awaits</em></h2>
            </div>
            <p class="sec-head__right">Explore a curated selection of our freshly made favourites — from morning pastries to afternoon treats.</p>
        </div>

        @if($featuredItems->count() > 0)
            <div class="menu-preview__grid">
                @foreach($featuredItems as $item)
                <div class="menu-card">
                    <div class="menu-card__img {{ $item->image ? '' : 'menu-card__img--ph' }}">
                        @if($item->image)
                            <img src="{{ asset('images/menu/' . $item->image) }}" alt="{{ $item->name }}">
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                                <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/>
                            </svg>
                        @endif
                        @if($item->category)
                            <span class="menu-card__cat">{{ $item->category->name }}</span>
                        @endif
                    </div>
                    <div class="menu-card__body">
                        <h3 class="menu-card__name">{{ $item->name }}</h3>
                        <p class="menu-card__desc">{{ $item->description ?? 'Delicious handcrafted item made with premium ingredients.' }}</p>
                        <div class="menu-card__footer">
                            <span class="menu-card__price"><sup>$</sup>{{ number_format($item->price, 2) }}</span>
                            @auth
                                <form action="{{ route('cart.add', $item->id) }}" method="POST" style="margin:0">
                                    @csrf
                                    <button type="submit" class="btn--card">Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn--card">Login to Order</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="menu-preview__empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                </svg>
                <h3>Menu Coming Soon</h3>
                <p>Our delicious items are being prepared. Check back soon!</p>
            </div>
        @endif

        <div class="menu-preview__cta">
            <a href="{{ route('menu.index') }}" class="btn btn--dark-lg">
                View Full Menu
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- ── Footer ── -->
<footer class="footer">
    <div class="footer__inner">
        <div class="footer__grid">
            <div class="footer__brand">
                <div class="footer__brand-logo">
                    <div class="footer__brand-mark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                        </svg>
                    </div>
                    <span class="footer__brand-name">{{ $settings['cafe_name'] ?? 'Cafe <span>System</span>' }}</span>
                </div>
                <p>{{ $settings['about_description'] ?? 'Serving freshly baked goods and premium coffee since day one. Experience the difference of handcrafted quality.' }}</p>
            </div>

            <div class="footer__col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('menu.index') }}">Menu</a></li>
                    <li><a href="#features">About Us</a></li>
                    <li><a href="#visit">Contact</a></li>
                </ul>
            </div>

            <div class="footer__col">
                <h4>Account</h4>
                <ul>
                    @auth
                        <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                        <li><a href="{{ route('cart.index') }}">Cart</a></li>
                        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>

            @if(($settings['contact_enabled'] ?? '1') == '1')
            <div class="footer__col">
                <h4>Contact</h4>
                <ul>
                    @if(!empty($settings['address']))  <li>{{ $settings['address'] }}</li> @endif
                    @if(!empty($settings['phone']))    <li>{{ $settings['phone'] }}</li>    @endif
                    @if(!empty($settings['email']))    <li><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></li> @endif
                </ul>
            </div>
            @endif
        </div>

        <div class="footer__bottom">
            <p>&copy; {{ date('Y') }} {{ $settings['cafe_name'] ?? 'Cafe System' }}. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Subtle nav scroll shadow -->
<script>
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 20);
    });
</script>

</body>
</html>