<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'CRUD Laravel') - I7 Developer</title>

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
            --sidebar-width: 265px;
            --header-height: 60px;
        }
        body { background: #f5f8fa; font-family: 'Inter', sans-serif; }
        .aside {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width); background: #1e1e2d; z-index: 1040;
            overflow-y: auto; transition: all 0.3s;
        }
        .aside .aside-logo {
            display: flex; align-items: center; justify-content: center;
            height: var(--header-height); padding: 0 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .aside .aside-logo h3 { color: #fff; margin: 0; font-size: 1.1rem; }
        .aside-menu { padding: 15px 0; }
        .aside-menu .menu-section {
            padding: 10px 25px 5px; color: #565674; font-size: 0.75rem;
            text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;
        }
        .aside-menu .menu-item { padding: 0 15px; }
        .aside-menu .menu-link {
            display: flex; align-items: center; padding: 9px 15px;
            color: #9899ac; text-decoration: none; border-radius: 6px;
            font-size: 0.875rem; transition: all 0.15s;
        }
        .aside-menu .menu-link:hover, .aside-menu .menu-link.active {
            background: rgba(255,255,255,0.04); color: #fff;
        }
        .aside-menu .menu-link.active { background: #1b84ff22; color: #1b84ff; }
        .aside-menu .menu-link i { font-size: 1.1rem; margin-right: 10px; width: 24px; text-align: center; }

        .wrapper {
            margin-left: var(--sidebar-width); min-height: 100vh;
            display: flex; flex-direction: column;
        }
        .header-bar {
            height: var(--header-height); background: #fff;
            border-bottom: 1px solid #eff2f5; display: flex;
            align-items: center; padding: 0 25px; position: sticky; top: 0; z-index: 1030;
        }
        .content-area { padding: 25px; flex: 1; }

        /* DataTable overrides */
        .dataTables_wrapper .dataTables_filter input { border-radius: 6px; }
        table.dataTable thead th { font-weight: 600; font-size: 0.85rem; text-transform: uppercase; color: #7e8299; }

        /* Card */
        .card { border: 0; box-shadow: 0 0 20px 0 rgba(76,87,125,.02); border-radius: 12px; }
        .card-header { background: transparent; border-bottom: 1px solid #eff2f5; padding: 1.25rem 1.5rem; }

        /* Form helpers */
        ._input_group { margin-bottom: 1rem; }
        ._laravel_error { font-size: 0.8rem; }

        /* Image input */
        .image-input { position: relative; display: inline-block; }
        .image-input .image-input-wrapper {
            background-size: cover; background-position: center;
            border-radius: 8px; border: 3px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        /* Sort items */
        .ui-state-default { cursor: move; }

        /* Toolbar actions */
        .toolbar-actions { display: none; }
        .toolbar-actions.show { display: flex; }

        /* Menu dropdown for actions */
        .action-menu { position: relative; display: inline-block; }
        .action-menu .dropdown-menu { min-width: 120px; }

        @media (max-width: 992px) {
            .aside { transform: translateX(-100%); }
            .aside.show { transform: translateX(0); }
            .wrapper { margin-left: 0; }
        }
    </style>
    @yield('style')
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

</body>
</html>
