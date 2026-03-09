<div class="aside" id="kt_aside">
    <div class="aside-logo">
        <div class="logo-icon">I7</div>
        <div class="logo-text">
            CRUD Laravel
            <small>Developer Reference</small>
        </div>
    </div>
    <div class="aside-menu">
        {{-- Dashboard --}}
        <div class="menu-section">Main</div>
        <div class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
        </div>

        <div class="menu-divider"></div>

        {{-- CRUD Examples --}}
        <div class="menu-section">CRUD Examples</div>
        <div class="menu-item">
            <a href="{{ route('developer.simpleCrud.index') }}" class="menu-link {{ request()->routeIs('developer.simpleCrud.*') ? 'active' : '' }}">
                <i class="bi bi-window-stack"></i> Simple CRUD
                <span class="badge bg-primary bg-opacity-10 text-primary ms-auto" style="font-size:.65rem;">Modal</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.advancedCrud.index') }}" class="menu-link {{ request()->routeIs('developer.advancedCrud.*') ? 'active' : '' }}">
                <i class="bi bi-person-lines-fill"></i> Advanced CRUD
                <span class="badge bg-success bg-opacity-10 text-success ms-auto" style="font-size:.65rem;">Page</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.crudWithSort.index') }}" class="menu-link {{ request()->routeIs('developer.crudWithSort.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-down-up"></i> CRUD with Sort
                <span class="badge bg-warning bg-opacity-10 text-warning ms-auto" style="font-size:.65rem;">Drag</span>
            </a>
        </div>

        <div class="menu-divider"></div>

        {{-- Documentation --}}
        <div class="menu-section">Documentation</div>
        <div class="menu-item">
            <a href="{{ route('developer.docs.phpHelper') }}" class="menu-link {{ request()->routeIs('developer.docs.phpHelper') ? 'active' : '' }}">
                <i class="bi bi-filetype-php"></i> PHP Helpers
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.docs.jsHelper') }}" class="menu-link {{ request()->routeIs('developer.docs.jsHelper') ? 'active' : '' }}">
                <i class="bi bi-filetype-js"></i> JS Helpers (I7)
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.docs.datatable') }}" class="menu-link {{ request()->routeIs('developer.docs.datatable') ? 'active' : '' }}">
                <i class="bi bi-table"></i> DataTable Guide
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.docs.ajax') }}" class="menu-link {{ request()->routeIs('developer.docs.ajax') ? 'active' : '' }}">
                <i class="bi bi-arrow-repeat"></i> AJAX Patterns
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.docs.inputs') }}" class="menu-link {{ request()->routeIs('developer.docs.inputs') ? 'active' : '' }}">
                <i class="bi bi-input-cursor-text"></i> Input Components
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.docs.layout') }}" class="menu-link {{ request()->routeIs('developer.docs.layout') ? 'active' : '' }}">
                <i class="bi bi-layout-sidebar-inset"></i> Layout Guide
            </a>
        </div>
    </div>
</div>
