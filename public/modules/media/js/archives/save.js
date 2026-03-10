let pond;
$(document).ready(function () { initFilePond(); initForm(); });

function initFilePond() {
    FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
    pond = FilePond.create(document.querySelector('#archiveInput'), {
        allowMultiple: false, maxFiles: 1, maxFileSize: '50MB',
        acceptedFileTypes: ['application/zip', 'application/x-rar-compressed', 'application/x-7z-compressed', 'application/x-tar', 'application/gzip', 'application/vnd.rar'],
        labelIdle: '<div class="text-center py-3"><i class="bi bi-file-earmark-zip" style="font-size:2.5rem;color:#ffc107;"></i><p class="mt-2 mb-1 fw-semibold text-dark">Drag & drop your archive here</p><p class="text-muted small mb-0">ZIP, RAR, 7z, TAR, GZ (max 50MB)</p></div>',
        credits: false,
    });
}

function initForm() {
    helperForm.submit({
        formId: 'saveForm', url: '/developer/media/archives/store', hasFile: true,
        beforeSend: function (formData) {
            let files = pond.getFiles();
            if (files.length > 0 && files[0].file) formData.append('archive', files[0].file);
            return formData;
        },
        onSuccess: function (response) {
            helperSwal.success(response.message, () => { window.location.href = '/developer/media/archives'; });
        }
    });
}
