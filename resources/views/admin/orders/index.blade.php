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
    .orders-body {
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
    .orders-layout { max-width:1140px; margin:0 auto; }

    /* ── Header ── */
    .page-header {
        display:flex;
        justify-content:space-between;
        align-items:flex-end;
        margin-bottom:28px;
    }
    .page-header h1 {
        font-family:'Syne',sans-serif;
        font-size:2rem;
        font-weight:700;
        color:var(--slate-800);
        letter-spacing:-.03em;
    }
    .page-header p { color:var(--text-muted); font-size:.95rem; margin-top:4px; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);} }

    /* ── Stats Cards ── */
    .stats-grid {
        display:grid;
        grid-template-columns:repeat(4, 1fr);
        gap:16px;
        margin-bottom:24px;
    }
    .stat-card {
        background:var(--card-bg);backdrop-filter:blur(10px);
        border:1px solid var(--card-border);border-radius:16px;
        padding:18px 22px;box-shadow:var(--card-shadow);
        display:flex;align-items:center;gap:14px;
        animation:fadeUp .4s ease both;
    }
    .stat-card:nth-child(1){animation-delay:.04s;}
    .stat-card:nth-child(2){animation-delay:.08s;}
    .stat-card:nth-child(3){animation-delay:.12s;}
    .stat-card:nth-child(4){animation-delay:.16s;}
    .stat-icon {
        width:44px;height:44px;border-radius:12px;
        display:flex;align-items:center;justify-content:center;
        flex-shrink:0;
    }
    .stat-icon svg { width:20px;height:20px; }
    .stat-icon.yellow { background:#fef3c7; }
    .stat-icon.yellow svg { color:#b45309; }
    .stat-icon.blue { background:#dbeafe; }
    .stat-icon.blue svg { color:var(--blue-600); }
    .stat-icon.teal { background:#ccfbf1; }
    .stat-icon.teal svg { color:var(--teal-500); }
    .stat-icon.slate { background:var(--slate-100); }
    .stat-icon.slate svg { color:var(--slate-500); }
    .stat-content .stat-value {
        font-family:'Syne',sans-serif;
        font-size:1.5rem;
        font-weight:700;
        color:var(--slate-800);
        line-height:1;
    }
    .stat-content .stat-label {
        font-size:.78rem;
        color:var(--text-muted);
        margin-top:3px;
    }

    /* ── Toolbar ── */
    .toolbar {
        display:flex;
        align-items:center;
        gap:12px;
        margin-bottom:18px;
        flex-wrap:wrap;
    }
    .search-wrap {
        flex:1;min-width:200px;max-width:380px;
        position:relative;
    }
    .search-wrap svg {
        position:absolute;left:13px;top:50%;transform:translateY(-50%);
        width:17px;height:17px;color:var(--slate-400);pointer-events:none;
    }
    .search-input {
        width:100%;
        padding:10px 14px 10px 38px;
        border:1.5px solid var(--slate-200);
        border-radius:12px;
        font-size:.84rem;
        color:var(--slate-700);
        font-family:inherit;
        background:#fff;
        transition:border-color .2s,box-shadow .2s;
    }
    .search-input::placeholder { color:var(--slate-400); }
    .search-input:focus { outline:none;border-color:var(--blue-300);box-shadow:0 0 0 3px rgba(59,130,246,.12); }

    .filter-pills { display:flex; gap:7px; flex-wrap:wrap; }
    .pill {
        padding:8px 16px;border-radius:20px;
        font-size:.78rem;font-weight:600;cursor:pointer;
        border:1.5px solid var(--slate-200);
        background:#fff;color:var(--slate-600);
        transition:all .18s;font-family:inherit;
        text-decoration:none;
    }
    .pill:hover { border-color:var(--blue-300);color:var(--blue-600); }
    .pill.active { background:var(--blue-50);border-color:var(--blue-200);color:var(--blue-600); }

    /* ── Panel ── */
    .panel {
        background:var(--card-bg);backdrop-filter:blur(14px);
        border:1px solid var(--card-border);border-radius:var(--radius);
        box-shadow:var(--card-shadow);overflow:hidden;
        animation:fadeUp .45s ease .15s both;
    }

    /* ── Empty State ── */
    .empty-state {
        padding:64px 32px;
        text-align:center;
    }
    .empty-state svg {
        width:56px;height:56px;
        color:var(--slate-300);
        margin:0 auto 16px;
    }
    .empty-state p {
        color:var(--text-muted);
        font-size:1rem;
    }

    /* ── Table ── */
    .table-scroll { overflow-x:auto; }
    table { width:100%;border-collapse:collapse;font-size:.85rem; }
    thead th {
        text-align:left;padding:14px 20px;
        font-size:.72rem;font-weight:600;color:var(--text-muted);
        text-transform:uppercase;letter-spacing:.06em;
        background:var(--slate-50);
        border-bottom:1px solid var(--slate-100);
        white-space:nowrap;
    }
    tbody td {
        padding:16px 20px;
        border-bottom:1px solid rgba(148,163,184,.1);
        color:var(--slate-700);
        white-space:nowrap;
    }
    tbody tr { transition:background .15s; }
    tbody tr:hover { background:rgba(59,130,246,.035); }
    tbody tr:last-child td { border-bottom:none; }

    /* ── Order ID ── */
    .order-id {
        font-family:'Syne',sans-serif;
        font-weight:700;
        color:var(--slate-800);
    }

    /* ── Customer Cell ── */
    .customer-cell {
        display:flex;
        align-items:center;
        gap:12px;
    }
    .customer-avatar {
        width:36px;height:36px;border-radius:10px;
        background:linear-gradient(135deg,var(--blue-100),var(--violet-100));
        display:flex;align-items:center;justify-content:center;
        flex-shrink:0;
    }
    .customer-avatar span {
        font-family:'Syne',sans-serif;
        font-size:.85rem;
        font-weight:700;
        background:linear-gradient(135deg,var(--blue-500),var(--violet-500));
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        background-clip:text;
    }
    .customer-name {
        font-weight:600;
        color:var(--slate-800);
    }

    /* ── Items Badge ── */
    .items-badge {
        display:inline-flex;
        align-items:center;
        gap:5px;
        padding:5px 12px;
        border-radius:20px;
        font-size:.78rem;
        font-weight:600;
        background:var(--slate-100);
        color:var(--slate-600);
    }
    .items-badge svg { width:13px; height:13px; }

    /* ── Money ── */
    .money-value {
        font-family:'Syne',sans-serif;
        font-size:.95rem;
        font-weight:700;
        color:var(--teal-500);
    }

    /* ── Status Badge ── */
    .status-badge {
        display:inline-flex;
        align-items:center;
        gap:5px;
        padding:5px 12px;
        border-radius:20px;
        font-size:.75rem;
        font-weight:600;
    }
    .status-badge svg { width:12px; height:12px; }
    .status-badge.pending { background:#fef3c7; color:#b45309; }
    .status-badge.preparing { background:#dbeafe; color:#1d4ed8; }
    .status-badge.ready { background:#d1fae5; color:#047857; }
    .status-badge.completed { background:var(--slate-100); color:var(--slate-600); }

    /* ── Date ── */
    .date-cell {
        font-size:.84rem;
        color:var(--slate-500);
    }

    /* ── View Button ── */
    .view-btn {
        display:inline-flex;
        align-items:center;
        gap:5px;
        padding:7px 14px;
        border-radius:10px;
        font-size:.8rem;
        font-weight:600;
        color:var(--blue-600);
        background:var(--blue-50);
        border:1px solid var(--blue-100);
        text-decoration:none;
        transition:all .18s;
    }
    .view-btn:hover {
        background:var(--blue-100);
        color:var(--blue-700);
    }
    .view-btn svg { width:14px; height:14px; }

    /* ── Responsive ── */
    @media(max-width:900px){
        .orders-body{padding:24px 16px 48px;}
        .stats-grid{grid-template-columns:repeat(2, 1fr);}
        .page-header{flex-direction:column;align-items:flex-start;gap:12px;}
    }
    @media(max-width:640px){
        .stats-grid{grid-template-columns:1fr;}
    }
</style>
@endsection

@section('content')
<div class="orders-body">
<div class="orders-layout">

    <!-- ── Header ── -->
    <div class="page-header">
        <div>
            <h1>Manage Orders</h1>
            <p>{{ $orders->count() }} order{{ $orders->count() !== 1 ? 's' : '' }} in total</p>
        </div>
    </div>

    <!-- ── Stats Cards ── -->
    @php
        $pending = $orders->where('status', 'pending')->count();
        $preparing = $orders->where('status', 'preparing')->count();
        $ready = $orders->where('status', 'ready')->count();
        $completed = $orders->where('status', 'completed')->count();
    @endphp
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon yellow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $pending }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $preparing }}</div>
                <div class="stat-label">Preparing</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon teal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $ready }}</div>
                <div class="stat-label">Ready</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon slate">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $completed }}</div>
                <div class="stat-label">Completed</div>
            </div>
        </div>
    </div>

    <!-- ── Toolbar ── -->
    <div class="toolbar">
        <div class="search-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input" id="orderSearch" placeholder="Search by customer or order ID…" oninput="filterOrders()">
        </div>
        <div class="filter-pills">
            <button class="pill active" onclick="filterByStatus('all', this)">All</button>
            <button class="pill" onclick="filterByStatus('pending', this)">Pending</button>
            <button class="pill" onclick="filterByStatus('preparing', this)">Preparing</button>
            <button class="pill" onclick="filterByStatus('ready', this)">Ready</button>
            <button class="pill" onclick="filterByStatus('completed', this)">Completed</button>
        </div>
    </div>

    <!-- ── Orders Table ── -->
    <div class="panel">
        @if($orders->count() === 0)
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                <p>No orders yet</p>
            </div>
        @else
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTableBody">
                        @foreach($orders as $order)
                        <tr data-status="{{ $order->status }}" data-search="#{{ $order->id }} {{ strtolower($order->user->name) }}">
                            <td>
                                <span class="order-id">#{{ $order->id }}</span>
                            </td>
                            <td>
                                <div class="customer-cell">
                                    <div class="customer-avatar">
                                        <span>{{ strtoupper(substr($order->user->name, 0, 1)) }}</span>
                                    </div>
                                    <span class="customer-name">{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="items-badge">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                                    {{ $order->orderItems->count() }} item{{ $order->orderItems->count() !== 1 ? 's' : '' }}
                                </span>
                            </td>
                            <td>
                                <span class="money-value">${{ number_format($order->total_price, 2) }}</span>
                            </td>
                            <td>
                                <span class="status-badge {{ $order->status }}">
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
                                </span>
                            </td>
                            <td>
                                <span class="date-cell">{{ $order->created_at->format('M d, Y') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="view-btn">
                                    View
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
</div>
@endsection

@section('scripts')
<script>
    let currentStatusFilter = 'all';

    function filterOrders() {
        const query = document.getElementById('orderSearch').value.toLowerCase();
        document.querySelectorAll('#ordersTableBody tr').forEach(row => {
            const searchText = row.dataset.search || '';
            const status = row.dataset.status;
            const matchSearch = searchText.includes(query);
            const matchStatus = currentStatusFilter === 'all' || status === currentStatusFilter;
            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    function filterByStatus(status, btn) {
        currentStatusFilter = status;
        document.querySelectorAll('.filter-pills .pill').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        filterOrders();
    }
</script>
@endsection
