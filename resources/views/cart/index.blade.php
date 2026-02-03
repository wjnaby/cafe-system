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

    .cart-page {
        font-family: 'Outfit', sans-serif;
        background: var(--cream-light);
        min-height: 100vh;
        color: var(--text-dark);
    }

    /* ─── Grain overlay ─── */
    .cart-page::before {
        content: '';
        position: fixed;
        inset: 0;
        z-index: 999;
        pointer-events: none;
        opacity: .035;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    }

    /* ═══════════════════════════════
       HERO HEADER
       ═══════════════════════════════ */
    .cart-hero {
        background: var(--brown-dark);
        position: relative;
        overflow: hidden;
        padding: 70px 0 60px;
    }

    /* ambient light blobs */
    .cart-hero .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(90px);
        opacity: .18;
        pointer-events: none;
    }
    .cart-hero .blob--1 {
        width: 420px; height: 420px;
        background: var(--amber);
        top: -120px; right: -100px;
    }
    .cart-hero .blob--2 {
        width: 280px; height: 280px;
        background: var(--brown-medium);
        bottom: -80px; left: -60px;
        opacity: .25;
    }

    .hero-inner {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 32px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        position: relative;
        z-index: 1;
    }

    /* Tag */
    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }
    .hero-tag__line {
        width: 32px;
        height: 1px;
        background: var(--amber);
    }
    .hero-tag__text {
        font-size: .78rem;
        font-weight: 500;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: var(--amber);
    }

    .hero-content h1 {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 400;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 10px;
    }
    .hero-content h1 em {
        font-style: italic;
        color: var(--amber);
    }

    .hero-content p {
        font-size: .95rem;
        color: rgba(255,255,255,.5);
        font-weight: 300;
    }

    /* Back to menu link */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: rgba(255,255,255,.7);
        text-decoration: none;
        font-weight: 400;
        font-size: .88rem;
        padding: 12px 22px;
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 10px;
        transition: all .3s ease;
        background: rgba(255,255,255,.04);
    }
    .btn-back:hover {
        background: rgba(255,255,255,.1);
        border-color: rgba(255,255,255,.25);
        color: #fff;
    }
    .btn-back svg { width: 16px; height: 16px; }

    /* ═══════════════════════════════
       CART BODY
       ═══════════════════════════════ */
    .cart-body {
        max-width: 900px;
        margin: -28px auto 80px;
        padding: 0 32px;
        position: relative;
        z-index: 10;
    }

    /* ─── Cart Panel ─── */
    .cart-panel {
        background: var(--card-bg);
        border-radius: 18px;
        box-shadow: 0 8px 40px rgba(61,35,20,.1);
        overflow: hidden;
    }

    /* ─── Cart Item Row ─── */
    .cart-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 22px 28px;
        border-bottom: 1px solid var(--border);
        transition: background .2s ease;
    }
    .cart-item:last-of-type { border-bottom: none; }
    .cart-item:hover { background: rgba(245,240,232,.5); }

    /* Thumbnail */
    .cart-thumb {
        flex-shrink: 0;
        width: 80px;
        height: 80px;
        border-radius: 14px;
        background: linear-gradient(140deg, var(--cream) 0%, #E4DCD0 100%);
        border: 1px solid var(--border);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cart-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .cart-thumb svg {
        width: 32px;
        height: 32px;
        opacity: .35;
        color: var(--brown-medium);
    }

    /* Name + price */
    .cart-info { flex: 1; min-width: 0; }
    .cart-info h3 {
        font-family: 'DM Serif Display', serif;
        font-size: 1.1rem;
        font-weight: 400;
        color: var(--text-dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 4px;
    }
    .cart-info p {
        font-size: .84rem;
        color: var(--text-muted);
        font-weight: 300;
    }

    /* Qty stepper */
    .qty-stepper {
        display: flex;
        align-items: center;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: var(--cream-light);
    }
    .qty-btn {
        width: 38px;
        height: 40px;
        border: none;
        background: transparent;
        color: var(--text-muted);
        font-size: 1.15rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .2s, color .2s;
        font-family: inherit;
    }
    .qty-btn:hover { background: var(--cream); color: var(--brown-dark); }
    .qty-val {
        width: 44px;
        height: 40px;
        border: none;
        border-left: 1px solid var(--border);
        border-right: 1px solid var(--border);
        text-align: center;
        font-size: .92rem;
        font-weight: 600;
        color: var(--text-dark);
        background: var(--card-bg);
        font-family: inherit;
    }
    .qty-val:focus { outline: none; }

    /* Subtotal */
    .cart-subtotal {
        flex-shrink: 0;
        min-width: 80px;
        text-align: right;
    }
    .cart-subtotal span {
        font-family: 'DM Serif Display', serif;
        font-size: 1.15rem;
        font-weight: 400;
        color: var(--brown-dark);
    }

    /* Remove btn */
    .remove-btn {
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        border: 1px solid transparent;
        border-radius: 10px;
        background: transparent;
        color: var(--border);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .2s ease;
    }
    .remove-btn:hover {
        background: #fef2f2;
        border-color: #fecaca;
        color: #ef4444;
    }
    .remove-btn svg { width: 18px; height: 18px; }

    /* ─── Summary Footer ─── */
    .cart-summary {
        background: var(--cream);
        border-top: 1px solid var(--border);
        padding: 28px;
    }

    /* Notes */
    .notes-label {
        font-size: .76rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: .1em;
        margin-bottom: 10px;
        display: block;
    }
    .notes-textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 14px 16px;
        font-size: .88rem;
        color: var(--text-dark);
        font-family: 'Outfit', sans-serif;
        resize: vertical;
        min-height: 90px;
        background: var(--card-bg);
        transition: border-color .25s, box-shadow .25s;
    }
    .notes-textarea::placeholder { color: #a89d95; }
    .notes-textarea:focus {
        outline: none;
        border-color: var(--amber);
        box-shadow: 0 0 0 3px rgba(212,165,116,.15);
    }
    .notes-hint {
        font-size: .76rem;
        color: var(--text-muted);
        margin-top: 8px;
        font-weight: 300;
    }

    /* Total row */
    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 24px 0 20px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }
    .total-row .label {
        font-size: .78rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: .1em;
    }
    .total-row .amount {
        font-family: 'DM Serif Display', serif;
        font-size: 2rem;
        color: var(--brown-dark);
        letter-spacing: -0.02em;
    }

    /* Place Order */
    .btn-place-order {
        width: 100%;
        padding: 16px;
        border: none;
        border-radius: 12px;
        background: var(--brown-dark);
        color: #fff;
        font-family: 'Outfit', sans-serif;
        font-size: .95rem;
        font-weight: 500;
        letter-spacing: .02em;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: background .25s, transform .15s;
    }
    .btn-place-order:hover {
        background: var(--brown-medium);
        transform: translateY(-2px);
    }
    .btn-place-order svg { width: 18px; height: 18px; }

    /* ─── Empty State ─── */
    .empty-panel {
        background: var(--card-bg);
        border-radius: 18px;
        box-shadow: 0 8px 40px rgba(61,35,20,.1);
        padding: 80px 32px;
        text-align: center;
    }
    .empty-icon-wrap {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: linear-gradient(140deg, var(--cream) 0%, #E4DCD0 100%);
        border: 1px solid var(--border);
        margin: 0 auto 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .empty-icon-wrap svg { width: 40px; height: 40px; color: var(--amber-dark); }
    .empty-panel h2 {
        font-family: 'DM Serif Display', serif;
        font-size: 1.5rem;
        font-weight: 400;
        color: var(--text-dark);
        margin-bottom: 8px;
    }
    .empty-panel p {
        font-size: .92rem;
        color: var(--text-muted);
        margin-bottom: 28px;
        font-weight: 300;
    }
    .btn-browse {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 28px;
        border-radius: 10px;
        background: var(--brown-dark);
        color: #fff;
        font-size: .9rem;
        font-weight: 500;
        text-decoration: none;
        transition: background .25s, transform .15s;
        font-family: 'Outfit', sans-serif;
    }
    .btn-browse:hover {
        background: var(--brown-medium);
        transform: translateY(-2px);
    }
    .btn-browse svg { width: 16px; height: 16px; }

    /* ─── Decorative element ─── */
    .cart-decor {
        text-align: center;
        margin-top: 48px;
        opacity: .3;
    }
    .cart-decor svg {
        width: 48px;
        height: 48px;
        color: var(--amber-dark);
    }

    /* ═══════════════════════════════
       RESPONSIVE
       ═══════════════════════════════ */
    @media (max-width: 700px) {
        .cart-hero { padding: 50px 0 40px; }
        .hero-inner { flex-direction: column; align-items: flex-start; gap: 24px; }
        .hero-content h1 { font-size: 2rem; }
        .cart-body { padding: 0 20px; margin-top: -20px; }
        .cart-item { padding: 18px 20px; gap: 14px; flex-wrap: wrap; }
        .cart-thumb { width: 64px; height: 64px; }
        .cart-info { flex: 1 1 calc(100% - 84px); }
        .qty-stepper { order: 5; }
        .cart-subtotal { order: 6; min-width: 60px; }
        .remove-btn { order: 4; margin-left: auto; }
        .cart-summary { padding: 22px 20px; }
        .total-row .amount { font-size: 1.65rem; }
    }

    @media (max-width: 480px) {
        .hero-inner { padding: 0 20px; }
        .qty-btn { width: 32px; height: 36px; }
        .qty-val { width: 38px; height: 36px; font-size: .85rem; }
    }
</style>
@endsection

@section('content')
<div class="cart-page">

    <!-- ── Hero Header ── -->
    <section class="cart-hero">
        <div class="blob blob--1"></div>
        <div class="blob blob--2"></div>

        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-tag">
                    <span class="hero-tag__line"></span>
                    <span class="hero-tag__text">Your Selection</span>
                </div>
                <h1>Shopping <em>Cart</em></h1>
                <p>{{ empty($cart) ? 'Your cart is waiting to be filled' : count($cart) . ' item' . (count($cart) > 1 ? 's' : '') . ' ready to order' }}</p>
            </div>

            <a href="{{ route('menu.index') }}" class="btn-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Continue Shopping
            </a>
        </div>
    </section>

    <!-- ── Cart Body ── -->
    <div class="cart-body">

        <!-- ── Empty State ── -->
        @if(empty($cart))
        <div class="empty-panel">
            <div class="empty-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                </svg>
            </div>
            <h2>Your cart is empty</h2>
            <p>Discover our handcrafted selection and add your favorites.</p>
            <a href="{{ route('menu.index') }}" class="btn-browse">
                Browse Menu
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <!-- ── Cart with Items ── -->
        @else
        <div class="cart-panel">

            <!-- Item Rows -->
            @foreach($cart as $id => $item)
            <div class="cart-item">

                <!-- Thumbnail -->
                <div class="cart-thumb">
                    @if(isset($item['image']) && $item['image'])
                        <img src="{{ asset('images/menu/'.$item['image']) }}" alt="{{ $item['name'] }}">
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                            <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/>
                        </svg>
                    @endif
                </div>

                <!-- Name / Price -->
                <div class="cart-info">
                    <h3>{{ $item['name'] }}</h3>
                    <p>${{ number_format($item['price'], 2) }} each</p>
                </div>

                <!-- Qty Stepper -->
                <div class="qty-stepper">
                    <form action="{{ route('cart.update', $id) }}" method="POST" style="display:contents;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="quantity" id="qty-hidden-{{ $id }}" value="{{ $item['quantity'] }}">
                    </form>
                    <button type="button" class="qty-btn" onclick="changeQty('{{ $id }}', -1)">−</button>
                    <span class="qty-val" id="qty-display-{{ $id }}">{{ $item['quantity'] }}</span>
                    <button type="button" class="qty-btn" onclick="changeQty('{{ $id }}', 1)">+</button>
                </div>

                <!-- Subtotal -->
                <div class="cart-subtotal">
                    <span id="subtotal-{{ $id }}">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                </div>

                <!-- Remove -->
                <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="remove-btn" title="Remove item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach

            <!-- ── Summary Footer ── -->
            <div class="cart-summary">

                <!-- Notes -->
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <label class="notes-label" for="notes">Special Requests</label>
                    <textarea name="notes" id="notes" rows="3" class="notes-textarea" placeholder="E.g., Less sugar, No ice, Extra hot…"></textarea>
                    <p class="notes-hint">Let us know about any special instructions for your order</p>

                    <!-- Total -->
                    <div class="total-row">
                        <span class="label">Order Total</span>
                        <span class="amount">${{ number_format($total, 2) }}</span>
                    </div>

                    <!-- Place Order -->
                    <button type="submit" class="btn-place-order">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                        Place Order
                    </button>
                </form>
            </div>
        </div>
        @endif

        <!-- Decorative -->
        <div class="cart-decor">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/>
                <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
            </svg>
        </div>

    </div><!-- .cart-body -->
</div><!-- .cart-page -->
@endsection

@section('scripts')
<script>
    // prices keyed by cart-item id, injected from Blade
    const prices = {
        @foreach($cart as $id => $item)
            '{{ $id }}': {{ $item['price'] }},
        @endforeach
    };

    function changeQty(id, delta) {
        const hidden  = document.getElementById('qty-hidden-' + id);
        const display = document.getElementById('qty-display-' + id);
        let val = parseInt(hidden.value) + delta;

        if (val < 1) {
            // if hitting zero, submit the remove form for that row
            const removeForm = hidden.closest('.cart-item')
                .querySelector('form[method="POST"]:last-of-type, button.remove-btn').closest('form');
            if (removeForm) removeForm.submit();
            return;
        }

        hidden.value   = val;
        display.textContent = val;

        // update on-screen subtotal
        const sub = document.getElementById('subtotal-' + id);
        sub.textContent = '$' + (prices[id] * val).toFixed(2);

        // auto-submit the update form after a short delay (debounce)
        clearTimeout(changeQty._timer);
        changeQty._timer = setTimeout(() => {
            const updateForm = hidden.closest('form');
            if (updateForm) updateForm.submit();
        }, 600);
    }
</script>
@endsection
