@extends('layouts.cpanel.app')

@section('title', ($item ? 'Edit' : 'Upload') . ' Video')
@section('page_title', ($item ? 'Edit' : 'Upload') . ' Video')
@section('page_subtitle', 'MP4, WebM, AVI, MOV video upload')

@section('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<style>
    .filepond--root { margin-bottom: 0; }
    .video-preview { border-radius: 12px; overflow: hidden; background: #000; }
    .video-preview video { width: 100%; max-height: 300px; }
</style>
@endsection

@section('content')
<form id="saveForm" enctype="multipart/form-data">
    @csrf
    @if($item) <input type="hidden" name="id" value="{{ $item->id }}"> @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom-0 py-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('developer.media.videos.index') }}" class="btn btn-sm btn-outline-secondary me-3"><i class="bi bi-arrow-left me-1"></i>Back</a>
                <h5 class="fw-bold text-dark mb-0">{{ $item ? 'Edit Video' : 'Upload Video' }}</h5>
                <div class="ms-auto">
                    <button type="submit" class="btn btn-sm btn-danger px-4"><i class="bi bi-check-lg me-1"></i>{{ $item ? 'Update' : 'Upload' }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            {{-- Video Upload --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-camera-video me-2 text-danger"></i>Video File</h6>
                </div>
                <div class="card-body">
                    @if($item)
                    <div class="video-preview mb-3">
                        <video controls>
                            <source src="{{ $item->file_url }}" type="video/{{ $item->type }}">
                        </video>
                    </div>
                    <p class="text-center"><small class="text-muted">{{ $item->original_name }} &middot; {{ $item->file_size_formatted }}</small></p>
                    <hr><small class="text-muted d-block mb-2">Upload a new video to replace:</small>
                    @endif
                    <input type="file" name="video" id="videoInput">
                    <div class="_laravel_error" data-field="video"></div>
                    <div class="mt-3 p-3 bg-light rounded-3">
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Accepted: MP4, WebM, AVI, MOV (max 100MB)</small>
                    </div>
                </div>
            </div>

            {{-- Thumbnail Upload --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-image me-2 text-danger"></i>Thumbnail (Optional)</h6>
                </div>
                <div class="card-body">
                    @if($item && $item->thumbnail)
                    <div class="text-center mb-3">
                        <img src="{{ $item->thumbnail_url }}" class="rounded shadow-sm" style="max-width:100%;max-height:200px;">
                    </div>
                    @endif
                    <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*">
                    <div class="_laravel_error" data-field="thumbnail"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-card-text me-2 text-danger"></i>Video Details</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ $item->title ?? '' }}" placeholder="Video title">
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
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="{{ asset('modules/media/js/videos/save.js') }}"></script>
@endsection
