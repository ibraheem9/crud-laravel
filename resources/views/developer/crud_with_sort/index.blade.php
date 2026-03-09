@extends('layouts.cpanel.app')
@section('title', 'CRUD with Sort')

@section('toolbar')
    <div class="page-toolbar">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap gap-2">
            {{-- Left: Title + Total + Search --}}
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <h5 class="mb-0 me-1">Plan Durations</h5>
                <span class="text-muted fw-medium" id="total_count" style="font-size:.85rem;">Total : <span class="fw-bold text-dark">—</span></span>
                <div class="vr d-none d-md-block" style="height:28px;opacity:.15;"></div>
                <div class="position-relative">
                    <i class="bi bi-search position-absolute" style="left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.82rem;"></i>
                    <input type="text" class="form-control form-control-sm" placeholder="Type to search"
                           data-table-filter="search" style="width:200px;padding-left:34px;border-radius:8px;"/>
                </div>
            </div>

            {{-- Right: Action Buttons --}}
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-icon-action" title="Refresh" onclick="dt.ajax.reload()">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <button id="sort_items_btn" class="btn btn-sm" style="background:#f0f9ff;color:#0284c7;border:1px solid #bae6fd;border-radius:8px;">
                    <i class="bi bi-sort-numeric-down me-1"></i> Sort Items
                </button>
                <button id="add_duration_btn" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add New
                </button>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card dt-card">
        <div class="card-body p-0">
            <table id="durations_datatable" class="table table-hover mb-0">
                <thead>
                <tr>
                    <th style="width:30px;"></th>
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

@section('style')
<style>
    .btn-icon-action {
        width: 36px; height: 36px; display: inline-flex; align-items: center;
        justify-content: center; border-radius: 8px; border: 1px solid #e2e8f0;
        background: #fff; color: #64748b; transition: all .15s;
    }
    .btn-icon-action:hover { background: #f1f5f9; color: var(--primary); border-color: var(--primary); }
    .btn-icon-action i { font-size: 1rem; }

    .dt-card { border-radius: 0 0 12px 12px; border-top: none; }
    .dt-card .card-body { padding: 0; }

    #durations_datatable thead th {
        background: #f8fafc !important; font-weight: 600; font-size: .78rem;
        text-transform: none !important; color: #475569; letter-spacing: 0;
        border-bottom: 1px solid #e2e8f0 !important; padding: 14px 16px !important;
    }
    #durations_datatable tbody td {
        padding: 16px !important; vertical-align: middle;
        border-bottom: 1px solid #f1f5f9 !important; font-size: .85rem;
    }
    #durations_datatable tbody tr { transition: background .1s; }
    #durations_datatable tbody tr:hover { background: #fafbfc !important; }

    .row-expand-btn {
        width: 24px; height: 24px; border-radius: 6px; border: 1px solid #e2e8f0;
        background: #fff; color: #94a3b8; display: inline-flex; align-items: center;
        justify-content: center; cursor: pointer; transition: all .15s; font-size: .7rem;
    }
    .row-expand-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

    .action-icon {
        width: 32px; height: 32px; border-radius: 8px; border: 1px solid #e2e8f0;
        background: #fff; color: #64748b; display: inline-flex; align-items: center;
        justify-content: center; cursor: pointer; transition: all .15s; font-size: .85rem;
        text-decoration: none;
    }
    .action-icon:hover { background: #f1f5f9; color: var(--primary); border-color: var(--primary); }
    .action-icon.danger:hover { background: #fef2f2; color: #ef4444; border-color: #fca5a5; }

    .order-badge {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px; border-radius: 8px; background: #f0f9ff;
        color: #0284c7; font-weight: 700; font-size: .82rem;
    }
</style>
@stop

@section('script')
    <script src="{{ asset('modules/developer/js/crud_with_sort/datatable.js') }}"></script>
    <script src="{{ asset('modules/developer/js/crud_with_sort/save.js') }}"></script>
    <script src="{{ asset('modules/developer/js/crud_with_sort/sort_items.js') }}"></script>
@stop
