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
        --slate-50:#f8fafc;--slate-100:#f1f5f9;--slate-200:#e2e8f0;--slate-300:#cbd5e1;
        --slate-400:#94a3b8;--slate-500:#64748b;--slate-600:#475569;--slate-700:#334155;--slate-800:#1e293b;
        --text-primary:#1e293b;--text-muted:#94a3b8;
        --card-bg:rgba(255,255,255,0.72);--card-border:rgba(148,163,184,0.18);
        --card-shadow:0 1px 3px rgba(30,41,59,0.06),0 1px 2px rgba(30,41,59,0.04);
        --radius:18px;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

    /* ── Page Shell ── */
    .customer-body {
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
    .customer-layout { max-width:900px; margin:0 auto; }

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

    /* ── Profile Card ── */
    .profile-card {
        background:var(--card-bg);backdrop-filter:blur(14px);
        border:1px solid var(--card-border);border-radius:var(--radius);
        box-shadow:var(--card-shadow);
        overflow:hidden;
        margin-bottom:24px;
        animation:fadeUp .4s ease both;
    }
    .profile-header {
        background:linear-gradient(135deg,var(--blue-500),var(--violet-500));
        padding:32px;
        display:flex;
        align-items:center;
        gap:24px;
    }
    .profile-avatar {
        width:88px;
        height:88px;
        border-radius:50%;
        background:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
        box-shadow:0 4px 20px rgba(0,0,0,.15);
    }
    .profile-avatar span {
        font-family:'Syne',sans-serif;
        font-size:2.5rem;
        font-weight:700;
        background:linear-gradient(135deg,var(--blue-500),var(--violet-500));
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        background-clip:text;
    }
    .profile-info h1 {
        font-family:'Syne',sans-serif;
        font-size:1.75rem;
        font-weight:700;
        color:#fff;
        letter-spacing:-.02em;
        margin-bottom:4px;
    }
    .profile-info .email {
        color:rgba(255,255,255,.85);
        font-size:.95rem;
        margin-bottom:6px;
    }
    .profile-info .member-since {
        color:rgba(255,255,255,.65);
        font-size:.82rem;
        display:flex;
        align-items:center;
        gap:6px;
    }
    .profile-info .member-since svg { width:14px; height:14px; }

    /* ── Stats Row ── */
    .stats-row {
        display:grid;
        grid-template-columns:repeat(3, 1fr);
        border-top:1px solid var(--card-border);
    }
    .stat-item {
        padding:20px 24px;
        text-align:center;
        border-right:1px solid var(--card-border);
    }
    .stat-item:last-child { border-right:none; }
    .stat-label {
        font-size:.78rem;
        font-weight:600;
        color:var(--text-muted);
        text-transform:uppercase;
        letter-spacing:.04em;
        margin-bottom:6px;
    }
    .stat-value {
        font-family:'Syne',sans-serif;
        font-size:1.5rem;
        font-weight:700;
    }
    .stat-value.orders { color:var(--slate-800); }
    .stat-value.spent { color:var(--teal-500); }
    .stat-value.average { color:var(--blue-600); }

    /* ── Orders Section ── */
    .orders-section {
        animation:fadeUp .4s ease .1s both;
    }
    .section-header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:16px;
        padding:0 4px;
    }
    .section-header h2 {
        font-family:'Syne',sans-serif;
        font-size:1.25rem;
        font-weight:700;
        color:var(--slate-800);
    }
    .section-header .count {
        background:var(--blue-50);
        color:var(--blue-600);
        font-size:.75rem;
        font-weight:600;
        padding:4px 12px;
        border-radius:12px;
    }

    .panel {
        background:var(--card-bg);backdrop-filter:blur(14px);
        border:1px solid var(--card-border);border-radius:var(--radius);
        box-shadow:var(--card-shadow);
        overflow:hidden;
    }

    /* ── Empty State ── */
    .empty-state {
        padding:48px;
        text-align:center;
        color:var(--text-muted);
    }
    .empty-state svg {
        width:48px;
        height:48px;
        margin:0 auto 16px;
        color:var(--slate-300);
    }
    .empty-state p { font-size:.95rem; }

    /* ── Order Card ── */
    .order-card {
        padding:20px 24px;
        border-bottom:1px solid rgba(148,163,184,.1);
        transition:background .15s;
    }
    .order-card:last-child { border-bottom:none; }
    .order-card:hover { background:rgba(59,130,246,.025); }

    .order-top {
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
        margin-bottom:16px;
    }
    .order-meta .order-id {
        font-family:'Syne',sans-serif;
        font-size:.95rem;
        font-weight:600;
        color:var(--slate-800);
        margin-bottom:2px;
    }
    .order-meta .order-date {
        font-size:.82rem;
        color:var(--text-muted);
    }
    .order-right {
        text-align:right;
    }
    .order-status {
        display:inline-flex;
        align-items:center;
        gap:5px;
        padding:5px 12px;
        border-radius:20px;
        font-size:.75rem;
        font-weight:600;
        margin-bottom:6px;
    }
    .order-status.pending {
        background:#fef3c7;
        color:#b45309;
    }
    .order-status.preparing {
        background:#dbeafe;
        color:#1d4ed8;
    }
    .order-status.ready {
        background:#d1fae5;
        color:#047857;
    }
    .order-status.completed {
        background:#f3f4f6;
        color:#374151;
    }
    .order-status svg { width:12px; height:12px; }
    .order-total {
        font-family:'Syne',sans-serif;
        font-size:1.1rem;
        font-weight:700;
        color:var(--slate-800);
    }

    /* ── Order Items ── */
    .order-items {
        background:var(--slate-50);
        border-radius:12px;
        padding:14px 18px;
        margin-bottom:14px;
    }
    .order-items-label {
        font-size:.75rem;
        font-weight:600;
        color:var(--text-muted);
        text-transform:uppercase;
        letter-spacing:.04em;
        margin-bottom:10px;
    }
    .order-item-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:6px 0;
    }
    .order-item-row:not(:last-child) {
        border-bottom:1px dashed var(--slate-200);
    }
    .order-item-name {
        font-size:.88rem;
        color:var(--slate-700);
    }
    .order-item-name .qty {
        color:var(--blue-600);
        font-weight:600;
    }
    .order-item-price {
        font-size:.88rem;
        font-weight:600;
        color:var(--slate-800);
    }

    /* ── View Link ── */
    .view-link {
        display:inline-flex;
        align-items:center;
        gap:5px;
        color:var(--blue-600);
        font-size:.84rem;
        font-weight:600;
        text-decoration:none;
        transition:color .2s;
    }
    .view-link:hover { color:var(--blue-700); }
    .view-link svg { width:14px; height:14px; }

    /* ── Responsive ── */
    @media(max-width:640px){
        .customer-body{padding:24px 16px 48px;}
        .profile-header{flex-direction:column;text-align:center;padding:28px 20px;}
        .profile-avatar{width:72px;height:72px;}
        .profile-avatar span{font-size:2rem;}
        .stats-row{grid-template-columns:1fr;}
        .stat-item{border-right:none;border-bottom:1px solid var(--card-border);}
        .stat-item:last-child{border-bottom:none;}
        .order-top{flex-direction:column;gap:12px;}
        .order-right{text-align:left;}
    }
</style>
@endsection

@section('content')
<div class="customer-body">
<div class="customer-layout">

    <!-- ── Back Link ── -->
    <a href="{{ route('admin.customers.index') }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Back to Customers
    </a>

    <!-- ── Profile Card ── -->
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <span>{{ strtoupper(substr($customer->name, 0, 1)) }}</span>
            </div>
            <div class="profile-info">
                <h1>{{ $customer->name }}</h1>
                <p class="email">{{ $customer->email }}</p>
                <p class="member-since">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Member since {{ $customer->created_at->format('M d, Y') }}
                </p>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-item">
                <div class="stat-label">Total Orders</div>
                <div class="stat-value orders">{{ $totalOrders }}</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Total Spent</div>
                <div class="stat-value spent">${{ number_format($totalSpent, 2) }}</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Average Order</div>
                <div class="stat-value average">${{ $totalOrders > 0 ? number_format($totalSpent / $totalOrders, 2) : '0.00' }}</div>
            </div>
        </div>
    </div>

    <!-- ── Order History ── -->
    <div class="orders-section">
        <div class="section-header">
            <h2>Order History</h2>
            <span class="count">{{ $orders->count() }} order{{ $orders->count() !== 1 ? 's' : '' }}</span>
        </div>

        <div class="panel">
            @if($orders->count() === 0)
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <p>This customer hasn't placed any orders yet</p>
                </div>
            @else
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-top">
                            <div class="order-meta">
                                <div class="order-id">Order #{{ $order->id }}</div>
                                <div class="order-date">{{ $order->created_at->format('M d, Y - h:i A') }}</div>
                            </div>
                            <div class="order-right">
                                <div class="order-status {{ $order->status }}">
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
                                <div class="order-total">${{ number_format($order->total_price, 2) }}</div>
                            </div>
                        </div>

                        <div class="order-items">
                            <div class="order-items-label">Items</div>
                            @foreach($order->orderItems as $item)
                                <div class="order-item-row">
                                    <span class="order-item-name"><span class="qty">{{ $item->quantity }}x</span> {{ $item->menuItem->name }}</span>
                                    <span class="order-item-price">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('admin.orders.show', $order->id) }}" class="view-link">
                            View Full Details
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

</div>
</div>
@endsection
