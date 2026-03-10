/**
 * Video CRUD - Save Form
 * FilePond for video + thumbnail upload
 */
let videoPond, thumbPond;

$(document).ready(function () { initFilePond(); initForm(); });

function initFilePond() {
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    // Video FilePond
    videoPond = FilePond.create(document.querySelector('#videoInput'), {
        allowMultiple: false, maxFiles: 1, maxFileSize: '100MB',
        acceptedFileTypes: ['video/mp4', 'video/webm', 'video/avi', 'video/quicktime', 'video/x-msvideo'],
        labelIdle: '<div class="text-center py-3"><i class="bi bi-camera-video" style="font-size:2.5rem;color:#dc3545;"></i><p class="mt-2 mb-1 fw-semibold text-dark">Drag & drop your video here</p><p class="text-muted small mb-0">MP4, WebM, AVI, MOV (max 100MB)</p></div>',
        credits: false,
    });

    // Thumbnail FilePond
    thumbPond = FilePond.create(document.querySelector('#thumbnailInput'), {
        allowMultiple: false, maxFiles: 1, maxFileSize: '5MB',
        acceptedFileTypes: ['image/jpeg', 'image/png', 'image/webp'],
        labelIdle: '<div class="text-center py-2"><i class="bi bi-image" style="font-size:1.5rem;color:#dc3545;"></i><p class="mt-1 mb-0 small fw-semibold">Drop thumbnail image</p></div>',
        imagePreviewHeight: 120, credits: false,
    });
}

function initForm() {
    helperForm.submit({
        formId: 'saveForm', url: '/developer/media/videos/store', hasFile: true,
        beforeSend: function (formData) {
            let videoFiles = videoPond.getFiles();
            if (videoFiles.length > 0 && videoFiles[0].file) formData.append('video', videoFiles[0].file);
            let thumbFiles = thumbPond.getFiles();
            if (thumbFiles.length > 0 && thumbFiles[0].file) formData.append('thumbnail', thumbFiles[0].file);
            return formData;
        },
        onSuccess: function (response) {
            helperSwal.success(response.message, () => { window.location.href = '/developer/media/videos'; });
        }
    });
}
