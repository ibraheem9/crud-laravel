@extends('layouts.cpanel.app')
@section('title', 'Advanced CRUD')
@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Advanced CRUD
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <span class="text-muted fs-7 fw-bold mt-2">Page Based</span>
                </h1>
            </div>
            <div class="d-flex align-items-center overflow-auto">
                <div class="position-relative my-1">
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ps-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <input type="text" data-table-filter="search" class="form-control form-control-sm form-control-solid w-150px ps-10" placeholder="Search"/>
                </div>
                <div class="bullet bg-secondary h-35px w-1px mx-6"></div>
                <div class="d-flex justify-content-end" data-table-toolbar="base">
                    <a href="{{ route('developer.advancedCrud.create') }}" class="btn btn-primary btn-sm">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
                            </svg>
                        </span>
                        Add New
                    </a>
                    <button type="button" class="btn btn-sm btn-icon btn-light-dark ms-3" onclick="dt.ajax.reload()">
                        <i class="la la-refresh fs-2"></i>
                    </button>
                </div>
                <div class="d-flex justify-content-end align-items-center d-none" data-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                        <span class="me-2" data-table-select="selected_count"></span>Selected
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" data-table-select="delete_selected">Delete Selected</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body pt-0">
            <table id="advanced_crud_datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" id="checkbox_id" data-kt-check="true"
                                   data-kt-check-target="#advanced_crud_datatable .form-check-input" value="1"/>
                        </div>
                    </th>
                    <th class="min-w-200px">Customer</th>
                    <th class="min-w-125px">Civil ID</th>
                    <th class="min-w-125px">Mobile</th>
                    <th class="min-w-80px">Type</th>
                    <th class="min-w-80px">Banned</th>
                    <th class="min-w-125px">Created At</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('style')
    <link href="{{ asset('cpanel/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"/>
@endsection
@section('script')
    <script src="{{ asset('cpanel/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('modules/developer/js/advanced_crud/datatable.js') }}"></script>
@endsection
