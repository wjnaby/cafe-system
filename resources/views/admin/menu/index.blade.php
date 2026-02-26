@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');

    :root {
        --brown-dark:#3D2314;--brown-medium:#5C3A21;--cream:#F5F0E8;--cream-light:#FAF8F5;
        --amber:#D4A574;--amber-dark:#B8956A;--text-dark:#2D1810;--text-muted:#6B5B4F;
        --teal-400:#2dd4bf;--teal-500:#14b8a6;
        --violet-400:#c4a882;--violet-500:#B8956A;--violet-50:#FDF8F3;--violet-100:#F5EDE4;--violet-600:#5C3A21;
        --amber-400:#e8c9a8;--amber-500:#D4A574;
        --rose-400:#fb7185;--rose-500:#f43f5e;
        --slate-50:#FAF8F5;--slate-100:#F5F0E8;--slate-200:#E8E2DA;--slate-300:#d4c4b4;
        --slate-400:#6B5B4F;--slate-500:#6B5B4F;--slate-600:#5C3A21;--slate-700:#3D2314;--slate-800:#2D1810;
        --text-primary:#2D1810;
        --card-bg:rgba(255,255,255,0.85);--card-border:rgba(232,226,218,0.8);
        --card-shadow:0 4px 20px rgba(0,0,0,0.05);
        --card-shadow-hover:0 8px 24px rgba(61,35,20,0.08),0 2px 6px rgba(0,0,0,0.04);
        --radius:18px;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

    /* ── Page Shell ── */
    .menu-body {
        font-family:'Poppins',system-ui,sans-serif;
        min-height:100vh;
        background:
            radial-gradient(ellipse 80% 60% at 15% 20%,rgba(245,240,232,.8) 0%,transparent 70%),
            radial-gradient(ellipse 60% 50% at 80% 70%,rgba(250,248,245,.6) 0%,transparent 65%),
            radial-gradient(ellipse 40% 40% at 55% 10%,rgba(212,165,116,.15) 0%,transparent 60%),
            linear-gradient(160deg,#FAF8F5 0%,#F5F0E8 40%,#FAF8F5 100%);
        color:var(--text-primary);
        padding:36px 40px 60px;
    }
    .menu-layout { max-width:1140px; margin:0 auto; }

    /* ── Header ── */
    .menu-header {
        display:flex;
        justify-content:space-between;
        align-items:flex-end;
        margin-bottom:28px;
    }
    .menu-header h1 {
        font-family:'Playfair Display',serif;
        font-size:2rem;
        font-weight:700;
        color:var(--text-dark);
        letter-spacing:-.03em;
    }
    .menu-header p { color:var(--text-muted); font-size:.95rem; margin-top:4px; }
    .header-actions { display:flex; gap:10px; }

    /* ── Buttons ── */
    .btn {
        display:inline-flex;align-items:center;gap:7px;
        padding:9px 18px;border-radius:10px;
        font-size:.82rem;font-weight:600;cursor:pointer;
        border:none;transition:all .2s;text-decoration:none;
        letter-spacing:.01em;font-family:inherit;
    }
    .btn-outline {
        background:var(--card-bg);border:1.5px solid var(--card-border);
        color:var(--slate-600);backdrop-filter:blur(8px);
    }
    .btn-outline:hover { border-color:var(--amber);color:var(--brown-medium);background:#fff; }
    .btn-primary {
        background:linear-gradient(135deg,var(--amber),var(--amber-dark));
        color:var(--brown-dark);box-shadow:0 3px 12px rgba(92,58,33,.2);
    }
    .btn-primary:hover { box-shadow:0 5px 18px rgba(92,58,33,.28); transform:translateY(-1px); }
    .btn-violet {
        background:linear-gradient(135deg,var(--amber),var(--brown-medium));
        color:#fff;box-shadow:0 3px 12px rgba(92,58,33,.25);
    }
    .btn-violet:hover { box-shadow:0 5px 18px rgba(92,58,33,.35); transform:translateY(-1px); }
    .btn svg { width:15px; height:15px; }

    /* ── Toolbar (search + filter) ── */
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
    .search-input:focus { outline:none;border-color:var(--amber);box-shadow:0 0 0 3px rgba(212,165,116,.2); }

    .filter-pills { display:flex; gap:7px; flex-wrap:wrap; }
    .pill {
        padding:7px 14px;border-radius:20px;
        font-size:.78rem;font-weight:600;cursor:pointer;
        border:1.5px solid var(--slate-200);
        background:#fff;color:var(--slate-600);
        transition:all .18s;font-family:inherit;
    }
    .pill:hover { border-color:var(--amber);color:var(--brown-medium); }
    .pill.active {
        background:#F5EDE4;border-color:var(--cream);color:var(--brown-medium);
    }

    /* ── Category Pills Row ── */
    .category-pills-row {
        display:flex;
        align-items:center;
        gap:8px;
        margin-bottom:24px;
        flex-wrap:wrap;
    }
    .category-pills-label {
        font-size:.75rem;
        font-weight:600;
        color:var(--text-muted);
        text-transform:uppercase;
        letter-spacing:.05em;
        margin-right:4px;
    }
    .cat-pill {
        padding:8px 16px;border-radius:20px;
        font-size:.8rem;font-weight:600;cursor:pointer;
        border:1.5px solid var(--amber);
        background:transparent;color:var(--brown-medium);
        transition:all .18s;font-family:inherit;
        display:inline-flex;align-items:center;gap:6px;
    }
    .cat-pill:hover {
        background:var(--amber);color:var(--brown-dark);
        transform:translateY(-1px);
        box-shadow:0 4px 12px rgba(92,58,33,.2);
    }
    .cat-pill.active {
        background:var(--amber-dark);color:#fff;
    }
    .cat-pill .cat-pill-count {
        background:rgba(255,255,255,.25);
        padding:2px 7px;
        border-radius:10px;
        font-size:.7rem;
    }
    .cat-pill:not(.active) .cat-pill-count {
        background:rgba(212,165,116,.2);
    }
    .add-cat-pill {
        border-style:dashed;
        border-color:var(--slate-300);
        color:var(--slate-500);
    }
    .add-cat-pill:hover {
        border-color:var(--amber);
        background:#F5EDE4;
        color:var(--brown-medium);
        box-shadow:none;
        transform:none;
    }
    .add-cat-pill svg { width:14px; height:14px; }

    /* ── Stats mini row ── */
    .mini-stats {
        display:flex;gap:14px;margin-bottom:22px;flex-wrap:wrap;
    }
    .mini-stat {
        background:var(--card-bg);backdrop-filter:blur(10px);
        border:1px solid var(--card-border);border-radius:14px;
        padding:14px 20px;box-shadow:var(--card-shadow);
        display:flex;align-items:center;gap:12px;
        flex:1;min-width:140px;
        animation:fadeUp .4s ease both;
    }
    .mini-stat:nth-child(1){animation-delay:.04s;}
    .mini-stat:nth-child(2){animation-delay:.08s;}
    .mini-stat:nth-child(3){animation-delay:.12s;}
    .mini-stat:nth-child(4){animation-delay:.16s;}
    .mini-stat-icon {
        width:36px;height:36px;border-radius:10px;
        display:flex;align-items:center;justify-content:center;flex-shrink:0;
    }
    .mini-stat-icon svg { width:17px;height:17px; }
    .ms-blue   { background:#F5EDE4; } .ms-blue svg   { color:var(--amber-dark); }
    .ms-teal   { background:#ccfbf1; } .ms-teal svg   { color:var(--teal-500); }
    .ms-amber  { background:#fef3c7; } .ms-amber svg  { color:var(--amber-500); }
    .ms-violet { background:#ede9fe; } .ms-violet svg { color:var(--violet-500); }
    .mini-stat-text .val { font-family:'Playfair Display',serif;font-size:1.15rem;font-weight:700;color:var(--text-dark); }
    .mini-stat-text .lbl { font-size:.74rem;color:var(--text-muted);margin-top:1px; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);} }

    /* ── Category Section ── */
    .category-section {
        margin-bottom:28px;
        animation:fadeUp .45s ease both;
    }
    .category-header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:14px;
        padding:0 4px;
    }
    .category-title {
        display:flex;
        align-items:center;
        gap:12px;
    }
    .category-title h2 {
        font-family:'Playfair Display',serif;
        font-size:1.25rem;
        font-weight:700;
        color:var(--text-dark);
        letter-spacing:-.02em;
    }
    .category-count {
        background:#F5EDE4;
        color:var(--brown-medium);
        font-size:.72rem;
        font-weight:600;
        padding:4px 10px;
        border-radius:12px;
    }
    .category-delete-btn {
        background:transparent;
        border:1.5px solid transparent;
        color:var(--slate-400);
        cursor:pointer;
        padding:6px 10px;
        border-radius:8px;
        font-size:.75rem;
        font-weight:600;
        display:flex;
        align-items:center;
        gap:5px;
        transition:all .18s;
        font-family:inherit;
    }
    .category-delete-btn:hover {
        background:#fef2f2;
        border-color:#fecaca;
        color:var(--rose-500);
    }
    .category-delete-btn svg { width:14px; height:14px; }

    /* ── Panel (glass card) ── */
    .panel {
        background:var(--card-bg);backdrop-filter:blur(14px);
        border:1px solid var(--card-border);border-radius:var(--radius);
        box-shadow:var(--card-shadow);overflow:hidden;
    }

    /* ── Table ── */
    .table-scroll { overflow-x:auto; }
    table { width:100%;border-collapse:collapse;font-size:.83rem; }
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

    /* Thumbnail */
    .menu-thumb {
        width:52px;height:52px;border-radius:13px;
        background:linear-gradient(135deg,#FDF8F3,var(--cream));
        border:1px solid var(--cream);
        overflow:hidden;display:flex;align-items:center;justify-content:center;
        flex-shrink:0;
    }
    .menu-thumb img { width:100%;height:100%;object-fit:cover; }
    .menu-thumb .ph { font-size:1.35rem; }

    /* Name cell */
    .item-name { font-family:'Syne',sans-serif;font-size:.9rem;font-weight:600;color:var(--slate-800); }
    .item-desc { font-size:.78rem;color:var(--text-muted);margin-top:2px;max-width:220px;white-space:normal; }

    /* Price */
    .price-val { font-family:'Syne',sans-serif;font-size:.92rem;font-weight:700;color:var(--slate-800); }

    /* Status toggle */
    .status-toggle {
        display:inline-flex;align-items:center;gap:8px;
        background:none;border:none;cursor:pointer;
        font-family:inherit;padding:0;
    }
    .toggle-track {
        width:42px;height:24px;border-radius:12px;
        position:relative;transition:background .25s;
    }
    .toggle-track.on  { background:var(--teal-400); }
    .toggle-track.off { background:var(--slate-300); }
    .toggle-knob {
        position:absolute;top:3px;
        width:18px;height:18px;border-radius:50%;
        background:#fff;
        box-shadow:0 1px 3px rgba(0,0,0,.2);
        transition:left .25s;
    }
    .toggle-track.on  .toggle-knob { left:21px; }
    .toggle-track.off .toggle-knob { left:3px; }
    .toggle-label { font-size:.78rem;font-weight:600; }
    .toggle-label.on  { color:var(--teal-500); }
    .toggle-label.off { color:var(--slate-400); }

    /* Actions */
    .actions-cell { display:flex;align-items:center;gap:6px; }
    .icon-btn {
        width:34px;height:34px;border-radius:9px;
        border:1.5px solid transparent;background:transparent;
        color:var(--slate-300);cursor:pointer;
        display:flex;align-items:center;justify-content:center;
        transition:all .18s;font-family:inherit;
    }
    .icon-btn svg { width:17px;height:17px; }
    .icon-btn.edit:hover   { background:#F5EDE4;border-color:var(--cream);color:var(--brown-medium); }
    .icon-btn.delete:hover { background:#fef2f2;border-color:#fecaca;color:var(--rose-500); }

    /* ── Empty Category State ── */
    .empty-category {
        padding:32px;
        text-align:center;
        color:var(--text-muted);
        font-size:.88rem;
    }

    /* ── Modal ── */
    .modal-overlay {
        position:fixed;
        inset:0;
        background:rgba(30,41,59,.5);
        backdrop-filter:blur(4px);
        display:flex;
        align-items:center;
        justify-content:center;
        z-index:1000;
        opacity:0;
        visibility:hidden;
        transition:all .25s;
    }
    .modal-overlay.active {
        opacity:1;
        visibility:visible;
    }
    .modal {
        background:#fff;
        border-radius:20px;
        padding:28px;
        width:100%;
        max-width:420px;
        box-shadow:0 25px 50px rgba(30,41,59,.25);
        transform:translateY(20px);
        transition:transform .25s;
    }
    .modal-overlay.active .modal {
        transform:translateY(0);
    }
    .modal-title {
        font-family:'Syne',sans-serif;
        font-size:1.25rem;
        font-weight:700;
        color:var(--slate-800);
        margin-bottom:20px;
    }
    .modal-input {
        width:100%;
        padding:12px 16px;
        border:1.5px solid var(--slate-200);
        border-radius:12px;
        font-size:.9rem;
        font-family:inherit;
        color:var(--slate-700);
        margin-bottom:20px;
        transition:border-color .2s,box-shadow .2s;
    }
    .modal-input:focus {
        outline:none;
        border-color:var(--amber);
        box-shadow:0 0 0 3px rgba(212,165,116,.2);
    }
    .modal-actions {
        display:flex;
        justify-content:flex-end;
        gap:10px;
    }
    .modal-actions .btn { padding:10px 20px; }

    /* ── Alert Messages ── */
    .alert {
        padding:14px 20px;
        border-radius:12px;
        margin-bottom:20px;
        font-size:.88rem;
        font-weight:500;
        animation:fadeUp .3s ease both;
    }
    .alert-success {
        background:#ecfdf5;
        border:1px solid #a7f3d0;
        color:#047857;
    }
    .alert-error {
        background:#fef2f2;
        border:1px solid #fecaca;
        color:#b91c1c;
    }

    /* ── Responsive ── */
    @media(max-width:900px){
        .menu-body{padding:24px 16px 48px;}
        .menu-header{flex-direction:column;align-items:flex-start;gap:14px;}
        .mini-stats{gap:10px;}
        .mini-stat{min-width:120px;padding:12px 14px;}
        .header-actions{flex-wrap:wrap;}
    }
</style>
@endsection

@section('content')
<div class="menu-body">
<div class="menu-layout">

    <!-- ── Alert Messages ── -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <!-- ── Header ── -->
    <div class="menu-header">
        <div>
            <h1>Manage Menu</h1>
            <p>{{ $menuItems->count() }} item{{ $menuItems->count() !== 1 ? 's' : '' }} across {{ $categories->count() }} categories</p>
        </div>
        <div class="header-actions">
            <button type="button" class="btn btn-violet" onclick="openCategoryModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                New Category
            </button>
            <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add New Item
            </a>
        </div>
    </div>

    <!-- ── Mini Stats ── -->
    <div class="mini-stats">
        @php
            $totalItems  = $menuItems->count();
            $activeItems = $menuItems->filter(fn($i) => $i->status === 'active')->count();
            $inactiveItems = $totalItems - $activeItems;
            $totalCategories = $categories->count();
        @endphp
        <div class="mini-stat">
            <div class="mini-stat-icon ms-blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div class="mini-stat-text"><div class="val">{{ $totalItems }}</div><div class="lbl">Total Items</div></div>
        </div>
        <div class="mini-stat">
            <div class="mini-stat-icon ms-teal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="mini-stat-text"><div class="val">{{ $activeItems }}</div><div class="lbl">Active</div></div>
        </div>
        <div class="mini-stat">
            <div class="mini-stat-icon ms-amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div class="mini-stat-text"><div class="val">{{ $inactiveItems }}</div><div class="lbl">Inactive</div></div>
        </div>
        <div class="mini-stat">
            <div class="mini-stat-icon ms-violet">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
            </div>
            <div class="mini-stat-text"><div class="val">{{ $totalCategories }}</div><div class="lbl">Categories</div></div>
        </div>
    </div>

    <!-- ── Toolbar ── -->
    <div class="toolbar">
        <div class="search-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input" id="menuSearch" placeholder="Search items…" oninput="filterItems()">
        </div>
        <div class="filter-pills" id="filterPills">
            <button class="pill active" onclick="filterByStatus('all', this)">All</button>
            <button class="pill" onclick="filterByStatus('active', this)">Active</button>
            <button class="pill" onclick="filterByStatus('inactive', this)">Inactive</button>
        </div>
    </div>

    <!-- ── Category Pills ── -->
    <div class="category-pills-row">
        <span class="category-pills-label">Categories:</span>
        <button class="cat-pill active" onclick="filterByCategory('all', this)">
            All
            <span class="cat-pill-count">{{ $menuItems->count() }}</span>
        </button>
        @foreach($categories as $cat)
        <button class="cat-pill" onclick="filterByCategory({{ $cat->id }}, this)">
            {{ $cat->name }}
            <span class="cat-pill-count">{{ $cat->menuItems->count() }}</span>
        </button>
        @endforeach
        <button class="cat-pill add-cat-pill" onclick="openCategoryModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New
        </button>
    </div>

    <!-- ── Categories with Items ── -->
    @foreach($categories as $category)
    <div class="category-section" data-category-id="{{ $category->id }}">
        <div class="category-header">
            <div class="category-title">
                <h2>{{ $category->name }}</h2>
                <span class="category-count">{{ $category->menuItems->count() }} item{{ $category->menuItems->count() !== 1 ? 's' : '' }}</span>
            </div>
            @if($category->menuItems->count() === 0)
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="category-delete-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                    Delete Category
                </button>
            </form>
            @endif
        </div>
        <div class="panel">
            @if($category->menuItems->count() > 0)
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th style="width:72px;">Item</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th style="width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->menuItems as $item)
                        <tr class="menu-item-row" data-status="{{ $item->status }}" data-name="{{ strtolower($item->name) }} {{ strtolower($item->description ?? '') }}">
                            <!-- Thumb -->
                            <td>
                                <div class="menu-thumb">
                                    @if($item->image)
                                        <img src="{{ asset('images/menu/'.$item->image) }}" alt="{{ $item->name }}">
                                    @else
                                        <span class="ph">☕</span>
                                    @endif
                                </div>
                            </td>
                            <!-- Name + Desc -->
                            <td>
                                <div class="item-name">{{ $item->name }}</div>
                                <div class="item-desc">{{ Str::limit($item->description, 50) }}</div>
                            </td>
                            <!-- Price -->
                            <td><span class="price-val">${{ number_format($item->price, 2) }}</span></td>
                            <!-- Status toggle -->
                            <td>
                                <form action="{{ route('admin.menu.toggle', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="status-toggle">
                                        <div class="toggle-track {{ $item->status === 'active' ? 'on' : 'off' }}">
                                            <div class="toggle-knob"></div>
                                        </div>
                                        <span class="toggle-label {{ $item->status === 'active' ? 'on' : 'off' }}">{{ ucfirst($item->status) }}</span>
                                    </button>
                                </form>
                            </td>
                            <!-- Actions -->
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('admin.menu.edit', $item->id) }}" class="icon-btn edit" title="Edit">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this item? This can\'t be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn delete" title="Delete">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-category">
                No items in this category yet. <a href="{{ route('admin.menu.create') }}" style="color:var(--brown-medium);text-decoration:underline;">Add one</a>
            </div>
            @endif
        </div>
    </div>
    @endforeach

    @if($categories->count() === 0)
    <div class="panel" style="padding:48px;text-align:center;">
        <p style="color:var(--text-muted);font-size:.95rem;margin-bottom:16px;">No categories yet. Create your first category to get started.</p>
        <button type="button" class="btn btn-primary" onclick="openCategoryModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Create Category
        </button>
    </div>
    @endif

</div><!-- .menu-layout -->
</div><!-- .menu-body -->

<!-- ── New Category Modal ── -->
<div class="modal-overlay" id="categoryModal">
    <div class="modal">
        <h3 class="modal-title">Create New Category</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <input type="text" name="name" class="modal-input" placeholder="Category name (e.g., Hot Drinks, Pastries...)" required autofocus>
            <div class="modal-actions">
                <button type="button" class="btn btn-outline" onclick="closeCategoryModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentStatusFilter = 'all';
    let currentCategoryFilter = 'all';

    function filterItems() {
        const query = document.getElementById('menuSearch').value.toLowerCase();
        
        // Filter individual rows
        document.querySelectorAll('.menu-item-row').forEach(row => {
            const text   = row.dataset.name || '';
            const status = row.dataset.status;
            const matchSearch = text.includes(query);
            const matchStatus = currentStatusFilter === 'all' || status === currentStatusFilter;
            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });

        // Show/hide category sections based on category filter
        document.querySelectorAll('.category-section').forEach(section => {
            const categoryId = section.dataset.categoryId;
            const matchCategory = currentCategoryFilter === 'all' || categoryId == currentCategoryFilter;
            
            if (!matchCategory) {
                section.style.display = 'none';
                return;
            }
            
            const visibleRows = section.querySelectorAll('.menu-item-row:not([style*="display: none"])');
            const hasVisibleItems = visibleRows.length > 0;
            const hasEmptyDiv = section.querySelector('.empty-category');
            
            // If searching/filtering status and no visible items, hide the section
            if ((query || currentStatusFilter !== 'all') && !hasVisibleItems) {
                section.style.display = 'none';
            } else {
                section.style.display = '';
            }
        });
    }

    function filterByStatus(status, btn) {
        currentStatusFilter = status;
        document.querySelectorAll('.filter-pills .pill').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        filterItems();
    }

    function filterByCategory(categoryId, btn) {
        currentCategoryFilter = categoryId;
        document.querySelectorAll('.category-pills-row .cat-pill:not(.add-cat-pill)').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        filterItems();
    }

    function openCategoryModal() {
        document.getElementById('categoryModal').classList.add('active');
        document.querySelector('#categoryModal input[name="name"]').focus();
    }

    function closeCategoryModal() {
        document.getElementById('categoryModal').classList.remove('active');
    }

    // Close modal on outside click
    document.getElementById('categoryModal').addEventListener('click', function(e) {
        if (e.target === this) closeCategoryModal();
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeCategoryModal();
    });

</script>
@endsection