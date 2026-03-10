let dataTable;
const archiveIcons = { zip: 'bi-file-earmark-zip text-warning', rar: 'bi-file-earmark-zip text-danger', '7z': 'bi-file-earmark-zip text-info', tar: 'bi-file-earmark-zip text-secondary', gz: 'bi-file-earmark-zip text-success', other: 'bi-file-earmark text-muted' };

$(document).ready(function () { initDataTable(); initSearch(); });

function initDataTable() {
    dataTable = $('#dataTable').DataTable({
        processing: true, serverSide: true,
        ajax: { url: '/developer/media/archives/datatable', type: 'GET' },
        columns: [
            { data: 'id', render: d => `<span class="badge bg-light text-dark border">${d}</span>` },
            { data: 'type', orderable: false, render: d => `<i class="bi ${archiveIcons[d] || archiveIcons.other}" style="font-size:1.4rem;"></i>` },
            { data: 'title', render: d => `<span class="fw-semibold text-dark">${d}</span>` },
            { data: 'original_name', render: d => `<small class="text-muted">${d.length > 35 ? d.substring(0,35)+'...' : d}</small>` },
            { data: 'file_size_formatted', render: d => `<span class="badge bg-light text-dark border">${d}</span>` },
            { data: 'is_active', render: (d, t, r) => `<div class="form-check form-switch"><input class="form-check-input" type="checkbox" ${d?'checked':''} onchange="toggleStatus(${r.id})" style="cursor:pointer;"></div>` },
            { data: 'created_at', render: d => d ? `<small class="text-muted">${new Date(d).toLocaleDateString('en-GB')}</small>` : '-' },
            { data: 'actions', orderable: false, searchable: false, render: (d) => `<div class="d-flex gap-1"><a href="/developer/media/archives/download/${d}" class="btn btn-sm btn-outline-secondary" title="Download"><i class="bi bi-download"></i></a><a href="/developer/media/archives/save/${d}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a><button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${d})"><i class="bi bi-trash"></i></button></div>` }
        ],
        order: [[0, 'desc']], dom: 'rtip',
        language: { emptyTable: '<div class="text-center py-4"><i class="bi bi-file-earmark-zip text-muted" style="font-size:2rem;"></i><p class="text-muted mt-2 mb-0">No archives found</p></div>' },
        drawCallback: function (s) { $('#totalCount').text('Total: ' + (s._iRecordsTotal || 0)); }
    });
}

function initSearch() { let t; $('#searchInput').on('keyup', function () { clearTimeout(t); t = setTimeout(() => { dataTable.search($(this).val()).draw(); }, 400); }); }
function reloadDatatable() { dataTable.ajax.reload(null, false); }
function toggleStatus(id) { helperForm.sendAjax({ url: '/developer/media/archives/toggle-status', data: { id }, onSuccess: () => reloadDatatable() }); }
function deleteItem(id) { helperConfirm.deleteConfirm(() => { helperForm.sendAjax({ url: '/developer/media/archives/delete', type: 'DELETE', data: { id }, onSuccess: () => { reloadDatatable(); helperSwal.success('Deleted!'); } }); }); }
