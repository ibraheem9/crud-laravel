"use strict";

var dt;

var KTDatatablesServerSide = function() {
    var table;

    var initDatatable = function() {
        dt = $("#items_datatable").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            ajax: {
                url: baseUrl + '/developer/simpleCrud/datatable',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'img_html', name: 'img' },
                { data: 'name', name: 'name' },
                { data: 'details', name: 'details' },
                { data: 'is_active', name: 'is_active' },
                { data: 'created_at', name: 'created_at' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: true,
                    render: function(data) {
                        return '<span class="badge bg-light text-dark">#' + data + '</span>';
                    }
                },
                {
                    targets: 1,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<img src="' + (row.img_url || defaultImage) + '" class="rounded" style="width:40px;height:40px;object-fit:cover;" />';
                    }
                },
                {
                    targets: 2,
                    orderable: true,
                    render: function(data) {
                        return '<span class="fw-bold">' + (data || '---') + '</span>';
                    }
                },
                {
                    targets: 3,
                    orderable: false,
                    render: function(data) {
                        if (!data) return '---';
                        return data.length > 50 ? data.substring(0, 50) + '...' : data;
                    }
                },
                {
                    targets: 4,
                    orderable: true,
                    render: function(data, type, row) {
                        return '<div class="form-check form-switch">' +
                            '<input onclick="updateItemStatus(\'is_active\', this, ' + row.id + ')" ' +
                            (data ? 'checked' : '') +
                            ' class="form-check-input" type="checkbox"/>' +
                            '</div>';
                    }
                },
                {
                    targets: 5,
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
                        return '<div class="dropdown">' +
                            '<button class="btn btn-sm btn-light" data-bs-toggle="dropdown">Actions <i class="bi bi-chevron-down"></i></button>' +
                            '<ul class="dropdown-menu">' +
                            '<li><a href="javascript:;" class="dropdown-item edit_btn" data-id="' + row.id + '"><i class="bi bi-pencil me-2"></i>Edit</a></li>' +
                            '<li><a href="javascript:;" class="dropdown-item delete_btn text-danger" data-id="' + row.id + '"><i class="bi bi-trash me-2"></i>Delete</a></li>' +
                            '</ul>' +
                            '</div>';
                    }
                },
            ],
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
                helperConfirm.delete(id, 'developer/simpleCrud/delete', function() {
                    $('#items_datatable').DataTable().ajax.reload();
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
