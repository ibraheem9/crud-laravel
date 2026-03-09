@extends('layouts.cpanel.app')
@section('title', 'Dashboard')

@section('style')
<style>
    .feature-card {
        border: 1px solid #e2e8f0; border-radius: 14px; padding: 24px;
        background: #fff; transition: all 0.2s ease; text-decoration: none; display: block;
    }
    .feature-card:hover {
        border-color: var(--primary); box-shadow: 0 8px 25px -5px rgba(59,130,246,0.12);
        transform: translateY(-2px);
    }
    .feature-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }
    .doc-card {
        border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px;
        transition: all 0.2s ease; text-decoration: none; display: block; color: inherit;
    }
    .doc-card:hover {
        border-color: #cbd5e1; background: #f8fafc; color: inherit;
    }
    .doc-card .doc-icon {
        width: 40px; height: 40px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; margin-bottom: 10px;
    }
    .welcome-banner {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1e40af 100%);
        border-radius: 16px; padding: 32px; color: #fff; margin-bottom: 28px;
        position: relative; overflow: hidden;
    }
    .welcome-banner::after {
        content: ''; position: absolute; right: -40px; top: -40px;
        width: 200px; height: 200px; border-radius: 50%;
        background: rgba(59,130,246,0.15);
    }
    .welcome-banner h2 { font-weight: 700; font-size: 1.5rem; margin-bottom: 8px; }
    .welcome-banner p { color: #94a3b8; font-size: 0.9rem; margin: 0; max-width: 600px; }
    .tree-view {
        background: #0f172a; color: #e2e8f0; border-radius: 12px;
        padding: 24px; font-family: 'JetBrains Mono', 'Fira Code', monospace;
        font-size: 0.78rem; line-height: 1.7; overflow-x: auto;
    }
    .tree-view .comment { color: #64748b; }
    .tree-view .folder { color: #60a5fa; }
    .tree-view .file { color: #94a3b8; }
    .tree-view .highlight { color: #fbbf24; }
</style>
@stop

@section('content')
    {{-- Welcome Banner --}}
    <div class="welcome-banner">
        <h2>I7 CRUD Reference Project</h2>
        <p>A comprehensive Laravel 12 developer toolkit with ready-to-use CRUD patterns, helpers, and documentation. Built for rapid development.</p>
    </div>

    {{-- CRUD Feature Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <a href="{{ route('developer.simpleCrud.index') }}" class="feature-card">
                <div class="feature-icon mb-3" style="background:#eff6ff;color:#3b82f6;">
                    <i class="bi bi-window-stack"></i>
                </div>
                <h6 class="fw-bold mb-1" style="color:#0f172a;">Simple CRUD</h6>
                <p class="text-muted mb-2" style="font-size:.82rem;">Modal-based create, edit, delete with AJAX DataTable, image upload, and status toggles.</p>
                <span class="badge" style="background:#eff6ff;color:#3b82f6;font-size:.7rem;">Modal Based</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('developer.advancedCrud.index') }}" class="feature-card">
                <div class="feature-icon mb-3" style="background:#f0fdf4;color:#16a34a;">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <h6 class="fw-bold mb-1" style="color:#0f172a;">Advanced CRUD</h6>
                <p class="text-muted mb-2" style="font-size:.82rem;">Full page forms with multi-column layout, image preview, password toggle, multi-delete.</p>
                <span class="badge" style="background:#f0fdf4;color:#16a34a;font-size:.7rem;">Page Based</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('developer.crudWithSort.index') }}" class="feature-card">
                <div class="feature-icon mb-3" style="background:#fefce8;color:#ca8a04;">
                    <i class="bi bi-arrow-down-up"></i>
                </div>
                <h6 class="fw-bold mb-1" style="color:#0f172a;">CRUD with Sort</h6>
                <p class="text-muted mb-2" style="font-size:.82rem;">Drag-and-drop reordering with jQuery UI Sortable, order saved via AJAX.</p>
                <span class="badge" style="background:#fefce8;color:#ca8a04;font-size:.7rem;">Drag & Drop</span>
            </a>
        </div>
    </div>

    {{-- Documentation Cards --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6><i class="bi bi-book me-2 text-primary"></i>Developer Documentation</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('developer.docs.phpHelper') }}" class="doc-card">
                        <div class="doc-icon" style="background:#fef3c7;color:#d97706;"><i class="bi bi-filetype-php"></i></div>
                        <h6 style="font-size:.88rem;font-weight:600;margin-bottom:2px;">PHP Helpers</h6>
                        <small class="text-muted">ApiHelper, FilesHelper, MainHelper</small>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('developer.docs.jsHelper') }}" class="doc-card">
                        <div class="doc-icon" style="background:#fef9c3;color:#a16207;"><i class="bi bi-filetype-js"></i></div>
                        <h6 style="font-size:.88rem;font-weight:600;margin-bottom:2px;">JS Helpers (I7)</h6>
                        <small class="text-muted">helperForm, helperSwal, helperConfirm</small>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('developer.docs.datatable') }}" class="doc-card">
                        <div class="doc-icon" style="background:#e0f2fe;color:#0284c7;"><i class="bi bi-table"></i></div>
                        <h6 style="font-size:.88rem;font-weight:600;margin-bottom:2px;">DataTable Guide</h6>
                        <small class="text-muted">Yajra Server-side, Columns, Actions</small>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('developer.docs.ajax') }}" class="doc-card">
                        <div class="doc-icon" style="background:#f0fdf4;color:#16a34a;"><i class="bi bi-arrow-repeat"></i></div>
                        <h6 style="font-size:.88rem;font-weight:600;margin-bottom:2px;">AJAX Patterns</h6>
                        <small class="text-muted">Store, Update, Delete, Status Toggle</small>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('developer.docs.inputs') }}" class="doc-card">
                        <div class="doc-icon" style="background:#fce7f3;color:#db2777;"><i class="bi bi-input-cursor-text"></i></div>
                        <h6 style="font-size:.88rem;font-weight:600;margin-bottom:2px;">Input Components</h6>
                        <small class="text-muted">Masks, Pickers, Select2, Switches</small>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('developer.docs.layout') }}" class="doc-card">
                        <div class="doc-icon" style="background:#f1f5f9;color:#475569;"><i class="bi bi-layout-sidebar-inset"></i></div>
                        <h6 style="font-size:.88rem;font-weight:600;margin-bottom:2px;">Layout Guide</h6>
                        <small class="text-muted">Blade structure, Sections, Patterns</small>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Project Structure --}}
    <div class="card">
        <div class="card-header">
            <h6><i class="bi bi-folder2-open me-2 text-primary"></i>Project Structure</h6>
        </div>
        <div class="card-body p-0">
            <div class="tree-view">
<pre style="margin:0;font-family:inherit;">
<span class="folder">crud-laravel/</span>
├── <span class="folder">app/</span>
│   ├── <span class="folder">Helpers/</span>
│   │   ├── <span class="file">ApiHelper.php</span>          <span class="comment"># sendResponse(), getRealIpAddr()</span>
│   │   ├── <span class="file">FilesHelper.php</span>        <span class="comment"># uploadImage(), getImageUrl(), deleteFile()</span>
│   │   └── <span class="file">MainHelper.php</span>         <span class="comment"># dateFormat(), generateHashID()</span>
│   ├── <span class="folder">Http/</span>
│   │   ├── <span class="folder">Controllers/Developer/</span>
│   │   │   ├── <span class="file">SimpleCrudController.php</span>     <span class="comment"># Modal-based CRUD</span>
│   │   │   ├── <span class="file">AdvancedCrudController.php</span>   <span class="comment"># Page-based CRUD</span>
│   │   │   ├── <span class="file">CrudWithSortController.php</span>   <span class="comment"># Sortable CRUD</span>
│   │   │   ├── <span class="file">DashboardController.php</span>
│   │   │   └── <span class="file">DocsController.php</span>
│   │   └── <span class="folder">Requests/Developer/</span>
│   │       ├── <span class="file">SaveSimpleCrudRequest.php</span>
│   │       ├── <span class="file">SaveAdvancedCrudRequest.php</span>
│   │       └── <span class="file">SaveCrudWithSortRequest.php</span>
│   └── <span class="folder">Models/Developer/</span>
│       ├── <span class="file">SimpleCrud.php</span>
│       ├── <span class="file">AdvancedCrud.php</span>
│       └── <span class="file">CrudWithSort.php</span>
├── <span class="folder">resources/</span>
│   ├── <span class="highlight">I7_Helpers/</span>                <span class="comment"># Original I7 JS helpers</span>
│   └── <span class="folder">views/</span>
│       ├── <span class="folder">layouts/cpanel/</span>        <span class="comment"># Main layout with sidebar</span>
│       └── <span class="folder">developer/</span>             <span class="comment"># All CRUD views + docs</span>
├── <span class="folder">public/modules/developer/js/</span>   <span class="comment"># Page-specific JS files</span>
└── <span class="file">routes/web.php</span>                 <span class="comment"># All routes</span>
</pre>
            </div>
        </div>
    </div>
@stop
