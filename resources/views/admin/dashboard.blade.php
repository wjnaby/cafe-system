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
        --sky-200:  #bae6fd;
        --sky-300:  #7dd3fc;
        --sky-400:  #38bdf8;
        --sky-500:  #0ea5e9;
        --teal-400: #2dd4bf;
        --teal-500: #14b8a6;
        --violet-400:#a78bfa;
        --violet-500:#8b5cf6;
        --amber-400: #fbbf24;
        --amber-500: #f59e0b;
        --rose-400:  #fb7185;
        --rose-500:  #f43f5e;
        --slate-50:  #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-300: #cbd5e1;
        --slate-400: #94a3b8;
        --slate-500: #64748b;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-800: #1e293b;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --card-bg: rgba(255,255,255,0.72);
        --card-border: rgba(148,163,184,0.18);
        --card-shadow: 0 1px 3px rgba(30,41,59,0.06), 0 1px 2px rgba(30,41,59,0.04);
        --card-shadow-hover: 0 8px 24px rgba(37,99,235,0.12), 0 2px 6px rgba(30,41,59,0.06);
        --radius: 18px;
        --radius-sm: 12px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .dash-body {
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

    /* ── Header ── */
    .dash-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 36px;
    }
    .dash-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--slate-800);
        letter-spacing: -0.03em;
    }
    .dash-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-top: 4px;
        font-weight: 400;
    }
    .header-actions {
        display: flex;
        gap: 10px;
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
    }
    .btn-outline {
        background: var(--card-bg);
        border: 1.5px solid var(--card-border);
        color: var(--slate-600);
        backdrop-filter: blur(8px);
    }
    .btn-outline:hover { border-color: var(--blue-300); color: var(--blue-600); background: #fff; }
    .btn-primary {
        background: linear-gradient(135deg, var(--blue-500), var(--blue-600));
        color: #fff;
        box-shadow: 0 3px 12px rgba(37,99,235,0.28);
    }
    .btn-primary:hover { box-shadow: 0 5px 18px rgba(37,99,235,0.38); transform: translateY(-1px); }
    .btn svg { width: 15px; height: 15px; }

    /* ── Top Stats Row ── */
    .stats-top {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: var(--card-bg);
        backdrop-filter: blur(14px);
        border: 1px solid var(--card-border);
        border-radius: var(--radius);
        padding: 22px 22px 18px;
        box-shadow: var(--card-shadow);
        transition: box-shadow 0.25s, transform 0.25s;
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 100px; height: 100px;
        border-radius: 50%;
        opacity: 0.12;
        pointer-events: none;
    }
    .stat-card:hover { box-shadow: var(--card-shadow-hover); transform: translateY(-2px); }

    .stat-card.c-blue::before   { background: var(--blue-400); }
    .stat-card.c-sky::before    { background: var(--sky-400); }
    .stat-card.c-teal::before   { background: var(--teal-400); }
    .stat-card.c-violet::before { background: var(--violet-400); }

    .stat-top-row { display: flex; justify-content: space-between; align-items: flex-start; }
    .stat-icon {
        width: 42px; height: 42px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
    }
    .stat-icon svg { width: 20px; height: 20px; }
    .ic-blue   { background: #dbeafe; }  .ic-blue svg   { color: var(--blue-500); }
    .ic-sky    { background: #e0f2fe; }  .ic-sky svg    { color: var(--sky-500); }
    .ic-teal   { background: #ccfbf1; }  .ic-teal svg   { color: var(--teal-500); }
    .ic-violet { background: #ede9fe; }  .ic-violet svg { color: var(--violet-500); }

    .stat-label { font-size: 0.78rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em; }
    .stat-value { font-family: 'Syne', sans-serif; font-size: 1.75rem; font-weight: 700; color: var(--slate-800); margin: 8px 0 4px; letter-spacing: -0.02em; }
    .stat-sub   { font-size: 0.76rem; color: var(--text-muted); display: flex; align-items: center; gap: 5px; }
    .badge-up   { color: var(--teal-500); font-weight: 600; }
    .badge-down { color: var(--rose-400); font-weight: 600; }

    /* ── Middle Row: Chart + Side Stats ── */
    .mid-row {
        display: grid;
        grid-template-columns: 1.7fr 1fr;
        gap: 18px;
        margin-bottom: 24px;
    }
    .panel {
        background: var(--card-bg);
        backdrop-filter: blur(14px);
        border: 1px solid var(--card-border);
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        transition: box-shadow 0.25s;
        overflow: hidden;
    }
    .panel:hover { box-shadow: var(--card-shadow-hover); }
    .panel-head {
        padding: 20px 24px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .panel-head h2 {
        font-family: 'Syne', sans-serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--slate-800);
    }
    .panel-head .manage-link {
        font-size: 0.78rem;
        color: var(--blue-500);
        font-weight: 600;
        text-decoration: none;
        display: flex; align-items: center; gap: 4px;
        transition: color 0.2s;
    }
    .panel-head .manage-link:hover { color: var(--blue-700); }
    .panel-head .manage-link svg { width: 13px; height: 13px; }

    /* ── Revenue Chart ── */
    .chart-wrap { padding: 20px 24px 24px; }
    .chart-legend { display: flex; gap: 20px; margin-bottom: 16px; }
    .legend-item { display: flex; align-items: center; gap: 7px; font-size: 0.78rem; color: var(--slate-500); font-weight: 500; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; }
    .legend-dot.blue { background: var(--blue-500); }
    .legend-dot.sky  { background: var(--sky-400); }

    .chart-svg { width: 100%; display: block; }

    /* ── Side: Status Breakdown ── */
    .status-list { padding: 16px 24px 22px; }
    .status-item {
        display: flex; align-items: center; gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid var(--slate-100);
    }
    .status-item:last-child { border-bottom: none; }
    .status-dot { width: 11px; height: 11px; border-radius: 50%; flex-shrink: 0; }
    .status-dot.pending   { background: var(--amber-400); }
    .status-dot.preparing { background: var(--blue-400); }
    .status-dot.ready     { background: var(--teal-400); }
    .status-dot.completed { background: var(--slate-300); }

    .status-info { flex: 1; }
    .status-name { font-size: 0.84rem; font-weight: 600; color: var(--slate-700); }
    .status-count { font-size: 0.76rem; color: var(--text-muted); margin-top: 1px; }

    .status-bar-bg { flex: 0 0 90px; background: var(--slate-100); border-radius: 6px; height: 7px; overflow: hidden; }
    .status-bar-fill { height: 100%; border-radius: 6px; transition: width 0.6s ease; }
    .fill-pending   { background: var(--amber-400); }
    .fill-preparing { background: var(--blue-400); }
    .fill-ready     { background: var(--teal-400); }
    .fill-completed { background: var(--slate-300); }

    .status-pct { font-size: 0.78rem; font-weight: 600; color: var(--slate-500); min-width: 34px; text-align: right; }

    /* ── Bottom Row: Orders Table + Top Items ── */
    .bottom-row {
        display: grid;
        grid-template-columns: 1.65fr 1fr;
        gap: 18px;
    }

    /* ── Orders Table ── */
    .table-scroll { overflow-x: auto; }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.82rem;
    }
    thead th {
        text-align: left;
        padding: 12px 18px;
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        background: var(--slate-50);
        border-bottom: 1px solid var(--slate-100);
        white-space: nowrap;
    }
    tbody td {
        padding: 13px 18px;
        border-bottom: 1px solid rgba(148,163,184,0.1);
        color: var(--slate-700);
        white-space: nowrap;
    }
    tbody tr { transition: background 0.15s; }
    tbody tr:hover { background: rgba(59,130,246,0.035); }
    tbody tr:last-child td { border-bottom: none; }

    .order-id { font-weight: 700; color: var(--slate-800); }
    .order-total { font-weight: 600; color: var(--slate-800); }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.73rem;
        font-weight: 600;
    }
    .badge.pending   { background: #fef3c7; color: #b45309; }
    .badge.preparing { background: #dbeafe; color: #1d4ed8; }
    .badge.ready     { background: #d1fae5; color: #047857; }
    .badge.completed { background: var(--slate-100); color: var(--slate-500); }

    .action-link {
        color: var(--blue-500);
        font-weight: 600;
        text-decoration: none;
        font-size: 0.78rem;
        display: inline-flex; align-items: center; gap: 3px;
        transition: color 0.2s;
    }
    .action-link:hover { color: var(--blue-700); }

    /* ── Top Menu Items ── */
    .menu-item-row {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 14px 0;
        border-bottom: 1px solid var(--slate-100);
    }
    .menu-item-row:last-child { border-bottom: none; }
    .menu-rank {
        width: 28px; height: 28px;
        border-radius: 8px;
        background: var(--blue-50);
        color: var(--blue-600);
        font-weight: 700;
        font-size: 0.78rem;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .menu-info { flex: 1; min-width: 0; }
    .menu-name { font-size: 0.84rem; font-weight: 600; color: var(--slate-700); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .menu-cat  { font-size: 0.74rem; color: var(--text-muted); margin-top: 1px; }
    .menu-orders { font-size: 0.78rem; font-weight: 600; color: var(--blue-600); white-space: nowrap; }

    /* ── Empty State ── */
    .empty-state { text-align: center; padding: 48px 24px; }
    .empty-state svg { width: 44px; height: 44px; color: var(--slate-200); margin: 0 auto 12px; display: block; }
    .empty-state p { color: var(--text-muted); font-size: 0.85rem; }

    /* ── Responsive ── */
    @media (max-width: 1100px) {
        .stats-top { grid-template-columns: repeat(2,1fr); }
        .mid-row, .bottom-row { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
        .dash-body { padding: 24px 16px 48px; }
        .stats-top { grid-template-columns: 1fr 1fr; }
        .dash-header { flex-direction: column; align-items: flex-start; gap: 14px; }
    }
</style>
@endsection

@section('content')
<div class="dash-body">

    <!-- ── Header ── -->
    <div class="dash-header">
        <div>
            <h1>Dashboard</h1>
            <p>Welcome back! Here's your overview for today.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                Manage Orders
            </a>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                Manage Menu
            </a>
        </div>
    </div>

    <!-- ── Top Stats ── -->
    <div class="stats-top">
        <div class="stat-card c-blue">
            <div class="stat-top-row">
                <span class="stat-label">Today's Orders</span>
                <div class="stat-icon ic-blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                </div>
            </div>
            <p class="stat-value">{{ $todayOrders }}</p>
            <p class="stat-sub">
                @if(isset($ordersChange) && $ordersChange != 0)
                    <span class="{{ $ordersChange > 0 ? 'badge-up' : 'badge-down' }}">{{ $ordersChange > 0 ? '↑' : '↓' }} {{ abs($ordersChange) }}%</span> vs yesterday
                @else
                    Today's total
                @endif
            </p>
        </div>

        <div class="stat-card c-sky">
            <div class="stat-top-row">
                <span class="stat-label">Today's Revenue</span>
                <div class="stat-icon ic-sky">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                </div>
            </div>
            <p class="stat-value">${{ number_format($todayRevenue, 2) }}</p>
            <p class="stat-sub">
                @if(isset($revenueChange) && $revenueChange != 0)
                    <span class="{{ $revenueChange > 0 ? 'badge-up' : 'badge-down' }}">{{ $revenueChange > 0 ? '↑' : '↓' }} {{ abs($revenueChange) }}%</span> vs yesterday
                @else
                    Today's total
                @endif
            </p>
        </div>

        <div class="stat-card c-teal">
            <div class="stat-top-row">
                <span class="stat-label">Pending Orders</span>
                <div class="stat-icon ic-teal">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
            </div>
            <p class="stat-value">{{ $pendingOrders }}</p>
            <p class="stat-sub">Awaiting action</p>
        </div>

        <div class="stat-card c-violet">
            <div class="stat-top-row">
                <span class="stat-label">Menu Items</span>
                <div class="stat-icon ic-violet">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
            </div>
            <p class="stat-value">{{ $activeMenuItems }}</p>
            <p class="stat-sub">Active on menu</p>
        </div>
    </div>

    <!-- ── Mid Row: Revenue Chart + Order Status ── -->
    <div class="mid-row">

        <!-- Revenue Chart -->
        <div class="panel">
            <div class="panel-head">
                <h2>Revenue Overview</h2>
                <a href="{{ route('admin.orders.index') }}" class="manage-link">
                    Manage <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
            </div>
            <div class="chart-wrap">
                <div class="chart-legend">
                    <div class="legend-item"><span class="legend-dot blue"></span> Revenue</div>
                    <div class="legend-item"><span class="legend-dot sky"></span> Orders</div>
                </div>
                @if(isset($weeklyData) && count($weeklyData) > 0)
                @php
                    $maxRevenue = max(array_column($weeklyData, 'revenue')) ?: 1;
                    $maxOrders = max(array_column($weeklyData, 'orders')) ?: 1;
                    $chartHeight = 160;
                    $chartTop = 30;
                    $chartWidth = 620;
                    $startX = 60;
                    $count = count($weeklyData);
                    $stepX = $count > 1 ? $chartWidth / ($count - 1) : $chartWidth;
                    
                    // Calculate Y labels
                    $yLabels = [
                        round($maxRevenue),
                        round($maxRevenue * 0.75),
                        round($maxRevenue * 0.5),
                        round($maxRevenue * 0.25),
                    ];
                    
                    // Build revenue points
                    $revenuePoints = [];
                    $orderPoints = [];
                    foreach ($weeklyData as $i => $day) {
                        $x = $startX + ($i * $stepX);
                        $revenueY = $chartTop + $chartHeight - (($day['revenue'] / $maxRevenue) * $chartHeight);
                        $orderY = $chartTop + $chartHeight - (($day['orders'] / $maxOrders) * $chartHeight);
                        $revenuePoints[] = ['x' => $x, 'y' => $revenueY];
                        $orderPoints[] = ['x' => $x, 'y' => $orderY];
                    }
                    
                    // Build SVG path for line
                    $revenuePath = 'M' . $revenuePoints[0]['x'] . ',' . $revenuePoints[0]['y'];
                    $orderPath = 'M' . $orderPoints[0]['x'] . ',' . $orderPoints[0]['y'];
                    for ($i = 1; $i < count($revenuePoints); $i++) {
                        $revenuePath .= ' L' . $revenuePoints[$i]['x'] . ',' . $revenuePoints[$i]['y'];
                        $orderPath .= ' L' . $orderPoints[$i]['x'] . ',' . $orderPoints[$i]['y'];
                    }
                    
                    // Build area path (close at bottom)
                    $revenueArea = $revenuePath . ' L' . end($revenuePoints)['x'] . ',190 L' . $revenuePoints[0]['x'] . ',190 Z';
                    $orderArea = $orderPath . ' L' . end($orderPoints)['x'] . ',190 L' . $orderPoints[0]['x'] . ',190 Z';
                @endphp
                <svg class="chart-svg" viewBox="0 0 720 220" preserveAspectRatio="none" style="height:220px;">
                    <defs>
                        <linearGradient id="gRevenue" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#3b82f6" stop-opacity="0.22"/>
                            <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.01"/>
                        </linearGradient>
                        <linearGradient id="gOrders" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.16"/>
                            <stop offset="100%" stop-color="#38bdf8" stop-opacity="0.01"/>
                        </linearGradient>
                    </defs>

                    <!-- Grid Lines -->
                    <line x1="0" y1="44"  x2="720" y2="44"  stroke="#e2e8f0" stroke-width="1"/>
                    <line x1="0" y1="88"  x2="720" y2="88"  stroke="#e2e8f0" stroke-width="1"/>
                    <line x1="0" y1="132" x2="720" y2="132" stroke="#e2e8f0" stroke-width="1"/>
                    <line x1="0" y1="176" x2="720" y2="176" stroke="#e2e8f0" stroke-width="1"/>

                    <!-- Y Labels (dynamic) -->
                    <text x="0" y="40"  fill="#94a3b8" font-size="11" font-family="DM Sans, sans-serif">${{ number_format($yLabels[0]) }}</text>
                    <text x="0" y="84"  fill="#94a3b8" font-size="11" font-family="DM Sans, sans-serif">${{ number_format($yLabels[1]) }}</text>
                    <text x="0" y="128" fill="#94a3b8" font-size="11" font-family="DM Sans, sans-serif">${{ number_format($yLabels[2]) }}</text>
                    <text x="0" y="172" fill="#94a3b8" font-size="11" font-family="DM Sans, sans-serif">${{ number_format($yLabels[3]) }}</text>

                    <!-- Revenue Area -->
                    <path d="{{ $revenueArea }}" fill="url(#gRevenue)"/>
                    <!-- Revenue Line -->
                    <path d="{{ $revenuePath }}" fill="none" stroke="#3b82f6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>

                    <!-- Orders Area -->
                    <path d="{{ $orderArea }}" fill="url(#gOrders)"/>
                    <!-- Orders Line -->
                    <path d="{{ $orderPath }}" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="5,3"/>

                    <!-- Revenue Dots -->
                    @foreach($revenuePoints as $point)
                    <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="4" fill="#fff" stroke="#3b82f6" stroke-width="2.5"/>
                    @endforeach

                    <!-- X Labels (dynamic) -->
                    @foreach($weeklyData as $i => $day)
                    <text x="{{ $startX + ($i * $stepX) }}" y="210" fill="#94a3b8" font-size="11" font-family="DM Sans, sans-serif" text-anchor="middle">{{ $day['label'] }}</text>
                    @endforeach
                </svg>
                @else
                <div class="empty-state" style="padding: 40px 0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    <p>No revenue data available</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Order Status Breakdown -->
        <div class="panel">
            <div class="panel-head">
                <h2>Order Status</h2>
                <a href="{{ route('admin.orders.index') }}" class="manage-link">
                    Manage <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
            </div>
            <!-- Donut Chart (CSS) -->
            <div style="display:flex; justify-content:center; padding: 22px 0 10px;">
                @php
                    $pending   = $ordersByStatus['pending']   ?? 0;
                    $preparing = $ordersByStatus['preparing'] ?? 0;
                    $ready     = $ordersByStatus['ready']     ?? 0;
                    $completed = $ordersByStatus['completed'] ?? 0;
                    $total     = $pending + $preparing + $ready + $completed;
                    $pPend = $total > 0 ? round(($pending/$total)*360, 1) : 0;
                    $pPrep = $total > 0 ? round(($preparing/$total)*360, 1) : 0;
                    $pRead = $total > 0 ? round(($ready/$total)*360, 1) : 0;
                    $pComp = $total > 0 ? 360 - $pPend - $pPrep - $pRead : 0;
                    // cumulative offsets
                    $off1 = 0;
                    $off2 = $pPend;
                    $off3 = $off2 + $pPrep;
                    $off4 = $off3 + $pRead;
                @endphp
                <svg viewBox="0 0 120 120" width="130" height="130">
                    <!-- Background ring -->
                    <circle cx="60" cy="60" r="44" fill="none" stroke="#f1f5f9" stroke-width="18"/>
                    <!-- Segments using stroke-dasharray trick -->
                    <!-- Pending (amber) -->
                    <circle cx="60" cy="60" r="44" fill="none" stroke="#fbbf24" stroke-width="18"
                        stroke-dasharray="{{ $pPend }} {{ 360 - $pPend }}"
                        stroke-dashoffset="{{ 90 - $off1 }}"
                        transform="rotate(0 60 60)" style="transition: stroke-dasharray 0.6s;"/>
                    <!-- Preparing (blue) -->
                    <circle cx="60" cy="60" r="44" fill="none" stroke="#60a5fa" stroke-width="18"
                        stroke-dasharray="{{ $pPrep }} {{ 360 - $pPrep }}"
                        stroke-dashoffset="{{ 90 - $off2 }}"
                        style="transition: stroke-dasharray 0.6s;"/>
                    <!-- Ready (teal) -->
                    <circle cx="60" cy="60" r="44" fill="none" stroke="#2dd4bf" stroke-width="18"
                        stroke-dasharray="{{ $pRead }} {{ 360 - $pRead }}"
                        stroke-dashoffset="{{ 90 - $off3 }}"
                        style="transition: stroke-dasharray 0.6s;"/>
                    <!-- Completed (slate) -->
                    <circle cx="60" cy="60" r="44" fill="none" stroke="#cbd5e1" stroke-width="18"
                        stroke-dasharray="{{ $pComp }} {{ 360 - $pComp }}"
                        stroke-dashoffset="{{ 90 - $off4 }}"
                        style="transition: stroke-dasharray 0.6s;"/>
                    <!-- Center text -->
                    <text x="60" y="57" text-anchor="middle" font-family="Syne, sans-serif" font-size="18" font-weight="700" fill="#1e293b">{{ $total }}</text>
                    <text x="60" y="72" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="9" fill="#94a3b8">Total</text>
                </svg>
            </div>

            <!-- Status list with bars -->
            <div class="status-list">
                @php
                    $statuses = [
                        ['key'=>'pending',   'label'=>'Pending',   'val'=>$pending,   'pct'=>$total > 0 ? round(($pending/$total)*100) : 0],
                        ['key'=>'preparing', 'label'=>'Preparing', 'val'=>$preparing, 'pct'=>$total > 0 ? round(($preparing/$total)*100) : 0],
                        ['key'=>'ready',     'label'=>'Ready',     'val'=>$ready,     'pct'=>$total > 0 ? round(($ready/$total)*100) : 0],
                        ['key'=>'completed', 'label'=>'Completed', 'val'=>$completed, 'pct'=>$total > 0 ? round(($completed/$total)*100) : 0],
                    ];
                @endphp
                @foreach($statuses as $s)
                <div class="status-item">
                    <span class="status-dot {{ $s['key'] }}"></span>
                    <div class="status-info">
                        <div class="status-name">{{ $s['label'] }}</div>
                        <div class="status-count">{{ $s['val'] }} orders</div>
                    </div>
                    <div class="status-bar-bg"><div class="status-bar-fill fill-{{ $s['key'] }}" style="width:{{ $s['pct'] }}%"></div></div>
                    <span class="status-pct">{{ $s['pct'] }}%</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ── Bottom Row: Recent Orders + Top Menu Items ── -->
    <div class="bottom-row">

        <!-- Recent Orders Table -->
        <div class="panel">
            <div class="panel-head" style="padding-bottom:0;">
                <h2>Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="manage-link">
                    Manage <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
            </div>

            @if($recentOrders->count() > 0)
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td class="order-id">#{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td class="order-total">${{ number_format($order->total_price, 2) }}</td>
                            <td><span class="badge {{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                            <td style="color:var(--text-muted);">{{ $order->created_at->format('M d, H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="action-link">
                                    View <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                <p>No orders yet</p>
            </div>
            @endif
        </div>

        <!-- Top Menu Items -->
        <div class="panel">
            <div class="panel-head">
                <h2>Top Menu Items</h2>
                <a href="{{ route('admin.menu.index') }}" class="manage-link">
                    Manage <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
            </div>
            <div style="padding: 8px 24px 20px;">
                @forelse($topMenuItems ?? [] as $i => $item)
                <div class="menu-item-row">
                    <div class="menu-rank">{{ $i + 1 }}</div>
                    <div class="menu-info">
                        <div class="menu-name">{{ $item['name'] }}</div>
                        <div class="menu-cat">{{ $item['category'] }}</div>
                    </div>
                    <div class="menu-orders">{{ $item['orders'] }} orders</div>
                </div>
                @empty
                <div class="empty-state" style="padding: 24px 0;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    <p>No menu data available</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection