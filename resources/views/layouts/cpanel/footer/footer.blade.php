<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">{{ now()->year }} &copy;</span>
            <a href="https://github.com/ibraheem9/crud-laravel" target="_blank" class="text-gray-800 text-hover-primary">
                CRUD Laravel
            </a>
        </div>
        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
            <li class="menu-item">
                <span class="menu-link px-2 text-muted">Laravel {{ app()->version() }}</span>
            </li>
            <li class="menu-item">
                <span class="menu-link px-2 text-muted">PHP {{ phpversion() }}</span>
            </li>
        </ul>
    </div>
</div>
