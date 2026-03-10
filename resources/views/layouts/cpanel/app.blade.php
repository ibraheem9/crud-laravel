<!DOCTYPE html>
<html lang="en" dir="ltr">
<!--begin::Head-->
<head>
    <base href="{{ url('/') }}">
    <title>@yield('title') - CRUD Laravel</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('cpanel/media/logos/favicon.ico') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('cpanel/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('cpanel/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->

    <style>
        .decimal_mask { text-align: left !important; direction: ltr !important; }
        .error { color: indianred; }
        .required { font-weight: bold !important; }
        .required:after {
            content: "*"; position: relative; color: #f1416c;
            padding-left: 0.25rem; font-weight: bold !important; vertical-align: middle !important;
        }
        .select2-container { width: 100% !important; }
        .select2-container--default .select2-selection--single { height: 50px !important; }
        table.dataTable > thead .sorting:after,
        table.dataTable > thead .sorting_asc:after,
        table.dataTable > thead .sorting_asc_disabled:after,
        table.dataTable > thead .sorting_desc:after,
        table.dataTable > thead .sorting_desc_disabled:after {
            right: unset !important; content: unset !important;
        }
        .aside-dark .menu .menu-item .menu-link .menu-icon,
        .aside-dark .menu .menu-item .menu-link .menu-icon .svg-icon,
        .aside-dark .menu .menu-item .menu-link .menu-icon i { color: #ffffff; }
        .aside-dark .menu .menu-item .menu-link.active .menu-icon,
        .aside-dark .menu .menu-item .menu-link.active .menu-icon .svg-icon,
        .aside-dark .menu .menu-item .menu-link.active .menu-icon i { color: #00ffcb; }
    </style>

    @yield('style')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        @include('layouts.cpanel.aside.aside')
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            @include('layouts.cpanel.header.header')
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Toolbar-->
                @yield('toolbar')
                <!--end::Toolbar-->
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        @yield('content')
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            @include('layouts.cpanel.footer.footer')
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->

@include('layouts.cpanel.footer.scroll_top')

<!--begin::Javascript-->
<script>
    var baseUrl = @json(url('/'));
    var language = 'en';
</script>
<script>var hostUrl = "cpanel/";</script>
<script src="{{ asset('cpanel/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('cpanel/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('js/core.js') }}"></script>
<!--end::Javascript-->

@yield('script')

</body>
<!--end::Body-->
</html>
