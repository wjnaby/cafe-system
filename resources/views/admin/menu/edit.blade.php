@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');

    :root {
        --brown-dark:#3D2314;--brown-medium:#5C3A21;--cream:#F5F0E8;--cream-light:#FAF8F5;
        --amber:#D4A574;--amber-dark:#B8956A;--text-dark:#2D1810;--text-muted:#6B5B4F;
        --sky-100:#E8E2DA;--teal-400:#2dd4bf;--teal-500:#14b8a6;
        --rose-400:#fb7185;--rose-500:#f43f5e;
        --slate-50:#FAF8F5;--slate-100:#F5F0E8;--slate-200:#E8E2DA;--slate-300:#d4c4b4;
        --slate-400:#6B5B4F;--slate-500:#6B5B4F;--slate-600:#5C3A21;--slate-700:#3D2314;--slate-800:#2D1810;
        --text-primary:#2D1810;
        --card-bg:rgba(255,255,255,0.85);--card-border:rgba(232,226,218,0.8);
        --card-shadow:0 4px 20px rgba(0,0,0,0.05);--radius:18px;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

    /* ── Page Shell ── */
    .edit-body {
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
    .edit-layout { max-width:680px; margin:0 auto; }

    /* ── Header ── */
    .edit-header {
        margin-bottom:28px;
    }
    .back-link {
        display:inline-flex;
        align-items:center;
        gap:6px;
        color:var(--slate-500);
        font-size:.85rem;
        font-weight:500;
        text-decoration:none;
        margin-bottom:12px;
        transition:color .2s;
    }
    .back-link:hover { color:var(--brown-medium); }
    .back-link svg { width:16px; height:16px; }
    .edit-header h1 {
        font-family:'Playfair Display',serif;
        font-size:1.75rem;
        font-weight:700;
        color:var(--text-dark);
        letter-spacing:-.03em;
    }
    .edit-header p { color:var(--text-muted); font-size:.9rem; margin-top:4px; }

    /* ── Panel (glass card) ── */
    .panel {
        background:var(--card-bg);backdrop-filter:blur(14px);
        border:1px solid var(--card-border);border-radius:var(--radius);
        box-shadow:var(--card-shadow);
        padding:32px;
        animation:fadeUp .45s ease both;
    }
    @keyframes fadeUp { from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);} }

    /* ── Form ── */
    .form-grid {
        display:grid;
        gap:24px;
    }
    .form-row {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:20px;
    }
    .form-group { display:flex; flex-direction:column; }
    .form-group.full { grid-column:1 / -1; }
    
    .form-label {
        font-size:.82rem;
        font-weight:600;
        color:var(--slate-700);
        margin-bottom:8px;
        display:flex;
        align-items:center;
        gap:4px;
    }
    .form-label .required { color:var(--rose-500); }

    .form-input,
    .form-select,
    .form-textarea {
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
    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline:none;
        border-color:var(--amber);
        box-shadow:0 0 0 3px rgba(212,165,116,.2);
    }
    .form-input::placeholder,
    .form-textarea::placeholder { color:var(--slate-400); }
    
    .form-textarea { resize:vertical; min-height:100px; }
    
    .form-select {
        cursor:pointer;
        appearance:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat:no-repeat;
        background-position:right 12px center;
        background-size:18px;
        padding-right:40px;
    }

    .form-hint {
        font-size:.78rem;
        color:var(--text-muted);
        margin-top:6px;
    }
    .form-error {
        font-size:.78rem;
        color:var(--rose-500);
        margin-top:6px;
    }

    /* ── Current Image Preview ── */
    .current-image-wrap {
        display:flex;
        align-items:flex-start;
        gap:16px;
    }
    .current-image {
        width:100px;
        height:100px;
        border-radius:14px;
        object-fit:cover;
        border:2px solid var(--slate-100);
        flex-shrink:0;
    }
    .current-image-placeholder {
        width:100px;
        height:100px;
        border-radius:14px;
        background:linear-gradient(135deg,#FDF8F3,var(--cream));
        border:2px solid var(--cream);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:2.5rem;
        flex-shrink:0;
    }
    .image-info {
        flex:1;
    }
    .image-info .label {
        font-size:.82rem;
        font-weight:600;
        color:var(--slate-700);
        margin-bottom:8px;
    }

    /* ── File Input ── */
    .file-input-wrap {
        position:relative;
    }
    .file-input {
        width:100%;
        padding:12px 16px;
        border:1.5px dashed var(--slate-300);
        border-radius:12px;
        font-size:.85rem;
        color:var(--slate-600);
        font-family:inherit;
        background:var(--slate-50);
        cursor:pointer;
        transition:border-color .2s,background .2s;
    }
    .file-input:hover {
        border-color:var(--amber);
        background:#F5EDE4;
    }
    .file-input:focus {
        outline:none;
        border-color:var(--amber-dark);
    }
    .file-input::file-selector-button {
        padding:6px 14px;
        margin-right:12px;
        border:none;
        border-radius:8px;
        background:var(--amber);
        color:var(--brown-dark);
        font-size:.8rem;
        font-weight:600;
        cursor:pointer;
        transition:background .2s;
    }
    .file-input::file-selector-button:hover {
        background:var(--amber-dark);
    }

    /* ── Status Toggle Style ── */
    .status-options {
        display:flex;
        gap:12px;
    }
    .status-option {
        flex:1;
        position:relative;
    }
    .status-option input {
        position:absolute;
        opacity:0;
        width:100%;
        height:100%;
        cursor:pointer;
    }
    .status-option-label {
        display:flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        padding:12px 16px;
        border:1.5px solid var(--slate-200);
        border-radius:12px;
        font-size:.88rem;
        font-weight:600;
        color:var(--slate-500);
        background:#fff;
        cursor:pointer;
        transition:all .2s;
    }
    .status-option input:checked + .status-option-label.active-label {
        border-color:var(--teal-400);
        background:rgba(45,212,191,.1);
        color:var(--teal-500);
    }
    .status-option input:checked + .status-option-label.inactive-label {
        border-color:var(--slate-400);
        background:var(--slate-100);
        color:var(--slate-600);
    }
    .status-option-label svg { width:18px; height:18px; }

    /* ── Buttons ── */
    .form-actions {
        display:flex;
        justify-content:flex-end;
        gap:12px;
        margin-top:8px;
        padding-top:24px;
        border-top:1px solid var(--slate-100);
    }
    .btn {
        display:inline-flex;align-items:center;gap:7px;
        padding:11px 22px;border-radius:12px;
        font-size:.88rem;font-weight:600;cursor:pointer;
        border:none;transition:all .2s;text-decoration:none;
        font-family:inherit;
    }
    .btn-outline {
        background:#fff;border:1.5px solid var(--slate-200);
        color:var(--slate-600);
    }
    .btn-outline:hover { border-color:var(--slate-300);background:var(--slate-50); }
    .btn-primary {
        background:linear-gradient(135deg,var(--amber),var(--amber-dark));
        color:var(--brown-dark);box-shadow:0 3px 12px rgba(92,58,33,.2);
    }
    .btn-primary:hover { box-shadow:0 5px 18px rgba(92,58,33,.28); transform:translateY(-1px); }
    .btn svg { width:16px; height:16px; }

    /* ── Alert Messages ── */
    .alert {
        padding:14px 20px;
        border-radius:12px;
        margin-bottom:20px;
        font-size:.88rem;
        font-weight:500;
    }
    .alert-error {
        background:#fef2f2;
        border:1px solid #fecaca;
        color:#b91c1c;
    }

    /* ── Responsive ── */
    @media(max-width:640px){
        .edit-body{padding:24px 16px 48px;}
        .panel{padding:24px 20px;}
        .form-row{grid-template-columns:1fr;}
        .current-image-wrap{flex-direction:column;}
    }
</style>
@endsection

@section('content')
<div class="edit-body">
<div class="edit-layout">

    <!-- ── Header ── -->
    <div class="edit-header">
        <a href="{{ route('admin.menu.index') }}" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Back to Menu
        </a>
        <h1>Edit Menu Item</h1>
        <p>Update details for "{{ $menuItem->name }}"</p>
    </div>

    <!-- ── Form Panel ── -->
    <div class="panel">
        <form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                
                <!-- Name -->
                <div class="form-group full">
                    <label class="form-label">Item Name <span class="required">*</span></label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $menuItem->name) }}" placeholder="e.g., Caramel Latte" required>
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group full">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea" placeholder="Describe this item...">{{ old('description', $menuItem->description) }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Price & Category Row -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Price ($) <span class="required">*</span></label>
                        <input type="number" name="price" class="form-input" step="0.01" min="0" value="{{ old('price', $menuItem->price) }}" placeholder="0.00" required>
                        @error('price')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category <span class="required">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $menuItem->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group full">
                    <label class="form-label">Status <span class="required">*</span></label>
                    <div class="status-options">
                        <label class="status-option">
                            <input type="radio" name="status" value="active" {{ old('status', $menuItem->status) === 'active' ? 'checked' : '' }} required>
                            <span class="status-option-label active-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Active
                            </span>
                        </label>
                        <label class="status-option">
                            <input type="radio" name="status" value="inactive" {{ old('status', $menuItem->status) === 'inactive' ? 'checked' : '' }}>
                            <span class="status-option-label inactive-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                Inactive
                            </span>
                        </label>
                    </div>
                    @error('status')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Current Image & Upload -->
                <div class="form-group full">
                    <div class="current-image-wrap">
                        @if($menuItem->image)
                            <img src="{{ asset('images/menu/'.$menuItem->image) }}" alt="{{ $menuItem->name }}" class="current-image">
                        @else
                            <div class="current-image-placeholder">☕</div>
                        @endif
                        <div class="image-info">
                            <div class="label">{{ $menuItem->image ? 'Change Image' : 'Add Image' }}</div>
                            <input type="file" name="image" class="file-input" accept="image/*">
                            <p class="form-hint">{{ $menuItem->image ? 'Leave empty to keep current image' : 'Upload a JPG, PNG image (max 2MB)' }}</p>
                            @error('image')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Update Item
                    </button>
                </div>

            </div>
        </form>
    </div>

</div>
</div>
@endsection
