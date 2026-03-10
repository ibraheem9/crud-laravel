<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'CRUD Laravel') - I7 Developer</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

    {{-- Font Awesome 6 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    {{-- DataTables Bootstrap 5 --}}
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    {{-- Toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    {{-- SweetAlert2 --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet"/>
    {{-- jQuery UI (for sortable) --}}
    <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet"/>
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet"/>
    {{-- Flatpickr --}}
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet"/>

    <style>
        :root {
            --sidebar-width: 270px;
            --header-height: 64px;
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #eff6ff;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: rgba(59,130,246,0.15);
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #3b82f6;
            --body-bg: #f1f5f9;
            --card-shadow: 0 1px 3px 0 rgba(0,0,0,.06), 0 1px 2px -1px rgba(0,0,0,.06);
            --card-shadow-hover: 0 10px 15px -3px rgba(0,0,0,.08), 0 4px 6px -4px rgba(0,0,0,.08);
        }

        * { box-sizing: border-box; }
        body {
            background: var(--body-bg);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 0.875rem;
            color: #1e293b;
        }

        /* ─── Scrollbar ────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ─── Sidebar ──────────────────────────────────────────── */
        .aside {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width); background: var(--sidebar-bg);
            z-index: 1040; overflow-y: auto; overflow-x: hidden;
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            border-right: 1px solid rgba(255,255,255,0.05);
        }
        .aside-logo {
            display: flex; align-items: center; gap: 12px;
            height: 72px; padding: 0 24px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .aside-logo .logo-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 0.9rem;
        }
        .aside-logo .logo-text {
            color: #f1f5f9; font-size: 1rem; font-weight: 600; letter-spacing: -0.01em;
        }
        .aside-logo .logo-text small {
            display: block; color: #64748b; font-size: 0.7rem; font-weight: 400; letter-spacing: 0.02em;
        }
        .aside-menu { padding: 16px 0; }
        .aside-menu .menu-section {
            padding: 20px 24px 8px; color: #475569; font-size: 0.65rem;
            text-transform: uppercase; letter-spacing: 0.08em; font-weight: 600;
        }
        .aside-menu .menu-item { padding: 2px 12px; }
        .aside-menu .menu-link {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px; color: var(--sidebar-text);
            text-decoration: none; border-radius: 8px;
            font-size: 0.82rem; font-weight: 500;
            transition: all 0.15s ease;
        }
        .aside-menu .menu-link:hover {
            background: var(--sidebar-hover); color: #e2e8f0;
        }
        .aside-menu .menu-link.active {
            background: var(--sidebar-active); color: var(--sidebar-text-active);
        }
        .aside-menu .menu-link i {
            font-size: 1rem; width: 20px; text-align: center; opacity: 0.8;
        }
        .aside-menu .menu-link.active i { opacity: 1; }
        .aside-menu .menu-divider {
            height: 1px; background: rgba(255,255,255,0.05); margin: 8px 24px;
        }

        /* ─── Main Wrapper ─────────────────────────────────────── */
        .wrapper {
            margin-left: var(--sidebar-width); min-height: 100vh;
            display: flex; flex-direction: column;
        }

        /* ─── Header ───────────────────────────────────────────── */
        .header-bar {
            height: var(--header-height); background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center; padding: 0 28px;
            position: sticky; top: 0; z-index: 1030;
            backdrop-filter: blur(8px);
        }
        .header-bar .page-title {
            font-size: 0.95rem; font-weight: 600; color: #0f172a;
        }
        .header-bar .breadcrumb-item { font-size: 0.78rem; }
        .header-bar .header-badges .badge {
            font-size: 0.7rem; font-weight: 500; padding: 5px 10px; border-radius: 6px;
        }

        /* ─── Content ──────────────────────────────────────────── */
        .content-area { padding: 28px; flex: 1; }

        /* ─── Toolbar ──────────────────────────────────────────── */
        .page-toolbar {
            background: #fff; border-bottom: 1px solid #e2e8f0;
            padding: 16px 28px;
        }
        .page-toolbar h5 { font-size: 1.05rem; font-weight: 700; color: #0f172a; margin: 0; }
        .page-toolbar .text-muted { font-size: 0.78rem; }

        /* ─── Cards ────────────────────────────────────────────── */
        .card {
            border: 1px solid #e2e8f0; box-shadow: var(--card-shadow);
            border-radius: 12px; background: #fff;
        }
        .card-header {
            background: transparent; border-bottom: 1px solid #f1f5f9;
            padding: 16px 20px;
        }
        .card-header h6, .card-header h5 {
            font-weight: 600; margin: 0; color: #0f172a;
        }
        .card-body { padding: 20px; }

        /* ─── DataTable Overrides ──────────────────────────────── */
        .dataTables_wrapper .dataTables_filter { display: none; }
        .dataTables_wrapper .dataTables_length select {
            border-radius: 6px; padding: 4px 8px; border-color: #e2e8f0;
        }
        table.dataTable { border-collapse: collapse !important; }
        table.dataTable thead th {
            font-weight: 600; font-size: 0.75rem; text-transform: uppercase;
            color: #64748b; letter-spacing: 0.04em; border-bottom: 2px solid #e2e8f0 !important;
            padding: 12px 16px !important;
        }
        table.dataTable tbody td {
            padding: 12px 16px !important; vertical-align: middle;
            border-bottom: 1px solid #f1f5f9 !important; font-size: 0.84rem;
        }
        table.dataTable tbody tr:hover { background: #f8fafc !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important; color: #fff !important;
            border-color: var(--primary) !important; border-radius: 6px;
        }
        .dataTables_wrapper .dataTables_info { font-size: 0.78rem; color: #64748b; }

        /* ─── Form Helpers ─────────────────────────────────────── */
        ._input_group { margin-bottom: 1rem; }
        ._input_group label { font-weight: 500; font-size: 0.82rem; color: #334155; margin-bottom: 4px; }
        ._laravel_error { font-size: 0.78rem; }
        .form-control, .form-select {
            border-color: #e2e8f0; border-radius: 8px; font-size: 0.84rem;
            padding: 8px 14px; transition: border-color 0.15s, box-shadow 0.15s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary); box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }

        /* ─── Buttons ──────────────────────────────────────────── */
        .btn { border-radius: 8px; font-size: 0.84rem; font-weight: 500; padding: 8px 16px; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-light { background: #f1f5f9; border-color: #e2e8f0; color: #334155; }
        .btn-light:hover { background: #e2e8f0; border-color: #cbd5e1; color: #0f172a; }

        /* ─── Image Input ──────────────────────────────────────── */
        .image-input { position: relative; display: inline-block; }
        .image-input .image-input-wrapper {
            background-size: cover; background-position: center;
            border-radius: 10px; border: 3px solid #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* ─── Sort Items ───────────────────────────────────────── */
        .ui-state-default { cursor: move; }

        /* ─── Toolbar Actions ──────────────────────────────────── */
        .toolbar-actions { display: none; }
        .toolbar-actions.show { display: flex; }

        /* ─── Status Switch ────────────────────────────────────── */
        .form-check-input:checked { background-color: var(--primary); border-color: var(--primary); }

        /* ─── Badge ────────────────────────────────────────────── */
        .badge { font-weight: 500; letter-spacing: 0.01em; }

        /* ─── Modal ────────────────────────────────────────────── */
        .modal-content { border: 0; border-radius: 14px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
        .modal-header { border-bottom: 1px solid #f1f5f9; padding: 16px 20px; }
        .modal-header .modal-title { font-weight: 600; font-size: 1rem; }
        .modal-body { padding: 20px; }
        .modal-footer { border-top: 1px solid #f1f5f9; padding: 12px 20px; }

        /* ─── Dropdown ─────────────────────────────────────────── */
        .dropdown-menu {
            border: 1px solid #e2e8f0; border-radius: 10px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,.1); padding: 6px;
        }
        .dropdown-item {
            border-radius: 6px; font-size: 0.82rem; padding: 8px 12px;
        }
        .dropdown-item:hover { background: #f1f5f9; }

        /* ─── Responsive ───────────────────────────────────────── */
        @media (max-width: 992px) {
            .aside { transform: translateX(-100%); }
            .aside.show { transform: translateX(0); }
            .wrapper { margin-left: 0; }
        }
    </style>
    @yield('style')
    @yield('styles')
</head>
<body>

{{-- Sidebar --}}
@include('layouts.cpanel.aside.aside')

{{-- Main Wrapper --}}
<div class="wrapper">
    {{-- Header --}}
    @include('layouts.cpanel.header.header')

    {{-- Toolbar --}}
    @yield('toolbar')

    {{-- Content --}}
    <div class="content-area">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>

{{-- Overlay for mobile sidebar --}}
<div class="aside-overlay d-none" id="aside_overlay" onclick="closeSidebar()"
     style="position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:1039;"></div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/he@1.2.0/he.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>

{{-- Global Variables --}}
<script>
    var baseUrl = @json(url('/'));
    var APP_DEBUG = @json(config('app.debug'));
    var defaultImage = @json(getDefaultImg());

    // Minimal Lang shim for I7_Helpers compatibility
    var Lang = {
        _locale: 'en',
        _messages: {
            'cpanel.delete_title': 'Are you sure?',
            'cpanel.delete_confirmation': 'You won\'t be able to revert this!',
            'cpanel.yes_delete': 'Yes, delete it!',
            'cpanel.cancel': 'Cancel',
            'cpanel.deleted_success': 'Deleted successfully!',
            'cpanel.error': 'Something went wrong!',
            'cpanel.sort': 'Sort Items',
            'cpanel.close': 'Close',
        },
        setLocale: function(l) { this._locale = l; },
        get: function(key) { return this._messages[key] || key; }
    };

    // Mobile sidebar toggle
    function toggleSidebar() {
        document.getElementById('kt_aside').classList.toggle('show');
        document.getElementById('aside_overlay').classList.toggle('d-none');
    }
    function closeSidebar() {
        document.getElementById('kt_aside').classList.remove('show');
        document.getElementById('aside_overlay').classList.add('d-none');
    }
</script>

{{-- I7 Helpers (compiled core.js) --}}
@include('layouts.cpanel.styles.i7_helpers')

{{-- Toastr defaults --}}
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
    };
</script>

@yield('script')
@yield('scripts')

</body>
</html>
