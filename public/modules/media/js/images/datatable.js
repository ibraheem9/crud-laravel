"use strict";

var dt;

var KTDatatablesServerSide = function() {

    var initDatatable = function() {
        dt = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            pageLength: 10,
            dom: '<"d-none"f>rt<"row mx-2 my-3"<"col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"li><"col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"p>>',
            language: {
                processing: '<div class="d-flex align-items-center gap-2"><span class="spinner-border w-15px h-15px text-primary"></span> Loading...</div>',
                emptyTable: '<div class="text-center py-4 text-muted"><i class="bi bi-image fs-2x d-block mb-2"></i>No images found</div>',
                info: 'Showing _START_ to _END_ of _TOTAL_',
                paginate: { previous: '<i class="previous"></i>', next: '<i class="next"></i>' }
            },
            ajax: {
                url: baseUrl + '/developer/media/images/datatable',
                type: 'GET',
            },
            columns: [
                { data: 'id', orderable: false, searchable: false },
                { data: 'id', name: 'id' },
                { data: 'image_url', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'alt_text', name: 'alt_text' },
                { data: 'is_active', name: 'is_active' },
                { data: 'created_at', name: 'created_at' },
                { data: 'id', orderable: false, searchable: false },
            ],
            columnDefs: [
                {
                    targets: 0,
                    className: 'w-10px pe-2',
                    render: function(data) {
                        return '<div class="form-check form-check-sm form-check-custom form-check-solid">' +
                            '<input class="form-check-input row-checkbox" type="checkbox" value="' + data + '" />' +
                            '</div>';
                    }
                },
                {
                    targets: 1,
                    render: function(data) {
                        return '<span class="badge badge-light fw-bolder">' + data + '</span>';
                    }
                },
                {
                    targets: 2,
                    render: function(data, type, row) {
                        return '<div class="symbol symbol-50px">' +
                            '<img src="' + data + '" alt="' + (row.alt_text || '') + '" ' +
                            'onerror="this.src=\'https://via.placeholder.com/50x50?text=No+Image\'" ' +
                            'style="cursor:pointer;object-fit:cover;" onclick="window.open(\'' + data + '\',\'_blank\')" />' +
                            '</div>';
                    }
                },
                {
                    targets: 3,
                    render: function(data) {
                        return '<span class="text-dark fw-bolder text-hover-primary fs-6">' + (data || '—') + '</span>';
                    }
                },
                {
                    targets: 4,
                    render: function(data) {
                        return data
                            ? '<span class="text-muted fw-bold">' + data + '</span>'
                            : '<span class="text-muted fst-italic">Not set</span>';
                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row) {
                        var checked = data ? 'checked' : '';
                        return '<div class="form-check form-switch form-check-custom form-check-solid">' +
                            '<input class="form-check-input" type="checkbox" ' + checked +
                            ' onchange="toggleStatus(' + row.id + ')" style="cursor:pointer;" />' +
                            '</div>';
                    }
                },
                {
                    targets: 6,
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
                            '<div class="menu-item px-3"><a href="' + baseUrl + '/developer/media/images/save/' + row.id + '" class="menu-link px-3">Edit</a></div>' +
                            '<div class="menu-item px-3"><a href="javascript:;" class="menu-link px-3" onclick="deleteItem(' + row.id + ')">Delete</a></div>' +
                            '</div>';
                    }
                },
            ],
            drawCallback: function(settings) {
                var total = settings._iRecordsTotal || 0;
                $('#totalCount').text('Total: ' + total);
                KTMenu.createInstances();
            }
        });

        dt.on('draw', function() {
            initCheckboxEvents();
        });
    };

    var handleSearchDatatable = function() {
        var filterSearch = document.querySelector('#searchInput');
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

    var initCheckboxEvents = function() {
        document.querySelectorAll('.row-checkbox').forEach(function(cb) {
            cb.addEventListener('change', function() {
                toggleMultiDeleteBtn();
            });
        });
    };

    return {
        init: function() {
            initDatatable();
            handleSearchDatatable();

            // Check all
            var checkAll = document.querySelector('#checkAll');
            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    var checked = this.checked;
                    document.querySelectorAll('.row-checkbox').forEach(function(cb) {
                        cb.checked = checked;
                    });
                    toggleMultiDeleteBtn();
                });
            }
        }
    };
}();

function reloadDatatable() {
    dt.ajax.reload(null, false);
}

function toggleMultiDeleteBtn() {
    var count = document.querySelectorAll('.row-checkbox:checked').length;
    var btn = document.querySelector('#btnMultiDelete');
    if (count > 0) {
        btn.classList.remove('d-none');
        btn.innerHTML = '<i class="bi bi-trash me-1"></i> Delete (' + count + ')';
    } else {
        btn.classList.add('d-none');
    }
}

function toggleStatus(id) {
    $.ajax({
        url: baseUrl + '/developer/media/images/toggle-status',
        type: 'POST',
        data: { id: id, _token: $('meta[name="csrf-token"]').attr('content') },
        success: function() { reloadDatatable(); }
    });
}

function deleteItem(id) {
    helperConfirm.delete(id, 'developer/media/images/delete', function() {
        reloadDatatable();
    });
}

function multiDelete() {
    var ids = [];
    document.querySelectorAll('.row-checkbox:checked').forEach(function(cb) {
        ids.push(cb.value);
    });
    if (ids.length === 0) return;

    helperConfirm.deleteConfirm(function() {
        $.ajax({
            url: baseUrl + '/developer/media/images/multi-delete',
            type: 'POST',
            data: { ids: ids, _token: $('meta[name="csrf-token"]').attr('content') },
            success: function() {
                reloadDatatable();
                document.querySelector('#checkAll').checked = false;
                toggleMultiDeleteBtn();
                helperSwal.success(ids.length + ' images deleted');
            }
        });
    }, 'Delete ' + ids.length + ' images?');
}

$(document).ready(function() {
    KTDatatablesServerSide.init();
});
