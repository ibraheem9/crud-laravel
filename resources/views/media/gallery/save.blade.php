@extends('layouts.cpanel.app')
@section('title', ($item ? 'Edit' : 'New') . ' Gallery')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                    {{ $item ? 'Edit Gallery' : 'Create Gallery' }}
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('developer.media.gallery.index') }}" class="btn btn-sm btn-light">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <button type="submit" form="saveForm" class="btn btn-sm btn-primary">
                    <i class="bi bi-check-lg me-1"></i> {{ $item ? 'Update' : 'Save' }}
                </button>
            </div>
        </div>
    </div>
@endsection

@section('style')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<style>
    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 12px; }
    .gallery-item {
        position: relative; border-radius: 0.475rem; overflow: hidden;
        border: 1px dashed var(--bs-gray-300); transition: all 0.3s; cursor: grab;
    }
    .gallery-item:hover { border-color: var(--bs-primary); }
    .gallery-item img { width: 100%; height: 140px; object-fit: cover; }
    .gallery-item .item-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5); display: flex; align-items: center;
        justify-content: center; gap: 8px; opacity: 0; transition: opacity 0.3s;
    }
    .gallery-item:hover .item-overlay { opacity: 1; }
    .gallery-item .item-order {
        position: absolute; top: 6px; left: 6px;
        background: var(--bs-primary); color: #fff; border-radius: 50%;
        width: 24px; height: 24px; display: flex; align-items: center;
        justify-content: center; font-size: 11px; font-weight: 700;
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

        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="row g-5 g-xl-10">
                {{-- Left: Gallery Info --}}
                <div class="col-xl-4">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title"><h2>Gallery Info</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="_input_group fv-row mb-7">
                                <label class="required fw-bold fs-6 mb-2">Title</label>
                                <input type="text" name="title" class="form-control form-control-solid"
                                       value="{{ $item->title ?? '' }}" placeholder="Gallery title">
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                            <div class="_input_group fv-row mb-7">
                                <label class="fw-bold fs-6 mb-2">Description</label>
                                <textarea name="description" class="form-control form-control-solid" rows="5"
                                          placeholder="Optional description...">{{ $item->description ?? '' }}</textarea>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Images --}}
                <div class="col-xl-8">
                    <div class="card card-flush py-4 mb-5">
                        <div class="card-header">
                            <div class="card-title"><h2>Upload Images</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="_input_group fv-row mb-2">
                                <input type="file" name="images[]" id="galleryInput" multiple accept="image/*">
                                <div class="_laravel_error text-danger mt-2"></div>
                            </div>
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mt-4">
                                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                    <i class="bi bi-info-circle-fill text-primary fs-3"></i>
                                </span>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-bold">
                                        <div class="fs-6 text-gray-700">Upload multiple images at once. Max 10MB each. Drag & drop supported.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($item && $item->items->count() > 0)
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Gallery Images</h2>
                                <span class="badge badge-primary ms-3">{{ $item->items->count() }}</span>
                            </div>
                            <div class="card-toolbar">
                                <span class="text-muted fs-7"><i class="bi bi-arrows-move me-1"></i>Drag to reorder</span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="{{ asset('modules/media/js/gallery/save.js') }}"></script>
@endsection
