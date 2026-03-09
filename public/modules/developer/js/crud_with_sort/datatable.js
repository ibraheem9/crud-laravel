"use strict";

var dt;

var KTDatatablesServerSide = function() {

    var initDatatable = function() {
        dt = $("#durations_datatable").DataTable({
            responsive: false,
            processing: true,
            serverSide: true,
            order: [[1, 'asc']],
            stateSave: false,
            pageLength: 10,
            dom: '<"d-none"f>rt<"dt-footer d-flex align-items-center justify-content-between px-3 py-3"lip>',
            language: {
                processing: '<div class="d-flex align-items-center gap-2"><div class="spinner-border spinner-border-sm text-primary"></div> Loading...</div>',
                emptyTable: '<div class="text-center py-4 text-muted"><i class="bi bi-inbox fs-3 d-block mb-2"></i>No durations found</div>',
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                paginate: { previous: '<i class="bi bi-chevron-left"></i>', next: '<i class="bi bi-chevron-right"></i>' }
            },
            ajax: {
                url: baseUrl + '/developer/crudWithSort/datatable',
            },
            columns: [
                { data: null, orderable: false, searchable: false },
                { data: 'order', name: 'order' },
                { data: 'name', name: 'name' },
                { data: 'days', name: 'days' },
                { data: 'created_at', name: 'created_at' },
                { data: null, orderable: false, searchable: false },
            ],
            columnDefs: [
                {
                    targets: 0,
                    className: 'text-center',
                    render: function() {
                        return '<span class="row-expand-btn"><i class="bi bi-caret-right-fill"></i></span>';
                    }
                },
                {
                    targets: 1,
                    className: 'text-center',
                    render: function(data) {
                        return '<span class="order-badge">' + (data || 0) + '</span>';
                    }
                },
                {
                    targets: 2,
                    render: function(data) {
                        return '<span class="fw-semibold text-dark">' + (data || '—') + '</span>';
                    }
                },
                {
                    targets: 3,
                    render: function(data) {
                        if (!data) return '<span class="text-muted">—</span>';
                        return '<span class="badge" style="background:#f0fdf4;color:#16a34a;font-size:.82rem;font-weight:600;padding:6px 12px;border-radius:6px;">' + data + ' days</span>';
                    }
                },
                {
                    targets: 4,
                    render: function(data) {
                        return '<span class="text-muted">' + (helperJS.formatDate(data) || '—') + '</span>';
                    }
                },
                {
                    targets: -1,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return '<div class="d-flex align-items-center justify-content-end gap-1">' +
                            '<a href="javascript:;" class="action-icon edit_btn" data-id="' + row.id + '" title="Edit">' +
                            '<i class="bi bi-pencil-square"></i></a>' +
                            '<a href="javascript:;" class="action-icon danger delete_btn" data-id="' + row.id + '" title="Delete">' +
                            '<i class="bi bi-trash3"></i></a>' +
                            '</div>';
                    }
                },
            ],
            drawCallback: function(settings) {
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

    var handleDeleteRows = function() {
        document.querySelectorAll('.delete_btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var id = this.getAttribute('data-id');
                helperConfirm.delete(id, 'developer/crudWithSort/delete', function() {
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

    return {
        init: function() {
            initDatatable();
            handleSearchDatatable();
        }
    };
}();

$(document).ready(function() {
    KTDatatablesServerSide.init();
});
