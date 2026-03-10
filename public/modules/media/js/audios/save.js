let pond;
$(document).ready(function () { initFilePond(); initForm(); });

function initFilePond() {
    FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
    pond = FilePond.create(document.querySelector('#audioInput'), {
        allowMultiple: false, maxFiles: 1, maxFileSize: '30MB',
        acceptedFileTypes: ['audio/mpeg', 'audio/wav', 'audio/ogg', 'audio/aac', 'audio/flac', 'audio/mp3'],
        labelIdle: '<div class="text-center py-3"><i class="bi bi-music-note-beamed" style="font-size:2.5rem;color:#8b5cf6;"></i><p class="mt-2 mb-1 fw-semibold text-dark">Drag & drop your audio file here</p><p class="text-muted small mb-0">MP3, WAV, OGG, AAC, FLAC (max 30MB)</p></div>',
        credits: false,
    });
}

function initForm() {
    helperForm.submit({
        formId: 'saveForm', url: '/developer/media/audios/store', hasFile: true,
        beforeSend: function (formData) {
            let files = pond.getFiles();
            if (files.length > 0 && files[0].file) formData.append('audio', files[0].file);
            return formData;
        },
        onSuccess: function (response) {
            helperSwal.success(response.message, () => { window.location.href = '/developer/media/audios'; });
        }
    });
}
