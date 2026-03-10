@extends('layouts.cpanel.app')

@section('title', ($item ? 'Edit' : 'Upload') . ' Document')
@section('page_title', ($item ? 'Edit' : 'Upload') . ' Document')
@section('page_subtitle', 'PDF, Word, Excel, PowerPoint upload with FilePond')

@section('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<style>
    .filepond--root { margin-bottom: 0; }
    .current-file-card {
        border: 2px dashed #dee2e6; border-radius: 12px; padding: 24px;
        text-align: center; background: #f8f9fa;
    }
    .file-type-icon { font-size: 3rem; margin-bottom: 12px; }
    .file-type-pdf { color: #dc3545; }
    .file-type-word { color: #0d6efd; }
    .file-type-excel { color: #198754; }
    .file-type-powerpoint { color: #fd7e14; }
    .file-type-other { color: #6c757d; }
</style>
@endsection

@section('content')
<form id="saveForm" enctype="multipart/form-data">
    @csrf
    @if($item)
        <input type="hidden" name="id" value="{{ $item->id }}">
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom-0 py-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('developer.media.documents.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
                <h5 class="fw-bold text-dark mb-0">{{ $item ? 'Edit Document' : 'Upload Document' }}</h5>
                <div class="ms-auto">
                    <button type="submit" class="btn btn-sm btn-info text-white px-4">
                        <i class="bi bi-check-lg me-1"></i>{{ $item ? 'Update' : 'Upload' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-cloud-upload me-2 text-info"></i>File Upload</h6>
                </div>
                <div class="card-body">
                    @if($item)
                    <div class="current-file-card mb-3" id="currentFileCard">
                        <i class="bi bi-file-earmark-{{ $item->type === 'pdf' ? 'pdf' : ($item->type === 'word' ? 'word' : ($item->type === 'excel' ? 'excel' : ($item->type === 'powerpoint' ? 'ppt' : 'text'))) }} file-type-icon file-type-{{ $item->type }}"></i>
                        <p class="fw-semibold mb-1">{{ $item->original_name }}</p>
                        <small class="text-muted d-block">{{ $item->file_size_formatted }} &middot; {{ strtoupper($item->type) }}</small>
                        <a href="{{ route('developer.media.documents.download', $item->id) }}" class="btn btn-sm btn-outline-info mt-2">
                            <i class="bi bi-download me-1"></i>Download
                        </a>
                    </div>
                    <hr>
                    <small class="text-muted d-block mb-2">Upload a new file to replace:</small>
                    @endif

                    <input type="file" name="document" id="documentInput">
                    <div class="_laravel_error" data-field="document"></div>

                    <div class="mt-3 p-3 bg-light rounded-3">
                        <small class="text-muted d-block mb-1"><i class="bi bi-info-circle me-1"></i>Accepted Formats:</small>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="badge bg-danger-subtle text-danger">PDF</span>
                            <span class="badge bg-primary-subtle text-primary">Word (.doc, .docx)</span>
                            <span class="badge bg-success-subtle text-success">Excel (.xls, .xlsx)</span>
                            <span class="badge bg-warning-subtle text-warning">PowerPoint (.ppt, .pptx)</span>
                        </div>
                        <small class="text-muted d-block mt-2">Max size: 20MB</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-card-text me-2 text-info"></i>Document Details</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ $item->title ?? '' }}" placeholder="Document title">
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
<script src="{{ asset('modules/media/js/documents/save.js') }}"></script>
@endsection
