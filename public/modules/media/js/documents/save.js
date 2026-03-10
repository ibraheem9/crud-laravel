/**
 * Documents CRUD - Save Form
 * FilePond for document upload (PDF, Word, Excel, PPT)
 */

let pond;

$(document).ready(function () {
    initFilePond();
    initForm();
});

function initFilePond() {
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    pond = FilePond.create(document.querySelector('#documentInput'), {
        allowMultiple: false,
        maxFiles: 1,
        maxFileSize: '20MB',
        acceptedFileTypes: [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ],
        labelIdle: '<div class="text-center py-3">' +
            '<i class="bi bi-file-earmark-arrow-up" style="font-size:2.5rem;color:#0dcaf0;"></i>' +
            '<p class="mt-2 mb-1 fw-semibold text-dark">Drag & drop your document here</p>' +
            '<p class="text-muted small mb-0">PDF, Word, Excel, PowerPoint (max 20MB)</p>' +
            '</div>',
        credits: false,
    });
}

function initForm() {
    helperForm.submit({
        formId: 'saveForm',
        url: '/developer/media/documents/store',
        hasFile: true,
        beforeSend: function (formData) {
            let files = pond.getFiles();
            if (files.length > 0 && files[0].file) {
                formData.append('document', files[0].file);
            }
            return formData;
        },
        onSuccess: function (response) {
            helperSwal.success(response.message, function () {
                window.location.href = '/developer/media/documents';
            });
        }
    });
}
