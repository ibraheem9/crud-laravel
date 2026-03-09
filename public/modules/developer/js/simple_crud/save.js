"use strict";

var item_modal;

$(document).ready(function() {
    item_modal = new bootstrap.Modal(document.getElementById('item_modal'), { keyboard: false });
});

// Open the save modal (create or edit)
function openSaveModal(id) {
    id = id || 0;
    $.ajax({
        url: baseUrl + '/developer/simpleCrud/save/' + id,
        type: 'GET',
        success: function(result) {
            if (result.status) {
                $('#item_modal_content').html(result.data);
                item_modal.show();
                initSaveForm();
                // Re-init inputs after modal load
                CpanelApp.init();
            }
        },
        error: function(error) {
            helperSwal.exception(error);
        }
    });
}

// Initialize the save form inside the modal
function initSaveForm() {
    var formHtml = $("#item_form");

    formHtml.off('submit').on('submit', function(e) {
        e.preventDefault();
        saveItem(this);
    });
}

// Save item via AJAX
function saveItem(form) {
    var form_data = new FormData(form);
    var isUpdate = $('#item_form input[name="item_id"]').val() != 0;
    var url = isUpdate
        ? baseUrl + '/developer/simpleCrud/update'
        : baseUrl + '/developer/simpleCrud/store';

    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        btn: $('#save_item_btn'),
        success: function(result) {
            if (result.status) {
                toastr.success(result.msg);
                $('#items_datatable').DataTable().ajax.reload();
                item_modal.hide();
                helperForm.resetForm('#item_form');
            } else {
                toastr.error(result.msg);
            }
        },
        error: function(jqXHR) {
            if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                helperForm.showValidationErrors(jqXHR.responseJSON.errors, '#item_form');
            } else {
                helperSwal.exception(jqXHR);
            }
        }
    });
}

// Add button click handler
$(document).on('click', '#add_item_btn', function() {
    openSaveModal(0);
});
