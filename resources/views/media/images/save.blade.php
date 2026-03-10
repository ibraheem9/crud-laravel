@extends('layouts.cpanel.app')
@section('title', ($item ? 'Edit' : 'New') . ' Image')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                    {{ $item ? 'Edit Image' : 'Upload New Image' }}
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <span class="text-muted fs-7 fw-bold mt-2">Single image with FilePond & Doka</span>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('developer.media.images.index') }}" class="btn btn-sm btn-light">
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
<link href="{{ asset('vendor/doka/doka.min.css') }}" rel="stylesheet">
<style>
    .filepond--root { margin-bottom: 0; }
    .image-preview-wrapper { position: relative; border-radius: 0.475rem; overflow: hidden; }
    .image-preview-wrapper img { width: 100%; height: 300px; object-fit: cover; }
    .image-preview-actions {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5); display: flex; align-items: center;
        justify-content: center; gap: 10px; opacity: 0; transition: opacity 0.3s;
    }
    .image-preview-wrapper:hover .image-preview-actions { opacity: 1; }
    .doka-editor-container { width: 100%; height: 500px; }
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
                {{-- Left: Image Upload --}}
                <div class="col-xl-5">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title"><h2>Image Upload</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            @if($item && $item->image)
                                <div class="image-preview-wrapper mb-5" id="currentImagePreview">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->alt_text }}" id="previewImg">
                                    <div class="image-preview-actions">
                                        <button type="button" class="btn btn-sm btn-light" onclick="openDokaEditor()">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeCurrentImage()">
                                            <i class="bi bi-trash me-1"></i>Remove
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <div class="_input_group fv-row mb-2" id="filepondWrapper">
                                <input type="file" name="image" id="imageInput" accept="image/*">
                                <div class="_laravel_error text-danger mt-2"></div>
                            </div>

                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mt-4">
                                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                    <i class="bi bi-info-circle-fill text-primary fs-3"></i>
                                </span>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-bold">
                                        <div class="fs-6 text-gray-700">
                                            Max size: 10MB | Formats: JPG, PNG, GIF, WebP<br>
                                            Recommended: 1200x800px or larger
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Details --}}
                <div class="col-xl-7">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title"><h2>Image Details</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            {{-- Title --}}
                            <div class="_input_group fv-row mb-7">
                                <label class="required fw-bold fs-6 mb-2">Title</label>
                                <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0"
                                       value="{{ $item->title ?? '' }}" placeholder="Enter image title">
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>

                            {{-- Alt Text --}}
                            <div class="_input_group fv-row mb-7">
                                <label class="fw-bold fs-6 mb-2">Alt Text <span class="fs-8 text-muted">(SEO)</span></label>
                                <input type="text" name="alt_text" class="form-control form-control-solid mb-3 mb-lg-0"
                                       value="{{ $item->alt_text ?? '' }}" placeholder="Describe the image for accessibility">
                                <div class="form-text">Used for SEO and screen readers</div>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>

                            {{-- Description --}}
                            <div class="_input_group fv-row mb-7">
                                <label class="fw-bold fs-6 mb-2">Description</label>
                                <textarea name="description" class="form-control form-control-solid" rows="5"
                                          placeholder="Optional description...">{{ $item->description ?? '' }}</textarea>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
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
                <div class="modal-header">
                    <h2 class="fw-bolder">Image Editor</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div id="dokaEditorContainer" class="doka-editor-container"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="{{ asset('vendor/doka/doka.min.js') }}"></script>
<script src="{{ asset('modules/media/js/images/save.js') }}"></script>
@endsection
