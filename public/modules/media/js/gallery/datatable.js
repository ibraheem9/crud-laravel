/**
 * Gallery CRUD - DataTable
 */

let dataTable;

$(document).ready(function () {
    initDataTable();
    initSearch();
});

function initDataTable() {
    dataTable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: { url: '/developer/media/gallery/datatable', type: 'GET' },
        columns: [
            {
                data: 'id',
                render: function (data) {
                    return `<span class="badge bg-light text-dark border">${data}</span>`;
                }
            },
            {
                data: 'cover_image_url',
                orderable: false,
                searchable: false,
                render: function (data) {
                    return `<img src="${data}" class="rounded shadow-sm" style="width:50px;height:50px;object-fit:cover;"
                        onerror="this.src='https://via.placeholder.com/50x50?text=No+Cover'">`;
                }
            },
            {
                data: 'title',
                render: function (data) {
                    return `<span class="fw-semibold text-dark">${data}</span>`;
                }
            },
            {
                data: 'description',
                render: function (data) {
                    if (!data) return '<small class="text-muted fst-italic">No description</small>';
                    return `<small class="text-muted">${data.length > 60 ? data.substring(0, 60) + '...' : data}</small>`;
                }
            },
            {
                data: 'items_count',
                render: function (data) {
                    return `<span class="badge bg-success-subtle text-success">${data} images</span>`;
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
                data: 'actions',
                orderable: false,
                searchable: false,
                render: function (data) {
                    return `<div class="d-flex gap-1">
                        <a href="/developer/media/gallery/save/${data}" class="btn btn-sm btn-outline-success" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${data})" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>`;
                }
            }
        ],
        order: [[0, 'desc']],
        dom: 'rtip',
        language: {
            processing: '<div class="spinner-border spinner-border-sm text-success"><span class="visually-hidden">Loading...</span></div>',
            emptyTable: '<div class="text-center py-4"><i class="bi bi-images text-muted" style="font-size:2rem;"></i><p class="text-muted mt-2 mb-0">No galleries found</p></div>',
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

function reloadDatatable() { dataTable.ajax.reload(null, false); }

function toggleStatus(id) {
    helperForm.sendAjax({
        url: '/developer/media/gallery/toggle-status',
        data: { id: id },
        onSuccess: function () { reloadDatatable(); }
    });
}

function deleteItem(id) {
    helperConfirm.deleteConfirm(function () {
        helperForm.sendAjax({
            url: '/developer/media/gallery/delete',
            type: 'DELETE',
            data: { id: id },
            onSuccess: function () { reloadDatatable(); helperSwal.success('Gallery deleted!'); }
        });
    });
}
