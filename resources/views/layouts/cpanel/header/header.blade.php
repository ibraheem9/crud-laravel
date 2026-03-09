<div class="header-bar">
    <button class="btn btn-sm btn-icon d-lg-none me-3" onclick="toggleSidebar()">
        <i class="bi bi-list fs-4"></i>
    </button>
    <div class="d-flex align-items-center">
        <span class="page-title">@yield('title', 'Dashboard')</span>
    </div>
    <div class="ms-auto d-flex align-items-center gap-2 header-badges">
        <span class="badge" style="background:#eff6ff;color:#3b82f6;">
            <i class="bi bi-box me-1"></i> Laravel {{ app()->version() }}
        </span>
        <span class="badge" style="background:#f0fdf4;color:#16a34a;">
            <i class="bi bi-filetype-php me-1"></i> PHP {{ phpversion() }}
        </span>
        <a href="https://github.com/ibraheem9/crud-laravel" target="_blank"
           class="badge text-decoration-none" style="background:#f1f5f9;color:#334155;">
            <i class="bi bi-github me-1"></i> GitHub
        </a>
    </div>
</div>
