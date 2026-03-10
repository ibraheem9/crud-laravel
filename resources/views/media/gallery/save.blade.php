@extends('layouts.cpanel.app')

@section('title', ($item ? 'Edit' : 'New') . ' Gallery')
@section('page_title', ($item ? 'Edit' : 'Create') . ' Gallery')
@section('page_subtitle', 'Multiple image upload with FilePond & drag-drop sorting')

@section('styles')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<style>
    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; }
    .gallery-item {
        position: relative; border-radius: 12px; overflow: hidden;
        border: 2px solid #e9ecef; transition: all 0.3s; cursor: grab;
    }
    .gallery-item:hover { border-color: #6366f1; box-shadow: 0 4px 12px rgba(99,102,241,0.15); }
    .gallery-item img { width: 100%; height: 160px; object-fit: cover; }
    .gallery-item .item-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5); display: flex; align-items: center;
        justify-content: center; gap: 8px; opacity: 0; transition: opacity 0.3s;
    }
    .gallery-item:hover .item-overlay { opacity: 1; }
    .gallery-item .item-order {
        position: absolute; top: 8px; left: 8px;
        background: rgba(99,102,241,0.9); color: #fff; border-radius: 50%;
        width: 28px; height: 28px; display: flex; align-items: center;
        justify-content: center; font-size: 12px; font-weight: 600;
    }
    .gallery-item .item-caption {
        padding: 8px 10px; background: #f8f9fa; font-size: 12px;
    }
    .sortable-ghost { opacity: 0.4; }
    .filepond--root { margin-bottom: 0; }
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
                <a href="{{ route('developer.media.gallery.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
                <h5 class="fw-bold text-dark mb-0">{{ $item ? 'Edit Gallery' : 'Create Gallery' }}</h5>
                <div class="ms-auto">
                    <button type="submit" class="btn btn-sm btn-success px-4">
                        <i class="bi bi-check-lg me-1"></i>{{ $item ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left: Gallery Info --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-success"></i>Gallery Info</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ $item->title ?? '' }}" placeholder="Gallery title">
                        <div class="_laravel_error" data-field="title"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Optional description...">{{ $item->description ?? '' }}</textarea>
                        <div class="_laravel_error" data-field="description"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Images --}}
        <div class="col-lg-8">
            {{-- Upload New Images --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-cloud-upload me-2 text-success"></i>Upload Images</h6>
                </div>
                <div class="card-body">
                    <input type="file" name="images[]" id="galleryInput" multiple accept="image/*">
                    <div class="_laravel_error" data-field="images"></div>
                    <div class="mt-2 p-3 bg-light rounded-3">
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Upload multiple images at once. Max 10MB each. Drag & drop supported.</small>
                    </div>
                </div>
            </div>

            {{-- Existing Images (Edit mode) --}}
            @if($item && $item->items->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex align-items-center">
                    <h6 class="fw-bold mb-0"><i class="bi bi-grid me-2 text-success"></i>Gallery Images</h6>
                    <span class="badge bg-success ms-2">{{ $item->items->count() }}</span>
                    <small class="text-muted ms-auto"><i class="bi bi-arrows-move me-1"></i>Drag to reorder</small>
                </div>
                <div class="card-body">
                    <div class="gallery-grid" id="galleryGrid">
                        @foreach($item->items as $index => $galleryItem)
                        <div class="gallery-item" data-id="{{ $galleryItem->id }}">
                            <span class="item-order">{{ $index + 1 }}</span>
                            <img src="{{ $galleryItem->image_url }}" alt="{{ $galleryItem->caption }}">
                            <div class="item-overlay">
                                <button type="button" class="btn btn-sm btn-light" onclick="editCaption({{ $galleryItem->id }}, '{{ addslashes($galleryItem->caption) }}')">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeGalleryItem({{ $galleryItem->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            @if($galleryItem->caption)
                            <div class="item-caption text-truncate">{{ $galleryItem->caption }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="{{ asset('modules/media/js/gallery/save.js') }}"></script>
@endsection
