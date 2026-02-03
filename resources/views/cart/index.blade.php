@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Syne:wght@500;600;700&display=swap');

    :root {
        --blue-50:  #eef4ff;
        --blue-100: #dbeafe;
        --blue-200: #bfdbfe;
        --blue-300: #93c5fd;
        --blue-400: #60a5fa;
        --blue-500: #3b82f6;
        --blue-600: #2563eb;
        --blue-700: #1d4ed8;
        --sky-100:  #e0f2fe;
        --sky-400:  #38bdf8;
        --sky-500:  #0ea5e9;
        --teal-400: #2dd4bf;
        --teal-500: #14b8a6;
        --rose-400: #fb7185;
        --rose-500: #f43f5e;
        --slate-50:  #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-300: #cbd5e1;
        --slate-400: #94a3b8;
        --slate-500: #64748b;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-800: #1e293b;
        --text-primary:   #1e293b;
        --text-muted:     #94a3b8;
        --card-bg:        rgba(255,255,255,0.72);
        --card-border:    rgba(148,163,184,0.18);
        --card-shadow:    0 1px 3px rgba(30,41,59,0.06), 0 1px 2px rgba(30,41,59,0.04);
        --card-shadow-hover: 0 8px 24px rgba(37,99,235,0.12), 0 2px 6px rgba(30,41,59,0.06);
        --radius: 18px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    /* ── Page Shell ── (identical to dashboard) */
    .cart-body {
        font-family: 'DM Sans', system-ui, sans-serif;
        min-height: 100vh;
        background:
            radial-gradient(ellipse 80% 60% at 15% 20%, rgba(219,234,254,0.55) 0%, transparent 70%),
            radial-gradient(ellipse 60% 50% at 80% 70%, rgba(224,242,254,0.45) 0%, transparent 65%),
            radial-gradient(ellipse 40% 40% at 55% 10%, rgba(191,219,254,0.3) 0%, transparent 60%),
            linear-gradient(160deg, #eef4ff 0%, #f0f7ff 40%, #eef6ff 100%);
        color: var(--text-primary);
        padding: 36px 40px 60px;
    }

    /* ── Layout ── */
    .cart-layout {
        max-width: 960px;
        margin: 0 auto;
    }

    /* ── Header ── */
    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 32px;
    }
    .cart-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--slate-800);
        letter-spacing: -0.03em;
    }
    .cart-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-top: 4px;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
        letter-spacing: 0.01em;
        font-family: inherit;
    }
    .btn-outline {
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        color: var(--slate-600);
        backdrop-filter: blur(8px);
    }
    .btn-outline:hover { border-color: var(--blue-300); color: var(--blue-600); background: #fff; }
    .btn svg { width: 15px; height: 15px; }

    /* ── Panel (glass card) ── */
    .panel {
        background: var(--card-bg);
        backdrop-filter: blur(14px);
        border: 1px solid var(--card-border);
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
        animation: fadeUp 0.4s ease both;
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Cart Item Row ── */
    .cart-item {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--slate-100);
        transition: background 0.15s;
    }
    .cart-item:last-child { border-bottom: none; }
    .cart-item:hover { background: rgba(59,130,246,0.03); }

    /* Thumbnail */
    .cart-thumb {
        flex-shrink: 0;
        width: 72px;
        height: 72px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--blue-50), var(--sky-100));
        border: 1px solid var(--blue-100);
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
    .cart-thumb .placeholder-icon {
        font-size: 1.6rem;
    }

    /* Name + price */
    .cart-info { flex: 1; min-width: 0; }
    .cart-info h3 {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--slate-800);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .cart-info p {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 3px;
    }

    /* Qty stepper */
    .qty-stepper {
        display: flex;
        align-items: center;
        gap: 0;
        border: 1.5px solid var(--slate-200);
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .qty-btn {
        width: 34px;
        height: 36px;
        border: none;
        background: var(--slate-50);
        color: var(--slate-600);
        font-size: 1.1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s, color 0.15s;
        font-family: inherit;
    }
    .qty-btn:hover { background: var(--blue-50); color: var(--blue-600); }
    .qty-val {
        width: 38px;
        height: 36px;
        border: none;
        border-left: 1px solid var(--slate-200);
        border-right: 1px solid var(--slate-200);
        text-align: center;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--slate-800);
        background: #fff;
        font-family: inherit;
    }
    .qty-val:focus { outline: none; }

    /* Subtotal */
    .cart-subtotal {
        flex-shrink: 0;
        min-width: 72px;
        text-align: right;
    }
    .cart-subtotal span {
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: var(--slate-800);
    }

    /* Remove btn */
    .remove-btn {
        flex-shrink: 0;
        width: 34px;
        height: 34px;
        border: 1.5px solid transparent;
        border-radius: 9px;
        background: transparent;
        color: var(--slate-300);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.18s;
    }
    .remove-btn:hover {
        background: #fef2f2;
        border-color: #fecaca;
        color: var(--rose-500);
    }
    .remove-btn svg { width: 17px; height: 17px; }

    /* ── Summary Footer ── */
    .cart-summary {
        background: var(--slate-50);
        border-top: 1px solid var(--slate-100);
        padding: 24px;
    }

    /* Notes */
    .notes-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--slate-600);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 8px;
        display: block;
    }
    .notes-textarea {
        width: 100%;
        border: 1.5px solid var(--slate-200);
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 0.84rem;
        color: var(--slate-700);
        font-family: inherit;
        resize: vertical;
        min-height: 76px;
        background: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .notes-textarea::placeholder { color: var(--slate-400); }
    .notes-textarea:focus {
        outline: none;
        border-color: var(--blue-300);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
    }
    .notes-hint {
        font-size: 0.74rem;
        color: var(--text-muted);
        margin-top: 6px;
    }

    /* Total row */
    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0 18px;
        padding-top: 18px;
        border-top: 1px solid var(--slate-200);
    }
    .total-row .label {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--slate-500);
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
    .total-row .amount {
        font-family: 'Syne', sans-serif;
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--slate-800);
        letter-spacing: -0.02em;
    }

    /* Place Order */
    .btn-place-order {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-600));
        color: #fff;
        font-family: 'Syne', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 3px 12px rgba(37,99,235,0.28);
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .btn-place-order:hover {
        box-shadow: 0 5px 20px rgba(37,99,235,0.38);
        transform: translateY(-1px);
    }
    .btn-place-order svg { width: 18px; height: 18px; }

    /* ── Empty State ── */
    .empty-panel {
        background: var(--card-bg);
        backdrop-filter: blur(14px);
        border: 1px solid var(--card-border);
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        padding: 72px 24px;
        text-align: center;
        animation: fadeUp 0.4s ease both;
    }
    .empty-icon-wrap {
        width: 80px;
        height: 80px;
        border-radius: 24px;
        background: linear-gradient(135deg, var(--blue-50), var(--sky-100));
        border: 1px solid var(--blue-100);
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .empty-icon-wrap svg { width: 36px; height: 36px; color: var(--blue-400); }
    .empty-panel h2 {
        font-family: 'Syne', sans-serif;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--slate-800);
        margin-bottom: 6px;
    }
    .empty-panel p {
        font-size: 0.88rem;
        color: var(--text-muted);
        margin-bottom: 24px;
    }
    .btn-browse {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 24px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--blue-500), var(--blue-600));
        color: #fff;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 3px 12px rgba(37,99,235,0.28);
        transition: box-shadow 0.2s, transform 0.2s;
        font-family: inherit;
    }
    .btn-browse:hover {
        box-shadow: 0 5px 18px rgba(37,99,235,0.38);
        transform: translateY(-1px);
    }
    .btn-browse svg { width: 15px; height: 15px; }

    /* ── Responsive ── */
    @media (max-width: 640px) {
        .cart-body { padding: 24px 16px 48px; }
        .cart-item { padding: 16px; gap: 12px; }
        .cart-thumb { width: 58px; height: 58px; }
        .qty-btn { width: 28px; height: 32px; }
        .qty-val { width: 32px; height: 32px; font-size: 0.82rem; }
        .cart-summary { padding: 18px; }
        .cart-header { flex-direction: column; align-items: flex-start; gap: 14px; }
    }
</style>
@endsection

@section('content')
<div class="cart-body">
<div class="cart-layout">

    <!-- ── Header ── -->
    <div class="cart-header">
        <div>
            <h1>Shopping Cart</h1>
            <p>{{ empty($cart) ? 'Nothing here yet' : count($cart) . ' item' . (count($cart) > 1 ? 's' : '') . ' in your cart' }}</p>
        </div>
        <a href="{{ route('menu.index') }}" class="btn btn-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><path d="M12 19l-7-7 7-7"/></svg>
            Continue Shopping
        </a>
    </div>

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
        <p>Add some items from our menu to get started.</p>
        <a href="{{ route('menu.index') }}" class="btn-browse">
            Browse Menu
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><path d="M12 5l7 7-7 7"/></svg>
        </a>
    </div>

    <!-- ── Cart with Items ── -->
    @else
    <div class="panel">

        <!-- Item Rows -->
        @foreach($cart as $id => $item)
        <div class="cart-item">

            <!-- Thumbnail -->
            <div class="cart-thumb">
                @if(isset($item['image']) && $item['image'])
                    <img src="{{ asset('images/menu/'.$item['image']) }}" alt="{{ $item['name'] }}">
                @else
                    <span class="placeholder-icon">☕</span>
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
                <textarea name="notes" id="notes" rows="3" class="notes-textarea" placeholder="E.g., Less sugar, No ice, Extra spicy…"></textarea>
                <p class="notes-hint">Any special instructions for your order</p>

                <!-- Total -->
                <div class="total-row">
                    <span class="label">Total</span>
                    <span class="amount">${{ number_format($total, 2) }}</span>
                </div>

                <!-- Place Order -->
                <button type="submit" class="btn-place-order">
                    Place Order
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                </button>
            </form>
        </div>
    </div>
    @endif

</div><!-- .cart-layout -->
</div><!-- .cart-body -->
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