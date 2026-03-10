/**
 * Documents CRUD - DataTable
 */

let dataTable;

const typeIcons = {
    pdf: '<i class="bi bi-file-earmark-pdf text-danger" style="font-size:1.4rem;"></i>',
    word: '<i class="bi bi-file-earmark-word text-primary" style="font-size:1.4rem;"></i>',
    excel: '<i class="bi bi-file-earmark-excel text-success" style="font-size:1.4rem;"></i>',
    powerpoint: '<i class="bi bi-file-earmark-ppt text-warning" style="font-size:1.4rem;"></i>',
    other: '<i class="bi bi-file-earmark text-secondary" style="font-size:1.4rem;"></i>',
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
                    return `<input type="checkbox" class="form-check-input row-checkbox" value="${data}">`;
                }
            },
            {
                data: 'id',
                render: function (data) {
                    return `<span class="badge bg-light text-dark border">${data}</span>`;
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
                    return `<span class="fw-semibold text-dark">${data}</span>`;
                }
            },
            {
                data: 'original_name',
                render: function (data) {
                    let name = data.length > 35 ? data.substring(0, 35) + '...' : data;
                    return `<small class="text-muted" title="${data}">${name}</small>`;
                }
            },
            {
                data: 'file_size_formatted',
                render: function (data) {
                    return `<span class="badge bg-light text-dark border">${data}</span>`;
                }
            },
            {
                data: 'is_active',
                render: function (data, type, row) {
                    let checked = data ? 'checked' : '';
                    return `<div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" ${checked}
                            onchange="toggleStatus(${row.id})" style="cursor:pointer;">
                    </div>`;
                }
            },
            {
                data: 'created_at',
                render: function (data) {
                    if (!data) return '-';
                    return `<small class="text-muted">${new Date(data).toLocaleDateString('en-GB')}</small>`;
                }
            },
            {
                data: 'actions', orderable: false, searchable: false,
                render: function (data, type, row) {
                    return `<div class="d-flex gap-1">
                        <a href="/developer/media/documents/download/${data}" class="btn btn-sm btn-outline-secondary" title="Download">
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="/developer/media/documents/save/${data}" class="btn btn-sm btn-outline-info" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${data})" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>`;
                }
            }
        ],
        order: [[1, 'desc']],
        dom: 'rtip',
        language: {
            processing: '<div class="spinner-border spinner-border-sm text-info"><span class="visually-hidden">Loading...</span></div>',
            emptyTable: '<div class="text-center py-4"><i class="bi bi-file-earmark-text text-muted" style="font-size:2rem;"></i><p class="text-muted mt-2 mb-0">No documents found</p></div>',
        },
        drawCallback: function (settings) {
            $('#totalCount').text('Total: ' + (settings._iRecordsTotal || 0));
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
        $('#btnMultiDelete').removeClass('d-none').html(`<i class="bi bi-trash"></i> Delete (${count})`);
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
