/**
 * Video CRUD - DataTable with thumbnail and video preview modal
 */
let dataTable;

$(document).ready(function () { initDataTable(); initSearch(); });

function initDataTable() {
    dataTable = $('#dataTable').DataTable({
        processing: true, serverSide: true,
        ajax: { url: '/developer/media/videos/datatable', type: 'GET' },
        columns: [
            { data: 'id', render: d => `<span class="badge bg-light text-dark border">${d}</span>` },
            { data: 'thumbnail_url', orderable: false, searchable: false, render: (d, t, r) => {
                let thumb = d || 'https://via.placeholder.com/120x70?text=No+Thumb';
                return `<div style="position:relative;cursor:pointer;width:120px;height:70px;" onclick="previewVideo('${r.file_url}', '${r.title}')">
                    <img src="${thumb}" class="rounded shadow-sm" style="width:120px;height:70px;object-fit:cover;" onerror="this.src='https://via.placeholder.com/120x70?text=No+Thumb'">
                    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(0,0,0,0.6);border-radius:50%;width:30px;height:30px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-play-fill text-white"></i>
                    </div>
                </div>`;
            }},
            { data: 'title', render: d => `<span class="fw-semibold text-dark">${d}</span>` },
            { data: 'original_name', render: d => `<small class="text-muted">${d.length > 30 ? d.substring(0,30)+'...' : d}</small>` },
            { data: 'file_size_formatted', render: d => `<span class="badge bg-light text-dark border">${d}</span>` },
            { data: 'is_active', render: (d, t, r) => `<div class="form-check form-switch"><input class="form-check-input" type="checkbox" ${d?'checked':''} onchange="toggleStatus(${r.id})" style="cursor:pointer;"></div>` },
            { data: 'created_at', render: d => d ? `<small class="text-muted">${new Date(d).toLocaleDateString('en-GB')}</small>` : '-' },
            { data: 'actions', orderable: false, searchable: false, render: d => `<div class="d-flex gap-1"><a href="/developer/media/videos/save/${d}" class="btn btn-sm btn-outline-danger" title="Edit"><i class="bi bi-pencil"></i></a><button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${d})"><i class="bi bi-trash"></i></button></div>` }
        ],
        order: [[0, 'desc']], dom: 'rtip',
        language: { emptyTable: '<div class="text-center py-4"><i class="bi bi-camera-video text-muted" style="font-size:2rem;"></i><p class="text-muted mt-2 mb-0">No videos found</p></div>' },
        drawCallback: function (s) { $('#totalCount').text('Total: ' + (s._iRecordsTotal || 0)); }
    });
}

function initSearch() { let t; $('#searchInput').on('keyup', function () { clearTimeout(t); t = setTimeout(() => { dataTable.search($(this).val()).draw(); }, 400); }); }
function reloadDatatable() { dataTable.ajax.reload(null, false); }
function toggleStatus(id) { helperForm.sendAjax({ url: '/developer/media/videos/toggle-status', data: { id }, onSuccess: () => reloadDatatable() }); }
function deleteItem(id) { helperConfirm.deleteConfirm(() => { helperForm.sendAjax({ url: '/developer/media/videos/delete', type: 'DELETE', data: { id }, onSuccess: () => { reloadDatatable(); helperSwal.success('Deleted!'); } }); }); }

function previewVideo(url, title) {
    let player = document.getElementById('videoPlayer');
    player.src = url;
    document.getElementById('videoPreviewTitle').textContent = title || 'Video Preview';
    new bootstrap.Modal(document.getElementById('videoPreviewModal')).show();
}

function pauseVideo() {
    let player = document.getElementById('videoPlayer');
    player.pause();
    player.src = '';
}
