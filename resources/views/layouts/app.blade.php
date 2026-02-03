<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Cafe System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --brown-dark: #3D2314;
            --brown-medium: #5C3A21;
            --brown-light: #8B6914;
            --cream: #FAF7F2;
            --cream-dark: #F5EFE6;
            --amber: #D4A574;
            --amber-dark: #B8956A;
            --text-dark: #2D1810;
            --text-muted: #6B5B4F;
        }
        
        .nav-bar {
            font-family: 'Poppins', sans-serif;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--brown-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-logo span {
            color: var(--amber-dark);
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-link {
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .nav-link:hover {
            color: var(--brown-dark);
            background: var(--cream-dark);
        }
        .nav-link.active {
            color: var(--brown-dark);
            background: var(--cream);
        }
        .nav-link svg {
            width: 16px;
            height: 16px;
        }
        .nav-link .badge {
            background: var(--amber);
            color: var(--brown-dark);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 50px;
            margin-left: 4px;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 6px;
            border-radius: 50px;
            background: var(--cream);
            border: 2px solid var(--cream-dark);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .nav-user:hover {
            border-color: var(--amber);
            background: var(--cream-dark);
        }
        .nav-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--amber), var(--amber-dark));
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .nav-avatar span {
            font-family: 'Playfair Display', serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--brown-dark);
        }
        .nav-user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--brown-dark);
        }
        .nav-user-role {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: capitalize;
        }
        .nav-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }
        .nav-btn-outline {
            background: transparent;
            color: var(--brown-dark);
            border: 2px solid var(--brown-dark);
        }
        .nav-btn-outline:hover {
            background: var(--brown-dark);
            color: #fff;
        }
        .nav-btn-primary {
            background: var(--brown-dark);
            color: #fff;
            box-shadow: 0 4px 15px rgba(61, 35, 20, 0.3);
        }
        .nav-btn-primary:hover {
            background: var(--brown-medium);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(61, 35, 20, 0.4);
        }
        .nav-logout {
            background: transparent;
            border: 2px solid var(--cream-dark);
            color: var(--text-muted);
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .nav-logout:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }
        .nav-divider {
            width: 1px;
            height: 32px;
            background: var(--cream-dark);
            margin: 0 8px;
        }
        
        /* Mobile Menu */
        .nav-mobile-toggle {
            display: none;
            background: none;
            border: none;
            padding: 8px;
            cursor: pointer;
            color: var(--brown-dark);
        }
        .nav-mobile-toggle svg {
            width: 28px;
            height: 28px;
        }
        
        /* Body padding for fixed navbar */
        body {
            padding-top: 70px;
            background: var(--cream);
        }
        
        @media (max-width: 900px) {
            .nav-links, .nav-divider { display: none; }
            .nav-mobile-toggle { display: block; }
        }
        
        @media (max-width: 480px) {
            .nav-btn {
                padding: 8px 16px;
                font-size: 0.8rem;
            }
            .nav-user-name, .nav-user-role {
                display: none;
            }
            .nav-user {
                padding: 4px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    
    <!-- Navigation Bar -->
    <nav class="nav-bar">
        <div class="nav-container">
            <!-- Logo -->
            <a href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin.dashboard') : route('welcome') }}" class="nav-logo">
                🥐 <span>Cafe System</span>
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
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            Settings
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
            
            <!-- Mobile Toggle -->
            <button class="nav-mobile-toggle">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
