@extends('layouts.cpanel.app')
@section('title', 'Advanced CRUD (Page)')

@section('toolbar')
    <div class="bg-white border-bottom px-4 py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-0">Customers</h5>
                <small class="text-muted">Advanced Page-based CRUD with Image Upload, Multi-delete, Status Toggle</small>
            </div>
            <div class="d-flex gap-2">
                {{-- Multi-delete toolbar (hidden by default) --}}
                <div class="toolbar-actions" id="multi_delete_toolbar">
                    <span class="text-muted me-2"><span id="selected_count">0</span> selected</span>
                    <button id="multi_delete_btn" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash me-1"></i> Delete Selected
                    </button>
                </div>
                <a href="{{ route('developer.advancedCrud.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add Customer
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mb-0">Customers List</h6>
            <input type="text" class="form-control form-control-sm" placeholder="Search..."
                   data-table-filter="search" style="width: 200px;"/>
        </div>
        <div class="card-body">
            <table id="customers_datatable" class="table table-row-bordered table-hover gy-4 gs-4">
                <thead>
                <tr class="fw-bold text-muted">
                    <th style="width: 30px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="select_all_checkbox"/>
                        </div>
                    </th>
                    <th>Customer</th>
                    <th>Civil ID</th>
                    <th>Mobile</th>
                    <th>Banned</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@stop

@section('script')
    <script src="{{ asset('modules/developer/js/advanced_crud/datatable.js') }}"></script>
@stop
