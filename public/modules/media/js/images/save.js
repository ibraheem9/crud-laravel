/**
 * Single Image CRUD - Save Form
 * FilePond for upload + Doka for image editing
 */

let pond;

$(document).ready(function () {
    initFilePond();
    initForm();
});

/**
 * Initialize FilePond with image preview and validation plugins.
 */
function initFilePond() {
    // Register plugins
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Create FilePond instance
    pond = FilePond.create(document.querySelector('#imageInput'), {
        allowMultiple: false,
        maxFiles: 1,
        maxFileSize: '10MB',
        acceptedFileTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
        labelIdle: '<div class="text-center py-3">' +
            '<i class="bi bi-cloud-arrow-up" style="font-size:2.5rem;color:#6366f1;"></i>' +
            '<p class="mt-2 mb-1 fw-semibold text-dark">Drag & drop your image here</p>' +
            '<p class="text-muted small mb-0">or <span class="text-primary" style="cursor:pointer;">Browse Files</span></p>' +
            '</div>',
        labelFileProcessing: 'Uploading...',
        labelFileProcessingComplete: 'Upload complete',
        labelFileProcessingAborted: 'Upload cancelled',
        labelFileProcessingError: 'Error during upload',
        labelTapToCancel: 'tap to cancel',
        labelTapToRetry: 'tap to retry',
        stylePanelLayout: 'compact',
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'right bottom',
        styleButtonRemoveItemPosition: 'left bottom',
        imagePreviewHeight: 250,
        credits: false,
    });
}

/**
 * Initialize form submission with helperForm.
 */
function initForm() {
    helperForm.submit({
        formId: 'saveForm',
        url: '/developer/media/images/store',
        hasFile: true,
        beforeSend: function (formData) {
            // Append FilePond file if exists
            let files = pond.getFiles();
            if (files.length > 0 && files[0].file) {
                formData.append('image', files[0].file);
            }
            return formData;
        },
        onSuccess: function (response) {
            helperSwal.success(response.message, function () {
                window.location.href = '/developer/media/images';
            });
        }
    });
}

/**
 * Open Doka image editor for the current image.
 */
function openDokaEditor() {
    let imgSrc = document.getElementById('previewImg').src;

    // Check if Doka is available
    if (typeof Doka === 'undefined') {
        helperSwal.error('Image editor is not loaded');
        return;
    }

    let editor = Doka.create({
        src: imgSrc,
        cropAspectRatio: null,
        cropAspectRatioOptions: [
            { label: 'Free', value: null },
            { label: 'Square', value: 1 },
            { label: '16:9', value: 1.7778 },
            { label: '4:3', value: 1.3333 },
            { label: '3:2', value: 1.5 },
        ],
        outputType: 'blob',
        outputQuality: 90,
        onconfirm: function (output) {
            saveEditedImage(output.file);
        },
        oncancel: function () {
            // Editor closed
        }
    });
}

/**
 * Save the edited image back to the server.
 */
function saveEditedImage(blob) {
    let formData = new FormData();
    formData.append('id', $('input[name="id"]').val());
    formData.append('image', blob, 'edited-image.jpg');
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    helperForm.sendAjax({
        url: '/developer/media/images/store-edited',
        data: formData,
        processData: false,
        contentType: false,
        onSuccess: function (response) {
            // Update preview
            if (response.data && response.data.image_url) {
                document.getElementById('previewImg').src = response.data.image_url + '?t=' + Date.now();
            }
            helperSwal.success('Image edited and saved!');
        }
    });
}

/**
 * Remove current image preview and show FilePond uploader.
 */
function removeCurrentImage() {
    helperConfirm.deleteConfirm(function () {
        $('#currentImagePreview').fadeOut(300, function () {
            $(this).remove();
        });
    }, 'Remove current image?');
}
