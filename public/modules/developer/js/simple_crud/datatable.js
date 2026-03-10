"use strict";

var dt;

var KTDatatablesServerSide = function () {

    var initDatatable = function () {
        dt = $("#simple_crud_datatable").DataTable({
            processing: true,
            serverSide: true,
            order: [[2, 'desc']],
            stateSave: false,
            pageLength: 10,
            ajax: {
                url: baseUrl + '/developer/simpleCrud/datatable',
            },
            columns: [
                {data: 'id', orderable: false, searchable: false},   // checkbox
                {data: 'img', orderable: false, searchable: false},  // image
                {data: 'name', name: 'name'},                       // name
                {data: 'details', name: 'details'},                  // description
                {data: 'is_active', name: 'is_active'},             // status
                {data: 'created_at', name: 'created_at'},           // date
                {data: null, orderable: false, searchable: false},   // actions
            ],
            columnDefs: [
                // ── Checkbox ──
                {
                    targets: 0,
                    render: function (data, type, row) {
                        return `<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="${row.id}" />
                        </div>`;
                    }
                },
                // ── Image ──
                {
                    targets: 1,
                    render: function (data, type, row) {
                        if (data) {
                            return `<div class="symbol symbol-50px">
                                <img src="${data}" alt="${row.name}" style="object-fit:cover;"/>
                            </div>`;
                        }
                        return `<div class="symbol symbol-50px">
                            <span class="symbol-label bg-light-primary text-primary fw-bolder">${row.name ? row.name.charAt(0).toUpperCase() : 'N'}</span>
                        </div>`;
                    }
                },
                // ── Name ──
                {
                    targets: 2,
                    render: function (data, type, row) {
                        return `<span class="text-dark fw-bolder text-hover-primary d-block fs-6">${data || '—'}</span>
                                <span class="text-muted fw-bold d-block fs-7">ID: ${row.id}</span>`;
                    }
                },
                // ── Description ──
                {
                    targets: 3,
                    render: function (data) {
                        if (!data) return '<span class="text-muted">—</span>';
                        var truncated = data.length > 50 ? data.substring(0, 50) + '...' : data;
                        return `<span class="text-gray-600 fs-7">${truncated}</span>`;
                    }
                },
                // ── Status Toggle ──
                {
                    targets: 4,
                    render: function (data, type, row) {
                        var checked = data == 1 ? 'checked' : '';
                        return `<div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input h-20px w-30px" type="checkbox" ${checked}
                                   onchange="updateItemStatus('is_active', this, ${row.id})" />
                        </div>`;
                    }
                },
                // ── Created Date ──
                {
                    targets: 5,
                    render: function (data) {
                        if (!data) return '';
                        return `<span class="text-muted fw-bold">${data}</span>`;
                    }
                },
                // ── Actions Menu ──
                {
                    targets: -1,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            Actions
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" class="menu-link px-3" onclick="openSaveModal(${row.id})">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" class="menu-link px-3 text-danger" onclick="deleteItem(${row.id})">Delete</a>
                            </div>
                        </div>`;
                    }
                },
            ],
            drawCallback: function () {
                KTMenu.createInstances();
            }
        });
    };

    var handleSearchDatatable = function () {
        var filterSearch = document.querySelector('[data-table-filter="search"]');
        var searchTimeout;
        if (filterSearch) {
            filterSearch.addEventListener('keyup', function (e) {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    dt.search(e.target.value).draw();
                }, 500);
            });
        }
    };

    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
        }
    };
}();

$(document).ready(function () {
    KTDatatablesServerSide.init();
});

// Open save modal (create or edit)
function openSaveModal(id) {
    var url = baseUrl + '/developer/simpleCrud/save?item_id=' + (id || 0);
    helperJS.getModalContent('#item_modal', url);
}

function resetForm() {
    openSaveModal(0);
}

// Delete item
function deleteItem(id) {
    helperConfirm.delete(id, 'developer/simpleCrud/delete', function () {
        dt.ajax.reload();
    });
}

// Toggle status
function updateItemStatus(column, element, id) {
    $.ajax({
        url: baseUrl + '/developer/simpleCrud/updateStatus',
        type: 'POST',
        data: {id: id, column: column},
        success: function (result) {
            if (result.status) {
                toastr.success(result.msg);
            } else {
                toastr.error(result.msg);
                element.checked = !element.checked;
            }
        },
        error: function (error) {
            helperSwal.exception(error);
            element.checked = !element.checked;
        }
    });
}
