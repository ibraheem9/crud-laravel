{{-- I7_Helpers - Inline JS Helpers --}}
<script>
/**
 * helperJS - General JavaScript utilities
 */
var helperJS = (function() {
    return {
        consoleLog: function(msg) {
            if (APP_DEBUG) console.log(msg);
        },
        formatDate: function(date) {
            if (!date) return '---';
            var d = new Date(date);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            return d.getDate() + ' ' + months[d.getMonth()] + ', ' + d.getFullYear() + ' ' +
                   String(d.getHours()).padStart(2,'0') + ':' + String(d.getMinutes()).padStart(2,'0');
        },
        formatDateOnly: function(date) {
            if (!date) return '---';
            var d = new Date(date);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            return d.getDate() + ' ' + months[d.getMonth()] + ', ' + d.getFullYear();
        },
        redirect: function(url) {
            window.location.href = url;
        },
        reloadPage: function() {
            location.reload();
        },
        getUrlParameter: function(name) {
            var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results ? decodeURIComponent(results[1]) : null;
        }
    };
})();

/**
 * helperForm - Form handling utilities
 */
var helperForm = (function() {
    return {
        showValidationErrors: function(errors, formSelector) {
            this.removeValidationErrors();
            if (errors) {
                Object.keys(errors).forEach(function(key) {
                    var input = $(formSelector).find('[name="' + key + '"]');
                    var errorDiv = input.closest('._input_group').find('._laravel_error');
                    if (errorDiv.length) {
                        errorDiv.text(errors[key][0]);
                    } else {
                        // Fallback: find by class
                        input.after('<div class="_laravel_error text-danger mt-1">' + errors[key][0] + '</div>');
                    }
                });
            }
        },
        removeValidationErrors: function() {
            $('._laravel_error').text('');
        },
        resetForm: function(formSelector) {
            $(formSelector)[0].reset();
            this.removeValidationErrors();
            // Reset select2
            $(formSelector).find('select[data-control="select2"]').val(null).trigger('change');
        },
        preventOnEnter: function(selector) {
            $(document).on('keypress', selector + ' input', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        },
        getFormData: function(formSelector) {
            return new FormData($(formSelector)[0]);
        }
    };
})();

/**
 * helperUI - UI utilities
 */
var helperUI = (function() {
    return {
        markAsideActiveMenuItem: function() {
            // Already handled via Blade active class
        },
        blockUI: function(target) {
            $(target).css('opacity', '0.5').css('pointer-events', 'none');
        },
        unblockUI: function(target) {
            $(target).css('opacity', '1').css('pointer-events', 'auto');
        }
    };
})();

/**
 * helperSwal - SweetAlert2 wrapper
 */
var helperSwal = (function() {
    return {
        success: function(msg) {
            Swal.fire({ icon: 'success', title: 'Success', text: msg, timer: 2000, showConfirmButton: false });
        },
        error: function(msg) {
            Swal.fire({ icon: 'error', title: 'Error', text: msg });
        },
        warning: function(msg) {
            Swal.fire({ icon: 'warning', title: 'Warning', text: msg });
        },
        html: function(html, icon) {
            Swal.fire({ icon: icon || 'info', html: html });
        },
        exception: function(error) {
            var msg = 'Something went wrong!';
            if (error && error.responseJSON && error.responseJSON.msg) {
                msg = error.responseJSON.msg;
            } else if (typeof error === 'string') {
                msg = error;
            }
            Swal.fire({ icon: 'error', title: 'Error', text: msg });
        }
    };
})();

/**
 * helperConfirm - Confirmation dialogs
 */
var helperConfirm = (function() {
    return {
        delete: function(id, link, callback, callbackParams) {
            callbackParams = callbackParams || [];
            Swal.fire({
                title: Lang.get('cpanel.delete_title'),
                text: Lang.get('cpanel.delete_confirmation'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3cc4fa',
                cancelButtonColor: '#ff3e51',
                confirmButtonText: Lang.get('cpanel.yes_delete'),
                cancelButtonText: Lang.get('cpanel.cancel')
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: baseUrl + '/' + link,
                        type: 'DELETE',
                        data: { id: id },
                        success: function(result) {
                            if (result.status) {
                                toastr.success(result.msg || Lang.get('cpanel.deleted_success'));
                            } else {
                                helperSwal.warning(result.msg || Lang.get('cpanel.error'));
                            }
                            if (callback) callback.apply(this, callbackParams);
                        },
                        error: function(xhr) { helperSwal.exception(xhr); }
                    });
                }
            });
        },
        confirmProcess: function(title, text, confirmCallback, confirmParams, cancelCallback, cancelParams) {
            confirmParams = confirmParams || [];
            cancelParams = cancelParams || [];
            Swal.fire({
                title: title, text: text, icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0abb87', cancelButtonColor: '#d33',
                confirmButtonText: 'Ok', cancelButtonText: 'Cancel'
            }).then(function(result) {
                if (result.isConfirmed) {
                    if (confirmCallback) confirmCallback.apply(this, confirmParams);
                } else {
                    if (cancelCallback) cancelCallback.apply(this, cancelParams);
                }
            });
        }
    };
})();

/**
 * helperInputs - Input initialization
 */
var helperInputs = (function() {
    return {
        initDecimalMask: function() {
            Inputmask({ alias: 'decimal', groupSeparator: '', digits: 2, rightAlign: false }).mask('.decimal_mask');
        },
        initIntegerMask: function() {
            Inputmask({ alias: 'integer', groupSeparator: '', rightAlign: false }).mask('.integer_mask');
        },
        initSignedIntegerMask: function() {
            Inputmask({ alias: 'integer', groupSeparator: '', rightAlign: false, allowMinus: true }).mask('.signed_integer_mask');
        },
        initEmailMask: function() {
            Inputmask({ alias: 'email' }).mask('.email_mask');
        },
        initDateMask: function() {
            Inputmask({ alias: 'datetime', inputFormat: 'yyyy-mm-dd', placeholder: 'yyyy-mm-dd' }).mask('.date_mask');
        },
        initPaymentCardMask: function() {
            Inputmask('9999 9999 9999 9999').mask('.payment_card_mask');
        },
        initMobileMask: function() {
            Inputmask({ mask: '999-999-9999' }).mask('.mobile_mask');
        },
        initTimePicker: function() {
            flatpickr('.time_picker', { enableTime: true, noCalendar: true, dateFormat: 'H:i', time_24hr: true });
        },
        initDatePicker: function() {
            flatpickr('.date_picker', { dateFormat: 'Y-m-d' });
        },
        initDateRangePicker: function() {
            flatpickr('.date_range_picker', { mode: 'range', dateFormat: 'Y-m-d' });
        },
        initDatePickerWithMaskMinDateToday: function() {
            flatpickr('.date_picker_min_today', { dateFormat: 'Y-m-d', minDate: 'today' });
        },
        initDatePickerWithMask: function() {
            flatpickr('.date_picker_mask', { dateFormat: 'Y-m-d', allowInput: true });
        },
        initDateTimePicker: function() {
            flatpickr('.datetime_picker', { enableTime: true, dateFormat: 'Y-m-d H:i', time_24hr: true });
        },
        initTinymce: function() {
            // TinyMCE init placeholder - add tinymce CDN if needed
        },
        initMaxLength: function() {
            $('[maxlength]').each(function() {
                var max = $(this).attr('maxlength');
                if (!$(this).next('.maxlength-indicator').length) {
                    $(this).after('<small class="maxlength-indicator text-muted"></small>');
                }
                $(this).on('input', function() {
                    $(this).next('.maxlength-indicator').text($(this).val().length + '/' + max);
                });
            });
        }
    };
})();

/**
 * Block UI - AJAX loading state for buttons
 */
var buttons = {};
$(document).ready(function() {
    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (settings.btn) {
                var btn = settings.btn;
                buttons[btn.attr('id')] = { button: btn, html: btn.html() };
                btn.prop('disabled', true);
                btn.html('<span>Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>');
            }
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        statusCode: {
            419: function() { window.location.reload(); },
            401: function() { window.location.reload(); }
        }
    });

    $(document).ajaxComplete(function() {
        Object.keys(buttons).forEach(function(btnId) {
            var bd = buttons[btnId];
            if (bd && bd.button) {
                bd.button.html(bd.html || 'Save');
                bd.button.prop('disabled', false);
            }
        });
    });

    $(document).ajaxSuccess(function() {
        helperForm.removeValidationErrors();
    });

    // Offline/Online handlers
    window.addEventListener('offline', function() {
        $('button[type="submit"]').prop('disabled', true);
        helperSwal.html('<div class="text-center"><i class="bi bi-wifi-off fs-1 text-danger"></i><h5 class="mt-2">No Internet Connection</h5></div>');
    });
    window.addEventListener('online', function() {
        $('button[type="submit"]').prop('disabled', false);
        toastr.success('Connection restored!');
    });
});

/**
 * CpanelApp - Application initializer
 */
var CpanelApp = (function() {
    return {
        init: function() {
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
            helperInputs.initMaxLength();
            helperInputs.initDateTimePicker();

            // Init Select2
            $('select[data-control="select2"]').select2({ theme: 'bootstrap-5', width: '100%' });
        }
    };
})();

$(document).ready(function() {
    CpanelApp.init();
});
</script>
