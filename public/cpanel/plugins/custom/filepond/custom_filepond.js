
class CustomPond {
    constructor(pond, doka, processedImg) {
      this.pond = pond;
      this.doka = doka;
    }

    // Method
    setprocessedImg(newProcessedImg) {
      return this.processedImg  = newProcessedImg;
    }
}

var CustomFilepond = function () {


    return {
        init: function (options) {

            let processedImage = null;

            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageEdit,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
                FilePondPluginImageTransform
            );


            let imgInput = document.querySelector(options.imgInputSelector);
            let default_file = $(imgInput).attr('data-default-file');
            let pond = FilePond.create( imgInput, {

                imagePreviewTransparencyIndicator: 'grid',
                imagePreviewMaxHeight:  options.allowPreview ? 200 : 0,
                imagePreviewMinHeight: options.allowPreview ? 80 : 0,
                styleImageEditButtonEditItemPosition: 'top right',
                // allowImagePreview: options.allowPreview,
                credits: false,
                required: options.isRequired,
                checkValidity: true,
                name: $(imgInput).attr('name'),

                instantUpload: false,
                acceptedFileTypes: options.acceptedFileTypes ? options.acceptedFileTypes : ['image/png', 'image/jpg', 'image/jpeg'],
                maxFileSize: "5MB",
                labelIdle: 'اسحب الملف أو <span class="filepond--label-action"> اضغط هنا </span>',
                labelFileTypeNotAllowed: 'نوع الملف غير صحيح',
                fileValidateTypeLabelExpectedTypes: 'يجب إدخال ملف صحيح',
                labelMaxFileSizeExceeded: 'حجم الملف كبير',
                labelMaxFileSize: 'الحد الأقصى لحجم الملف هو {filesize}',


                // labelIdle: 'أسحب وأفلت الصورة هنا <span class="filepond--label-action"> او اختر ملف من جهازك </span>',
                labelMaxTotalFileSizeExceeded: 'تم تجاوز الحد الأقصى للحجم الإجمالي',
                labelMaxTotalFileSize: 'الحد الأقصى لحجم الملف الكلي هو {filesize}',
                labelTapToCancel: 'اضغط للالغاء',
                // labelFileTypeNotAllowed: 'يسمح فقط برفع صور من نوع : jpg, png, jpeg.',
                labelFileWaitingForSize: 'في انتظار حجم الصورة',
                labelFileSizeNotAvailable: 'حجم الصورة غير متوفر نرجو المحاولة مرة اخرى',
                labelFileLoadError: 'حصل خطأ غير متوقع!',
                labelFileProcessing: 'جاري التحميل...',
                labelFileProcessingComplete: '👍',
                labelFileProcessingAborted: 'تم الغاء عملية التحميل',
                labelFileProcessingError: 'حصل خطأ غير متوقع! نرجو المحاولة',
                labelFileProcessingRevertError: 'خطأ أثناء الرجوع',
                labelFileRemoveError: 'خطأ أثناء الحذف',
                labelTapToRetry: 'اضغط للمحاولة مره اخرى',
                labelTapToUndo: 'اضغط للرجوع',
                labelButtonRemoveItem: 'حذف',
                labelButtonAbortItemLoad: 'الغاء',
                labelButtonRetryItemLoad: 'إعادة المحاولة',
                labelButtonAbortItemProcessing: 'الغاء',
                labelButtonUndoItemProcessing: 'رجوع',
                labelButtonRetryItemProcessing: 'إعادة المحاولة',
                labelButtonProcessItem: 'رفع',
                imageValidateSizeLabelImageSizeTooSmall: ' الصورة صغيرة جدا',
                imageValidateSizeLabelExpectedMinSize: 'الحد الأدنى للحجم لصور هو {minWidth} × {minHeight}',
                imageValidateSizeLabelExpectedMaxSize: ' الحجم الأقصى لصور هو {maxWidth} × {maxHeight}',
                imageValidateSizeLabelImageResolutionTooLow: 'جودة الصورة منخفض جداً',

                // default crop aspect ratio
                imageCropAspectRatio: 1,

                // resize to width of 200
                imageResizeTargetWidth: 200,

                // open editor on image drop
                imageEditInstantEdit: false,

                // configure Doka
                imageEditEditor: Doka.create(customDokaOptions),


                onpreparefile: function (file, output) {
                    customPond.processedImage = output;
                    console.log('onpreparefile', output, customPond);
                    if(options.imgChangeCallback){
                        options.imgChangeCallback($(options.imgInputSelector),output)
                    }
                },

                onremovefile: function (error, file) {
                    customPond.processedImage = null;
                    console.log('onremovefile', customPond);
                    if (options.imgRemoveCallback) {
                        options.imgRemoveCallback($(options.imgInputSelector))
                    }

                },

            });

            let modal = $(options.imgInputSelector).parents('.modal').first();
            console.log('pond', pond);
            console.log('modal', modal,$(modal), options.imgInputSelector,$(imgInput), imgInput)
            if (modal) {
                $(modal).on('shown.bs.modal', function () {
                    $(document).off('focusin.modal');
                });
            }


            let customPond = new CustomPond(pond, pond.imageEditEditor, processedImage);

            if (default_file) {
                fetchFile(customPond, default_file);
            }

            return customPond;
        }

    }
}();



function fetchFile(customPond,url) {
    $.ajax({
        url:  baseUrl + "/file/fetch?url=" +  url,
        type: 'GET',
        // xhr:function(){// Seems like the only way to get access to the xhr object
        //     var xhr = new XMLHttpRequest();
        //     xhr.responseType= 'blob'
        //     return xhr;
        // },
        success: function ( result) {

            console.log('fetchFile', result);
            customPond.pond.addFile( result );

        },
        error: function (result) {
            console.log('fetchFile:error',result);


        }
    });

    // var xhr = new XMLHttpRequest();
    // xhr.open('GET', baseUrl + "/file/fetch?url=" +  url, true);
    // xhr.responseType = 'blob';
    // xhr.onload = function(e) {
    // if (this.status == 200) {
    //     var myBlob = this.response;
    //     console.log('myBlob',myBlob)
    //     customPond.pond.addFile(myBlob);

    //     // myBlob is now the blob that the object URL pointed to.
    // }
    // };
    // xhr.send();
}
