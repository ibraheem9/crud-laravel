"use strict";

var dt;

var KTDatatablesServerSide = function() {
    var table;

    var initDatatable = function() {
        dt = $("#customers_datatable").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                url: baseUrl + '/developer/advancedCrud/datatable',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'civil_id', name: 'civil_id' },
                { data: 'mobile', name: 'mobile' },
                { data: 'banned_at', name: 'banned_at' },
                { data: 'created_at', name: 'created_at' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return '<div class="form-check">' +
                            '<input class="form-check-input checkbox_id" type="checkbox" value="' + data + '" />' +
                            '</div>';
                    }
                },
                {
                    targets: 1,
                    orderable: true,
                    render: function(data, type, row) {
                        var imgUrl = row.img_url || defaultImage;
                        return '<div class="d-flex align-items-center">' +
                            '<div class="me-3">' +
                            '<a href="' + baseUrl + '/developer/advancedCrud/' + row.id + '/show">' +
                            '<img src="' + imgUrl + '" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;" />' +
                            '</a>' +
                            '</div>' +
                            '<div>' +
                            '<a href="' + baseUrl + '/developer/advancedCrud/' + row.id + '/show" class="text-dark fw-bold text-hover-primary">' + row.name + '</a>' +
                            '<br><small class="text-muted">' + (row.email || '') + '</small>' +
                            '</div>' +
                            '</div>';
                    }
                },
                {
                    targets: 2,
                    orderable: true,
                    render: function(data) { return data || '---'; }
                },
                {
                    targets: 3,
                    orderable: true,
                    render: function(data) { return data || '---'; }
                },
                {
                    targets: 4,
                    orderable: true,
                    render: function(data, type, row) {
                        return '<div class="form-check form-switch">' +
                            '<input onclick="updateCustomerStatus(\'banned_at\', this, ' + row.id + ')" ' +
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
                            '<li><a href="' + baseUrl + '/developer/advancedCrud/' + row.id + '/show" class="dropdown-item"><i class="bi bi-eye me-2"></i>View</a></li>' +
                            '<li><a href="' + baseUrl + '/developer/advancedCrud/' + row.id + '/edit" class="dropdown-item"><i class="bi bi-pencil me-2"></i>Edit</a></li>' +
                            '<li><hr class="dropdown-divider"></li>' +
                            '<li><a href="javascript:;" class="dropdown-item text-danger delete_btn" data-id="' + row.id + '"><i class="bi bi-trash me-2"></i>Delete</a></li>' +
                            '</ul>' +
                            '</div>';
                    }
                },
            ],
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
                    $('#customers_datatable').DataTable().ajax.reload();
                });
            });
        });
    };

    var initCheckboxes = function() {
        var checkboxes = document.querySelectorAll('#customers_datatable .checkbox_id');
        checkboxes.forEach(function(cb) {
            cb.addEventListener('change', function() {
                toggleToolbar();
            });
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
                                    $('#customers_datatable').DataTable().ajax.reload();
                                    document.getElementById('select_all_checkbox').checked = false;
                                    toggleToolbar();
                                }
                            },
                            error: function(error) { helperSwal.exception(error); }
                        });
                    }
                );
            });
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
