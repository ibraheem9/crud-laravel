@extends('layouts.cpanel.app')
@section('title', 'Simple CRUD (Modal)')

@section('toolbar')
    <div class="page-toolbar">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div>
                <h5>Simple CRUD</h5>
                <small class="text-muted">Modal-based Create, Edit, Delete with AJAX DataTable</small>
            </div>
            <div class="d-flex align-items-center gap-2">
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
            <div class="d-flex align-items-center gap-2">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute" style="left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.8rem;"></i>
                    <input type="text" class="form-control form-control-sm" placeholder="Search items..."
                           data-table-filter="search" style="width:220px;padding-left:32px;"/>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table id="items_datatable" class="table table-hover mb-0">
                <thead>
                <tr>
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
