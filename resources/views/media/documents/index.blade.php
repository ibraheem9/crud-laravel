@extends('layouts.cpanel.app')

@section('title', 'Documents CRUD')
@section('page_title', 'Documents CRUD')
@section('page_subtitle', 'Upload & manage PDF, Word, Excel, PowerPoint files')

@section('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 py-4">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <h5 class="fw-bold text-dark mb-0 me-3">
                <i class="bi bi-file-earmark-text text-info me-2"></i>Documents
            </h5>
            <span class="badge bg-light text-dark border px-3 py-2 fw-normal" id="totalCount">Total: 0</span>
            <div class="position-relative ms-2">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" id="searchInput" class="form-control form-control-sm ps-5" placeholder="Type to search" style="min-width:200px;">
            </div>
            {{-- Type Filter --}}
            <select id="typeFilter" class="form-select form-select-sm" style="width:140px;">
                <option value="">All Types</option>
                <option value="pdf">PDF</option>
                <option value="word">Word</option>
                <option value="excel">Excel</option>
                <option value="powerpoint">PowerPoint</option>
            </select>
            <div class="ms-auto d-flex gap-2">
                <button class="btn btn-sm btn-outline-danger d-none" id="btnMultiDelete" onclick="multiDelete()">
                    <i class="bi bi-trash"></i> Delete Selected
                </button>
                <button class="btn btn-sm btn-outline-secondary" onclick="reloadDatatable()">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <a href="{{ route('developer.media.documents.save') }}" class="btn btn-sm btn-info text-white">
                    <i class="bi bi-plus-lg me-1"></i>Upload Document
                </a>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <table id="dataTable" class="table table-hover align-middle mb-0" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th width="40"><input type="checkbox" class="form-check-input" id="checkAll"></th>
                    <th width="50">#</th>
                    <th width="50">Type</th>
                    <th>Title</th>
                    <th>Original File</th>
                    <th width="100">Size</th>
                    <th width="100">Status</th>
                    <th width="120">Created</th>
                    <th width="160">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('modules/media/js/documents/datatable.js') }}"></script>
@endsection
