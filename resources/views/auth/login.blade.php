@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');

    :root {
        --brown-dark: #3D2314;
        --brown-medium: #5C3A21;
        --cream: #F5F0E8;
        --cream-light: #FAF8F5;
        --cream-dark: #E8E2DA;
        --amber: #D4A574;
        --amber-dark: #B8956A;
        --text-dark: #2D1810;
        --text-muted: #6B5B4F;
        --slate-50: #FAF8F5;
        --slate-200: #E8E2DA;
        --slate-300: #d4c4b4;
        --slate-400: #6B5B4F;
        --slate-600: #5C3A21;
        --slate-700: #3D2314;
        --rose-500: #f43f5e;
        --card-bg: rgba(255,255,255,0.92);
        --card-border: rgba(232,226,218,0.8);
        --card-shadow: 0 8px 32px rgba(61,35,20,0.08), 0 2px 8px rgba(0,0,0,0.04);
        --radius: 20px;
        --input-radius: 12px;
    }

    .login-body {
        font-family: 'Poppins', system-ui, sans-serif;
        min-height: calc(100vh - 70px);
        background:
            radial-gradient(ellipse 80% 60% at 15% 20%, rgba(245,240,232,0.9) 0%, transparent 70%),
            radial-gradient(ellipse 60% 50% at 85% 80%, rgba(250,248,245,0.7) 0%, transparent 65%),
            radial-gradient(ellipse 50% 40% at 50% 50%, rgba(212,165,116,0.08) 0%, transparent 60%),
            linear-gradient(165deg, #FAF8F5 0%, #F5F0E8 50%, #FAF8F5 100%);
        color: var(--text-dark);
        padding: 48px 24px 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-layout {
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
    }

    .panel {
        background: var(--card-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--card-border);
        border-radius: var(--radius);
        box-shadow: var(--card-shadow);
        padding: 40px 36px 32px;
        animation: fadeUp 0.4s ease both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Header inside card: icon + title + subtitle */
    .login-card-icon {
        width: 44px;
        height: 44px;
        margin: 0 auto 20px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--amber), var(--amber-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brown-dark);
    }
    .login-card-icon svg {
        width: 22px;
        height: 22px;
    }
    .login-card-header {
        text-align: center;
        margin-bottom: 28px;
    }
    .login-card-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        letter-spacing: -0.02em;
        margin: 0;
    }
    .login-card-header p {
        color: var(--text-muted);
        font-size: 0.875rem;
        margin: 8px 0 0;
        line-height: 1.45;
    }

    /* Input with left icon */
    .form-grid { display: flex; flex-direction: column; gap: 16px; }
    .form-group { display: flex; flex-direction: column; }
    .input-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 16px;
        height: 50px;
        border: 1.5px solid var(--slate-200);
        border-radius: var(--input-radius);
        background: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-wrap:focus-within {
        border-color: var(--amber);
        box-shadow: 0 0 0 3px rgba(212,165,116,0.2);
    }
    .input-wrap .input-icon {
        color: var(--slate-400);
        flex-shrink: 0;
    }
    .input-wrap .input-icon svg { width: 20px; height: 20px; }
    .input-wrap .input-icon-right {
        margin-left: auto;
        padding: 4px;
        cursor: pointer;
        color: var(--slate-400);
        background: none;
        border: none;
        border-radius: 6px;
        transition: color 0.2s;
    }
    .input-wrap .input-icon-right:hover { color: var(--slate-700); }
    .input-wrap .input-icon-right svg { width: 20px; height: 20px; }
    .input-wrap .form-input {
        flex: 1;
        min-width: 0;
        border: none;
        background: none;
        padding: 0;
        font-size: 0.9rem;
        color: var(--slate-700);
        font-family: inherit;
    }
    .input-wrap .form-input::placeholder { color: var(--slate-400); }
    .input-wrap .form-input:focus { outline: none; }
    .form-error { font-size: 0.78rem; color: var(--rose-500); margin-top: 6px; }

    /* Forgot password row */
    .forgot-row {
        display: flex;
        justify-content: flex-end;
        margin-top: -4px;
    }
    .forgot-link {
        font-size: 0.85rem;
        color: var(--amber-dark);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .forgot-link:hover { color: var(--brown-medium); }

    /* Primary button: full width, dark */
    .form-actions { margin-top: 24px; }
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px 24px;
        border-radius: var(--input-radius);
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
        font-family: inherit;
    }
    .btn-primary {
        background: var(--brown-dark);
        color: #fff;
        box-shadow: 0 4px 14px rgba(61,35,20,0.25);
    }
    .btn-primary:hover {
        background: var(--brown-medium);
        box-shadow: 0 6px 20px rgba(61,35,20,0.3);
        transform: translateY(-1px);
    }

    /* Divider + secondary CTA */
    .login-divider {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 24px 0 20px;
    }
    .login-divider::before,
    .login-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--slate-200);
    }
    .login-divider span {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 500;
    }
    .btn-outline {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 12px 24px;
        border-radius: var(--input-radius);
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        border: 1.5px solid var(--slate-200);
        background: #fff;
        color: var(--slate-700);
        text-decoration: none;
        font-family: inherit;
        transition: all 0.2s;
    }
    .btn-outline:hover {
        border-color: var(--amber);
        background: var(--cream-light);
        color: var(--brown-dark);
    }

    .alert-success {
        background: rgba(212,165,116,0.2);
        border: 1px solid rgba(184,149,106,0.4);
        color: var(--brown-medium);
        padding: 12px 16px;
        border-radius: var(--input-radius);
        font-size: 0.88rem;
        margin-bottom: 20px;
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

    .hidden { display: none !important; }

    @media (max-width: 480px) {
        .login-body { padding: 32px 16px 48px; }
        .panel { padding: 28px 24px 24px; }
    }
</style>
@endsection

@section('content')
<div class="login-body">
    <div class="login-layout">

        <a href="{{ route('welcome') }}" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Back to home
        </a>

        <div class="panel">
            <div class="login-card-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div class="login-card-header">
                <h1>Sign in with email</h1>
                <p>Sign in to order from the menu, track your orders, and manage your account.</p>
            </div>

            @if (session('status'))
                <div class="alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <div class="input-wrap">
                            <span class="input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </span>
                            <input id="email" type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="Email" required autofocus autocomplete="username">
                        </div>
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-wrap">
                            <span class="input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input id="password" type="password" name="password" class="form-input" placeholder="Password" required autocomplete="current-password">
                            <button type="button" class="input-icon-right" id="toggle-password" title="Show password" aria-label="Show password">
                                <svg id="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="icon-eye-off" class="hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        @if (Route::has('password.request'))
                            <div class="forgot-row">
                                <a class="forgot-link" href="{{ route('password.request') }}">Forgot password?</a>
                            </div>
                        @endif
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </div>
            </form>

            <div class="login-divider">
                <span>Or create an account</span>
            </div>
            <a href="{{ route('register') }}" class="btn-outline">Create your free account</a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
(function() {
    var toggle = document.getElementById('toggle-password');
    var passwordInput = document.getElementById('password');
    var iconEye = document.getElementById('icon-eye');
    var iconEyeOff = document.getElementById('icon-eye-off');
    if (!toggle || !passwordInput) return;
    toggle.addEventListener('click', function() {
        var isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        iconEye.classList.toggle('hidden', isPassword);
        iconEyeOff.classList.toggle('hidden', !isPassword);
        toggle.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
        toggle.setAttribute('title', isPassword ? 'Hide password' : 'Show password');
    });
})();
</script>
@endsection
