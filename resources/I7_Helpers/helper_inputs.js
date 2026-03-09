helperInputs = function () {
    return {
        initEmojiPicker: function () {
            const {createPopup} = window.picmoPopup;

            var emojiInputs = $('.emoji_picker_input');

            // Loop through each div element
            emojiInputs.each(function (index) {

                const trigger = $(this).find('.picker_btn');
                //note:: for usage in modal
                // data-modal-id="#your_modal_id" put this in the html tag have class emoji_picker_input
                let rootElement = $(this).attr('data-modal-id') ?? null;
                helperJS.consoleLog(rootElement);
                let extraOptions = {};
                if (rootElement) {
                    extraOptions = {
                        rootElement: document.querySelector(rootElement),
                    };
                }

                let options = {
                    referenceElement: trigger[0],
                    triggerElement: trigger[0],
                    position: 'right-end',
                };
                let newOptions = helperJS.merge2Objects(options, extraOptions);
                helperJS.consoleLog(newOptions);

                const picker = createPopup({}, newOptions);

                trigger.on('click', () => {
                    picker.toggle();
                });

                picker.addEventListener('emoji:select', (selection) => {
                    // $(this).find('input').val(selection.emoji + " " + selection.label);
                    $(this).find('input').val(selection.emoji);
                });
            });


        },
        initMobileMask: function () {
            Inputmask({
                "mask": "(+999) 999-9999",
                "placeholder": "(+___) ___-____",
            }).mask(".mobile_mask");
        },
        initIntegerMask: function () {
            Inputmask({
                "mask": "9",
                "repeat": 10,
                "greedy": false
            }).mask(".integer_mask");
        },
        initSignedIntegerMask: function () {
            Inputmask({
                "mask": "9",
                "repeat": 10,
                "greedy": false,
                definitions: {
                    "9": {
                        validator: "[-+]?[0-9]*",
                        cardinality: 1
                    }
                }
            }).mask(".signed_integer_mask");
        },
        initDecimalMask: function () {
            Inputmask("decimal", {
                "rightAlignNumerics": false
            }).mask(".decimal_mask");
        },
        initEmailMask: function () {
            Inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
                greedy: false,
                onBeforePaste: function (pastedValue, opts) {
                    pastedValue = pastedValue.toLowerCase();
                    return pastedValue.replace("mailto:", "");
                },
                definitions: {
                    "*": {
                        validator: '[0-9A-Za-z!#$%&"*+/=?^_`{|}~\-]',
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            }).mask(".email_mask");
        },
        initDateMask: function () {
            Inputmask({
                "mask": "9999-99-99",
                "placeholder": "dd-mm-yyyy"
            }).mask(".date_mask");

        },
        initPaymentCardMask: function () {
            Inputmask({
                "mask": "9999 9999 9999 9999",
                "placeholder": "____ ____ ____ ____",
            }).mask(".payment_card_mask");
        },
        initTimePicker: function () {
            let el = $(".time_picker");
            if (el.length > 0) {
                el.flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                });
            }
        },
        initDateTimePicker: function () {
            let el = $(".date_time_picker");
            if (el.length > 0) {
                el.flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            }
        },
        initDatePickerWithMaskMinDateToday: function initDatePickerWithMaskMinDateToday() {
            let el = $(".date_picker_min_today_mask");
            if (el.length > 0) {
                Inputmask("9999-99-99", {
                    placeholder: "YYYY-MM-DD",
                    clearIncomplete: true,
                }).mask(el);

                el.flatpickr({
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    allowInput: true
                });
            }
        },
        initDatePickerWithMask: function initDatePickerWithMask() {
            let el = $(".date_picker_mask");
            if (el.length > 0) {
                Inputmask("9999-99-99", {
                    placeholder: "YYYY-MM-DD",
                    clearIncomplete: true,
                }).mask(el);

                el.flatpickr({
                    dateFormat: "Y-m-d",
                    allowInput: true
                });
            }
        },
        initDatePicker: function () {
            let el = $(".date_picker");
            if (el.length > 0) {
                el.flatpickr({
                    dateFormat: "Y-m-d",
                });
            }
        },
        initDateRangePicker: function () {
            let el = $(".date_range_picker");
            if (el.length > 0) {
                el.flatpickr({
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    mode: "range"
                });
            }
        },
        initTinymce: function (h = 300) {
            let el = $(".tinymce_main");
            if (el.length > 0) {
                tinymce.init({
                    selector: ".tinymce_main",
                    menubar: false,
                    toolbar: ["styleselect fontselect fontsizeselect",
                        "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                        "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview"],
                    plugins: "advlist autolink link image lists charmap print preview code",
                    height: h,
                });
            }
        },
        initMaxLength: function (h = 300) {
            $('.maxlength').maxlength({
                threshold: 20,
                warningClass: "badge badge-danger",
                limitReachedClass: "badge badge-success",
                separator: ' of ',
                preText: 'You have ',
                postText: ' chars remaining.',
                validate: true
            });

        }


    }
}();
