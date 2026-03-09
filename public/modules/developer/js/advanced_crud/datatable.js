"use strict";

var dt;

var KTDatatablesServerSide = function() {

    var initDatatable = function() {
        dt = $("#customers_datatable").DataTable({
            responsive: false,
            processing: true,
            serverSide: true,
            order: [[2, 'desc']],
            stateSave: false,
            pageLength: 10,
            dom: '<"d-none"f>rt<"dt-footer d-flex align-items-center justify-content-between px-3 py-3"lip>',
            language: {
                processing: '<div class="d-flex align-items-center gap-2"><div class="spinner-border spinner-border-sm text-primary"></div> Loading...</div>',
                emptyTable: '<div class="text-center py-4 text-muted"><i class="bi bi-inbox fs-3 d-block mb-2"></i>No customers found</div>',
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                paginate: { previous: '<i class="bi bi-chevron-left"></i>', next: '<i class="bi bi-chevron-right"></i>' }
            },
            ajax: {
                url: baseUrl + '/developer/advancedCrud/datatable',
            },
            columns: [
                { data: null, orderable: false, searchable: false },   // expand
                { data: 'id', orderable: false, searchable: false },   // checkbox
                { data: 'name', name: 'name' },                       // customer
                { data: 'civil_id', name: 'civil_id' },               // civil id
                { data: 'mobile', name: 'mobile' },                   // mobile
                { data: 'banned_at', name: 'banned_at' },             // banned toggle
                { data: 'created_at', name: 'created_at' },           // date
                { data: null, orderable: false, searchable: false },   // actions
            ],
            columnDefs: [
                // ── Expand Arrow ────────────────────────────
                {
                    targets: 0,
                    className: 'text-center',
                    render: function() {
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

                // ── Customer Cell (Image + Name + Email) ────
                {
                    targets: 2,
                    render: function(data, type, row) {
                        var imgUrl = row.img_url || defaultImage;
                        return '<div class="customer-cell">' +
                            '<a href="' + baseUrl + '/developer/advancedCrud/' + row.id + '/show">' +
                            '<img src="' + imgUrl + '" alt="' + (data || '') + '" />' +
                            '</a>' +
                            '<div>' +
                            '<a href="' + baseUrl + '/developer/advancedCrud/' + row.id + '/show" class="cust-name text-decoration-none">' + (data || '—') + '</a>' +
                            '<div class="cust-email">' + (row.email || '') + '</div>' +
                            '</div>' +
                            '</div>';
                    }
                },

                // ── Civil ID ────────────────────────────────
                {
                    targets: 3,
                    render: function(data) {
                        return data || '<span class="text-muted">—</span>';
                    }
                },

                // ── Mobile ──────────────────────────────────
                {
                    targets: 4,
                    render: function(data) {
                        return data || '<span class="text-muted">—</span>';
                    }
                },

                // ── Banned Toggle ───────────────────────────
                {
                    targets: 5,
                    className: 'text-center',
                    render: function(data, type, row) {
                        return '<div class="form-check form-switch d-inline-block">' +
                            '<input onclick="updateCustomerStatus(\'banned_at\', this, ' + row.id + ')" ' +
                            (data ? 'checked' : '') +
                            ' class="form-check-input" type="checkbox" role="switch"/>' +
                            '</div>';
                    }
                },

                // ── Created Date ────────────────────────────
                {
                    targets: 6,
                    render: function(data) {
                        return '<span class="text-muted">' + (helperJS.formatDate(data) || '—') + '</span>';
                    }
                },

                // ── Action Icons ────────────────────────────
                {
                    targets: -1,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return '<div class="d-flex align-items-center justify-content-end gap-1">' +
                            '<a href="' + baseUrl + '/developer/advancedCrud/' + row.id + '/show" class="action-icon" title="View">' +
                            '<i class="bi bi-eye"></i></a>' +
                            '<a href="' + baseUrl + '/developer/advancedCrud/' + row.id + '/edit" class="action-icon" title="Edit">' +
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
            initCheckboxes();
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
        document.querySelectorAll('.delete_btn').forEach(function(d) {
            d.addEventListener('click', function(e) {
                e.preventDefault();
                var id = this.getAttribute('data-id');
                helperConfirm.delete(id, 'developer/advancedCrud/delete', function() {
                    dt.ajax.reload();
                });
            });
        });
    };

    var initCheckboxes = function() {
        document.querySelectorAll('#customers_datatable .checkbox_id').forEach(function(cb) {
            cb.addEventListener('change', function() { toggleToolbar(); });
        });
    };

    var toggleToolbar = function() {
        var checked = document.querySelectorAll('#customers_datatable .checkbox_id:checked');
        var toolbar = document.getElementById('multi_delete_toolbar');
        var countEl = document.getElementById('selected_count');
        if (checked.length > 0) {
            toolbar.classList.add('show');
            countEl.textContent = checked.length;
        } else {
            toolbar.classList.remove('show');
        }
    };

    return {
        init: function() {
            initDatatable();
            handleSearchDatatable();

            // Select all checkbox
            document.getElementById('select_all_checkbox').addEventListener('change', function() {
                var isChecked = this.checked;
                document.querySelectorAll('#customers_datatable .checkbox_id').forEach(function(cb) {
                    cb.checked = isChecked;
                });
                toggleToolbar();
            });

            // Multi-delete button
            document.getElementById('multi_delete_btn').addEventListener('click', function() {
                var ids = [];
                document.querySelectorAll('#customers_datatable .checkbox_id:checked').forEach(function(cb) {
                    ids.push(cb.value);
                });
                if (ids.length === 0) return;

                helperConfirm.confirmProcess(
                    'Delete ' + ids.length + ' items?',
                    'This action cannot be undone.',
                    function() {
                        $.ajax({
                            url: baseUrl + '/developer/advancedCrud/multiDelete',
                            type: 'POST',
                            data: { ids: ids },
                            success: function(result) {
                                if (result.status) {
                                    toastr.success(result.msg);
                                    dt.ajax.reload();
                                    document.getElementById('select_all_checkbox').checked = false;
                                    toggleToolbar();
                                }
                            },
                            error: function(error) { helperSwal.exception(error); }
                        });
                    }
                );
            });

            // Type filter
            var typeFilter = document.getElementById('type_filter');
            if (typeFilter) {
                typeFilter.addEventListener('change', function() {
                    dt.column(2).search(this.value).draw();
                });
            }
        }
    };
}();

$(document).ready(function() {
    KTDatatablesServerSide.init();
});

// Toggle status from DataTable
function updateCustomerStatus(column, element, id) {
    $.ajax({
        url: baseUrl + '/developer/advancedCrud/updateStatus',
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
