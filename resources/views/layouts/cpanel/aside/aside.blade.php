<div class="aside" id="kt_aside">
    <div class="aside-logo">
        <h3><i class="bi bi-code-square text-primary me-2"></i> I7 CRUD</h3>
    </div>
    <div class="aside-menu">
        {{-- Dashboard --}}
        <div class="menu-section">Main</div>
        <div class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </div>

        {{-- CRUD Examples --}}
        <div class="menu-section mt-3">CRUD Examples</div>
        <div class="menu-item">
            <a href="{{ route('developer.simpleCrud.index') }}" class="menu-link {{ request()->routeIs('developer.simpleCrud.*') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Simple CRUD (Modal)
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.advancedCrud.index') }}" class="menu-link {{ request()->routeIs('developer.advancedCrud.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Advanced CRUD (Page)
            </a>
        </div>
        <div class="menu-item">
            <a href="{{ route('developer.crudWithSort.index') }}" class="menu-link {{ request()->routeIs('developer.crudWithSort.*') ? 'active' : '' }}">
                <i class="bi bi-sort-numeric-down"></i> CRUD with Sort
            </a>
        </div>

        {{-- Documentation --}}
        <div class="menu-section mt-3">Documentation</div>
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
                <i class="bi bi-layout-sidebar"></i> Layout Guide
            </a>
        </div>
    </div>
</div>
