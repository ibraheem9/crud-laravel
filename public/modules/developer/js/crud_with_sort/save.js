"use strict";

var duration_modal;

$(document).ready(function() {
    duration_modal = new bootstrap.Modal(document.getElementById('duration_modal'), { keyboard: false });
});

var durationForm = $("#duration_form");

durationForm.validate({
    rules: {
        name: { required: true },
        days: { required: true, digits: true },
    },
    submitHandler: function(form) {
        saveDuration(form);
        return false;
    }
});

function saveDuration(form) {
    var form_data = new FormData(form);
    var isUpdate = $('#duration_id').val() != 0;
    var url = isUpdate
        ? baseUrl + '/developer/crudWithSort/update'
        : baseUrl + '/developer/crudWithSort/store';

    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        btn: $('#save_duration_btn'),
        success: function(result) {
            if (result.status) {
                toastr.success(result.msg);
                $('#durations_datatable').DataTable().ajax.reload();
                duration_modal.hide();
                helperForm.resetForm('#duration_form');
                $('#duration_id').val(0);
            } else {
                toastr.error(result.msg);
            }
        },
        error: function(jqXHR) {
            if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                helperForm.showValidationErrors(jqXHR.responseJSON.errors, '#duration_form');
            } else {
                helperSwal.exception(jqXHR);
            }
        }
    });
}

// Add button
$(document).on('click', '#add_duration_btn', function() {
    helperForm.resetForm('#duration_form');
    $('#duration_id').val(0);
    duration_modal.show();
});

// Edit button (from DataTable)
$(document).on('click', '.edit_btn', function() {
    var row = dt.row($(this).closest('tr')).data();
    $('#duration_id').val(row.id);
    $('#duration_name').val(row.name.replace(/<[^>]*>/g, ''));
    $('#duration_days').val(row.days);
    duration_modal.show();
});
