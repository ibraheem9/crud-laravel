@extends('layouts.cpanel.app')
@section('title', ($item ? 'Edit' : 'Upload') . ' Audio')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                    {{ $item ? 'Edit Audio' : 'Upload Audio' }}
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('developer.media.audios.index') }}" class="btn btn-sm btn-light">
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
<style>.filepond--root { margin-bottom: 0; }</style>
@endsection

@section('content')
    <form id="saveForm" enctype="multipart/form-data">
        @csrf
        @if($item) <input type="hidden" name="id" value="{{ $item->id }}"> @endif

        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="row g-5 g-xl-10">
                {{-- Left: Audio Upload --}}
                <div class="col-xl-5">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title"><h2>Audio Upload</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            @if($item)
                            <div class="border border-dashed border-gray-300 rounded p-6 text-center mb-7">
                                <i class="bi bi-music-note-beamed text-primary d-block mb-3" style="font-size:3rem;"></i>
                                <span class="text-dark fw-bolder d-block fs-6">{{ $item->original_name }}</span>
                                <span class="text-muted d-block fs-7 mt-1">{{ $item->file_size_formatted }}</span>
                                <div class="mt-3">
                                    <audio controls class="w-100" style="max-width:300px;">
                                        <source src="{{ $item->file_url }}" type="audio/{{ $item->type }}">
                                    </audio>
                                </div>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <span class="text-muted fs-7 d-block mb-3">Upload a new file to replace:</span>
                            @endif

                            <div class="_input_group fv-row mb-2">
                                <input type="file" name="audio" id="audioInput">
                                <div class="_laravel_error text-danger mt-2"></div>
                            </div>

                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mt-5">
                                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                    <i class="bi bi-info-circle-fill text-primary fs-3"></i>
                                </span>
                                <div class="d-flex flex-stack flex-grow-1">
                                    <div class="fw-bold">
                                        <div class="fs-7 text-gray-700">Accepted: MP3, WAV, OGG, AAC, FLAC (max 30MB)</div>
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
                            <div class="card-title"><h2>Audio Details</h2></div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="_input_group fv-row mb-7">
                                <label class="required fw-bold fs-6 mb-2">Title</label>
                                <input type="text" name="title" class="form-control form-control-solid"
                                       value="{{ $item->title ?? '' }}" placeholder="Audio title">
                                <div class="_laravel_error text-danger mt-1"></div>
                            </div>
                            <div class="_input_group fv-row mb-7">
                                <label class="fw-bold fs-6 mb-2">Artist</label>
                                <input type="text" name="artist" class="form-control form-control-solid"
                                       value="{{ $item->artist ?? '' }}" placeholder="Artist name (optional)">
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
            </div>
        </div>
    </form>
@endsection

@section('script')
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="{{ asset('modules/media/js/audios/save.js') }}"></script>
@endsection
