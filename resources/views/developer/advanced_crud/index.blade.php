@extends('layouts.cpanel.app')
@section('title', 'Advanced CRUD (Page)')

@section('toolbar')
    <div class="page-toolbar">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap gap-2">
            {{-- Left: Title + Total + Search + Filter --}}
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <h5 class="mb-0 me-1">Customers</h5>
                <span class="text-muted fw-medium" id="total_count" style="font-size:.85rem;">Total : <span class="fw-bold text-dark">—</span></span>
                <div class="vr d-none d-md-block" style="height:28px;opacity:.15;"></div>
                <div class="position-relative">
                    <i class="bi bi-search position-absolute" style="left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.82rem;"></i>
                    <input type="text" class="form-control form-control-sm" placeholder="Type to search"
                           data-table-filter="search" style="width:200px;padding-left:34px;border-radius:8px;"/>
                </div>
                <select id="type_filter" class="form-select form-select-sm" style="width:140px;border-radius:8px;">
                    <option value="">All Types</option>
                    <option value="customer">Customer</option>
                    <option value="guardian">Guardian</option>
                </select>
            </div>

            {{-- Right: Action Buttons --}}
            <div class="d-flex align-items-center gap-2">
                {{-- Multi-delete (hidden by default) --}}
                <div class="toolbar-actions" id="multi_delete_toolbar">
                    <span class="text-muted me-2" style="font-size:.82rem;"><span id="selected_count" class="fw-bold text-danger">0</span> selected</span>
                    <button id="multi_delete_btn" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash3 me-1"></i> Delete
                    </button>
                </div>
                <button class="btn btn-sm btn-icon-action" title="Export">
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                </button>
                <button class="btn btn-sm btn-icon-action" title="Filter">
                    <i class="bi bi-funnel"></i>
                </button>
                <button class="btn btn-sm btn-icon-action" title="Refresh" onclick="dt.ajax.reload()">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <a href="{{ route('developer.advancedCrud.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add New
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card dt-card">
        <div class="card-body p-0">
            <table id="customers_datatable" class="table table-hover mb-0">
                <thead>
                <tr>
                    <th style="width:30px;"></th>
                    <th style="width:30px;"><div class="form-check"><input class="form-check-input" type="checkbox" id="select_all_checkbox"/></div></th>
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

    #customers_datatable thead th {
        background: #f8fafc !important; font-weight: 600; font-size: .78rem;
        text-transform: none !important; color: #475569; letter-spacing: 0;
        border-bottom: 1px solid #e2e8f0 !important; padding: 14px 16px !important;
    }
    #customers_datatable tbody td {
        padding: 16px !important; vertical-align: middle;
        border-bottom: 1px solid #f1f5f9 !important; font-size: .85rem;
    }
    #customers_datatable tbody tr { transition: background .1s; }
    #customers_datatable tbody tr:hover { background: #fafbfc !important; }

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

    .form-check-input:checked { background-color: #22c55e; border-color: #22c55e; }

    .customer-cell { display: flex; align-items: center; gap: 12px; }
    .customer-cell img {
        width: 48px; height: 48px; border-radius: 50%; object-fit: cover;
        border: 2px solid #f1f5f9;
    }
    .customer-cell .cust-name { font-weight: 600; color: #1e293b; font-size: .88rem; }
    .customer-cell .cust-email { color: #94a3b8; font-size: .78rem; }
</style>
@stop

@section('script')
    <script src="{{ asset('modules/developer/js/advanced_crud/datatable.js') }}"></script>
@stop
