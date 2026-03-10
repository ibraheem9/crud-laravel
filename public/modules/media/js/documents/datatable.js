/**
 * Documents CRUD - DataTable (Metronic 8)
 */

let dataTable;

const typeIcons = {
    pdf: '<i class="bi bi-file-earmark-pdf text-danger" style="font-size:1.4rem;"></i>',
    word: '<i class="bi bi-file-earmark-word text-primary" style="font-size:1.4rem;"></i>',
    excel: '<i class="bi bi-file-earmark-excel text-success" style="font-size:1.4rem;"></i>',
    powerpoint: '<i class="bi bi-file-earmark-ppt text-warning" style="font-size:1.4rem;"></i>',
    other: '<i class="bi bi-file-earmark text-gray-500" style="font-size:1.4rem;"></i>',
};

$(document).ready(function () {
    initDataTable();
    initSearch();
    initCheckAll();
    initTypeFilter();
});

function initDataTable() {
    dataTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url: '/developer/media/documents/datatable', type: 'GET' },
        columns: [
            {
                data: 'id', orderable: false, searchable: false,
                render: function (data) {
                    return `<div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input row-checkbox" type="checkbox" value="${data}">
                    </div>`;
                }
            },
            {
                data: 'id',
                render: function (data) {
                    return `<span class="badge badge-light fw-bolder">${data}</span>`;
                }
            },
            {
                data: 'type', orderable: false,
                render: function (data) {
                    return typeIcons[data] || typeIcons.other;
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
                            <a href="/developer/media/documents/download/${data}" class="menu-link px-3"><i class="bi bi-download me-2"></i>Download</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="/developer/media/documents/save/${data}" class="menu-link px-3"><i class="bi bi-pencil me-2"></i>Edit</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="javascript:void(0);" class="menu-link px-3 text-danger" onclick="deleteItem(${data})"><i class="bi bi-trash me-2"></i>Delete</a>
                        </div>
                    </div>`;
                }
            }
        ],
        order: [[1, 'desc']],
        dom: 'rtip',
        language: {
            processing: '<span class="spinner-border spinner-border-sm align-middle ms-2"></span>',
            emptyTable: '<div class="text-center py-10"><i class="bi bi-file-earmark-text text-gray-400" style="font-size:3rem;"></i><p class="text-gray-400 mt-3 mb-0">No documents found</p></div>',
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

function initTypeFilter() {
    $('#typeFilter').on('change', function () {
        dataTable.column(2).search($(this).val()).draw();
    });
}

function initCheckAll() {
    $('#checkAll').on('change', function () {
        $('.row-checkbox').prop('checked', $(this).prop('checked'));
        toggleMultiDeleteBtn();
    });
    $(document).on('change', '.row-checkbox', function () { toggleMultiDeleteBtn(); });
}

function toggleMultiDeleteBtn() {
    let count = $('.row-checkbox:checked').length;
    if (count > 0) {
        $('#btnMultiDelete').removeClass('d-none').html(`<i class="bi bi-trash me-1"></i> Delete (${count})`);
    } else {
        $('#btnMultiDelete').addClass('d-none');
    }
}

function reloadDatatable() { dataTable.ajax.reload(null, false); }

function toggleStatus(id) {
    helperForm.sendAjax({
        url: '/developer/media/documents/toggle-status',
        data: { id: id },
        onSuccess: function () { reloadDatatable(); }
    });
}

function deleteItem(id) {
    helperConfirm.deleteConfirm(function () {
        helperForm.sendAjax({
            url: '/developer/media/documents/delete',
            type: 'DELETE',
            data: { id: id },
            onSuccess: function () { reloadDatatable(); helperSwal.success('Document deleted!'); }
        });
    });
}

function multiDelete() {
    let ids = [];
    $('.row-checkbox:checked').each(function () { ids.push($(this).val()); });
    if (ids.length === 0) return;

    helperConfirm.deleteConfirm(function () {
        helperForm.sendAjax({
            url: '/developer/media/documents/multi-delete',
            data: { ids: ids },
            onSuccess: function () {
                reloadDatatable();
                $('#checkAll').prop('checked', false);
                toggleMultiDeleteBtn();
                helperSwal.success(ids.length + ' documents deleted');
            }
        });
    }, 'Delete ' + ids.length + ' documents?');
}
