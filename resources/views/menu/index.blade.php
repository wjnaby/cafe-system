@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Outfit:wght@300;400;500;600&display=swap');

    :root {
        --brown-dark: #3D2314;
        --brown-medium: #5C3A21;
        --brown-light: #8B6914;
        --cream: #F5F0E8;
        --cream-light: #FAF8F5;
        --amber: #D4A574;
        --amber-dark: #B8956A;
        --text-dark: #2D1810;
        --text-muted: #6B5B4F;
        --card-bg: #fff;
        --border: #E8E2DA;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .menu-page {
        font-family: 'Outfit', sans-serif;
        background: var(--cream-light);
        min-height: 100vh;
        color: var(--text-dark);
    }

    /* ─── Grain overlay ─── */
    .menu-page::before {
        content: '';
        position: fixed;
        inset: 0;
        z-index: 999;
        pointer-events: none;
        opacity: .035;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    }

    /* ═══════════════════════════════
       HERO
       ═══════════════════════════════ */
    .menu-hero {
        background: var(--brown-dark);
        position: relative;
        overflow: hidden;
        padding: 140px 0 100px;
    }

    /* ambient light blobs */
    .menu-hero .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(90px);
        opacity: .18;
        pointer-events: none;
    }
    .menu-hero .blob--1 {
        width: 520px; height: 520px;
        background: var(--amber);
        top: -160px; right: -140px;
    }
    .menu-hero .blob--2 {
        width: 320px; height: 320px;
        background: var(--brown-medium);
        bottom: -100px; left: -80px;
        opacity: .25;
    }

    .hero-inner {
        max-width: 1160px;
        margin: 0 auto;
        padding: 0 32px;
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 80px;
        align-items: end;
        position: relative;
        z-index: 1;
    }

    /* Tag */
    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 28px;
    }
    .hero-tag__line {
        width: 32px;
        height: 1px;
        background: var(--amber);
    }
    .hero-tag__text {
        font-size: .8rem;
        font-weight: 500;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: var(--amber);
    }

    .hero-content h1 {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(3rem, 6vw, 5rem);
        font-weight: 400;
        color: #fff;
        line-height: 1.08;
        margin-bottom: 24px;
    }
    .hero-content h1 em {
        font-style: italic;
        color: var(--amber);
    }

    .hero-content p {
        font-size: 1.05rem;
        color: rgba(255,255,255,.55);
        line-height: 1.75;
        max-width: 480px;
        margin-bottom: 40px;
        font-weight: 300;
    }

    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        font-size: .92rem;
        letter-spacing: .06em;
        transition: gap .3s ease;
    }
    .hero-cta:hover { gap: 20px; }
    .hero-cta__circle {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: var(--amber);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .3s ease, transform .3s ease;
    }
    .hero-cta:hover .hero-cta__circle {
        background: var(--amber-dark);
        transform: scale(1.08);
    }
    .hero-cta__circle svg { width: 18px; height: 18px; color: var(--brown-dark); }

    /* Right visual block */
    .hero-visual {
        position: relative;
        height: 360px;
    }
    .hero-visual__card {
        position: absolute;
        inset: 0;
        background: linear-gradient(145deg, rgba(255,255,255,.06) 0%, transparent 70%);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 24px;
        backdrop-filter: blur(2px);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 36px;
        overflow: hidden;
    }
    .hero-visual__card::before {
        content: '';
        position: absolute;
        top: 28px; right: 28px;
        width: 140px; height: 140px;
        border-radius: 50%;
        border: 1px solid rgba(212,165,116,.22);
    }
    .hero-visual__card::after {
        content: '';
        position: absolute;
        top: 48px; right: 48px;
        width: 100px; height: 100px;
        border-radius: 50%;
        border: 1px solid rgba(212,165,116,.14);
    }
    .hero-visual__stat {
        position: relative;
        z-index: 1;
    }
    .hero-visual__stat-num {
        font-family: 'DM Serif Display', serif;
        font-size: 2.6rem;
        color: #fff;
        line-height: 1;
    }
    .hero-visual__stat-label {
        font-size: .78rem;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: rgba(255,255,255,.4);
        margin-top: 6px;
        font-weight: 400;
    }
    /* floating mini-cards */
    .hero-visual__mini {
        position: absolute;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 14px;
        backdrop-filter: blur(4px);
        padding: 14px 18px;
        z-index: 2;
    }
    .hero-visual__mini--top {
        top: -20px; left: 20px;
    }
    .hero-visual__mini--right {
        top: 60px; right: -30px;
    }
    .hero-visual__mini-label {
        font-size: .7rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: rgba(255,255,255,.4);
    }
    .hero-visual__mini-val {
        font-size: .95rem;
        font-weight: 600;
        color: #fff;
        margin-top: 2px;
    }

    /* ═══════════════════════════════
       SEARCH / FILTER BAR
       ═══════════════════════════════ */
    .search-section {
        max-width: 1160px;
        margin: -36px auto 0;
        padding: 0 32px;
        position: relative;
        z-index: 10;
    }

    .search-bar {
        background: var(--card-bg);
        border-radius: 18px;
        box-shadow: 0 8px 40px rgba(61,35,20,.1);
        padding: 10px 10px 10px 28px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .search-bar__icon {
        width: 18px; height: 18px;
        color: var(--text-muted);
        flex-shrink: 0;
    }

    .search-bar input[type="text"] {
        flex: 1;
        border: none;
        outline: none;
        font-family: 'Outfit', sans-serif;
        font-size: .92rem;
        color: var(--text-dark);
        background: transparent;
        min-width: 0;
        padding: 8px 0;
    }
    .search-bar input::placeholder { color: #a89d95; }

    .search-bar select {
        appearance: none;
        -webkit-appearance: none;
        border: none;
        outline: none;
        font-family: 'Outfit', sans-serif;
        font-size: .88rem;
        color: var(--text-muted);
        background: var(--cream-light)
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B5B4F' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E")
            right 14px center no-repeat;
        padding: 10px 38px 10px 16px;
        border-radius: 10px;
        cursor: pointer;
        min-width: 175px;
        transition: background-color .25s;
    }
    .search-bar select:focus { background-color: var(--cream); }

    .search-bar__btn {
        background: var(--brown-dark);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 13px 26px;
        font-family: 'Outfit', sans-serif;
        font-size: .88rem;
        font-weight: 500;
        cursor: pointer;
        transition: background .25s, transform .15s;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }
    .search-bar__btn:hover { background: var(--brown-medium); transform: translateY(-1px); }
    .search-bar__btn svg { width: 16px; height: 16px; }

    .search-bar__clear {
        font-family: 'Outfit', sans-serif;
        font-size: .82rem;
        color: var(--text-muted);
        text-decoration: none;
        padding: 10px 14px;
        border-radius: 10px;
        transition: background .25s, color .25s;
        white-space: nowrap;
    }
    .search-bar__clear:hover { background: var(--cream); color: var(--brown-dark); }

    /* ═══════════════════════════════
       CATEGORY PILLS
       ═══════════════════════════════ */
    .category-filters {
        max-width: 1160px;
        margin: 32px auto 0;
        padding: 0 32px;
    }
    .category-filters__row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .category-filters__label {
        font-size: .75rem;
        font-weight: 500;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-right: 6px;
    }

    .cat-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 18px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: var(--card-bg);
        font-family: 'Outfit', sans-serif;
        font-size: .84rem;
        font-weight: 400;
        color: var(--text-muted);
        cursor: pointer;
        text-decoration: none;
        transition: border-color .25s, color .25s, background .25s, box-shadow .25s;
    }
    .cat-pill:hover {
        border-color: var(--amber);
        color: var(--brown-dark);
        box-shadow: 0 3px 12px rgba(61,35,20,.08);
    }
    .cat-pill.active {
        background: var(--brown-dark);
        border-color: var(--brown-dark);
        color: #fff;
    }
    .cat-pill.active:hover { background: var(--brown-medium); border-color: var(--brown-medium); }

    .cat-pill__count {
        font-size: .72rem;
        font-weight: 600;
        opacity: .55;
    }
    .cat-pill.active .cat-pill__count { opacity: .7; }

    /* ═══════════════════════════════
       MENU BODY
       ═══════════════════════════════ */
    .menu-body {
        max-width: 1160px;
        margin: 52px auto 100px;
        padding: 0 32px;
    }

    /* Section header */
    .section-head {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 28px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--border);
    }
    .section-head__left {
        display: flex;
        align-items: baseline;
        gap: 16px;
    }
    .section-head h2 {
        font-family: 'DM Serif Display', serif;
        font-size: 1.9rem;
        font-weight: 400;
        color: var(--text-dark);
    }
    .section-head__count {
        font-size: .78rem;
        font-weight: 500;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--text-muted);
    }

    /* Product grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 22px;
    }

    /* ─── Product Card ─── */
    .product-card {
        background: var(--card-bg);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: box-shadow .35s ease, transform .35s ease;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        box-shadow: 0 12px 40px rgba(61,35,20,.11);
        transform: translateY(-4px);
    }

    /* Image area */
    .product-card__img {
        height: 195px;
        background: linear-gradient(140deg, var(--cream) 0%, #E4DCD0 100%);
        position: relative;
        overflow: hidden;
    }
    .product-card__img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .product-card:hover .product-card__img img { transform: scale(1.06); }

    /* fallback pattern when no image */
    .product-card__img--placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-card__img--placeholder svg {
        width: 56px; height: 56px;
        opacity: .25;
        color: var(--brown-medium);
    }

    /* badge */
    .product-card__badge {
        position: absolute;
        top: 14px; left: 14px;
        background: var(--brown-dark);
        color: var(--amber);
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        padding: 5px 11px;
        border-radius: 6px;
        z-index: 2;
    }

    /* Body */
    .product-card__body {
        padding: 22px 22px 0;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .product-card__name {
        font-family: 'DM Serif Display', serif;
        font-size: 1.2rem;
        font-weight: 400;
        color: var(--text-dark);
        margin-bottom: 6px;
    }
    .product-card__desc {
        font-size: .84rem;
        color: var(--text-muted);
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 14px;
        font-weight: 300;
    }

    /* Stars */
    .product-card__stars {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: auto;
    }
    .product-card__stars-row { display: flex; gap: 2px; }
    .product-card__stars-row span { font-size: 13px; color: #E8B84B; }
    .product-card__stars-row span.empty { color: var(--border); }
    .product-card__stars-label {
        font-size: .77rem;
        color: var(--text-muted);
    }

    /* Footer */
    .product-card__footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 0 22px;
        margin-top: 18px;
        border-top: 1px solid var(--border);
    }
    .product-card__price {
        font-family: 'DM Serif Display', serif;
        font-size: 1.45rem;
        color: var(--brown-dark);
    }
    .product-card__price sup {
        font-size: .72rem;
        vertical-align: super;
        font-family: 'Outfit', sans-serif;
        font-weight: 500;
        margin-right: 1px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--brown-dark);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-family: 'Outfit', sans-serif;
        font-size: .84rem;
        font-weight: 500;
        cursor: pointer;
        transition: background .25s, transform .15s;
        text-decoration: none;
    }
    .btn-add:hover { background: var(--brown-medium); transform: scale(1.04); }
    .btn-add svg { width: 16px; height: 16px; }

    .btn-login {
        display: inline-flex;
        align-items: center;
        background: var(--cream);
        color: var(--text-muted);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 10px 18px;
        font-family: 'Outfit', sans-serif;
        font-size: .84rem;
        font-weight: 400;
        cursor: pointer;
        text-decoration: none;
        transition: background .25s, color .25s;
    }
    .btn-login:hover { background: var(--border); color: var(--brown-dark); }

    /* No results */
    .no-results {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 80px 40px;
        text-align: center;
    }
    .no-results__icon {
        width: 48px; height: 48px;
        margin: 0 auto 24px;
        color: var(--amber);
    }
    .no-results h3 {
        font-family: 'DM Serif Display', serif;
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--text-dark);
        margin-bottom: 8px;
    }
    .no-results p { color: var(--text-muted); font-size: .9rem; margin-bottom: 20px; }
    .no-results a {
        color: var(--amber-dark);
        font-weight: 500;
        text-decoration: none;
        font-size: .88rem;
        transition: color .25s;
    }
    .no-results a:hover { color: var(--brown-dark); }

    /* ═══════════════════════════════
       RESPONSIVE
       ═══════════════════════════════ */
    @media (max-width: 860px) {
        .hero-inner {
            grid-template-columns: 1fr;
            gap: 0;
        }
        .hero-visual { display: none; }
        .menu-hero { padding: 110px 0 72px; }
        .hero-content h1 { font-size: 2.8rem; }
    }
    @media (max-width: 600px) {
        .menu-hero { padding: 90px 0 60px; }
        .hero-inner { padding: 0 20px; }
        .hero-content h1 { font-size: 2.2rem; }
        .hero-content p { font-size: .94rem; }
        .search-section, .category-filters, .menu-body { padding-left: 20px; padding-right: 20px; }
        .search-bar {
            flex-wrap: wrap;
            padding: 14px;
            gap: 10px;
        }
        .search-bar input[type="text"],
        .search-bar select { width: 100%; min-width: 0; }
        .search-bar__btn { width: 100%; justify-content: center; }
        .product-grid { grid-template-columns: 1fr; }
        .section-head h2 { font-size: 1.55rem; }
    }
</style>
@endsection

@section('content')
<div class="menu-page">

    <!-- ── Hero ── -->
    <section class="menu-hero">
        <div class="blob blob--1"></div>
        <div class="blob blob--2"></div>

        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-tag">
                    <span class="hero-tag__line"></span>
                    <span class="hero-tag__text">Premium Selection</span>
                </div>
                <h1>Savor the<br><em>Perfect Brew</em></h1>
                <p>Discover our handcrafted selection of premium coffees, teas, and delicious treats — each prepared with passion and the finest ingredients.</p>

                @auth
                    <a href="#menu-items" class="hero-cta">
                        <div class="hero-cta__circle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </div>
                        Explore Menu
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hero-cta">
                        <div class="hero-cta__circle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </div>
                        Login to Order
                    </a>
                @endauth
            </div>

            <!-- Right visual (hidden on mobile) -->
            <div class="hero-visual">
                <div class="hero-visual__mini hero-visual__mini--top">
                    <div class="hero-visual__mini-label">Origin</div>
                    <div class="hero-visual__mini-val">Single Estate</div>
                </div>
                <div class="hero-visual__mini hero-visual__mini--right">
                    <div class="hero-visual__mini-label">Roasted</div>
                    <div class="hero-visual__mini-val">Fresh Daily</div>
                </div>
                <div class="hero-visual__card">
                    <div class="hero-visual__stat">
                        <div class="hero-visual__stat-num">47+</div>
                        <div class="hero-visual__stat-label">Handcrafted Drinks</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Search ── -->
    <section class="search-section">
        <form action="{{ route('menu.index') }}" method="GET" class="search-bar">
            <svg class="search-bar__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="search" placeholder="Search coffee, tea, pastries…" value="{{ request('search') }}">

            <select name="category">
                <option value="">All Categories</option>
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="search-bar__btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Search
            </button>
            <a href="{{ route('menu.index') }}" class="search-bar__clear">Clear</a>
        </form>
    </section>

    <!-- ── Category Pills ── -->
    <div class="category-filters">
        <div class="category-filters__row">
            <span class="category-filters__label">Filter</span>
            <!-- Example pills — wire up hrefs with query params as needed -->
            <a href="{{ route('menu.index') }}" class="cat-pill {{ !request('category') ? 'active' : '' }}">
                All
                <span class="cat-pill__count">{{ $categories->sum(fn($c) => $c->menuItems->count()) }}</span>
            </a>
            @foreach(\App\Models\Category::all() as $cat)
                <a href="{{ route('menu.index') }}?category={{ $cat->id }}" class="cat-pill {{ request('category') == $cat->id ? 'active' : '' }}">
                    {{ $cat->name }}
                    <span class="cat-pill__count">{{ $cat->menuItems->count() }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- ── Menu Items ── -->
    <main class="menu-body" id="menu-items">

        @php
            $hasItems = false;
            foreach($categories as $category) {
                if($category->menuItems->count() > 0) { $hasItems = true; break; }
            }
        @endphp

        @if(!$hasItems && (request('search') || request('category')))
            <div class="no-results">
                <svg class="no-results__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <h3>No items found</h3>
                <p>We couldn't find anything matching your search.</p>
                <a href="{{ route('menu.index') }}">← View all menu items</a>
            </div>
        @endif

        @foreach($categories as $category)
            @if($category->menuItems->count() > 0)
                <section style="margin-bottom: 56px;">

                    <div class="section-head">
                        <div class="section-head__left">
                            <h2>{{ $category->name }}</h2>
                            <span class="section-head__count">{{ $category->menuItems->count() }} items</span>
                        </div>
                    </div>

                    <div class="product-grid">
                        @foreach($category->menuItems as $item)
                            <article class="product-card">
                                <!-- Image -->
                                <div class="product-card__img {{ $item->image ? '' : 'product-card__img--placeholder' }}">
                                    @if($item->image)
                                        <img src="{{ asset('images/menu/'.$item->image) }}" alt="{{ $item->name }}">
                                    @else
                                        <!-- subtle coffee-cup icon as placeholder -->
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                                            <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/>
                                        </svg>
                                    @endif
                                    @if($loop->first && $loop->parent->first)
                                        <span class="product-card__badge">Popular</span>
                                    @endif
                                </div>

                                <!-- Body -->
                                <div class="product-card__body">
                                    <h3 class="product-card__name">{{ $item->name }}</h3>
                                    <p class="product-card__desc">{{ $item->description ?? 'A delicious handcrafted beverage made with premium ingredients.' }}</p>

                                    <div class="product-card__stars">
                                        <div class="product-card__stars-row">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="{{ $i <= 4 ? '' : 'empty' }}">★</span>
                                            @endfor
                                        </div>
                                        <span class="product-card__stars-label">4.0</span>
                                    </div>

                                    <!-- Footer -->
                                    <div class="product-card__footer">
                                        <div class="product-card__price">
                                            <sup>$</sup>{{ number_format($item->price, 2) }}
                                        </div>

                                        @auth
                                            <form action="{{ route('cart.add', $item->id) }}" method="POST" style="margin:0">
                                                @csrf
                                                <button type="submit" class="btn-add">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
                                                    Add
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="btn-login">Login to Order</a>
                                        @endauth
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach

    </main>
</div>
@endsection