@extends('layouts.cpanel.app')

@section('title', 'Video CRUD')
@section('page_title', 'Video CRUD')
@section('page_subtitle', 'Upload & manage video files with inline player')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 py-4">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <h5 class="fw-bold text-dark mb-0 me-3">
                <i class="bi bi-camera-video text-danger me-2"></i>Videos
            </h5>
            <span class="badge bg-light text-dark border px-3 py-2 fw-normal" id="totalCount">Total: 0</span>
            <div class="position-relative ms-2">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" id="searchInput" class="form-control form-control-sm ps-5" placeholder="Type to search" style="min-width:200px;">
            </div>
            <div class="ms-auto d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary" onclick="reloadDatatable()"><i class="bi bi-arrow-clockwise"></i></button>
                <a href="{{ route('developer.media.videos.save') }}" class="btn btn-sm btn-danger">
                    <i class="bi bi-plus-lg me-1"></i>Upload Video
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table id="dataTable" class="table table-hover align-middle mb-0" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th width="50">#</th>
                    <th width="160">Thumbnail</th>
                    <th>Title</th>
                    <th>Original File</th>
                    <th width="100">Size</th>
                    <th width="100">Status</th>
                    <th width="120">Created</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Video Preview Modal --}}
<div class="modal fade" id="videoPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-dark text-white py-2">
                <h6 class="modal-title" id="videoPreviewTitle">Video Preview</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="pauseVideo()"></button>
            </div>
            <div class="modal-body p-0 bg-black">
                <video id="videoPlayer" controls class="w-100" style="max-height:500px;"></video>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('modules/media/js/videos/datatable.js') }}"></script>
@endsection
