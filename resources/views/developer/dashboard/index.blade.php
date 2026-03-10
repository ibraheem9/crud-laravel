@extends('layouts.cpanel.app')
@section('title', 'Dashboard')
@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Dashboard
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <span class="text-muted fs-7 fw-bold mt-2">Developer Reference</span>
                </h1>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!--begin::Row - Stats-->
    <div class="row g-5 g-xl-8 mb-8">
        <div class="col-xl-4">
            <a href="{{ url('/developer/simpleCrud') }}" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-window-stack text-white fs-2hx"></i>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">Simple CRUD</div>
                    <div class="fw-bold text-white opacity-75">Modal-based create/edit with DataTable</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="{{ url('/developer/advancedCrud') }}" class="card bg-info hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-layout-text-window-reverse text-white fs-2hx"></i>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">Advanced CRUD</div>
                    <div class="fw-bold text-white opacity-75">Page-based form with all input types</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="{{ url('/developer/crudWithSort') }}" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-arrow-down-up text-white fs-2hx"></i>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">CRUD with Sort</div>
                    <div class="fw-bold text-white opacity-75">Drag & drop sortable items</div>
                </div>
            </a>
        </div>
    </div>
    <!--end::Row-->

    <!--begin::Row - Media CRUDs-->
    <div class="row g-5 g-xl-8 mb-8">
        <div class="col-xl-4">
            <a href="{{ url('/developer/media/images') }}" class="card hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-image text-success fs-2hx"></i>
                    <div class="text-dark fw-bolder fs-2 mb-2 mt-5">Single Image</div>
                    <div class="fw-bold text-muted">FilePond + Doka editor integration</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="{{ url('/developer/media/gallery') }}" class="card hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-images text-danger fs-2hx"></i>
                    <div class="text-dark fw-bolder fs-2 mb-2 mt-5">Image Gallery</div>
                    <div class="fw-bold text-muted">Multiple images with sortable gallery</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="{{ url('/developer/media/documents') }}" class="card hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-file-earmark-text text-primary fs-2hx"></i>
                    <div class="text-dark fw-bolder fs-2 mb-2 mt-5">Documents</div>
                    <div class="fw-bold text-muted">PDF, Word, Excel, PowerPoint</div>
                </div>
            </a>
        </div>
    </div>
    <!--end::Row-->

    <!--begin::Row - More Media-->
    <div class="row g-5 g-xl-8 mb-8">
        <div class="col-xl-4">
            <a href="{{ url('/developer/media/archives') }}" class="card hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-file-earmark-zip text-dark fs-2hx"></i>
                    <div class="text-dark fw-bolder fs-2 mb-2 mt-5">Archives</div>
                    <div class="fw-bold text-muted">ZIP & RAR file management</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="{{ url('/developer/media/audios') }}" class="card hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-music-note-beamed text-info fs-2hx"></i>
                    <div class="text-dark fw-bolder fs-2 mb-2 mt-5">Audio</div>
                    <div class="fw-bold text-muted">Sound files with inline player</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="{{ url('/developer/media/videos') }}" class="card hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="bi bi-camera-video text-warning fs-2hx"></i>
                    <div class="text-dark fw-bolder fs-2 mb-2 mt-5">Video</div>
                    <div class="fw-bold text-muted">Video upload with thumbnail</div>
                </div>
            </a>
        </div>
    </div>
    <!--end::Row-->

    <!--begin::Row - Documentation-->
    <div class="card mb-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Documentation</span>
                <span class="text-muted mt-1 fw-bold fs-7">Developer guides and references</span>
            </h3>
        </div>
        <div class="card-body py-3">
            <div class="row g-5">
                <div class="col-md-4">
                    <a href="{{ url('/developer/docs/php-helper') }}" class="d-flex align-items-center bg-light-primary rounded p-5 mb-5">
                        <i class="bi bi-filetype-php text-primary fs-2hx me-5"></i>
                        <div class="flex-grow-1 me-2">
                            <span class="fw-bolder text-gray-800 fs-6">PHP Helpers</span>
                            <span class="text-muted fw-bold d-block">ApiHelper, FilesHelper, MainHelper</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('/developer/docs/js-helper') }}" class="d-flex align-items-center bg-light-info rounded p-5 mb-5">
                        <i class="bi bi-filetype-js text-info fs-2hx me-5"></i>
                        <div class="flex-grow-1 me-2">
                            <span class="fw-bolder text-gray-800 fs-6">JS Helpers (I7)</span>
                            <span class="text-muted fw-bold d-block">helperForm, helperSwal, helperConfirm</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('/developer/docs/datatable') }}" class="d-flex align-items-center bg-light-success rounded p-5 mb-5">
                        <i class="bi bi-table text-success fs-2hx me-5"></i>
                        <div class="flex-grow-1 me-2">
                            <span class="fw-bolder text-gray-800 fs-6">DataTable Guide</span>
                            <span class="text-muted fw-bold d-block">Yajra server-side DataTables</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('/developer/docs/ajax') }}" class="d-flex align-items-center bg-light-warning rounded p-5 mb-5">
                        <i class="bi bi-arrow-repeat text-warning fs-2hx me-5"></i>
                        <div class="flex-grow-1 me-2">
                            <span class="fw-bolder text-gray-800 fs-6">AJAX Patterns</span>
                            <span class="text-muted fw-bold d-block">Form submission, status toggle</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('/developer/docs/inputs') }}" class="d-flex align-items-center bg-light-danger rounded p-5 mb-5">
                        <i class="bi bi-input-cursor-text text-danger fs-2hx me-5"></i>
                        <div class="flex-grow-1 me-2">
                            <span class="fw-bolder text-gray-800 fs-6">Input Components</span>
                            <span class="text-muted fw-bold d-block">All input types reference</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('/developer/docs/layout') }}" class="d-flex align-items-center bg-light-dark rounded p-5 mb-5">
                        <i class="bi bi-layout-sidebar text-dark fs-2hx me-5"></i>
                        <div class="flex-grow-1 me-2">
                            <span class="fw-bolder text-gray-800 fs-6">Layout Guide</span>
                            <span class="text-muted fw-bold d-block">Metronic 8 layout structure</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
