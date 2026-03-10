@extends('layouts.cpanel.app')

@section('title', 'Single Image CRUD')
@section('page_title', 'Single Image CRUD')
@section('page_subtitle', 'Upload, edit & manage single images with Doka editor')

@section('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<link href="{{ asset('vendor/doka/doka.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="card shadow-sm border-0">
    {{-- Toolbar --}}
    <div class="card-header bg-white border-bottom-0 py-4">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <h5 class="fw-bold text-dark mb-0 me-3">
                <i class="bi bi-image text-primary me-2"></i>Images
            </h5>
            <span class="badge bg-light text-dark border px-3 py-2 fw-normal" id="totalCount">Total: 0</span>
            <div class="position-relative ms-2">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" id="searchInput" class="form-control form-control-sm ps-5" placeholder="Type to search" style="min-width:200px;">
            </div>
            <div class="ms-auto d-flex gap-2">
                <button class="btn btn-sm btn-outline-danger d-none" id="btnMultiDelete" onclick="multiDelete()">
                    <i class="bi bi-trash"></i> Delete Selected
                </button>
                <button class="btn btn-sm btn-outline-secondary" onclick="reloadDatatable()">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <a href="{{ route('developer.media.images.save') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>Add New
                </a>
            </div>
        </div>
    </div>

    {{-- DataTable --}}
    <div class="card-body p-0">
        <table id="dataTable" class="table table-hover align-middle mb-0" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th width="40"><input type="checkbox" class="form-check-input" id="checkAll"></th>
                    <th width="50">#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Alt Text</th>
                    <th width="100">Status</th>
                    <th width="120">Created</th>
                    <th width="140">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Doka Image Editor Modal --}}
<div class="modal fade" id="dokaEditorModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Image Editor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0" style="min-height:500px;">
                <div id="dokaEditorContainer"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="{{ asset('vendor/doka/doka.min.js') }}"></script>
<script src="{{ asset('modules/media/js/images/datatable.js') }}"></script>
@endsection
