@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');
    
    :root {
        --brown-dark: #3D2314;
        --brown-medium: #5C3A21;
        --cream: #F5F0E8;
        --cream-light: #FAF8F5;
        --amber: #D4A574;
        --amber-dark: #B8956A;
        --text-dark: #2D1810;
        --text-muted: #6B5B4F;
    }
    
    .settings-page {
        font-family: 'Poppins', sans-serif;
        background: var(--cream-light);
        min-height: 100vh;
        padding: 40px 24px;
    }
    
    .settings-container {
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .page-header {
        margin-bottom: 40px;
    }
    
    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .page-title::before {
        content: '';
        width: 4px;
        height: 32px;
        background: var(--amber);
        border-radius: 4px;
    }
    
    .page-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-top: 8px;
        margin-left: 16px;
    }
    
    .settings-form {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }
    
    .settings-section {
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--cream);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-title svg {
        width: 24px;
        height: 24px;
        color: var(--amber);
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .form-group.full-width {
        grid-column: span 2;
    }
    
    .form-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .form-input,
    .form-textarea {
        padding: 14px 18px;
        border: 2px solid #E8E2DA;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: var(--cream-light);
    }
    
    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--amber);
        background: #fff;
    }
    
    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .image-upload-wrapper {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }
    
    .image-preview {
        width: 150px;
        height: 120px;
        border-radius: 12px;
        overflow: hidden;
        background: var(--cream);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px dashed #E8E2DA;
    }
    
    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .image-preview-placeholder {
        font-size: 48px;
        opacity: 0.5;
    }
    
    .image-upload-controls {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .file-input-wrapper {
        position: relative;
    }
    
    .file-input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #E8E2DA;
        border-radius: 12px;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
        background: var(--cream-light);
        cursor: pointer;
    }
    
    .file-input::file-selector-button {
        background: var(--amber);
        color: var(--brown-dark);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 12px;
        transition: all 0.3s ease;
    }
    
    .file-input::file-selector-button:hover {
        background: var(--amber-dark);
    }
    
    .image-hint {
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    
    .delete-image-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: fit-content;
    }
    
    .delete-image-btn:hover {
        background: #fecaca;
    }
    
    /* Section Toggle Styles */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--cream);
    }
    
    .section-header .section-title {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .toggle-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .toggle-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-muted);
    }
    
    .toggle-switch {
        position: relative;
        width: 52px;
        height: 28px;
    }
    
    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.3s;
        border-radius: 28px;
    }
    
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .toggle-switch input:checked + .toggle-slider {
        background-color: #22c55e;
    }
    
    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(24px);
    }
    
    .section-disabled {
        opacity: 0.5;
        pointer-events: none;
    }
    
    .section-content {
        transition: opacity 0.3s ease;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-badge.enabled {
        background: #dcfce7;
        color: #16a34a;
    }
    
    .status-badge.disabled {
        background: #fee2e2;
        color: #dc2626;
    }
    
    .subsection-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-top: 32px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .subsection-title svg {
        width: 20px;
        height: 20px;
        color: var(--amber);
    }
    
    .feature-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    .feature-card {
        background: var(--cream-light);
        border-radius: 16px;
        padding: 24px;
    }
    
    .feature-card-title {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .feature-card-title span {
        font-size: 1.5rem;
    }
    
    .feature-card .form-group + .form-group {
        margin-top: 12px;
    }
    
    .feature-card .image-preview {
        width: 100%;
        margin-bottom: 8px;
    }
    
    .feature-card .delete-image-btn {
        margin-top: 8px;
    }
    
    .feature-textarea {
        min-height: 80px;
    }
    
    .submit-section {
        display: flex;
        justify-content: flex-end;
        gap: 16px;
        padding-top: 20px;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 32px;
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
    }
    
    .btn-primary {
        background: var(--brown-dark);
        color: #fff;
        box-shadow: 0 4px 15px rgba(61, 35, 20, 0.3);
    }
    
    .btn-primary:hover {
        background: var(--brown-medium);
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background: transparent;
        color: var(--text-muted);
        border: 2px solid #E8E2DA;
    }
    
    .btn-secondary:hover {
        border-color: var(--amber);
        color: var(--brown-dark);
    }
    
    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    
    .alert-error {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    
    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-group.full-width {
            grid-column: span 1;
        }
        
        .feature-cards {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 600px) {
        .settings-page {
            padding: 20px 16px;
        }
        
        .settings-section {
            padding: 20px;
        }
        
        .image-upload-wrapper {
            flex-direction: column;
        }
        
        .image-preview {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="settings-page">
    <div class="settings-container">
        
        <div class="page-header">
            <h1 class="page-title">Website Settings</h1>
            <p class="page-subtitle">Customize your welcome page content and images</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="settings-form">
            @csrf
            @method('PUT')
            
            <!-- General Settings -->
            <div class="settings-section">
                <h2 class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    General Settings
                </h2>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Cafe Name</label>
                        <input type="text" name="cafe_name" class="form-input" 
                            value="{{ old('cafe_name', $settings['cafe_name'] ?? '') }}" required>
                    </div>
                </div>
            </div>
            
            <!-- Hero Section -->
            <div class="settings-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        Hero Section
                    </h2>
                    <div class="toggle-wrapper">
                        <span class="status-badge {{ ($settings['hero_enabled'] ?? '1') == '1' ? 'enabled' : 'disabled' }}">
                            {{ ($settings['hero_enabled'] ?? '1') == '1' ? 'Enabled' : 'Disabled' }}
                        </span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="hero_enabled" value="1" {{ ($settings['hero_enabled'] ?? '1') == '1' ? 'checked' : '' }} onchange="toggleSection(this, 'hero-content')">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
                
                <div class="section-content" id="hero-content">
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">Hero Title</label>
                            <input type="text" name="hero_title" class="form-input" 
                                value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" required>
                        </div>
                        
                        <div class="form-group full-width">
                            <label class="form-label">Hero Subtitle</label>
                            <textarea name="hero_subtitle" class="form-textarea" required>{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                        </div>
                        
                        <div class="form-group full-width">
                            <label class="form-label">Hero Image</label>
                            <div class="image-upload-wrapper">
                                <div class="image-preview">
                                    @if(!empty($settings['hero_image']))
                                        <img src="{{ asset('images/settings/' . $settings['hero_image']) }}" alt="Hero Image">
                                    @else
                                        <span class="image-preview-placeholder">🖼️</span>
                                    @endif
                                </div>
                                <div class="image-upload-controls">
                                    <input type="file" name="hero_image" class="file-input" accept="image/*">
                                    <span class="image-hint">Recommended size: 800x600px. Max 5MB. Formats: JPG, PNG, GIF, WebP</span>
                                    @if(!empty($settings['hero_image']))
                                        <button type="button" class="delete-image-btn" onclick="deleteImage('hero_image')">Delete Image</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- About/Features Section -->
            <div class="settings-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        About & Features Section
                    </h2>
                    <div class="toggle-wrapper">
                        <span class="status-badge {{ ($settings['features_enabled'] ?? '1') == '1' ? 'enabled' : 'disabled' }}">
                            {{ ($settings['features_enabled'] ?? '1') == '1' ? 'Enabled' : 'Disabled' }}
                        </span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="features_enabled" value="1" {{ ($settings['features_enabled'] ?? '1') == '1' ? 'checked' : '' }} onchange="toggleSection(this, 'features-content')">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
                
                <div class="section-content" id="features-content">
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">Section Title</label>
                            <input type="text" name="about_title" class="form-input" 
                                value="{{ old('about_title', $settings['about_title'] ?? '') }}" required>
                        </div>
                        
                        <div class="form-group full-width">
                            <label class="form-label">Section Description</label>
                            <textarea name="about_description" class="form-textarea" required>{{ old('about_description', $settings['about_description'] ?? '') }}</textarea>
                        </div>
                    </div>
                    
                    <h3 class="subsection-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Feature Cards
                    </h3>
                
                    <div class="feature-cards">
                    <!-- Feature 1 -->
                    <div class="feature-card">
                        <h3 class="feature-card-title"><span>1️⃣</span> Feature 1</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="feature_1_title" class="form-input" 
                                value="{{ old('feature_1_title', $settings['feature_1_title'] ?? '') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="feature_1_description" class="form-textarea feature-textarea" required>{{ old('feature_1_description', $settings['feature_1_description'] ?? '') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <div class="image-preview">
                                @if(!empty($settings['feature_1_image']))
                                    <img src="{{ asset('images/settings/' . $settings['feature_1_image']) }}" alt="Feature 1">
                                @else
                                    <span class="image-preview-placeholder">🍞</span>
                                @endif
                            </div>
                            <input type="file" name="feature_1_image" class="file-input" accept="image/*">
                            @if(!empty($settings['feature_1_image']))
                                <button type="button" class="delete-image-btn" onclick="deleteImage('feature_1_image')">Delete</button>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="feature-card">
                        <h3 class="feature-card-title"><span>2️⃣</span> Feature 2</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="feature_2_title" class="form-input" 
                                value="{{ old('feature_2_title', $settings['feature_2_title'] ?? '') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="feature_2_description" class="form-textarea feature-textarea" required>{{ old('feature_2_description', $settings['feature_2_description'] ?? '') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <div class="image-preview">
                                @if(!empty($settings['feature_2_image']))
                                    <img src="{{ asset('images/settings/' . $settings['feature_2_image']) }}" alt="Feature 2">
                                @else
                                    <span class="image-preview-placeholder">🥐</span>
                                @endif
                            </div>
                            <input type="file" name="feature_2_image" class="file-input" accept="image/*">
                            @if(!empty($settings['feature_2_image']))
                                <button type="button" class="delete-image-btn" onclick="deleteImage('feature_2_image')">Delete</button>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="feature-card">
                        <h3 class="feature-card-title"><span>3️⃣</span> Feature 3</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="feature_3_title" class="form-input" 
                                value="{{ old('feature_3_title', $settings['feature_3_title'] ?? '') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="feature_3_description" class="form-textarea feature-textarea" required>{{ old('feature_3_description', $settings['feature_3_description'] ?? '') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <div class="image-preview">
                                @if(!empty($settings['feature_3_image']))
                                    <img src="{{ asset('images/settings/' . $settings['feature_3_image']) }}" alt="Feature 3">
                                @else
                                    <span class="image-preview-placeholder">🎂</span>
                                @endif
                            </div>
                            <input type="file" name="feature_3_image" class="file-input" accept="image/*">
                            @if(!empty($settings['feature_3_image']))
                                <button type="button" class="delete-image-btn" onclick="deleteImage('feature_3_image')">Delete</button>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
            <!-- Visit Us Section -->
            <div class="settings-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Visit Us Section
                    </h2>
                    <div class="toggle-wrapper">
                        <span class="status-badge {{ ($settings['visit_enabled'] ?? '1') == '1' ? 'enabled' : 'disabled' }}">
                            {{ ($settings['visit_enabled'] ?? '1') == '1' ? 'Enabled' : 'Disabled' }}
                        </span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="visit_enabled" value="1" {{ ($settings['visit_enabled'] ?? '1') == '1' ? 'checked' : '' }} onchange="toggleSection(this, 'visit-content')">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
                
                <div class="section-content" id="visit-content">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label">Section Title</label>
                        <input type="text" name="visit_title" class="form-input" 
                            value="{{ old('visit_title', $settings['visit_title'] ?? '') }}" required>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label">Section Description</label>
                        <textarea name="visit_description" class="form-textarea" required>{{ old('visit_description', $settings['visit_description'] ?? '') }}</textarea>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label">Visit Image</label>
                        <div class="image-upload-wrapper">
                            <div class="image-preview">
                                @if(!empty($settings['visit_image']))
                                    <img src="{{ asset('images/settings/' . $settings['visit_image']) }}" alt="Visit Image">
                                @else
                                    <span class="image-preview-placeholder">🏪</span>
                                @endif
                            </div>
                            <div class="image-upload-controls">
                                <input type="file" name="visit_image" class="file-input" accept="image/*">
                                <span class="image-hint">Recommended size: 600x400px. Max 5MB.</span>
                                @if(!empty($settings['visit_image']))
                                    <button type="button" class="delete-image-btn" onclick="deleteImage('visit_image')">Delete Image</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- Menu Preview Section -->
            <div class="settings-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                        Menu Preview Section
                    </h2>
                    <div class="toggle-wrapper">
                        <span class="status-badge {{ ($settings['menu_preview_enabled'] ?? '1') == '1' ? 'enabled' : 'disabled' }}">
                            {{ ($settings['menu_preview_enabled'] ?? '1') == '1' ? 'Enabled' : 'Disabled' }}
                        </span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="menu_preview_enabled" value="1" {{ ($settings['menu_preview_enabled'] ?? '1') == '1' ? 'checked' : '' }} onchange="toggleSection(this, 'menu-preview-content')">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
                
                <div class="section-content" id="menu-preview-content">
                    <p style="color: var(--text-muted); font-size: 0.9rem;">
                        This section displays featured menu items on the welcome page. The items shown are managed through the Menu Items section. 
                        Toggle this off to hide the menu preview from the welcome page.
                    </p>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="settings-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Contact Information
                    </h2>
                    <div class="toggle-wrapper">
                        <span class="status-badge {{ ($settings['contact_enabled'] ?? '1') == '1' ? 'enabled' : 'disabled' }}">
                            {{ ($settings['contact_enabled'] ?? '1') == '1' ? 'Enabled' : 'Disabled' }}
                        </span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="contact_enabled" value="1" {{ ($settings['contact_enabled'] ?? '1') == '1' ? 'checked' : '' }} onchange="toggleSection(this, 'contact-content')">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
                
                <div class="section-content" id="contact-content">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-input" 
                            value="{{ old('address', $settings['address'] ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-input" 
                            value="{{ old('phone', $settings['phone'] ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" 
                            value="{{ old('email', $settings['email'] ?? '') }}">
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label">Opening Hours</label>
                        <input type="text" name="opening_hours" class="form-input" 
                            value="{{ old('opening_hours', $settings['opening_hours'] ?? '') }}" 
                            placeholder="e.g., Mon-Fri: 7am-8pm, Sat-Sun: 8am-9pm">
                    </div>
                </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="submit-section">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function deleteImage(key) {
        if (confirm('Are you sure you want to delete this image?')) {
            fetch('{{ route("admin.settings.deleteImage") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ key: key })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
    }
    
    function toggleSection(checkbox, contentId) {
        const content = document.getElementById(contentId);
        const wrapper = checkbox.closest('.toggle-wrapper');
        const badge = wrapper.querySelector('.status-badge');
        
        if (checkbox.checked) {
            content.classList.remove('section-disabled');
            badge.classList.remove('disabled');
            badge.classList.add('enabled');
            badge.textContent = 'Enabled';
        } else {
            content.classList.add('section-disabled');
            badge.classList.remove('enabled');
            badge.classList.add('disabled');
            badge.textContent = 'Disabled';
        }
    }
    
    // Initialize section states on page load
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.toggle-switch input');
        toggles.forEach(function(toggle) {
            const contentId = toggle.getAttribute('onchange').match(/'([^']+)'/)[1];
            const content = document.getElementById(contentId);
            if (!toggle.checked && content) {
                content.classList.add('section-disabled');
            }
        });
    });
</script>
@endsection
