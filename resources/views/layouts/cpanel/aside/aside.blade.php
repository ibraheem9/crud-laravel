<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="{{ url('/developer/dashboard') }}">
            <span class="fs-3 fw-bolder text-white">I7</span>
            <span class="fs-6 fw-bold text-gray-500 ms-1">CRUD Laravel</span>
        </a>
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor"/>
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor"/>
                </svg>
            </span>
        </div>
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
             data-kt-scroll-offset="0">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                 id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

                {{-- ========== MAIN ========== --}}
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Main</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/dashboard*') ? 'active' : '' }}" href="{{ url('/developer/dashboard') }}">
                        <span class="menu-icon"><i class="bi bi-grid-1x2 fs-3"></i></span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                {{-- ========== CRUD EXAMPLES ========== --}}
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">CRUD Examples</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/simpleCrud*') ? 'active' : '' }}" href="{{ url('/developer/simpleCrud') }}">
                        <span class="menu-icon"><i class="bi bi-window-stack fs-3"></i></span>
                        <span class="menu-title">Simple CRUD</span>
                        <span class="menu-badge"><span class="badge badge-light-primary">Modal</span></span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/advancedCrud*') ? 'active' : '' }}" href="{{ url('/developer/advancedCrud') }}">
                        <span class="menu-icon"><i class="bi bi-layout-text-window-reverse fs-3"></i></span>
                        <span class="menu-title">Advanced CRUD</span>
                        <span class="menu-badge"><span class="badge badge-light-info">Page</span></span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/crudWithSort*') ? 'active' : '' }}" href="{{ url('/developer/crudWithSort') }}">
                        <span class="menu-icon"><i class="bi bi-arrow-down-up fs-3"></i></span>
                        <span class="menu-title">CRUD with Sort</span>
                        <span class="menu-badge"><span class="badge badge-light-warning">Drag</span></span>
                    </a>
                </div>

                {{-- ========== MEDIA CRUDs ========== --}}
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Media CRUDs</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/media/images*') ? 'active' : '' }}" href="{{ url('/developer/media/images') }}">
                        <span class="menu-icon"><i class="bi bi-image fs-3"></i></span>
                        <span class="menu-title">Single Image</span>
                        <span class="menu-badge"><span class="badge badge-light-success">Doka</span></span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/media/gallery*') ? 'active' : '' }}" href="{{ url('/developer/media/gallery') }}">
                        <span class="menu-icon"><i class="bi bi-images fs-3"></i></span>
                        <span class="menu-title">Image Gallery</span>
                        <span class="menu-badge"><span class="badge badge-light-danger">Multi</span></span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/media/documents*') ? 'active' : '' }}" href="{{ url('/developer/media/documents') }}">
                        <span class="menu-icon"><i class="bi bi-file-earmark-text fs-3"></i></span>
                        <span class="menu-title">Documents</span>
                        <span class="menu-badge"><span class="badge badge-light-primary">PDF/DOC</span></span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/media/archives*') ? 'active' : '' }}" href="{{ url('/developer/media/archives') }}">
                        <span class="menu-icon"><i class="bi bi-file-earmark-zip fs-3"></i></span>
                        <span class="menu-title">Archives</span>
                        <span class="menu-badge"><span class="badge badge-light-dark">ZIP/RAR</span></span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/media/audios*') ? 'active' : '' }}" href="{{ url('/developer/media/audios') }}">
                        <span class="menu-icon"><i class="bi bi-music-note-beamed fs-3"></i></span>
                        <span class="menu-title">Audio</span>
                        <span class="menu-badge"><span class="badge badge-light-info">Sound</span></span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/media/videos*') ? 'active' : '' }}" href="{{ url('/developer/media/videos') }}">
                        <span class="menu-icon"><i class="bi bi-camera-video fs-3"></i></span>
                        <span class="menu-title">Video</span>
                        <span class="menu-badge"><span class="badge badge-light-warning">Player</span></span>
                    </a>
                </div>

                {{-- ========== DOCUMENTATION ========== --}}
                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Documentation</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/docs/php-helper*') ? 'active' : '' }}" href="{{ url('/developer/docs/php-helper') }}">
                        <span class="menu-icon"><i class="bi bi-filetype-php fs-3"></i></span>
                        <span class="menu-title">PHP Helpers</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/docs/js-helper*') ? 'active' : '' }}" href="{{ url('/developer/docs/js-helper') }}">
                        <span class="menu-icon"><i class="bi bi-filetype-js fs-3"></i></span>
                        <span class="menu-title">JS Helpers (I7)</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/docs/datatable*') ? 'active' : '' }}" href="{{ url('/developer/docs/datatable') }}">
                        <span class="menu-icon"><i class="bi bi-table fs-3"></i></span>
                        <span class="menu-title">DataTable Guide</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/docs/ajax*') ? 'active' : '' }}" href="{{ url('/developer/docs/ajax') }}">
                        <span class="menu-icon"><i class="bi bi-arrow-repeat fs-3"></i></span>
                        <span class="menu-title">AJAX Patterns</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/docs/inputs*') ? 'active' : '' }}" href="{{ url('/developer/docs/inputs') }}">
                        <span class="menu-icon"><i class="bi bi-input-cursor-text fs-3"></i></span>
                        <span class="menu-title">Input Components</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('developer/docs/layout*') ? 'active' : '' }}" href="{{ url('/developer/docs/layout') }}">
                        <span class="menu-icon"><i class="bi bi-layout-sidebar fs-3"></i></span>
                        <span class="menu-title">Layout Guide</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!--end::Aside menu-->
    <!--begin::Aside Footer-->
    <div class="aside-footer flex-column-auto pb-5 px-4" id="kt_aside_footer">
        <a href="https://github.com/ibraheem9/crud-laravel" target="_blank"
           class="btn btn-flex flex-center btn-light-primary w-100" style="font-size:12px; font-weight:600;">
            <i class="bi bi-github fs-5 me-2"></i> View on GitHub
        </a>
    </div>
    <!--end::Aside Footer-->
</div>
