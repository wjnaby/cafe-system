@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');

    :root {
        --brown-dark: #3D2314;
        --brown-medium: #5C3A21;
        --cream: #F5F0E8;
        --amber: #D4A574;
        --amber-dark: #B8956A;
        --text-dark: #2D1810;
        --text-muted: #6B5B4F;
        --slate-200: #E8E2DA;
        --slate-400: #6B5B4F;
        --slate-700: #3D2314;
        --rose-500: #f43f5e;
        --card-bg: rgba(255,255,255,0.85);
        --card-border: rgba(232,226,218,0.8);
        --card-shadow: 0 4px 20px rgba(0,0,0,0.05);
        --radius: 18px;
    }

    .auth-body {
        font-family: 'Poppins', system-ui, sans-serif;
        min-height: calc(100vh - 70px);
        background:
            radial-gradient(ellipse 80% 60% at 15% 20%, rgba(245,240,232,0.8) 0%, transparent 70%),
            radial-gradient(ellipse 60% 50% at 80% 70%, rgba(250,248,245,0.6) 0%, transparent 65%),
            radial-gradient(ellipse 40% 40% at 55% 10%, rgba(212,165,116,0.15) 0%, transparent 60%),
            linear-gradient(160deg, #FAF8F5 0%, #F5F0E8 40%, #FAF8F5 100%);
        color: var(--text-dark);
        padding: 48px 24px 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-layout {
        max-width: 420px;
        width: 100%;
        margin: 0 auto;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .auth-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--text-dark);
        letter-spacing: -0.03em;
    }

    .auth-header p {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-top: 6px;
    }

    .panel {
        background: var(--card-bg);
        backdrop-filter: blur(14px);
        border: 1px solid var(--card-border);
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        padding: 32px;
        animation: fadeUp 0.4s ease both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-grid { display: flex; flex-direction: column; gap: 22px; }
    .form-group { display: flex; flex-direction: column; }
    .form-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--slate-700);
        margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid var(--slate-200);
        border-radius: 12px;
        font-size: 0.9rem;
        color: var(--slate-700);
        font-family: inherit;
        background: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input:focus {
        outline: none;
        border-color: var(--amber);
        box-shadow: 0 0 0 3px rgba(212,165,116,0.2);
    }
    .form-input::placeholder { color: var(--slate-400); }
    .form-error { font-size: 0.78rem; color: var(--rose-500); margin-top: 6px; }

    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-top: 8px;
    }

    .form-actions-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .auth-link {
        font-size: 0.88rem;
        color: var(--amber-dark);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .auth-link:hover { color: var(--brown-medium); }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
        font-family: inherit;
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--amber), var(--amber-dark));
        color: var(--brown-dark);
        box-shadow: 0 3px 12px rgba(92,58,33,0.2);
    }
    .btn-primary:hover {
        box-shadow: 0 5px 18px rgba(92,58,33,0.28);
        transform: translateY(-1px);
    }
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--text-muted);
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        margin-bottom: 20px;
        transition: color 0.2s;
    }
    .back-link:hover { color: var(--brown-medium); }
    .back-link svg { width: 16px; height: 16px; }
    @media (max-width: 480px) {
        .auth-body { padding: 32px 16px 48px; }
        .panel { padding: 24px 20px; }
        .form-actions-row { flex-direction: column; align-items: stretch; }
    }
</style>
@endsection

@section('content')
<div class="auth-body">
    <div class="auth-layout">

        <a href="{{ route('welcome') }}" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Back to home
        </a>

        <div class="auth-header">
            <h1>Create account</h1>
            <p>Register to place orders and manage your profile</p>
        </div>

        <div class="panel">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Your name" required autofocus autocomplete="name">
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="username">
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" class="form-input" placeholder="••••••••" required autocomplete="new-password">
                        @error('password')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required autocomplete="new-password">
                        @error('password_confirmation')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <div class="form-actions-row">
                            <a href="{{ route('login') }}" class="auth-link">
                                {{ __('Already registered?') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
