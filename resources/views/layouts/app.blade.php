<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Cafe System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Syne:wght@600;700&display=swap');
        
        .nav-bar {
            font-family: 'DM Sans', sans-serif;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(148,163,184,0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 52px;
        }
        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e293b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .nav-logo span {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .nav-link {
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .nav-link:hover {
            color: #3b82f6;
            background: rgba(59,130,246,0.08);
        }
        .nav-link.active {
            color: #3b82f6;
            background: rgba(59,130,246,0.1);
        }
        .nav-link svg {
            width: 15px;
            height: 15px;
        }
        .nav-link .badge {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 1px 6px;
            border-radius: 8px;
            margin-left: 2px;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-user {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 10px 4px 4px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.2s;
        }
        .nav-user:hover {
            border-color: #93c5fd;
            background: #eef4ff;
        }
        .nav-avatar {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: linear-gradient(135deg, #dbeafe, #ede9fe);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .nav-avatar span {
            font-family: 'Syne', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-user-name {
            font-size: 0.78rem;
            font-weight: 600;
            color: #334155;
        }
        .nav-user-role {
            font-size: 0.65rem;
            color: #94a3b8;
            text-transform: capitalize;
        }
        .nav-btn {
            padding: 7px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .nav-btn-outline {
            color: #64748b;
            border: 1.5px solid #e2e8f0;
            background: #fff;
        }
        .nav-btn-outline:hover {
            border-color: #93c5fd;
            color: #3b82f6;
        }
        .nav-btn-primary {
            color: #fff;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 2px 8px rgba(37,99,235,0.25);
        }
        .nav-btn-primary:hover {
            box-shadow: 0 4px 12px rgba(37,99,235,0.35);
            transform: translateY(-1px);
        }
        .nav-logout {
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            padding: 5px 8px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-logout:hover {
            color: #ef4444;
            background: rgba(239,68,68,0.08);
        }
        .nav-divider {
            width: 1px;
            height: 28px;
            background: #e2e8f0;
            margin: 0 8px;
        }
        
        /* Mobile Menu */
        .nav-mobile-toggle {
            display: none;
            background: none;
            border: none;
            padding: 8px;
            cursor: pointer;
            color: #64748b;
        }
        .nav-mobile-toggle svg {
            width: 24px;
            height: 24px;
        }
        
        @media (max-width: 900px) {
            .nav-links, .nav-divider { display: none; }
            .nav-mobile-toggle { display: block; }
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-50">
    
    <!-- Navigation Bar -->
    <nav class="nav-bar">
        <div class="nav-container">
            <!-- Logo -->
            <a href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin.dashboard') : route('menu.index') }}" class="nav-logo">
                ☕ <span>Cafe System</span>
            </a>
            
            <!-- Navigation Links -->
            <div class="nav-links">
                @auth
                    @if(Auth::user()->role === 'admin')
                        {{-- Admin Navigation --}}
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.menu.index') }}" class="nav-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Menu
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            Orders
                        </a>
                        <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Customers
                        </a>
                    @else
                        {{-- Customer Navigation --}}
                        <a href="{{ route('menu.index') }}" class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Menu
                        </a>
                        <a href="{{ route('cart.index') }}" class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            Cart
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="badge">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                        <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            My Orders
                        </a>
                    @endif
                @else
                    {{-- Guest Navigation --}}
                    <a href="{{ route('menu.index') }}" class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Menu
                    </a>
                @endauth
            </div>

            <!-- Right Side -->
            <div class="nav-right">
                @guest
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-outline">Login</a>
                    <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">Register</a>
                @else
                    <a href="{{ route('profile.edit') }}" class="nav-user">
                        <div class="nav-avatar">
                            <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <div class="nav-user-name">{{ Auth::user()->name }}</div>
                            <div class="nav-user-role">{{ Auth::user()->role }}</div>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="nav-logout">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
