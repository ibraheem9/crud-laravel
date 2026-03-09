<div class="header-bar">
    <button class="btn btn-sm btn-icon d-lg-none me-3" onclick="document.getElementById('kt_aside').classList.toggle('show')">
        <i class="bi bi-list fs-4"></i>
    </button>
    <div class="d-flex align-items-center">
        <h6 class="mb-0 text-gray-700">@yield('title', 'Dashboard')</h6>
    </div>
    <div class="ms-auto d-flex align-items-center">
        <span class="badge bg-primary">Laravel {{ app()->version() }}</span>
        <span class="badge bg-success ms-2">PHP {{ phpversion() }}</span>
    </div>
</div>
