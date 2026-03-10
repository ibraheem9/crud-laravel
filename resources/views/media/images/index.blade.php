@extends('layouts.cpanel.app')
@section('title', 'Single Image CRUD')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Single Image CRUD
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <span class="text-muted fs-7 fw-bold mt-2" id="totalCount">Total: 0</span>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button class="btn btn-sm btn-danger d-none" id="btnMultiDelete" onclick="multiDelete()">
                    <i class="bi bi-trash me-1"></i> Delete Selected
                </button>
                <a href="{{ route('developer.media.images.save') }}" class="btn btn-sm btn-primary">
                    <span class="svg-icon svg-icon-2"><i class="bi bi-plus-lg"></i></span> Upload Image
                </a>
            </div>
        </div>
    </div>
@endsection

@section('style')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<link href="{{ asset('vendor/doka/doka.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="bi bi-search fs-5 text-gray-500"></i>
                    </span>
                    <input type="text" id="searchInput"
                           class="form-control form-control-solid w-250px ps-14" placeholder="Search images..."/>
                </div>
            </div>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-icon btn-active-light-primary" title="Refresh" onclick="reloadDatatable()">
                    <i class="bi bi-arrow-clockwise fs-4"></i>
                </button>
            </div>
        </div>
        <div class="card-body py-4">
            <table id="dataTable" class="table align-middle table-row-dashed fs-6 gy-5" style="width:100%">
                <thead>
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" id="checkAll"/>
                        </div>
                    </th>
                    <th class="min-w-50px">#</th>
                    <th class="min-w-80px">Image</th>
                    <th class="min-w-125px">Title</th>
                    <th class="min-w-125px">Alt Text</th>
                    <th class="min-w-80px">Status</th>
                    <th class="min-w-100px">Created</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold"></tbody>
            </table>
        </div>
    </div>

    {{-- Doka Image Editor Modal --}}
    <div class="modal fade" id="dokaEditorModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bolder">Image Editor</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </div>
                </div>
                <div class="modal-body p-0" style="min-height:500px;">
                    <div id="dokaEditorContainer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="{{ asset('vendor/doka/doka.min.js') }}"></script>
<script src="{{ asset('modules/media/js/images/datatable.js') }}"></script>
@endsection
