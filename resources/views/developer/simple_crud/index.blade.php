@extends('layouts.cpanel.app')
@section('title', 'Simple CRUD (Modal)')

@section('toolbar')
    <div class="page-toolbar">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap gap-2">
            {{-- Left: Title + Total + Search + Filter --}}
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <h5 class="mb-0 me-1">Items</h5>
                <span class="text-muted fw-medium" id="total_count" style="font-size:.85rem;">Total : <span class="fw-bold text-dark">—</span></span>
                <div class="vr d-none d-md-block" style="height:28px;opacity:.15;"></div>
                <div class="position-relative">
                    <i class="bi bi-search position-absolute" style="left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.82rem;"></i>
                    <input type="text" class="form-control form-control-sm" placeholder="Type to search"
                           data-table-filter="search" style="width:200px;padding-left:34px;border-radius:8px;"/>
                </div>
                <select id="status_filter" class="form-select form-select-sm" style="width:120px;border-radius:8px;">
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            {{-- Right: Action Buttons --}}
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-icon-action" title="Export" onclick="exportTable()">
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                </button>
                <button class="btn btn-sm btn-icon-action" title="Filter" id="toggle_filter_btn">
                    <i class="bi bi-funnel"></i>
                </button>
                <button class="btn btn-sm btn-icon-action" title="Refresh" onclick="dt.ajax.reload()">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <button id="add_item_btn" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add New
                </button>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card dt-card">
        <div class="card-body p-0">
            <table id="items_datatable" class="table table-hover mb-0">
                <thead>
                <tr>
                    <th style="width:30px;"></th>
                    <th style="width:30px;"><div class="form-check"><input class="form-check-input" type="checkbox" id="select_all"/></div></th>
                    <th>Item</th>
                    <th>Is Active</th>
                    <th>Details</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- Save Modal --}}
    <div class="modal fade" tabindex="-1" id="item_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="item_modal_content"></div>
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

    /* DataTable card */
    .dt-card { border-radius: 0 0 12px 12px; border-top: none; }
    .dt-card .card-body { padding: 0; }

    /* Table styling matching reference */
    #items_datatable thead th {
        background: #f8fafc !important; font-weight: 600; font-size: .78rem;
        text-transform: none !important; color: #475569; letter-spacing: 0;
        border-bottom: 1px solid #e2e8f0 !important; padding: 14px 16px !important;
    }
    #items_datatable tbody td {
        padding: 16px !important; vertical-align: middle;
        border-bottom: 1px solid #f1f5f9 !important; font-size: .85rem;
    }
    #items_datatable tbody tr { transition: background .1s; }
    #items_datatable tbody tr:hover { background: #fafbfc !important; }

    /* Expand arrow */
    .row-expand-btn {
        width: 24px; height: 24px; border-radius: 6px; border: 1px solid #e2e8f0;
        background: #fff; color: #94a3b8; display: inline-flex; align-items: center;
        justify-content: center; cursor: pointer; transition: all .15s; font-size: .7rem;
    }
    .row-expand-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

    /* Action icon buttons */
    .action-icon {
        width: 32px; height: 32px; border-radius: 8px; border: 1px solid #e2e8f0;
        background: #fff; color: #64748b; display: inline-flex; align-items: center;
        justify-content: center; cursor: pointer; transition: all .15s; font-size: .85rem;
        text-decoration: none;
    }
    .action-icon:hover { background: #f1f5f9; color: var(--primary); border-color: var(--primary); }
    .action-icon.danger:hover { background: #fef2f2; color: #ef4444; border-color: #fca5a5; }

    /* Status toggle */
    .form-check-input:checked { background-color: #22c55e; border-color: #22c55e; }

    /* Item cell with image */
    .item-cell { display: flex; align-items: center; gap: 12px; }
    .item-cell img {
        width: 48px; height: 48px; border-radius: 10px; object-fit: cover;
        border: 2px solid #f1f5f9;
    }
    .item-cell .item-name { font-weight: 600; color: #1e293b; font-size: .88rem; }
    .item-cell .item-sub { color: #94a3b8; font-size: .78rem; }
</style>
@stop

@section('script')
    <script src="{{ asset('modules/developer/js/simple_crud/datatable.js') }}"></script>
    <script src="{{ asset('modules/developer/js/simple_crud/save.js') }}"></script>
@stop
