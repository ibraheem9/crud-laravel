CpanelApp = function()
{
    return{
        init()
        {
            helperUI.markAsideActiveMenuItem();

            helperForm.preventOnEnter('form');

            helperInputs.initDecimalMask();
            helperInputs.initDateMask();
            helperInputs.initEmailMask();
            helperInputs.initIntegerMask();
            helperInputs.initSignedIntegerMask();
            helperInputs.initPaymentCardMask();
            helperInputs.initMobileMask();
            helperInputs.initTimePicker();
            helperInputs.initDatePicker();
            helperInputs.initDateRangePicker();
            helperInputs.initDatePickerWithMaskMinDateToday();
            helperInputs.initDatePickerWithMask();
            helperInputs.initTinymce();
            helperInputs.initMaxLength();
            helperInputs.initDateTimePicker();

        }
    }
}();

$(document).ready(function (){
    CpanelApp.init();
});
