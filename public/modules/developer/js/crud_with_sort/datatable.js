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
            dom: '<"d-none"f>rt<"row mx-2 my-3"<"col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"li><"col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"p>>',
            language: {
                processing: '<div class="d-flex align-items-center gap-2"><span class="spinner-border w-15px h-15px text-primary"></span> Loading...</div>',
                emptyTable: '<div class="text-center py-4 text-muted"><i class="bi bi-inbox fs-3 d-block mb-2"></i>No durations found</div>',
                info: 'Showing _START_ to _END_ of _TOTAL_',
                paginate: { previous: '<i class="previous"></i>', next: '<i class="next"></i>' }
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
                    className: 'w-10px pe-2',
                    render: function() {
                        return '<div class="form-check form-check-sm form-check-custom form-check-solid">' +
                            '<input class="form-check-input row-checkbox" type="checkbox" value="" />' +
                            '</div>';
                    }
                },
                {
                    targets: 1,
                    className: 'text-center',
                    render: function(data) {
                        return '<span class="badge badge-light-primary fw-bolder fs-7">' + (data || 0) + '</span>';
                    }
                },
                {
                    targets: 2,
                    render: function(data) {
                        return '<span class="text-dark fw-bolder text-hover-primary fs-6">' + (data || '—') + '</span>';
                    }
                },
                {
                    targets: 3,
                    render: function(data) {
                        if (!data) return '<span class="text-muted">—</span>';
                        return '<span class="badge badge-light-success fw-bolder">' + data + ' days</span>';
                    }
                },
                {
                    targets: 4,
                    render: function(data) {
                        return '<span class="text-muted fw-bold">' + (helperJS.formatDate(data) || '—') + '</span>';
                    }
                },
                {
                    targets: -1,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return '<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">' +
                            'Actions <span class="svg-icon svg-icon-5 m-0"><i class="bi bi-caret-down-fill"></i></span></a>' +
                            '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">' +
                            '<div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3 edit_btn" data-id="' + row.id + '">Edit</a></div>' +
                            '<div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3 delete_btn" data-id="' + row.id + '">Delete</a></div>' +
                            '</div>';
                    }
                },
            ],
            drawCallback: function(settings) {
                var total = settings._iRecordsTotal || 0;
                $('#total_count').text('Total: ' + total);
                KTMenu.createInstances();
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
