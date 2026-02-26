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

        html { scroll-behavior: smooth; }

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
            display: flex;
            align-items: center;
            background: var(--brown-dark);
            position: relative;
            overflow: hidden;
            padding: 88px 32px 64px;
        }

        /* Ambient blobs */
        .hero__blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
        }
        .hero__blob--1 { width: 500px; height: 500px; background: var(--amber); opacity: .12; top: -160px; right: -140px; }
        .hero__blob--2 { width: 320px; height: 320px; background: var(--brown-medium); opacity: .28; bottom: -80px; left: -80px; }
        .hero__blob--3 { width: 160px; height: 160px; background: var(--amber-dark); opacity: .08; top: 50%; left: 35%; }

        .hero__inner {
            max-width: 1160px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 56px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        /* Tag */
        .hero__tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
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
            font-size: clamp(2.4rem, 4.8vw, 3.8rem);
            font-weight: 400;
            color: #fff;
            line-height: 1.07;
            margin-bottom: 16px;
        }
        .hero__title em { font-style: italic; color: var(--amber); }

        .hero__sub {
            font-size: .95rem;
            color: rgba(255,255,255,.5);
            line-height: 1.7;
            max-width: 440px;
            margin-bottom: 28px;
            font-weight: 300;
        }

        .hero__actions { display: flex; gap: 12px; flex-wrap: wrap; }

        /* Right: single coffee image */
        .hero__visual {
            position: relative;
            height: 320px;
            border-radius: 20px;
            overflow: hidden;
        }
        .hero__visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }
        .hero__visual:hover img { transform: scale(1.03); }

        .hero__vis-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(145deg, rgba(255,255,255,.06) 0%, transparent 65%);
            border: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero__vis-placeholder svg { width: 80px; height: 80px; color: rgba(255,255,255,.2); }

        .hero__float {
            position: absolute;
            bottom: 14px; left: 14px;
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 10px;
            padding: 10px 14px;
            z-index: 2;
        }
        .hero__float-label { font-size: .65rem; letter-spacing: .1em; text-transform: uppercase; color: rgba(255,255,255,.5); }
        .hero__float-val { font-size: .85rem; font-weight: 600; color: #fff; margin-top: 2px; }

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
            padding: 72px 32px;
            background: var(--cream);
        }
        .visit__inner {
            max-width: 1160px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 48px;
            align-items: center;
        }

        .visit__img {
            border-radius: 16px;
            overflow: hidden;
            height: 320px;
            position: relative;
        }
        .visit__img img { width: 100%; height: 100%; object-fit: cover; }
        .visit__img--ph {
            width: 100%; height: 100%;
            background: linear-gradient(145deg, var(--cream-dark) 0%, #DDD5C6 100%);
            display: flex; align-items: center; justify-content: center;
        }
        .visit__img--ph svg { width: 56px; height: 56px; color: var(--amber-dark); opacity: .3; }

        /* Floating card on image */
        .visit__badge {
            position: absolute;
            bottom: 16px; right: 16px;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            padding: 12px 16px;
            box-shadow: 0 6px 24px rgba(0,0,0,.08);
            z-index: 2;
        }
        .visit__badge-label { font-size: .65rem; letter-spacing: .1em; text-transform: uppercase; color: var(--text-muted); }
        .visit__badge-val { font-family: 'DM Serif Display', serif; font-size: 1.05rem; color: var(--brown-dark); margin-top: 2px; }

        .visit__content .sec-tag { margin-bottom: 12px; display: inline-flex; align-items: center; gap: 10px; }
        .visit__content h2 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(1.65rem, 2.8vw, 2.15rem);
            font-weight: 400;
            color: var(--brown-dark);
            line-height: 1.2;
            margin-bottom: 10px;
        }
        .visit__content h2 em { font-style: italic; color: var(--amber-dark); }
        .visit__content > p {
            font-size: .88rem;
            color: var(--text-muted);
            line-height: 1.65;
            font-weight: 300;
            margin-bottom: 22px;
        }

        .visit__info { display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px; }
        .visit__info-row { display: flex; align-items: center; gap: 12px; }
        .visit__info-icon {
            width: 36px; height: 36px;
            border-radius: 8px;
            background: var(--cream-dark);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .visit__info-icon svg { width: 16px; height: 16px; color: var(--amber-dark); }
        .visit__info-text { font-size: .85rem; color: var(--text-dark); font-weight: 400; }
        .visit__info-label { font-size: .68rem; letter-spacing: .1em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 1px; }

        /* ═══════════════════════════════
           MENU PREVIEW
           ═══════════════════════════════ */
        .menu-preview {
            padding: 120px 32px 100px;
            background: linear-gradient(180deg, #fff 0%, var(--cream) 35%, var(--cream-dark) 100%);
            position: relative;
        }
        .menu-preview::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
            opacity: .8;
        }
        .menu-preview__inner { max-width: 1160px; margin: 0 auto; }

        .menu-preview .sec-head { margin-bottom: 56px; }
        .menu-preview .sec-head__title {
            position: relative;
            display: inline-block;
        }
        .menu-preview .sec-head__title::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--amber), transparent);
            border-radius: 2px;
            opacity: .4;
        }

        .menu-preview__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            margin-bottom: 56px;
        }

        .menu-card {
            border-radius: 20px;
            overflow: hidden;
            background: #fff;
            transition: box-shadow .4s ease, transform .4s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 20px rgba(61,35,20,.06), 0 1px 3px rgba(61,35,20,.04);
            border: 1px solid rgba(228, 222, 213, .6);
        }
        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 48px rgba(61,35,20,.12), 0 8px 24px rgba(61,35,20,.08);
            border-color: rgba(212,165,116,.25);
        }

        .menu-card__img {
            height: 200px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, var(--cream-dark) 0%, #E8E0D4 100%);
        }
        .menu-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .menu-card:hover .menu-card__img img { transform: scale(1.08); }

        .menu-card__img::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(61,35,20,.15) 0%, transparent 50%);
            pointer-events: none;
        }
        .menu-card__img--ph { display: flex; align-items: center; justify-content: center; }
        .menu-card__img--ph::after { display: none; }
        .menu-card__img--ph svg { width: 48px; height: 48px; color: var(--amber-dark); opacity: .35; }

        .menu-card__cat {
            position: absolute;
            top: 16px; left: 16px;
            background: rgba(255,255,255,.95);
            color: var(--brown-dark);
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            padding: 6px 12px;
            border-radius: 20px;
            z-index: 2;
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 8px rgba(61,35,20,.08);
        }

        .menu-card__body {
            padding: 24px 26px 26px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .menu-card__name {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            font-weight: 400;
            color: var(--brown-dark);
            margin-bottom: 0;
            line-height: 1.3;
        }
        .menu-card__desc {
            font-size: .84rem;
            color: var(--text-muted);
            line-height: 1.65;
            font-weight: 300;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0;
        }

        .menu-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 20px;
            margin-top: auto;
            gap: 12px;
        }
        .menu-card__price {
            font-family: 'DM Serif Display', serif;
            font-size: 1.5rem;
            color: var(--brown-dark);
            letter-spacing: -.02em;
        }
        .menu-card__price sup {
            font-size: .75rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            vertical-align: super;
            margin-right: 2px;
            opacity: .9;
        }

        .btn--card {
            padding: 10px 20px;
            border-radius: 10px;
            background: var(--amber);
            color: var(--brown-dark);
            font-family: 'Outfit', sans-serif;
            font-size: .83rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background .25s, transform .2s, box-shadow .25s;
            flex-shrink: 0;
            box-shadow: 0 2px 12px rgba(212,165,116,.3);
        }
        .btn--card:hover {
            background: var(--amber-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(212,165,116,.4);
        }

        /* empty state */
        .menu-preview__empty {
            border-radius: 20px;
            padding: 80px 48px;
            text-align: center;
            background: linear-gradient(145deg, #fff 0%, var(--cream) 100%);
            border: 1px dashed var(--border);
            box-shadow: 0 4px 24px rgba(61,35,20,.04);
        }
        .menu-preview__empty svg {
            width: 56px;
            height: 56px;
            color: var(--amber);
            margin-bottom: 20px;
            opacity: .9;
        }
        .menu-preview__empty h3 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: var(--brown-dark);
            margin-bottom: 8px;
        }
        .menu-preview__empty p { color: var(--text-muted); font-size: .9rem; }

        .menu-preview__cta {
            text-align: center;
        }
        .menu-preview__cta .btn {
            padding: 14px 32px;
            font-size: .9rem;
            border-radius: 12px;
        }

        /* ═══════════════════════════════
           FOOTER
           ═══════════════════════════════ */
        .footer {
            background: var(--brown-dark);
            color: #fff;
            padding: 40px 24px 20px;
        }
        .footer__inner { max-width: 1160px; margin: 0 auto; }

        .footer__grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 28px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }

        .footer__brand-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }
        .footer__brand-mark {
            width: 28px; height: 28px;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
        }
        .footer__brand-mark svg { width: 14px; height: 14px; color: var(--amber); }
        .footer__brand-name { font-family: 'DM Serif Display', serif; font-size: 1rem; }
        .footer__brand-name span { color: var(--amber); }

        .footer__brand p {
            font-size: .78rem;
            color: rgba(255,255,255,.5);
            line-height: 1.5;
            font-weight: 300;
            max-width: 280px;
        }

        .footer__col h4 {
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 10px;
        }
        .footer__col ul { list-style: none; }
        .footer__col li { margin-bottom: 6px; }
        .footer__col a {
            color: rgba(255,255,255,.5);
            text-decoration: none;
            font-size: .8rem;
            font-weight: 300;
            transition: color .25s;
        }
        .footer__col a:hover { color: #fff; }
        .footer__col li:not(:has(a)) {
            color: rgba(255,255,255,.5);
            font-size: .8rem;
            font-weight: 300;
        }

        .footer__bottom {
            padding-top: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer__bottom p {
            color: rgba(255,255,255,.3);
            font-size: .75rem;
        }

        /* ═══════════════════════════════
           RESPONSIVE
           ═══════════════════════════════ */
        @media (max-width: 1024px) {
            .hero__inner { grid-template-columns: 1fr; gap: 40px; }
            .hero__visual { max-width: 440px; margin: 0 auto; height: 280px; }
            .hero { text-align: center; }
            .hero__tag { justify-content: center; }
            .hero__sub { margin-left: auto; margin-right: auto; }
            .hero__actions { justify-content: center; }
            /* Stacked layout: use fade-in-up instead of side slide */
            .hero__tag, .hero__title, .hero__sub, .hero__actions { animation: fadeInUp .7s ease-out both; }
            .hero__tag { animation-delay: .15s; }
            .hero__title { animation-delay: .3s; }
            .hero__sub { animation-delay: .45s; }
            .hero__actions { animation-delay: .6s; }
            .hero__visual { animation: fadeInUp .9s ease-out .4s both; }

            .sec-head { grid-template-columns: 1fr; gap: 16px; }
            .sec-head__right { justify-self: start; max-width: 100%; }

            .features__grid,
            .menu-preview__grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }

            .visit__inner { grid-template-columns: 1fr; }
            .visit__img { order: -1; height: 260px; }

            .footer__grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .nav__links { display: none; }
            .nav__toggle { display: block; }

            .hero { padding: 72px 24px 52px; }
            .hero__visual { height: 240px; }
            .hero__title { font-size: 2.1rem; }

            .features, .visit, .menu-preview { padding: 64px 24px; }
            .menu-preview { padding: 64px 24px 72px; }
            .features__grid,
            .menu-preview__grid { grid-template-columns: 1fr; gap: 22px; max-width: 400px; margin-left: auto; margin-right: auto; }

            .footer__grid { grid-template-columns: 1fr; text-align: center; }
            .footer__brand p { max-width: 100%; }
            .footer__bottom { flex-direction: column; gap: 8px; text-align: center; }
        }

        @media (max-width: 480px) {
            .hero__actions { flex-direction: column; width: 100%; }
            .hero__actions .btn { width: 100%; justify-content: center; }
            .nav__actions .btn--outline { display: none; }
        }

        /* ═══════════════════════════════
           ANIMATIONS
           ═══════════════════════════════ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(8px, -12px) scale(1.02); }
            66% { transform: translate(-6px, 8px) scale(0.98); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-48px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(48px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Hero load-in: content from left, image from right */
        .hero__tag { animation: slideInLeft .7s ease-out .15s both; }
        .hero__title { animation: slideInLeft .75s ease-out .28s both; }
        .hero__sub { animation: slideInLeft .7s ease-out .42s both; }
        .hero__actions { animation: slideInLeft .7s ease-out .55s both; }
        .hero__visual { animation: slideInRight .9s ease-out .35s both; }
        .hero__blob--1 { animation: blobFloat 12s ease-in-out infinite; }
        .hero__blob--2 { animation: blobFloat 15s ease-in-out infinite .5s; }
        .hero__blob--3 { animation: blobFloat 10s ease-in-out infinite 1s; }

        /* Nav subtle fade-in */
        .nav { animation: fadeIn .5s ease-out; }

        /* Scroll-triggered reveal */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .65s ease-out, transform .65s ease-out;
        }
        .reveal.reveal--in-view {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal__item {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .5s ease-out, transform .5s ease-out;
        }
        .reveal.reveal--in-view .reveal__item {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal.reveal--in-view .reveal__item:nth-child(1) { transition-delay: .05s; }
        .reveal.reveal--in-view .reveal__item:nth-child(2) { transition-delay: .12s; }
        .reveal.reveal--in-view .reveal__item:nth-child(3) { transition-delay: .19s; }
        .reveal.reveal--in-view .reveal__item:nth-child(4) { transition-delay: .26s; }
        .reveal.reveal--in-view .reveal__item:nth-child(5) { transition-delay: .33s; }
        .reveal.reveal--in-view .reveal__item:nth-child(6) { transition-delay: .4s; }
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

        <!-- Coffee image -->
        <div class="hero__visual">
            @if(!empty($settings['hero_image']))
                <img src="{{ asset('images/settings/' . $settings['hero_image']) }}" alt="Coffee">
            @else
                <div class="hero__vis-placeholder">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8z"/>
                        <line x1="6" y1="2" x2="6" y2="4"/><line x1="10" y1="2" x2="10" y2="4"/><line x1="14" y1="2" x2="14" y2="4"/>
                    </svg>
                </div>
            @endif
            <div class="hero__float">
                <div class="hero__float-label">Est.</div>
                <div class="hero__float-val">Since {{ $settings['established_year'] ?? '2020' }}</div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ── Features ── -->
@if(($settings['features_enabled'] ?? '1') == '1')
<section class="features" id="features">
    <div class="features__inner reveal" id="revealFeatures">
        <div class="sec-head">
            <div class="sec-head__left reveal__item">
                <div class="sec-tag">
                    <span class="sec-tag__line"></span>
                    <span class="sec-tag__text">Why Choose Us</span>
                </div>
                <h2 class="sec-head__title">{{ $settings['about_title'] ?? 'What makes us <em>different</em>' }}</h2>
            </div>
            <p class="sec-head__right reveal__item">{{ $settings['about_description'] ?? 'We pride ourselves on using only the finest ingredients, traditional recipes passed down through generations, and a passion for creating memorable experiences.' }}</p>
        </div>

        <div class="features__grid">
            <!-- Card 1 -->
            <div class="feat-card reveal__item">
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
            <div class="feat-card reveal__item">
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
            <div class="feat-card reveal__item">
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
    <div class="visit__inner reveal" id="revealVisit">
        <!-- Image side -->
        <div class="visit__img reveal__item">
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
        <div class="visit__content reveal__item">
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
    <div class="menu-preview__inner reveal" id="revealMenu">
        <div class="sec-head">
            <div class="sec-head__left reveal__item">
                <div class="sec-tag">
                    <span class="sec-tag__line"></span>
                    <span class="sec-tag__text">Menu</span>
                </div>
                <h2 class="sec-head__title">A taste of <em>what awaits</em></h2>
            </div>
            <p class="sec-head__right reveal__item">Explore a curated selection of our freshly made favourites — from morning pastries to afternoon treats.</p>
        </div>

        @if($featuredItems->count() > 0)
            <div class="menu-preview__grid">
                @foreach($featuredItems as $item)
                <div class="menu-card reveal__item">
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
            <div class="menu-preview__empty reveal__item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                </svg>
                <h3>Menu Coming Soon</h3>
                <p>Our delicious items are being prepared. Check back soon!</p>
            </div>
        @endif

        <div class="menu-preview__cta reveal__item">
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
                    <li><a href="{{ route('welcome') }}#features">About Us</a></li>
                    <li><a href="{{ route('welcome') }}#visit">Contact</a></li>
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

<!-- Subtle nav scroll shadow + scroll-triggered reveal -->
<script>
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 20);
    });

    (function() {
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal--in-view');
                }
            });
        }, { rootMargin: '0px 0px -60px 0px', threshold: 0.1 });
        reveals.forEach(function(el) { observer.observe(el); });
    })();
</script>

</body>
</html>