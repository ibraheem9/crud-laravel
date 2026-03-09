@extends('layouts.cpanel.app')
@section('title', 'CRUD with Sort')

@section('toolbar')
    <div class="bg-white border-bottom px-4 py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-0">Plan Durations</h5>
                <small class="text-muted">CRUD with Drag & Drop Sorting (jQuery UI Sortable)</small>
            </div>
            <div class="d-flex gap-2">
                <button id="sort_items_btn" class="btn btn-info btn-sm">
                    <i class="bi bi-sort-numeric-down me-1"></i> Sort Items
                </button>
                <button id="add_duration_btn" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add Duration
                </button>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mb-0">Durations List</h6>
            <input type="text" class="form-control form-control-sm" placeholder="Search..."
                   data-table-filter="search" style="width: 200px;"/>
        </div>
        <div class="card-body">
            <table id="durations_datatable" class="table table-row-bordered table-hover gy-4 gs-4">
                <thead>
                <tr class="fw-bold text-muted">
                    <th>Order</th>
                    <th>Name</th>
                    <th>Days</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- Save Modal --}}
    @include('developer.crud_with_sort.save')

    {{-- Sort Modal --}}
    @include('developer.crud_with_sort.sort_modal')
@stop

@section('script')
    <script src="{{ asset('modules/developer/js/crud_with_sort/datatable.js') }}"></script>
    <script src="{{ asset('modules/developer/js/crud_with_sort/save.js') }}"></script>
    <script src="{{ asset('modules/developer/js/crud_with_sort/sort_items.js') }}"></script>
@stop
