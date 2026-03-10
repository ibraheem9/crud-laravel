/**
 * Audio CRUD - DataTable with inline audio player
 */
let dataTable;

$(document).ready(function () { initDataTable(); initSearch(); });

function initDataTable() {
    dataTable = $('#dataTable').DataTable({
        processing: true, serverSide: true,
        ajax: { url: '/developer/media/audios/datatable', type: 'GET' },
        columns: [
            { data: 'id', render: d => `<span class="badge bg-light text-dark border">${d}</span>` },
            { data: 'title', render: (d, t, r) => {
                let artist = r.artist ? `<br><small class="text-muted">${r.artist}</small>` : '';
                return `<span class="fw-semibold text-dark">${d}</span>${artist}`;
            }},
            { data: 'original_name', render: d => `<small class="text-muted">${d.length > 30 ? d.substring(0,30)+'...' : d}</small>` },
            { data: 'file_url', orderable: false, searchable: false, render: d => {
                return `<audio controls preload="none" style="height:32px;width:220px;"><source src="${d}"></audio>`;
            }},
            { data: 'file_size_formatted', render: d => `<span class="badge bg-light text-dark border">${d}</span>` },
            { data: 'is_active', render: (d, t, r) => `<div class="form-check form-switch"><input class="form-check-input" type="checkbox" ${d?'checked':''} onchange="toggleStatus(${r.id})" style="cursor:pointer;"></div>` },
            { data: 'created_at', render: d => d ? `<small class="text-muted">${new Date(d).toLocaleDateString('en-GB')}</small>` : '-' },
            { data: 'actions', orderable: false, searchable: false, render: d => `<div class="d-flex gap-1"><a href="/developer/media/audios/save/${d}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a><button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${d})"><i class="bi bi-trash"></i></button></div>` }
        ],
        order: [[0, 'desc']], dom: 'rtip',
        language: { emptyTable: '<div class="text-center py-4"><i class="bi bi-music-note-beamed text-muted" style="font-size:2rem;"></i><p class="text-muted mt-2 mb-0">No audio files found</p></div>' },
        drawCallback: function (s) { $('#totalCount').text('Total: ' + (s._iRecordsTotal || 0)); }
    });
}

function initSearch() { let t; $('#searchInput').on('keyup', function () { clearTimeout(t); t = setTimeout(() => { dataTable.search($(this).val()).draw(); }, 400); }); }
function reloadDatatable() { dataTable.ajax.reload(null, false); }
function toggleStatus(id) { helperForm.sendAjax({ url: '/developer/media/audios/toggle-status', data: { id }, onSuccess: () => reloadDatatable() }); }
function deleteItem(id) { helperConfirm.deleteConfirm(() => { helperForm.sendAjax({ url: '/developer/media/audios/delete', type: 'DELETE', data: { id }, onSuccess: () => { reloadDatatable(); helperSwal.success('Deleted!'); } }); }); }
