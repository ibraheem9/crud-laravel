@extends('layouts.cpanel.app')

@section('title', ($item ? 'Edit' : 'Upload') . ' Archive')
@section('page_title', ($item ? 'Edit' : 'Upload') . ' Archive')
@section('page_subtitle', 'ZIP, RAR, 7z, TAR archive upload')

@section('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<style>.filepond--root { margin-bottom: 0; }</style>
@endsection

@section('content')
<form id="saveForm" enctype="multipart/form-data">
    @csrf
    @if($item) <input type="hidden" name="id" value="{{ $item->id }}"> @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom-0 py-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('developer.media.archives.index') }}" class="btn btn-sm btn-outline-secondary me-3"><i class="bi bi-arrow-left me-1"></i>Back</a>
                <h5 class="fw-bold text-dark mb-0">{{ $item ? 'Edit Archive' : 'Upload Archive' }}</h5>
                <div class="ms-auto">
                    <button type="submit" class="btn btn-sm btn-warning px-4"><i class="bi bi-check-lg me-1"></i>{{ $item ? 'Update' : 'Upload' }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-cloud-upload me-2 text-warning"></i>Archive Upload</h6>
                </div>
                <div class="card-body">
                    @if($item)
                    <div class="text-center p-4 bg-light rounded-3 mb-3">
                        <i class="bi bi-file-earmark-zip text-warning" style="font-size:3rem;"></i>
                        <p class="fw-semibold mb-1 mt-2">{{ $item->original_name }}</p>
                        <small class="text-muted">{{ $item->file_size_formatted }} &middot; {{ strtoupper($item->type) }}</small>
                        <div class="mt-2">
                            <a href="{{ route('developer.media.archives.download', $item->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-download me-1"></i>Download</a>
                        </div>
                    </div>
                    <hr><small class="text-muted d-block mb-2">Upload a new file to replace:</small>
                    @endif
                    <input type="file" name="archive" id="archiveInput">
                    <div class="_laravel_error" data-field="archive"></div>
                    <div class="mt-3 p-3 bg-light rounded-3">
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Accepted: ZIP, RAR, 7z, TAR, GZ (max 50MB)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-card-text me-2 text-warning"></i>Archive Details</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ $item->title ?? '' }}" placeholder="Archive title">
                        <div class="_laravel_error" data-field="title"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Optional description...">{{ $item->description ?? '' }}</textarea>
                        <div class="_laravel_error" data-field="description"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="{{ asset('modules/media/js/archives/save.js') }}"></script>
@endsection
