@extends('layouts.cpanel.app')
@section('title', 'CRUD with Sort')

@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Plan Durations
                    <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                    <span class="text-muted fs-7 fw-bold mt-2" id="total_count">Total: —</span>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button id="sort_items_btn" class="btn btn-sm btn-light-info">
                    <span class="svg-icon svg-icon-5 me-1">
                        <i class="bi bi-sort-numeric-down"></i>
                    </span>
                    Sort Items
                </button>
                <button id="add_duration_btn" class="btn btn-sm btn-primary">
                    <span class="svg-icon svg-icon-2">
                        <i class="bi bi-plus-lg"></i>
                    </span>
                    Add New
                </button>
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
                    <input type="text" data-table-filter="search"
                           class="form-control form-control-solid w-250px ps-14" placeholder="Search durations..."/>
                </div>
            </div>
            <div class="card-toolbar">
                <button class="btn btn-sm btn-icon btn-active-light-primary" title="Refresh" onclick="dt.ajax.reload()">
                    <i class="bi bi-arrow-clockwise fs-4"></i>
                </button>
            </div>
        </div>
        <div class="card-body py-4">
            <table id="durations_datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-25px"></th>
                    <th class="min-w-50px">Order</th>
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-80px">Days</th>
                    <th class="min-w-125px">Created</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold"></tbody>
            </table>
        </div>
    </div>

    {{-- Save Modal --}}
    @include('developer.crud_with_sort.save')

    {{-- Sort Modal --}}
    @include('developer.crud_with_sort.sort_modal')
@endsection

@section('script')
    <script src="{{ asset('modules/developer/js/crud_with_sort/datatable.js') }}"></script>
    <script src="{{ asset('modules/developer/js/crud_with_sort/save.js') }}"></script>
    <script src="{{ asset('modules/developer/js/crud_with_sort/sort_items.js') }}"></script>
@endsection
