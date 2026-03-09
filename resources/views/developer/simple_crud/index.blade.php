@extends('layouts.cpanel.app')
@section('title', 'Simple CRUD (Modal)')

@section('toolbar')
    <div class="bg-white border-bottom px-4 py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-0">Items</h5>
                <small class="text-muted">Simple Modal CRUD - Create, Edit, Delete via Bootstrap Modal</small>
            </div>
            <div>
                <button id="add_item_btn" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add New Item
                </button>
            </div>
        </div>
    </div>
@stop

@section('content')
    {{-- DataTable Card --}}
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mb-0">Items List</h6>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control form-control-sm" placeholder="Search..."
                       data-table-filter="search" style="width: 200px;"/>
            </div>
        </div>
        <div class="card-body">
            <table id="items_datatable" class="table table-row-bordered table-hover gy-4 gs-4">
                <thead>
                <tr class="fw-bold text-muted">
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Active</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- Save Modal (loaded via AJAX) --}}
    <div class="modal fade" tabindex="-1" id="item_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="item_modal_content">
                {{-- Content loaded via AJAX --}}
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="{{ asset('modules/developer/js/simple_crud/datatable.js') }}"></script>
    <script src="{{ asset('modules/developer/js/simple_crud/save.js') }}"></script>
@stop
