/**
 * Gallery CRUD - Save Form
 * FilePond multi-upload + SortableJS for reordering
 */

let pond;

$(document).ready(function () {
    initFilePond();
    initSortable();
    initForm();
});

function initFilePond() {
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    pond = FilePond.create(document.querySelector('#galleryInput'), {
        allowMultiple: true,
        maxFiles: 20,
        maxFileSize: '10MB',
        acceptedFileTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
        labelIdle: '<div class="text-center py-3">' +
            '<i class="bi bi-images" style="font-size:2.5rem;color:#22c55e;"></i>' +
            '<p class="mt-2 mb-1 fw-semibold text-dark">Drag & drop multiple images here</p>' +
            '<p class="text-muted small mb-0">or <span class="text-success" style="cursor:pointer;">Browse Files</span> (max 20 images)</p>' +
            '</div>',
        imagePreviewHeight: 150,
        credits: false,
    });
}

function initSortable() {
    let grid = document.getElementById('galleryGrid');
    if (!grid) return;

    new Sortable(grid, {
        animation: 300,
        ghostClass: 'sortable-ghost',
        onEnd: function () {
            // Update order numbers
            let items = [];
            grid.querySelectorAll('.gallery-item').forEach(function (el, index) {
                el.querySelector('.item-order').textContent = index + 1;
                items.push(el.dataset.id);
            });

            // Save sort order to server
            helperForm.sendAjax({
                url: '/developer/media/gallery/update-sort',
                data: { items: items },
                onSuccess: function () {
                    // Silent success
                }
            });
        }
    });
}

function initForm() {
    helperForm.submit({
        formId: 'saveForm',
        url: '/developer/media/gallery/store',
        hasFile: true,
        beforeSend: function (formData) {
            // Append FilePond files
            let files = pond.getFiles();
            files.forEach(function (fileItem, index) {
                if (fileItem.file) {
                    formData.append('images[' + index + ']', fileItem.file);
                }
            });
            return formData;
        },
        onSuccess: function (response) {
            helperSwal.success(response.message, function () {
                window.location.href = '/developer/media/gallery';
            });
        }
    });
}

function removeGalleryItem(itemId) {
    helperConfirm.deleteConfirm(function () {
        helperForm.sendAjax({
            url: '/developer/media/gallery/remove-item',
            data: { item_id: itemId },
            onSuccess: function () {
                // Remove from DOM
                $(`.gallery-item[data-id="${itemId}"]`).fadeOut(300, function () {
                    $(this).remove();
                    // Re-number remaining items
                    $('#galleryGrid .gallery-item .item-order').each(function (i) {
                        $(this).text(i + 1);
                    });
                });
                helperSwal.success('Image removed');
            }
        });
    }, 'Remove this image from gallery?');
}

function editCaption(itemId, currentCaption) {
    Swal.fire({
        title: 'Edit Caption',
        input: 'text',
        inputValue: currentCaption || '',
        inputPlaceholder: 'Enter caption...',
        showCancelButton: true,
        confirmButtonText: 'Save',
        confirmButtonColor: '#22c55e',
    }).then(function (result) {
        if (result.isConfirmed) {
            helperForm.sendAjax({
                url: '/developer/media/gallery/update-caption',
                data: { item_id: itemId, caption: result.value },
                onSuccess: function () {
                    helperSwal.success('Caption updated');
                    location.reload();
                }
            });
        }
    });
}
