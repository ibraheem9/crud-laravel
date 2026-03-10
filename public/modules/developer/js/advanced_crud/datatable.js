"use strict";

var dt;

var KTDatatablesServerSide = function () {

    var initDatatable = function () {
        dt = $("#advanced_crud_datatable").DataTable({
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            stateSave: false,
            pageLength: 10,
            ajax: {
                url: baseUrl + '/developer/advancedCrud/datatable',
            },
            columns: [
                {data: 'id', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'civil_id', name: 'civil_id'},
                {data: 'mobile', name: 'mobile'},
                {data: 'type', name: 'type'},
                {data: 'is_ban', name: 'is_ban'},
                {data: 'created_at', name: 'created_at'},
                {data: null, orderable: false, searchable: false},
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
                // ── Customer (Image + Name + Email) ──
                {
                    targets: 1,
                    render: function (data, type, row) {
                        var imgHtml = '';
                        if (row.img) {
                            imgHtml = `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="${baseUrl}/developer/advancedCrud/show/${row.id}">
                                    <img src="${row.img}" alt="${data}" class="w-100"/>
                                </a>
                            </div>`;
                        } else {
                            var initial = data ? data.charAt(0).toUpperCase() : 'C';
                            imgHtml = `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="${baseUrl}/developer/advancedCrud/show/${row.id}">
                                    <span class="symbol-label bg-light-primary text-primary fw-bolder">${initial}</span>
                                </a>
                            </div>`;
                        }
                        return `<div class="d-flex align-items-center">
                            ${imgHtml}
                            <div class="d-flex flex-column">
                                <a href="${baseUrl}/developer/advancedCrud/show/${row.id}" class="text-dark fw-bolder text-hover-primary fs-6">${data || '—'}</a>
                                <span class="text-muted fw-bold fs-7">${row.email || ''}</span>
                            </div>
                        </div>`;
                    }
                },
                // ── Civil ID ──
                {
                    targets: 2,
                    render: function (data) {
                        return data ? `<span class="badge badge-light-dark fw-bold">${data}</span>` : '<span class="text-muted">—</span>';
                    }
                },
                // ── Mobile ──
                {
                    targets: 3,
                    render: function (data) {
                        return data ? `<span class="text-gray-700">${data}</span>` : '<span class="text-muted">—</span>';
                    }
                },
                // ── Type Badge ──
                {
                    targets: 4,
                    render: function (data) {
                        var badgeClass = data === 'guardian' ? 'badge-light-warning' : 'badge-light-info';
                        return `<span class="badge ${badgeClass} fw-bold">${data || '—'}</span>`;
                    }
                },
                // ── Ban Status ──
                {
                    targets: 5,
                    render: function (data, type, row) {
                        var checked = data == 1 ? 'checked' : '';
                        return `<div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input h-20px w-30px" type="checkbox" ${checked}
                                   onchange="updateStatus('is_ban', this, ${row.id})" />
                        </div>`;
                    }
                },
                // ── Created Date ──
                {
                    targets: 6,
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
                                <a href="${baseUrl}/developer/advancedCrud/show/${row.id}" class="menu-link px-3">View</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="${baseUrl}/developer/advancedCrud/edit/${row.id}" class="menu-link px-3">Edit</a>
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

// Delete item
function deleteItem(id) {
    helperConfirm.delete(id, 'developer/advancedCrud/delete', function () {
        dt.ajax.reload();
    });
}

// Toggle status
function updateStatus(column, element, id) {
    $.ajax({
        url: baseUrl + '/developer/advancedCrud/updateStatus',
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
