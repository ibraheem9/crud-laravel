@extends('layouts.cpanel.app')

@section('title', 'Image Gallery CRUD')
@section('page_title', 'Image Gallery CRUD')
@section('page_subtitle', 'Multiple image upload with drag & drop sorting')

@section('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('content')
<div class="card shadow-sm border-0">
    {{-- Toolbar --}}
    <div class="card-header bg-white border-bottom-0 py-4">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <h5 class="fw-bold text-dark mb-0 me-3">
                <i class="bi bi-images text-success me-2"></i>Galleries
            </h5>
            <span class="badge bg-light text-dark border px-3 py-2 fw-normal" id="totalCount">Total: 0</span>
            <div class="position-relative ms-2">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" id="searchInput" class="form-control form-control-sm ps-5" placeholder="Type to search" style="min-width:200px;">
            </div>
            <div class="ms-auto d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary" onclick="reloadDatatable()">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <a href="{{ route('developer.media.gallery.save') }}" class="btn btn-sm btn-success">
                    <i class="bi bi-plus-lg me-1"></i>New Gallery
                </a>
            </div>
        </div>
    </div>

    {{-- DataTable --}}
    <div class="card-body p-0">
        <table id="dataTable" class="table table-hover align-middle mb-0" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th width="50">#</th>
                    <th width="80">Cover</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="80">Images</th>
                    <th width="100">Status</th>
                    <th width="120">Created</th>
                    <th width="140">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('modules/media/js/gallery/datatable.js') }}"></script>
@endsection
