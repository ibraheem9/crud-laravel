/**
 * Archives CRUD - DataTable (Metronic 8)
 */

let dataTable;

const archiveIcons = {
    zip: 'bi-file-earmark-zip text-warning',
    rar: 'bi-file-earmark-zip text-danger',
    '7z': 'bi-file-earmark-zip text-info',
    tar: 'bi-file-earmark-zip text-gray-600',
    gz: 'bi-file-earmark-zip text-success',
    other: 'bi-file-earmark text-gray-500'
};

$(document).ready(function () {
    initDataTable();
    initSearch();
});

function initDataTable() {
    dataTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url: '/developer/media/archives/datatable', type: 'GET' },
        columns: [
            {
                data: 'id',
                render: function (data) {
                    return `<span class="badge badge-light fw-bolder">${data}</span>`;
                }
            },
            {
                data: 'type', orderable: false,
                render: function (data) {
                    return `<i class="bi ${archiveIcons[data] || archiveIcons.other}" style="font-size:1.4rem;"></i>`;
                }
            },
            {
                data: 'title',
                render: function (data) {
                    return `<span class="text-dark fw-bolder text-hover-primary d-block fs-6">${data}</span>`;
                }
            },
            {
                data: 'original_name',
                render: function (data) {
                    let name = data.length > 35 ? data.substring(0, 35) + '...' : data;
                    return `<span class="text-muted fw-bold" title="${data}">${name}</span>`;
                }
            },
            {
                data: 'file_size_formatted',
                render: function (data) {
                    return `<span class="badge badge-light">${data}</span>`;
                }
            },
            {
                data: 'is_active',
                render: function (data, type, row) {
                    let checked = data ? 'checked' : '';
                    return `<div class="form-check form-check-solid form-switch fv-row">
                        <input class="form-check-input w-45px h-30px" type="checkbox" ${checked}
                            onchange="toggleStatus(${row.id})">
                    </div>`;
                }
            },
            {
                data: 'created_at',
                render: function (data) {
                    if (!data) return '-';
                    return `<span class="text-muted fw-bold">${new Date(data).toLocaleDateString('en-GB')}</span>`;
                }
            },
            {
                data: 'actions', orderable: false, searchable: false,
                className: 'text-end',
                render: function (data) {
                    return `<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        Actions <span class="svg-icon svg-icon-5 m-0"><i class="bi bi-chevron-down"></i></span>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="/developer/media/archives/download/${data}" class="menu-link px-3"><i class="bi bi-download me-2"></i>Download</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="/developer/media/archives/save/${data}" class="menu-link px-3"><i class="bi bi-pencil me-2"></i>Edit</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="javascript:void(0);" class="menu-link px-3 text-danger" onclick="deleteItem(${data})"><i class="bi bi-trash me-2"></i>Delete</a>
                        </div>
                    </div>`;
                }
            }
        ],
        order: [[0, 'desc']],
        dom: 'rtip',
        language: {
            processing: '<span class="spinner-border spinner-border-sm align-middle ms-2"></span>',
            emptyTable: '<div class="text-center py-10"><i class="bi bi-file-earmark-zip text-gray-400" style="font-size:3rem;"></i><p class="text-gray-400 mt-3 mb-0">No archives found</p></div>',
        },
        drawCallback: function (settings) {
            $('#totalCount').text('Total: ' + (settings._iRecordsTotal || 0));
            KTMenu.createInstances();
        }
    });
}

function initSearch() {
    let timer;
    $('#searchInput').on('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(() => { dataTable.search($(this).val()).draw(); }, 400);
    });
}

function reloadDatatable() { dataTable.ajax.reload(null, false); }

function toggleStatus(id) {
    helperForm.sendAjax({
        url: '/developer/media/archives/toggle-status',
        data: { id: id },
        onSuccess: function () { reloadDatatable(); }
    });
}

function deleteItem(id) {
    helperConfirm.deleteConfirm(function () {
        helperForm.sendAjax({
            url: '/developer/media/archives/delete',
            type: 'DELETE',
            data: { id: id },
            onSuccess: function () { reloadDatatable(); helperSwal.success('Archive deleted!'); }
        });
    });
}
