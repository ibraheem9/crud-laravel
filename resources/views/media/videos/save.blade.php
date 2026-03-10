@extends('layouts.cpanel.app')
@section('title', ($item ? 'Edit' : 'Upload') . ' Video')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                    {{ $item ? 'Edit Video' : 'Upload Video' }}
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('developer.media.videos.index') }}" class="btn btn-sm btn-light">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <button type="submit" form="saveForm" class="btn btn-sm btn-primary">
                    <i class="bi bi-check-lg me-1"></i> {{ $item ? 'Update' : 'Upload' }}
                </button>
            </div>
        </div>
    </div>
@endsection

@section('style')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<style>
    .filepond--root { margin-bottom: 0; }
    .video-preview { border-radius: 0.475rem; overflow: hidden; background: #000; }
    .video-preview video { width: 100%; max-height: 300px; }
</style>
@endsection

@section('content')
    <form id="saveForm" enctype="multipart/form-data">
        @csrf
        @if($item) <input type="hidden" name="id" value="{{ $item->id }}"> @endif

        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="row g-5 g-xl-10">
                {{-- Left: Video + Thumbnail Upload --}}
                <div class="col-xl-5">
                    <div class="card card-flush py-4 mb-5">
                        <div class="card-header">
                            <div class="card-title"><h2>Video File</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            @if($item)
                            <div class="video-preview mb-5">
                                <video controls>
                                    <source src="{{ $item->file_url }}" type="video/{{ $item->type }}">
                                </video>
                            </div>
                            <div class="text-center mb-5">
                                <span class="text-muted fs-7">{{ $item->original_name }} &middot; {{ $item->file_size_formatted }}</span>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <span class="text-muted fs-7 d-block mb-3">Upload a new video to replace:</span>
                            @endif

                            <div class="_input_group fv-row mb-2">
                                <input type="file" name="video" id="videoInput">
                                <div class="_laravel_error text-danger mt-2"></div>
                            </div>

                            <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6 mt-5">
                                <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                                    <i class="bi bi-info-circle-fill text-danger fs-3"></i>
                                </span>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-bold">
                                        <div class="fs-7 text-gray-700">Accepted: MP4, WebM, AVI, MOV (max 100MB)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title"><h2>Thumbnail</h2></div>
                            <div class="card-toolbar">
                                <span class="badge badge-light-info">Optional</span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            @if($item && $item->thumbnail)
                            <div class="text-center mb-5">
                                <img src="{{ $item->thumbnail_url }}" class="rounded mw-100" style="max-height:200px;">
                            </div>
                            @endif
                            <div class="_input_group fv-row">
                                <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*">
                                <div class="_laravel_error text-danger mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Details --}}
                <div class="col-xl-7">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title"><h2>Video Details</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="_input_group fv-row mb-7">
                                <label class="required fw-bold fs-6 mb-2">Title</label>
                                <input type="text" name="title" class="form-control form-control-solid"
                                       value="{{ $item->title ?? '' }}" placeholder="Video title">
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                            <div class="_input_group fv-row mb-7">
                                <label class="fw-bold fs-6 mb-2">Description</label>
                                <textarea name="description" class="form-control form-control-solid" rows="6"
                                          placeholder="Optional description...">{{ $item->description ?? '' }}</textarea>
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                        </div>
                    </div>
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
<script src="{{ asset('modules/media/js/videos/save.js') }}"></script>
@endsection
