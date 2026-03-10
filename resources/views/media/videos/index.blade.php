@extends('layouts.cpanel.app')
@section('title', 'Videos')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Videos
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <span class="text-muted fs-7 fw-bold mt-2" id="totalCount">Total: 0</span>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('developer.media.videos.save') }}" class="btn btn-sm btn-primary">
                    <span class="svg-icon svg-icon-2"><i class="bi bi-plus-lg"></i></span> Upload Video
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="bi bi-search fs-5 text-gray-500"></i>
                    </span>
                    <input type="text" id="searchInput"
                           class="form-control form-control-solid w-250px ps-14" placeholder="Search videos..."/>
                </div>
            </div>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-icon btn-active-light-primary" title="Refresh" onclick="reloadDatatable()">
                    <i class="bi bi-arrow-clockwise fs-4"></i>
                </button>
            </div>
        </div>
        <div class="card-body py-4">
            <table id="dataTable" class="table align-middle table-row-dashed fs-6 gy-5" style="width:100%">
                <thead>
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-50px">#</th>
                    <th class="min-w-100px">Thumbnail</th>
                    <th class="min-w-125px">Title</th>
                    <th class="min-w-100px">File Name</th>
                    <th class="min-w-80px">Size</th>
                    <th class="min-w-80px">Status</th>
                    <th class="min-w-100px">Created</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold"></tbody>
            </table>
        </div>
    </div>

    {{-- Video Preview Modal --}}
    <div class="modal fade" id="videoPreviewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoPreviewTitle">Video Preview</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" onclick="pauseVideo()">
                        <span class="svg-icon svg-icon-2x"><i class="bi bi-x-lg"></i></span>
                    </div>
                </div>
                <div class="modal-body p-0 bg-black">
                    <video id="videoPlayer" controls class="w-100" style="max-height:500px;"></video>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('modules/media/js/videos/datatable.js') }}"></script>
@endsection
