"use strict";

var dt;

var KTDatatablesServerSide = function() {
    var table;

    var initDatatable = function() {
        dt = $("#durations_datatable").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[0, 'asc']],
            ajax: {
                url: baseUrl + '/developer/crudWithSort/datatable',
            },
            columns: [
                { data: 'order', name: 'order' },
                { data: 'name', name: 'name' },
                { data: 'days', name: 'days' },
                { data: 'created_at', name: 'created_at' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: true,
                    render: function(data) {
                        return '<span class="badge bg-light text-dark">' + data + '</span>';
                    }
                },
                {
                    targets: 1,
                    orderable: true,
                    render: function(data) {
                        return '<span class="fw-bold">' + data + '</span>';
                    }
                },
                {
                    targets: 2,
                    orderable: true,
                    render: function(data) {
                        return '<span class="badge bg-info">' + data + ' days</span>';
                    }
                },
                {
                    targets: 3,
                    orderable: true,
                    render: function(data) {
                        return helperJS.formatDate(data) || '---';
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return '<div class="d-flex gap-1 justify-content-end">' +
                            '<button class="btn btn-sm btn-light-warning edit_btn"><i class="bi bi-pencil"></i></button>' +
                            '<button class="btn btn-sm btn-light-danger delete_btn" data-id="' + row.id + '"><i class="bi bi-trash"></i></button>' +
                            '</div>';
                    }
                },
            ],
        });

        dt.on('draw', function() {
            handleDeleteRows();
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
                helperConfirm.delete(id, 'developer/crudWithSort/delete', function() {
                    $('#durations_datatable').DataTable().ajax.reload();
                });
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
