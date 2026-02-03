@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Syne:wght@500;600;700&display=swap');

    :root {
        --blue-50:#eef4ff;--blue-100:#dbeafe;--blue-200:#bfdbfe;--blue-300:#93c5fd;
        --blue-400:#60a5fa;--blue-500:#3b82f6;--blue-600:#2563eb;--blue-700:#1d4ed8;
        --sky-100:#e0f2fe;--sky-400:#38bdf8;--sky-500:#0ea5e9;
        --teal-400:#2dd4bf;--teal-500:#14b8a6;
        --violet-400:#a78bfa;--violet-500:#8b5cf6;
        --amber-400:#fbbf24;--amber-500:#f59e0b;
        --rose-400:#fb7185;--rose-500:#f43f5e;
        --green-400:#4ade80;--green-500:#22c55e;
        --yellow-400:#facc15;--yellow-500:#eab308;
        --slate-50:#f8fafc;--slate-100:#f1f5f9;--slate-200:#e2e8f0;--slate-300:#cbd5e1;
        --slate-400:#94a3b8;--slate-500:#64748b;--slate-600:#475569;--slate-700:#334155;--slate-800:#1e293b;
        --text-primary:#1e293b;--text-muted:#94a3b8;
        --card-bg:rgba(255,255,255,0.72);--card-border:rgba(148,163,184,0.18);
        --card-shadow:0 1px 3px rgba(30,41,59,0.06),0 1px 2px rgba(30,41,59,0.04);
        --radius:18px;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

    /* ── Page Shell ── */
    .order-body {
        font-family:'DM Sans',system-ui,sans-serif;
        min-height:100vh;
        background:
            radial-gradient(ellipse 80% 60% at 15% 20%,rgba(219,234,254,.55) 0%,transparent 70%),
            radial-gradient(ellipse 60% 50% at 80% 70%,rgba(224,242,254,.45) 0%,transparent 65%),
            radial-gradient(ellipse 40% 40% at 55% 10%,rgba(191,219,254,.3) 0%,transparent 60%),
            linear-gradient(160deg,#eef4ff 0%,#f0f7ff 40%,#eef6ff 100%);
        color:var(--text-primary);
        padding:36px 40px 60px;
    }
    .order-layout { max-width:720px; margin:0 auto; }

    /* ── Back Link ── */
    .back-link {
        display:inline-flex;
        align-items:center;
        gap:6px;
        color:var(--slate-500);
        font-size:.85rem;
        font-weight:500;
        text-decoration:none;
        margin-bottom:20px;
        transition:color .2s;
    }
    .back-link:hover { color:var(--blue-600); }
    .back-link svg { width:16px; height:16px; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);} }

    /* ── Panel ── */
    .panel {
        background:var(--card-bg);backdrop-filter:blur(14px);
        border:1px solid var(--card-border);border-radius:var(--radius);
        box-shadow:var(--card-shadow);
        overflow:hidden;
        animation:fadeUp .4s ease both;
    }

    /* ── Order Header ── */
    .order-header {
        background:linear-gradient(135deg,var(--blue-500),var(--violet-500));
        padding:28px;
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
    }
    .order-header-left h1 {
        font-family:'Syne',sans-serif;
        font-size:1.5rem;
        font-weight:700;
        color:#fff;
        margin-bottom:6px;
    }
    .order-header-left .order-date {
        color:rgba(255,255,255,.8);
        font-size:.88rem;
        display:flex;
        align-items:center;
        gap:6px;
    }
    .order-header-left .order-date svg { width:15px; height:15px; }
    .order-header-right {
        text-align:right;
    }
    .order-header-right .status-badge {
        display:inline-flex;
        align-items:center;
        gap:6px;
        padding:6px 14px;
        border-radius:20px;
        font-size:.78rem;
        font-weight:600;
        background:rgba(255,255,255,.2);
        color:#fff;
        backdrop-filter:blur(8px);
        margin-bottom:8px;
    }
    .order-header-right .status-badge svg { width:14px; height:14px; }
    .order-header-right .total {
        font-family:'Syne',sans-serif;
        font-size:1.75rem;
        font-weight:700;
        color:#fff;
    }

    /* ── Section ── */
    .section {
        padding:24px 28px;
        border-bottom:1px solid var(--card-border);
    }
    .section:last-child { border-bottom:none; }
    .section-title {
        font-family:'Syne',sans-serif;
        font-size:1rem;
        font-weight:700;
        color:var(--slate-800);
        margin-bottom:16px;
        display:flex;
        align-items:center;
        gap:8px;
    }
    .section-title svg { width:18px; height:18px; color:var(--blue-500); }

    /* ── Customer Info ── */
    .customer-info {
        display:flex;
        align-items:center;
        gap:16px;
    }
    .customer-avatar {
        width:52px;
        height:52px;
        border-radius:14px;
        background:linear-gradient(135deg,var(--blue-100),var(--violet-100));
        display:flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
    }
    .customer-avatar span {
        font-family:'Syne',sans-serif;
        font-size:1.25rem;
        font-weight:700;
        background:linear-gradient(135deg,var(--blue-500),var(--violet-500));
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        background-clip:text;
    }
    .customer-details .name {
        font-family:'Syne',sans-serif;
        font-size:1rem;
        font-weight:600;
        color:var(--slate-800);
        margin-bottom:2px;
    }
    .customer-details .email {
        font-size:.88rem;
        color:var(--text-muted);
    }
    .customer-link {
        margin-left:auto;
        padding:8px 16px;
        border-radius:10px;
        font-size:.82rem;
        font-weight:600;
        color:var(--blue-600);
        background:var(--blue-50);
        border:1px solid var(--blue-100);
        text-decoration:none;
        transition:all .18s;
        display:inline-flex;
        align-items:center;
        gap:5px;
    }
    .customer-link:hover {
        background:var(--blue-100);
        color:var(--blue-700);
    }
    .customer-link svg { width:14px; height:14px; }

    /* ── Order Items ── */
    .order-item {
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:14px 0;
        border-bottom:1px dashed var(--slate-200);
    }
    .order-item:last-child { border-bottom:none; }
    .item-info {
        display:flex;
        align-items:center;
        gap:14px;
    }
    .item-qty {
        width:32px;
        height:32px;
        border-radius:10px;
        background:var(--blue-50);
        color:var(--blue-600);
        font-size:.85rem;
        font-weight:700;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
    }
    .item-details .item-name {
        font-family:'Syne',sans-serif;
        font-size:.95rem;
        font-weight:600;
        color:var(--slate-800);
        margin-bottom:2px;
    }
    .item-details .item-unit {
        font-size:.8rem;
        color:var(--text-muted);
    }
    .item-total {
        font-family:'Syne',sans-serif;
        font-size:1rem;
        font-weight:700;
        color:var(--slate-800);
    }

    /* ── Notes ── */
    .notes-box {
        background:#fffbeb;
        border:1px solid #fef3c7;
        border-left:4px solid var(--amber-400);
        border-radius:10px;
        padding:14px 18px;
        margin-top:16px;
    }
    .notes-label {
        font-size:.75rem;
        font-weight:600;
        color:#b45309;
        text-transform:uppercase;
        letter-spacing:.04em;
        margin-bottom:6px;
    }
    .notes-content {
        font-size:.9rem;
        color:#92400e;
        line-height:1.5;
    }

    /* ── Total Row ── */
    .total-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-top:20px;
        padding-top:20px;
        border-top:2px solid var(--slate-100);
    }
    .total-row .label {
        font-family:'Syne',sans-serif;
        font-size:1rem;
        font-weight:600;
        color:var(--slate-600);
    }
    .total-row .value {
        font-family:'Syne',sans-serif;
        font-size:1.35rem;
        font-weight:700;
        color:var(--teal-500);
    }

    /* ── Status Update ── */
    .status-form {
        display:flex;
        gap:12px;
        align-items:center;
    }
    .status-select {
        flex:1;
        padding:12px 16px;
        padding-right:40px;
        border:1.5px solid var(--slate-200);
        border-radius:12px;
        font-size:.9rem;
        font-family:inherit;
        color:var(--slate-700);
        background:#fff;
        cursor:pointer;
        appearance:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat:no-repeat;
        background-position:right 12px center;
        background-size:18px;
        transition:border-color .2s,box-shadow .2s;
    }
    .status-select:focus {
        outline:none;
        border-color:var(--blue-300);
        box-shadow:0 0 0 3px rgba(59,130,246,.12);
    }
    .btn-update {
        padding:12px 24px;
        border-radius:12px;
        font-size:.9rem;
        font-weight:600;
        border:none;
        cursor:pointer;
        background:linear-gradient(135deg,var(--blue-500),var(--blue-600));
        color:#fff;
        box-shadow:0 3px 12px rgba(37,99,235,.28);
        transition:all .2s;
        display:inline-flex;
        align-items:center;
        gap:6px;
    }
    .btn-update:hover {
        transform:translateY(-1px);
        box-shadow:0 5px 18px rgba(37,99,235,.38);
    }
    .btn-update svg { width:16px; height:16px; }

    /* ── Responsive ── */
    @media(max-width:640px){
        .order-body{padding:24px 16px 48px;}
        .order-header{flex-direction:column;gap:16px;padding:24px;}
        .order-header-right{text-align:left;}
        .customer-info{flex-wrap:wrap;}
        .customer-link{margin-left:0;margin-top:12px;width:100%;justify-content:center;}
        .status-form{flex-direction:column;}
        .btn-update{width:100%;justify-content:center;}
    }
</style>
@endsection

@section('content')
<div class="order-body">
<div class="order-layout">

    <!-- ── Back Link ── -->
    <a href="{{ route('admin.orders.index') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Back to Orders
    </a>

    <!-- ── Main Panel ── -->
    <div class="panel">
        
        <!-- Order Header -->
        <div class="order-header">
            <div class="order-header-left">
                <h1>Order #{{ $order->id }}</h1>
                <div class="order-date">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ $order->created_at->format('M d, Y - h:i A') }}
                </div>
            </div>
            <div class="order-header-right">
                <div class="status-badge">
                    @if($order->status === 'pending')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    @elseif($order->status === 'preparing')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    @elseif($order->status === 'ready')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    @endif
                    {{ ucfirst($order->status) }}
                </div>
                <div class="total">${{ number_format($order->total_price, 2) }}</div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="section">
            <div class="section-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Customer
            </div>
            <div class="customer-info">
                <div class="customer-avatar">
                    <span>{{ strtoupper(substr($order->user->name, 0, 1)) }}</span>
                </div>
                <div class="customer-details">
                    <div class="name">{{ $order->user->name }}</div>
                    <div class="email">{{ $order->user->email }}</div>
                </div>
                <a href="{{ route('admin.customers.show', $order->user->id) }}" class="customer-link">
                    View Profile
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
        </div>

        <!-- Order Items -->
        <div class="section">
            <div class="section-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                Order Items
            </div>
            
            @foreach($order->orderItems as $item)
                <div class="order-item">
                    <div class="item-info">
                        <span class="item-qty">{{ $item->quantity }}</span>
                        <div class="item-details">
                            <div class="item-name">{{ $item->menuItem->name }}</div>
                            <div class="item-unit">${{ number_format($item->price, 2) }} each</div>
                        </div>
                    </div>
                    <span class="item-total">${{ number_format($item->price * $item->quantity, 2) }}</span>
                </div>
            @endforeach

            @if($order->notes)
                <div class="notes-box">
                    <div class="notes-label">Customer Notes</div>
                    <div class="notes-content">{{ $order->notes }}</div>
                </div>
            @endif

            <div class="total-row">
                <span class="label">Order Total</span>
                <span class="value">${{ number_format($order->total_price, 2) }}</span>
            </div>
        </div>

        <!-- Update Status -->
        <div class="section">
            <div class="section-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                Update Status
            </div>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="status-form">
                @csrf
                @method('PATCH')
                <select name="status" class="status-select">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                    <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit" class="btn-update">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Update Status
                </button>
            </form>
        </div>

    </div>

</div>
</div>
@endsection
