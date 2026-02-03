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
    .customers-body {
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
    .customers-layout { max-width:1140px; margin:0 auto; }

    /* ── Header ── */
    .page-header {
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
        grid-template-columns:repeat(3, 1fr);
        gap:16px;
        margin-bottom:24px;
    }
    .stat-card {
        background:var(--card-bg);backdrop-filter:blur(10px);
        border:1px solid var(--card-border);border-radius:16px;
        padding:20px 24px;box-shadow:var(--card-shadow);
        display:flex;align-items:center;gap:16px;
        animation:fadeUp .4s ease both;
    }
    .stat-card:nth-child(1){animation-delay:.04s;}
    .stat-card:nth-child(2){animation-delay:.08s;}
    .stat-card:nth-child(3){animation-delay:.12s;}
    .stat-icon {
        width:48px;height:48px;border-radius:14px;
        display:flex;align-items:center;justify-content:center;
        flex-shrink:0;
    }
    .stat-icon svg { width:22px;height:22px; }
    .stat-icon.blue { background:#dbeafe; }
    .stat-icon.blue svg { color:var(--blue-500); }
    .stat-icon.teal { background:#ccfbf1; }
    .stat-icon.teal svg { color:var(--teal-500); }
    .stat-icon.violet { background:#ede9fe; }
    .stat-icon.violet svg { color:var(--violet-500); }
    .stat-content .stat-value {
        font-family:'Syne',sans-serif;
        font-size:1.75rem;
        font-weight:700;
        color:var(--slate-800);
        line-height:1;
    }
    .stat-content .stat-label {
        font-size:.82rem;
        color:var(--text-muted);
        margin-top:4px;
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

    /* ── Customer Avatar ── */
    .customer-cell {
        display:flex;
        align-items:center;
        gap:14px;
    }
    .customer-avatar {
        width:42px;height:42px;border-radius:12px;
        background:linear-gradient(135deg,var(--blue-100),var(--violet-100));
        border:1px solid var(--blue-100);
        display:flex;align-items:center;justify-content:center;
        flex-shrink:0;
    }
    .customer-avatar span {
        font-family:'Syne',sans-serif;
        font-size:1rem;
        font-weight:700;
        background:linear-gradient(135deg,var(--blue-500),var(--violet-500));
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        background-clip:text;
    }
    .customer-name {
        font-family:'Syne',sans-serif;
        font-size:.9rem;
        font-weight:600;
        color:var(--slate-800);
    }
    .customer-email {
        font-size:.8rem;
        color:var(--text-muted);
        margin-top:1px;
    }

    /* ── Badges ── */
    .orders-badge {
        display:inline-flex;
        align-items:center;
        gap:5px;
        padding:5px 12px;
        border-radius:20px;
        font-size:.78rem;
        font-weight:600;
        background:var(--blue-50);
        color:var(--blue-600);
        border:1px solid var(--blue-100);
    }
    .orders-badge svg { width:13px; height:13px; }

    /* ── Money ── */
    .money-value {
        font-family:'Syne',sans-serif;
        font-size:.95rem;
        font-weight:700;
        color:var(--teal-500);
    }

    /* ── Date ── */
    .date-cell {
        font-size:.84rem;
        color:var(--slate-500);
    }

    /* ── Action Button ── */
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
        .customers-body{padding:24px 16px 48px;}
        .stats-grid{grid-template-columns:1fr;}
        .stat-card{padding:16px 20px;}
    }
</style>
@endsection

@section('content')
<div class="customers-body">
<div class="customers-layout">

    <!-- ── Header ── -->
    <div class="page-header">
        <h1>Customers</h1>
        <p>{{ $customers->count() }} registered customer{{ $customers->count() !== 1 ? 's' : '' }}</p>
    </div>

    <!-- ── Stats Cards ── -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $customers->count() }}</div>
                <div class="stat-label">Total Customers</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon teal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $customers->where('orders_count', '>', 0)->count() }}</div>
                <div class="stat-label">Active Customers</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon violet">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $customers->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                <div class="stat-label">New This Month</div>
            </div>
        </div>
    </div>

    <!-- ── Toolbar ── -->
    <div class="toolbar">
        <div class="search-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input" id="customerSearch" placeholder="Search customers…" oninput="filterCustomers()">
        </div>
    </div>

    <!-- ── Customers Table ── -->
    <div class="panel">
        @if($customers->count() === 0)
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <p>No customers registered yet</p>
            </div>
        @else
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Orders</th>
                            <th>Total Spent</th>
                            <th>Joined</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customersTableBody">
                        @foreach($customers as $customer)
                        <tr data-search="{{ strtolower($customer->name) }} {{ strtolower($customer->email) }}">
                            <td>
                                <div class="customer-cell">
                                    <div class="customer-avatar">
                                        <span>{{ strtoupper(substr($customer->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <div class="customer-name">{{ $customer->name }}</div>
                                        <div class="customer-email">{{ $customer->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="orders-badge">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                                    {{ $customer->orders_count }} order{{ $customer->orders_count !== 1 ? 's' : '' }}
                                </span>
                            </td>
                            <td>
                                <span class="money-value">${{ number_format($customer->orders_sum_total_price ?? 0, 2) }}</span>
                            </td>
                            <td>
                                <span class="date-cell">{{ $customer->created_at->format('M d, Y') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.customers.show', $customer->id) }}" class="view-btn">
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
    function filterCustomers() {
        const query = document.getElementById('customerSearch').value.toLowerCase();
        document.querySelectorAll('#customersTableBody tr').forEach(row => {
            const searchText = row.dataset.search || '';
            row.style.display = searchText.includes(query) ? '' : 'none';
        });
    }
</script>
@endsection
