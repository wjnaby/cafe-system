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
    .profile-body {
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
    .profile-layout { max-width:700px; margin:0 auto; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);} }

    /* ── Profile Header ── */
    .profile-header {
        text-align:center;
        margin-bottom:32px;
        animation:fadeUp .4s ease both;
    }
    .profile-avatar {
        width:100px;
        height:100px;
        border-radius:24px;
        background:linear-gradient(135deg,var(--blue-100),var(--violet-100));
        border:3px solid #fff;
        box-shadow:0 8px 24px rgba(37,99,235,.15);
        display:flex;
        align-items:center;
        justify-content:center;
        margin:0 auto 16px;
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
    .profile-header h1 {
        font-family:'Syne',sans-serif;
        font-size:1.75rem;
        font-weight:700;
        color:var(--slate-800);
        margin-bottom:4px;
    }
    .profile-header .role-badge {
        display:inline-flex;
        align-items:center;
        gap:6px;
        padding:6px 14px;
        border-radius:20px;
        font-size:.8rem;
        font-weight:600;
        text-transform:capitalize;
    }
    .profile-header .role-badge.admin {
        background:linear-gradient(135deg,var(--violet-400),var(--violet-500));
        color:#fff;
    }
    .profile-header .role-badge.customer {
        background:var(--blue-50);
        color:var(--blue-600);
        border:1px solid var(--blue-100);
    }
    .profile-header .role-badge svg { width:14px; height:14px; }

    /* ── Panel ── */
    .panel {
        background:var(--card-bg);backdrop-filter:blur(14px);
        border:1px solid var(--card-border);border-radius:var(--radius);
        box-shadow:var(--card-shadow);
        padding:28px;
        margin-bottom:20px;
        animation:fadeUp .4s ease both;
    }
    .panel:nth-child(2){animation-delay:.08s;}
    .panel:nth-child(3){animation-delay:.16s;}
    .panel:nth-child(4){animation-delay:.24s;}

    .panel-title {
        font-family:'Syne',sans-serif;
        font-size:1.1rem;
        font-weight:700;
        color:var(--slate-800);
        margin-bottom:6px;
        display:flex;
        align-items:center;
        gap:10px;
    }
    .panel-title svg { width:20px; height:20px; color:var(--blue-500); }
    .panel-desc {
        font-size:.88rem;
        color:var(--text-muted);
        margin-bottom:20px;
    }

    /* ── Form ── */
    .form-group {
        margin-bottom:20px;
    }
    .form-label {
        display:block;
        font-size:.82rem;
        font-weight:600;
        color:var(--slate-700);
        margin-bottom:8px;
    }
    .form-input {
        width:100%;
        padding:12px 16px;
        border:1.5px solid var(--slate-200);
        border-radius:12px;
        font-size:.9rem;
        color:var(--slate-700);
        font-family:inherit;
        background:#fff;
        transition:border-color .2s,box-shadow .2s;
    }
    .form-input:focus {
        outline:none;
        border-color:var(--blue-300);
        box-shadow:0 0 0 3px rgba(59,130,246,.12);
    }
    .form-input::placeholder { color:var(--slate-400); }
    .form-error {
        font-size:.78rem;
        color:var(--rose-500);
        margin-top:6px;
    }

    .btn {
        display:inline-flex;align-items:center;gap:7px;
        padding:11px 22px;border-radius:12px;
        font-size:.88rem;font-weight:600;cursor:pointer;
        border:none;transition:all .2s;text-decoration:none;
        font-family:inherit;
    }
    .btn-primary {
        background:linear-gradient(135deg,var(--blue-500),var(--blue-600));
        color:#fff;box-shadow:0 3px 12px rgba(37,99,235,.28);
    }
    .btn-primary:hover { box-shadow:0 5px 18px rgba(37,99,235,.38); transform:translateY(-1px); }
    .btn svg { width:16px; height:16px; }

    .saved-msg {
        display:inline-flex;
        align-items:center;
        gap:6px;
        font-size:.85rem;
        color:var(--teal-500);
        margin-left:12px;
    }
    .saved-msg svg { width:16px; height:16px; }

    /* ── Danger Zone ── */
    .danger-zone {
        border-color:rgba(244,63,94,.2);
    }
    .danger-zone .panel-title { color:var(--rose-500); }
    .danger-zone .panel-title svg { color:var(--rose-500); }
    .btn-danger {
        background:#fef2f2;
        border:1.5px solid #fecaca;
        color:var(--rose-500);
    }
    .btn-danger:hover {
        background:#fee2e2;
        color:#b91c1c;
    }

    /* ── Account Info ── */
    .info-grid {
        display:grid;
        grid-template-columns:repeat(2, 1fr);
        gap:16px;
    }
    .info-item {
        background:var(--slate-50);
        border-radius:12px;
        padding:14px 18px;
    }
    .info-item .label {
        font-size:.75rem;
        font-weight:600;
        color:var(--text-muted);
        text-transform:uppercase;
        letter-spacing:.04em;
        margin-bottom:4px;
    }
    .info-item .value {
        font-size:.95rem;
        font-weight:600;
        color:var(--slate-700);
    }

    /* ── Responsive ── */
    @media(max-width:640px){
        .profile-body{padding:24px 16px 48px;}
        .panel{padding:20px;}
        .info-grid{grid-template-columns:1fr;}
    }
</style>
@endsection

@section('content')
<div class="profile-body">
<div class="profile-layout">

    <!-- ── Profile Header ── -->
    <div class="profile-header">
        <div class="profile-avatar">
            <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
        </div>
        <h1>{{ $user->name }}</h1>
        <span class="role-badge {{ $user->role }}">
            @if($user->role === 'admin')
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            @else
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            @endif
            {{ $user->role }}
        </span>
    </div>

    <!-- ── Account Info ── -->
    <div class="panel">
        <div class="panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            Account Information
        </div>
        <div class="panel-desc">Your account details and membership info</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="label">Email</div>
                <div class="value">{{ $user->email }}</div>
            </div>
            <div class="info-item">
                <div class="label">Member Since</div>
                <div class="value">{{ $user->created_at->format('M d, Y') }}</div>
            </div>
            @if($user->role === 'customer')
            <div class="info-item">
                <div class="label">Total Orders</div>
                <div class="value">{{ $user->orders()->count() }}</div>
            </div>
            <div class="info-item">
                <div class="label">Total Spent</div>
                <div class="value">${{ number_format($user->orders()->sum('total_price'), 2) }}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- ── Update Profile ── -->
    <div class="panel">
        <div class="panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Profile Information
        </div>
        <div class="panel-desc">Update your name and email address</div>
        
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="display:flex;align-items:center;">
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Save Changes
                </button>
                @if (session('status') === 'profile-updated')
                    <span class="saved-msg">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Saved!
                    </span>
                @endif
            </div>
        </form>
    </div>

    <!-- ── Update Password ── -->
    <div class="panel">
        <div class="panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Update Password
        </div>
        <div class="panel-desc">Ensure your account is using a strong password</div>
        
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            
            <div class="form-group">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-input" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-input" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-input" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="display:flex;align-items:center;">
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Update Password
                </button>
                @if (session('status') === 'password-updated')
                    <span class="saved-msg">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Updated!
                    </span>
                @endif
            </div>
        </form>
    </div>

    <!-- ── Delete Account ── -->
    <div class="panel danger-zone">
        <div class="panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            Delete Account
        </div>
        <div class="panel-desc">Once your account is deleted, all of its resources and data will be permanently deleted.</div>
        
        <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
            @csrf
            @method('delete')
            
            <div class="form-group">
                <label class="form-label">Enter your password to confirm</label>
                <input type="password" name="password" class="form-input" placeholder="Your password" required>
                @error('password', 'userDeletion')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-danger">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                Delete Account
            </button>
        </form>
    </div>

</div>
</div>
@endsection
