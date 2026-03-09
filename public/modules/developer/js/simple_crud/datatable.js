"use strict";

var dt;

var KTDatatablesServerSide = function() {

    var initDatatable = function() {
        dt = $("#items_datatable").DataTable({
            responsive: false,
            processing: true,
            serverSide: true,
            order: [[2, 'desc']],
            stateSave: false,
            pageLength: 10,
            dom: '<"d-none"f>rt<"dt-footer d-flex align-items-center justify-content-between px-3 py-3"lip>',
            language: {
                processing: '<div class="d-flex align-items-center gap-2"><div class="spinner-border spinner-border-sm text-primary"></div> Loading...</div>',
                emptyTable: '<div class="text-center py-4 text-muted"><i class="bi bi-inbox fs-3 d-block mb-2"></i>No items found</div>',
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                paginate: { previous: '<i class="bi bi-chevron-left"></i>', next: '<i class="bi bi-chevron-right"></i>' }
            },
            ajax: {
                url: baseUrl + '/developer/simpleCrud/datatable',
            },
            columns: [
                { data: null, orderable: false, searchable: false },   // expand
                { data: 'id', orderable: false, searchable: false },   // checkbox
                { data: 'name', name: 'name' },                       // item (image + name)
                { data: 'is_active', name: 'is_active' },             // status toggle
                { data: 'details', name: 'details' },                 // details
                { data: 'created_at', name: 'created_at' },           // date
                { data: null, orderable: false, searchable: false },   // actions
            ],
            columnDefs: [
                // ── Expand Arrow ────────────────────────────
                {
                    targets: 0,
                    className: 'text-center',
                    render: function(data, type, row) {
                        return '<span class="row-expand-btn"><i class="bi bi-caret-right-fill"></i></span>';
                    }
                },

                // ── Checkbox ────────────────────────────────
                {
                    targets: 1,
                    render: function(data, type, row) {
                        return '<div class="form-check">' +
                            '<input class="form-check-input checkbox_id" type="checkbox" value="' + row.id + '" />' +
                            '</div>';
                    }
                },

                // ── Item Cell (Image + Name + Key) ──────────
                {
                    targets: 2,
                    render: function(data, type, row) {
                        var imgUrl = row.img_url || defaultImage;
                        return '<div class="item-cell">' +
                            '<img src="' + imgUrl + '" alt="' + (data || '') + '" />' +
                            '<div>' +
                            '<div class="item-name">' + (data || '—') + '</div>' +
                            '<div class="item-sub">' + (row.key || 'ID: ' + row.id) + '</div>' +
                            '</div>' +
                            '</div>';
                    }
                },

                // ── Status Toggle (green check) ────────────
                {
                    targets: 3,
                    className: 'text-center',
                    render: function(data, type, row) {
                        var checked = data ? 'checked' : '';
                        return '<div class="form-check form-switch d-inline-block">' +
                            '<input onclick="updateItemStatus(\'is_active\', this, ' + row.id + ')" ' +
                            checked + ' class="form-check-input" type="checkbox" role="switch"/>' +
                            '</div>';
                    }
                },

                // ── Details (truncated) ─────────────────────
                {
                    targets: 4,
                    render: function(data) {
                        if (!data) return '<span class="text-muted">—</span>';
                        var decoded = typeof he !== 'undefined' ? he.decode(data) : data;
                        return '<span class="text-muted">' +
                            (decoded.length > 40 ? decoded.substring(0, 40) + '...' : decoded) +
                            '</span>';
                    }
                },

                // ── Created Date ────────────────────────────
                {
                    targets: 5,
                    render: function(data) {
                        return '<span class="text-muted">' + (helperJS.formatDate(data) || '—') + '</span>';
                    }
                },

                // ── Action Icons (copy, edit, delete) ───────
                {
                    targets: -1,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return '<div class="d-flex align-items-center justify-content-end gap-1">' +
                            '<a href="javascript:;" class="action-icon copy_btn" data-id="' + row.id + '" title="Duplicate">' +
                            '<i class="bi bi-copy"></i></a>' +
                            '<a href="javascript:;" class="action-icon edit_btn" data-id="' + row.id + '" title="Edit">' +
                            '<i class="bi bi-pencil-square"></i></a>' +
                            '<a href="javascript:;" class="action-icon danger delete_btn" data-id="' + row.id + '" title="Delete">' +
                            '<i class="bi bi-trash3"></i></a>' +
                            '</div>';
                    }
                },
            ],
            drawCallback: function(settings) {
                // Update total count in toolbar
                var total = settings._iRecordsTotal || 0;
                $('#total_count').html('Total : <span class="fw-bold text-dark">' + total + '</span>');
            }
        });

        dt.on('draw', function() {
            handleDeleteRows();
            handleEditRows();
        });
    };

    var handleSearchDatatable = function() {
        var filterSearch = document.querySelector('[data-table-filter="search"]');
        var searchTimeout;
        if (filterSearch) {
            filterSearch.addEventListener('keyup', function(e) {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    dt.search(e.target.value).draw();
                }, 500);
            });
        }
    };

    var handleStatusFilter = function() {
        var statusFilter = document.getElementById('status_filter');
        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                dt.column(3).search(this.value).draw();
            });
        }
    };

    var handleDeleteRows = function() {
        document.querySelectorAll('.delete_btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var id = this.getAttribute('data-id');
                helperConfirm.delete(id, 'developer/simpleCrud/delete', function() {
                    dt.ajax.reload();
                });
            });
        });
    };

    var handleEditRows = function() {
        document.querySelectorAll('.edit_btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var id = this.getAttribute('data-id');
                openSaveModal(id);
            });
        });
    };

    var handleSelectAll = function() {
        var selectAll = document.getElementById('select_all');
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                var isChecked = this.checked;
                document.querySelectorAll('#items_datatable .checkbox_id').forEach(function(cb) {
                    cb.checked = isChecked;
                });
            });
        }
    };

    return {
        init: function() {
            initDatatable();
            handleSearchDatatable();
            handleStatusFilter();
            handleSelectAll();
        }
    };
}();

$(document).ready(function() {
    KTDatatablesServerSide.init();
});

// Toggle status from DataTable
function updateItemStatus(column, element, id) {
    $.ajax({
        url: baseUrl + '/developer/simpleCrud/updateStatus',
        type: 'POST',
        data: { id: id, column: column },
        success: function(result) {
            if (result.status) {
                toastr.success(result.msg);
            } else {
                toastr.error(result.msg);
                element.checked = !element.checked;
            }
        },
        error: function(error) {
            helperSwal.exception(error);
            element.checked = !element.checked;
        }
    });
}

// Export table (placeholder)
function exportTable() {
    toastr.info('Export feature — integrate with DataTables Buttons or server-side export');
}
