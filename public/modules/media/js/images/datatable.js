/**
 * Single Image CRUD - DataTable
 * Uses Yajra DataTables with elegant design
 */

let dataTable;

$(document).ready(function () {
    initDataTable();
    initSearch();
    initCheckAll();
});

function initDataTable() {
    dataTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/developer/media/images/datatable',
            type: 'GET',
        },
        columns: [
            {
                data: 'id',
                orderable: false,
                searchable: false,
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
                data: 'image_url',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<img src="${data}" alt="${row.alt_text || ''}"
                        class="rounded shadow-sm" style="width:60px;height:60px;object-fit:cover;cursor:pointer;"
                        onclick="window.open('${data}','_blank')"
                        onerror="this.src='https://via.placeholder.com/60x60?text=No+Image'">`;
                }
            },
            {
                data: 'title',
                render: function (data) {
                    return `<span class="fw-semibold text-dark">${data}</span>`;
                }
            },
            {
                data: 'alt_text',
                render: function (data) {
                    return data ? `<small class="text-muted">${data}</small>` : '<small class="text-muted fst-italic">Not set</small>';
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
                    let d = new Date(data);
                    return `<small class="text-muted">${d.toLocaleDateString('en-GB')}</small>`;
                }
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<div class="d-flex gap-1">
                        <a href="/developer/media/images/save/${data}" class="btn btn-sm btn-outline-primary" title="Edit">
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
            processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
            emptyTable: '<div class="text-center py-4"><i class="bi bi-image text-muted" style="font-size:2rem;"></i><p class="text-muted mt-2 mb-0">No images found</p></div>',
        },
        drawCallback: function (settings) {
            let total = settings._iRecordsTotal || 0;
            $('#totalCount').text('Total: ' + total);
        }
    });
}

function initSearch() {
    let timer;
    $('#searchInput').on('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            dataTable.search($(this).val()).draw();
        }, 400);
    });
}

function initCheckAll() {
    $('#checkAll').on('change', function () {
        let checked = $(this).prop('checked');
        $('.row-checkbox').prop('checked', checked);
        toggleMultiDeleteBtn();
    });

    $(document).on('change', '.row-checkbox', function () {
        toggleMultiDeleteBtn();
    });
}

function toggleMultiDeleteBtn() {
    let count = $('.row-checkbox:checked').length;
    if (count > 0) {
        $('#btnMultiDelete').removeClass('d-none').html(`<i class="bi bi-trash"></i> Delete (${count})`);
    } else {
        $('#btnMultiDelete').addClass('d-none');
    }
}

function reloadDatatable() {
    dataTable.ajax.reload(null, false);
}

function toggleStatus(id) {
    helperForm.sendAjax({
        url: '/developer/media/images/toggle-status',
        data: { id: id },
        onSuccess: function () {
            reloadDatatable();
        }
    });
}

function deleteItem(id) {
    helperConfirm.deleteConfirm(function () {
        helperForm.sendAjax({
            url: '/developer/media/images/delete',
            type: 'DELETE',
            data: { id: id },
            onSuccess: function () {
                reloadDatatable();
                helperSwal.success('Deleted!');
            }
        });
    });
}

function multiDelete() {
    let ids = [];
    $('.row-checkbox:checked').each(function () {
        ids.push($(this).val());
    });

    if (ids.length === 0) return;

    helperConfirm.deleteConfirm(function () {
        helperForm.sendAjax({
            url: '/developer/media/images/multi-delete',
            data: { ids: ids },
            onSuccess: function () {
                reloadDatatable();
                $('#checkAll').prop('checked', false);
                toggleMultiDeleteBtn();
                helperSwal.success(ids.length + ' images deleted');
            }
        });
    }, 'Delete ' + ids.length + ' images?');
}
