@extends('layouts.cpanel.app')

@section('title', ($item ? 'Edit' : 'New') . ' Image')
@section('page_title', ($item ? 'Edit' : 'Upload New') . ' Image')
@section('page_subtitle', 'Single image upload with FilePond & Doka editor')

@section('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<link href="{{ asset('vendor/doka/doka.min.css') }}" rel="stylesheet">
<style>
    .filepond--root { margin-bottom: 0; }
    .image-preview-card { position: relative; border-radius: 12px; overflow: hidden; }
    .image-preview-card img { width: 100%; height: 300px; object-fit: cover; }
    .image-preview-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.4); display: flex; align-items: center;
        justify-content: center; gap: 10px; opacity: 0; transition: opacity 0.3s;
    }
    .image-preview-card:hover .image-preview-overlay { opacity: 1; }
    .doka-editor-container { width: 100%; height: 500px; }
</style>
@endsection

@section('content')
<form id="saveForm" enctype="multipart/form-data">
    @csrf
    @if($item)
        <input type="hidden" name="id" value="{{ $item->id }}">
    @endif

    {{-- Toolbar --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom-0 py-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('developer.media.images.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
                <h5 class="fw-bold text-dark mb-0">{{ $item ? 'Edit Image' : 'Upload New Image' }}</h5>
                <div class="ms-auto">
                    <button type="submit" class="btn btn-sm btn-primary px-4">
                        <i class="bi bi-check-lg me-1"></i>{{ $item ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left: Image Upload --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-cloud-upload me-2 text-primary"></i>Image Upload</h6>
                </div>
                <div class="card-body">
                    @if($item && $item->image)
                        <div class="image-preview-card mb-3" id="currentImagePreview">
                            <img src="{{ $item->image_url }}" alt="{{ $item->alt_text }}" id="previewImg">
                            <div class="image-preview-overlay">
                                <button type="button" class="btn btn-sm btn-light" onclick="openDokaEditor()">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeCurrentImage()">
                                    <i class="bi bi-trash me-1"></i>Remove
                                </button>
                            </div>
                        </div>
                    @endif

                    <div id="filepondWrapper">
                        <input type="file" name="image" id="imageInput" accept="image/*">
                    </div>
                    <div class="_laravel_error" data-field="image"></div>

                    <div class="mt-3 p-3 bg-light rounded-3">
                        <small class="text-muted d-block mb-1"><i class="bi bi-info-circle me-1"></i>Upload Guidelines:</small>
                        <small class="text-muted d-block">Max size: 10MB | Formats: JPG, PNG, GIF, WebP</small>
                        <small class="text-muted d-block">Recommended: 1200x800px or larger</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Details --}}
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-card-text me-2 text-primary"></i>Image Details</h6>
                </div>
                <div class="card-body">
                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ $item->title ?? '' }}" placeholder="Enter image title">
                        <div class="_laravel_error" data-field="title"></div>
                    </div>

                    {{-- Alt Text --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alt Text <small class="text-muted">(SEO)</small></label>
                        <input type="text" name="alt_text" class="form-control" value="{{ $item->alt_text ?? '' }}" placeholder="Describe the image for accessibility">
                        <div class="form-text">Used for SEO and screen readers</div>
                        <div class="_laravel_error" data-field="alt_text"></div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Optional description...">{{ $item->description ?? '' }}</textarea>
                        <div class="_laravel_error" data-field="description"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Doka Editor Modal --}}
<div class="modal fade" id="dokaModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white py-2">
                <h6 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Image Editor (Crop, Filter, Adjust)</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div id="dokaEditorContainer" class="doka-editor-container"></div>
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
<script src="{{ asset('modules/media/js/images/save.js') }}"></script>
@endsection
