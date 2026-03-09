"use strict";

var customerForm = $("#customer_form");

customerForm.validate({
    rules: {
        name: { required: true },
        email: { required: true, email: true },
        civil_id: { required: true },
        dob: { required: true },
    },
    submitHandler: function(form) {
        saveCustomer(form);
        return false;
    }
});

function saveCustomer(form) {
    var form_data = new FormData(form);

    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        btn: $('#save_customer_btn'),
        success: function(result) {
            if (result.status) {
                toastr.success(result.msg);
                // Redirect to list after save
                var redirectUrl = $(form).data('after');
                if (redirectUrl) {
                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 1000);
                }
            } else {
                toastr.error(result.msg);
            }
        },
        error: function(jqXHR) {
            if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                helperForm.showValidationErrors(jqXHR.responseJSON.errors, '#customer_form');
            } else {
                helperSwal.exception(jqXHR);
            }
        }
    });
}
