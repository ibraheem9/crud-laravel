function  initFilepond(is_required = true, acceptedTypes = ['application/pdf' ], name= 'details[file]', maxSize = "5MB"){

    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);


    FilePond.parse(document.body);

     pond = document.querySelector('.filepond--root');
    FilePond.setOptions({
        required: is_required,
        element: '.filepond-parent',
        checkValidity: true,
        stylePanelLayout: 'integrated',
        name: name,
        labelIdle: 'اسحب الملف أو <span class="filepond--label-action"> اضغط هنا </span>',
        labelFileTypeNotAllowed: 'نوع الملف غير صحيح',
        instantUpload: false,
        acceptedFileTypes: acceptedTypes,
        maxFileSize:  maxSize,
        labelMaxFileSizeExceeded: 'حجم الملف كبير',
        labelMaxFileSize: 'الحد الأقصى لحجم الملف هو {filesize}'

    });

    filepond_selected = null;

    if(pond){
        pond.addEventListener('FilePond:addfile', e => {
            console.log('File added', e.detail);
            filepond_selected = e.detail.file;
        });
    }


}
