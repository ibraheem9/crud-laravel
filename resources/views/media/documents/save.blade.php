@extends('layouts.cpanel.app')
@section('title', ($item ? 'Edit' : 'Upload') . ' Document')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                    {{ $item ? 'Edit Document' : 'Upload Document' }}
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('developer.media.documents.index') }}" class="btn btn-sm btn-light">
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
<style>
    .filepond--root { margin-bottom: 0; }
    .file-type-icon { font-size: 3rem; }
    .file-type-pdf { color: #f1416c; }
    .file-type-word { color: #009ef7; }
    .file-type-excel { color: #50cd89; }
    .file-type-powerpoint { color: #ffc700; }
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
                {{-- Left: File Upload --}}
                <div class="col-xl-5">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title"><h2>File Upload</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            @if($item)
                            <div class="border border-dashed border-gray-300 rounded p-6 text-center mb-7">
                                <i class="bi bi-file-earmark-{{ $item->type === 'pdf' ? 'pdf' : ($item->type === 'word' ? 'word' : ($item->type === 'excel' ? 'excel' : 'ppt')) }} file-type-icon file-type-{{ $item->type }} d-block mb-3"></i>
                                <span class="text-dark fw-bolder d-block fs-6">{{ $item->original_name }}</span>
                                <span class="text-muted d-block fs-7 mt-1">{{ $item->file_size_formatted }} &middot; {{ strtoupper($item->type) }}</span>
                                <a href="{{ route('developer.media.documents.download', $item->id) }}" class="btn btn-sm btn-light-primary mt-3">
                                    <i class="bi bi-download me-1"></i>Download
                                </a>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <span class="text-muted fs-7 d-block mb-3">Upload a new file to replace:</span>
                            @endif

                            <div class="_input_group fv-row mb-2">
                                <input type="file" name="document" id="documentInput">
                                <div class="_laravel_error text-danger mt-2"></div>
                            </div>

                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mt-5">
                                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                    <i class="bi bi-info-circle-fill text-primary fs-3"></i>
                                </span>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-bold">
                                        <div class="fs-7 text-gray-700">
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                <span class="badge badge-light-danger">PDF</span>
                                                <span class="badge badge-light-info">Word</span>
                                                <span class="badge badge-light-success">Excel</span>
                                                <span class="badge badge-light-warning">PowerPoint</span>
                                            </div>
                                            Max size: 20MB
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Document Details --}}
                <div class="col-xl-7">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title"><h2>Document Details</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="_input_group fv-row mb-7">
                                <label class="required fw-bold fs-6 mb-2">Title</label>
                                <input type="text" name="title" class="form-control form-control-solid"
                                       value="{{ $item->title ?? '' }}" placeholder="Document title">
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
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="{{ asset('modules/media/js/documents/save.js') }}"></script>
@endsection
