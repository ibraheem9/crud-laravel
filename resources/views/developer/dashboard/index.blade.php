@extends('layouts.cpanel.app')
@section('title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
                        <i class="bi bi-grid fs-3 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted fs-7">Simple CRUD</div>
                        <div class="fw-bold fs-4">Modal Based</div>
                    </div>
                </div>
                <a href="{{ route('developer.simpleCrud.index') }}" class="btn btn-sm btn-light-primary mt-3">View Example</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded p-3 me-3">
                        <i class="bi bi-people fs-3 text-success"></i>
                    </div>
                    <div>
                        <div class="text-muted fs-7">Advanced CRUD</div>
                        <div class="fw-bold fs-4">Page Based</div>
                    </div>
                </div>
                <a href="{{ route('developer.advancedCrud.index') }}" class="btn btn-sm btn-light-success mt-3">View Example</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 rounded p-3 me-3">
                        <i class="bi bi-sort-numeric-down fs-3 text-warning"></i>
                    </div>
                    <div>
                        <div class="text-muted fs-7">CRUD with Sort</div>
                        <div class="fw-bold fs-4">Drag & Drop</div>
                    </div>
                </div>
                <a href="{{ route('developer.crudWithSort.index') }}" class="btn btn-sm btn-light-warning mt-3">View Example</a>
            </div>
        </div>
    </div>

    {{-- Documentation Cards --}}
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Developer Documentation</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('developer.docs.phpHelper') }}" class="d-block p-3 border rounded text-decoration-none hover-elevate-up">
                        <i class="bi bi-filetype-php fs-3 text-primary"></i>
                        <h6 class="mt-2 mb-1">PHP Helpers</h6>
                        <small class="text-muted">ApiHelper, FilesHelper, MainHelper</small>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('developer.docs.jsHelper') }}" class="d-block p-3 border rounded text-decoration-none hover-elevate-up">
                        <i class="bi bi-filetype-js fs-3 text-warning"></i>
                        <h6 class="mt-2 mb-1">JS Helpers (I7)</h6>
                        <small class="text-muted">helperForm, helperSwal, helperConfirm, helperInputs</small>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('developer.docs.ajax') }}" class="d-block p-3 border rounded text-decoration-none hover-elevate-up">
                        <i class="bi bi-arrow-repeat fs-3 text-success"></i>
                        <h6 class="mt-2 mb-1">AJAX Patterns</h6>
                        <small class="text-muted">Store, Update, Delete, Status Toggle</small>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('developer.docs.datatable') }}" class="d-block p-3 border rounded text-decoration-none hover-elevate-up">
                        <i class="bi bi-table fs-3 text-info"></i>
                        <h6 class="mt-2 mb-1">DataTable Guide</h6>
                        <small class="text-muted">Server-side, Columns, Actions</small>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('developer.docs.inputs') }}" class="d-block p-3 border rounded text-decoration-none hover-elevate-up">
                        <i class="bi bi-input-cursor-text fs-3 text-danger"></i>
                        <h6 class="mt-2 mb-1">Input Components</h6>
                        <small class="text-muted">Masks, Pickers, Select2, Switches</small>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('developer.docs.layout') }}" class="d-block p-3 border rounded text-decoration-none hover-elevate-up">
                        <i class="bi bi-layout-sidebar fs-3 text-secondary"></i>
                        <h6 class="mt-2 mb-1">Layout Guide</h6>
                        <small class="text-muted">Blade structure, Sections, Patterns</small>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Project Info --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Project Structure</h5>
        </div>
        <div class="card-body">
            <pre class="bg-dark text-light p-3 rounded" style="font-size: 0.8rem;">
crud-laravel/
├── app/
│   ├── Helpers/
│   │   ├── ApiHelper.php          # sendResponse(), getRealIpAddr()
│   │   ├── FilesHelper.php        # uploadImage(), getImageUrl(), deleteFile()
│   │   └── MainHelper.php         # dateFormat(), generateHashID()
│   ├── Http/
│   │   ├── Controllers/Developer/
│   │   │   ├── SimpleCrudController.php      # Modal-based CRUD
│   │   │   ├── AdvancedCrudController.php    # Page-based CRUD
│   │   │   ├── CrudWithSortController.php    # Sortable CRUD
│   │   │   ├── DashboardController.php
│   │   │   └── DocsController.php
│   │   └── Requests/Developer/
│   │       ├── SaveSimpleCrudRequest.php
│   │       ├── SaveAdvancedCrudRequest.php
│   │       └── SaveCrudWithSortRequest.php
│   └── Models/Developer/
│       ├── SimpleCrud.php
│       ├── AdvancedCrud.php
│       └── CrudWithSort.php
├── resources/
│   ├── I7_Helpers/                # Original I7 JS helpers
│   └── views/
│       ├── layouts/cpanel/        # Main layout with sidebar
│       └── developer/             # All CRUD views + docs
├── public/modules/developer/js/   # Page-specific JS files
└── routes/web.php                 # All routes
            </pre>
        </div>
    </div>
@stop
