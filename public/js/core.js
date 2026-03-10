/******/ (() => { // webpackBootstrap
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!********************************************!*\
  !*** ./resources/I7_Helpers/app_helper.js ***!
  \********************************************/
CpanelApp = function () {
  return {
    init: function init() {
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
  };
}();
$(document).ready(function () {
  CpanelApp.init();
});
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!******************************************!*\
  !*** ./resources/I7_Helpers/block_ui.js ***!
  \******************************************/
var buttons = {};
$(document).ready(function () {
  $.ajaxSetup({
    beforeSend: function beforeSend(xhr, settings) {
      if (settings.btn) {
        var btn = settings.btn;
        buttons[btn.attr('id')] = {
          button: btn,
          // Store the button element
          html: btn.html() // Store the button HTML
        };
        if (btn) {
          btn.prop('disabled', true);
          btn.html("\n                                <span>Please wait...\n                                    <span class=\"spinner-border spinner-border-sm align-middle ms-2\">\n                                    </span>\n                                </span>\n                                ");
        }
      }
      xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    },
    statusCode: {
      419: function _() {
        window.location.reload();
      },
      401: function _() {
        window.location.reload();
      },
      404: function _() {
        // helperSwal.exception(Lang.get('cpanel.no_data'))
      },
      500: function _() {

        // helperSwal.exception(Lang.get('cpanel.error'))
      }
    }
  });
  $(document).ajaxComplete(function (event, request, settings) {
    Object.keys(buttons).forEach(function (btnId) {
      var buttonData = buttons[btnId];
      if (buttonData && buttonData.button) {
        var _buttonData$html;
        buttonData.button.html((_buttonData$html = buttonData.html) !== null && _buttonData$html !== void 0 ? _buttonData$html : 'Save');
        buttonData.button.prop('disabled', false);
      }
    });
  });
  $(document).ajaxSuccess(function (event, request, settings) {
    helperForm.removeValidationErrors();
  });

  // Handle offline and online events
  window.addEventListener('offline', function () {
    // Disable all submit buttons on the page when offline
    $('button[type="submit"], input[type="submit"]').each(function () {
      var btn = $(this);
      buttons[btn.attr('id')] = {
        button: btn,
        // Store the button element
        html: btn.html() // Store the button HTML content
      };
      btn.prop('disabled', true); // Disable the button
    });

    // Show "No Internet" message using helperSwal
    var offlineAlertHTML = "\n            <div class=\"text-center\">\n                <i class=\"fa fa-wifi fa-3x text-danger\"></i>\n                <h5 class=\"mt-2\">No Internet Connection</h5>\n                <p class=\"text-muted\">You are currently offline. Please check your connection.</p>\n            </div>\n        ";
    helperSwal.html(offlineAlertHTML);
  });
  window.addEventListener('online', function () {
    // Re-enable all submit buttons and show success message
    Object.keys(buttons).forEach(function (btnId) {
      var buttonData = buttons[btnId];
      if (buttonData && buttonData.button) {
        buttonData.button.html(buttonData.html || 'Save'); // Reset the button HTML content
        buttonData.button.prop('disabled', false); // Re-enable the button
      }
    });

    // Show "Connection Restored" message using helperSwal
    var onlineAlertHTML = "\n            <div class=\"text-center\">\n                <i class=\"fa fa-wifi fa-3x text-success\"></i>\n                <h5 class=\"mt-2\">Connection Restored</h5>\n                <p class=\"text-muted\">You are back online!</p>\n            </div>\n        ";
    helperSwal.html(onlineAlertHTML);
  });
});
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!************************************************!*\
  !*** ./resources/I7_Helpers/helper_confirm.js ***!
  \************************************************/
helperConfirm = function () {
  return {
    "delete": function _delete(id, link, callback) {
      var _this = this;
      var callbackParams = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : [];
      swal.fire({
        title: Lang.get('cpanel.delete_title'),
        text: Lang.get('cpanel.delete_confirmation'),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3cc4fa',
        cancelButtonColor: '#ff3e51',
        confirmButtonText: Lang.get('cpanel.yes_delete'),
        cancelButtonText: Lang.get('cpanel.cancel')
      }).then(function (willDelete) {
        if (willDelete.value) {
          $.ajax({
            url: baseUrl + '/' + link,
            type: "DELETE",
            data: {
              id: id
            },
            success: function success(result) {
              if (result.status) {
                var _result$msg;
                var msg = (_result$msg = result.msg) !== null && _result$msg !== void 0 ? _result$msg : Lang.get('cpanel.deleted_success');
                toastr.success(msg);
              } else {
                var _result$msg2;
                var _msg = (_result$msg2 = result.msg) !== null && _result$msg2 !== void 0 ? _result$msg2 : Lang.get('cpanel.error');
                var htmlRegex = /<([A-Z][A-Z0-9]*)\b[^>]*>(.*?)<\/\1>/i;
                if (htmlRegex.test(_msg)) {
                  helperSwal.html(_msg, 'warning');
                } else {
                  helperSwal.warning(_msg);
                }
              }
              if (callback) {
                callback.apply(this, callbackParams);
              }
            },
            error: function error(xhr, ajaxOptions, thrownError) {
              helperSwal.exception(thrownError);
            },
            complete: function complete() {}
          });
        } else {
          callback.apply(_this, callbackParams);
        }
      });
    },
    cancel: function cancel(id, link, callback) {
      var callbackParams = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : [];
      swal.fire({
        title: 'Cancel Confirmation',
        text: 'Are you sure about canceling this item?',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3cc4fa',
        cancelButtonColor: '#ff3e51',
        confirmButtonText: 'Yes, Cancel it',
        cancelButtonText: 'Back'
      }).then(function (willDelete) {
        if (willDelete.value) {
          $.ajax({
            url: baseUrl + '/' + link,
            type: "DELETE",
            data: {
              id: id
            },
            success: function success(result) {
              if (result.status) {
                var _result$msg3;
                var msg = (_result$msg3 = result.msg) !== null && _result$msg3 !== void 0 ? _result$msg3 : Lang.get('cpanel.deleted_success');
                toastr.success(msg);
              } else {
                var _result$msg4;
                var _msg2 = (_result$msg4 = result.msg) !== null && _result$msg4 !== void 0 ? _result$msg4 : Lang.get('cpanel.error');
                var htmlRegex = /<([A-Z][A-Z0-9]*)\b[^>]*>(.*?)<\/\1>/i;
                if (htmlRegex.test(_msg2)) {
                  helperSwal.html(_msg2, 'warning');
                } else {
                  helperSwal.warning(_msg2);
                }
              }
              if (callback) {
                callback.apply(this, callbackParams);
              }
            },
            error: function error(xhr, ajaxOptions, thrownError) {
              helperSwal.exception(thrownError);
            },
            complete: function complete() {}
          });
        }
      });
    },
    confirmProcess: function confirmProcess(title, text) {
      var _this2 = this;
      var confirmCallback = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
      var confirmCallbackParams = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : [];
      var cancelCallback = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
      var cancelCallbackParams = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : [];
      var confirmRedirectLink = arguments.length > 6 && arguments[6] !== undefined ? arguments[6] : null;
      var cancelRedirectLink = arguments.length > 7 && arguments[7] !== undefined ? arguments[7] : null;
      var openRedirectLinkInNewTab = arguments.length > 8 && arguments[8] !== undefined ? arguments[8] : false;
      swal.fire({
        title: title,
        text: text,
        icon: "warning",
        dangerMode: true,
        showCancelButton: true,
        confirmButtonColor: '#0abb87',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok',
        cancelButtonText: 'Cancel'
      }).then(function (willDelete) {
        if (willDelete.value) {
          if (confirmCallback) {
            confirmCallback.apply(_this2, confirmCallbackParams);
          } else if (confirmRedirectLink) {
            if (openRedirectLinkInNewTab) {
              window.open(confirmRedirectLink, '_blank');
            } else {
              window.location.href = confirmRedirectLink;
            }
          }
        } else {
          if (cancelCallback) {
            cancelCallback.apply(_this2, cancelCallbackParams);
          } else if (cancelRedirectLink) {
            if (openRedirectLinkInNewTab) {
              window.open(cancelRedirectLink, '_blank');
            } else {
              window.location.href = cancelRedirectLink;
            }
          }
        }
      });
    }
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!*********************************************!*\
  !*** ./resources/I7_Helpers/helper_form.js ***!
  \*********************************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(arr, i) { var _i = null == arr ? null : "undefined" != typeof Symbol && arr[Symbol.iterator] || arr["@@iterator"]; if (null != _i) { var _s, _e, _x, _r, _arr = [], _n = !0, _d = !1; try { if (_x = (_i = _i.call(arr)).next, 0 === i) { if (Object(_i) !== _i) return; _n = !1; } else for (; !(_n = (_s = _x.call(_i)).done) && (_arr.push(_s.value), _arr.length !== i); _n = !0); } catch (err) { _d = !0, _e = err; } finally { try { if (!_n && null != _i["return"] && (_r = _i["return"](), Object(_r) !== _r)) return; } finally { if (_d) throw _e; } } return _arr; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
helperForm = function () {
  return {
    showValidationErrors: function showValidationErrors(errors) {
      var formId = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      helperForm.removeValidationErrors(formId);
      if (errors && formId) {
        var i = 0;
        for (var key in errors) {
          if (i === 0) {
            try {
              var firstErrorElement = $(formId).find('._laravel_error').filter(function () {
                return $(this).html().trim() !== '';
              }).toArray().sort(function (a, b) {
                return $(a).offset().top - $(b).offset().top;
              })[0];
              if (firstErrorElement) {
                $('html, body').animate({
                  scrollTop: $(firstErrorElement).offset().top - 200
                }, 600);
              }
            } catch (e) {
              helperJS.consoleLog(e);
            }
          }
          ++i;
          $(formId).find('[name="' + key + '"]').parents('._input_group').find('._laravel_error').html(errors[key][0]);
          $(formId).find('[id="' + key + '"]').parents('._input_group').find('._laravel_error').html(errors[key][0]);
          $(formId).find('.' + key).parents('._input_group').find('._laravel_error').html(errors[key][0]);
          $(formId).find('[name="' + key + '"]').addClass('is-invalid');
          $(formId).find('[id="' + key + '"]').addClass('is-invalid');
          $(formId).find('[class="' + key + '"]').addClass('is-invalid');
        }
      } else if (errors) {
        for (var _key in errors) {
          $('[name="' + _key + '"]').parents('._input_group').find('._laravel_error').html(errors[_key][0]);
          $('[id="' + _key + '"]').parents('._input_group').find('._laravel_error').html(errors[_key][0]);
          $('.' + _key).parents('._input_group').find('._laravel_error').html(errors[_key][0]);
          $('[name="' + _key + '"]').addClass('is-invalid');
          $('[id="' + _key + '"]').addClass('is-invalid');
          $('[class="' + _key + '"]').addClass('is-invalid');
        }
      }
    },
    removeValidationErrors: function removeValidationErrors() {
      var formId = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      if (formId) {
        $(formId).find('.is-invalid').removeClass('is-invalid');
        $(formId).find('._laravel_error').html('');
      } else {
        $('.is-invalid').removeClass('is-invalid');
        $('._laravel_error').html('');
      }
    },
    showValidationErrorsInSwal: function showValidationErrorsInSwal(errors) {
      var errorText = '<ul>';
      for (var _i = 0, _Object$entries = Object.entries(errors); _i < _Object$entries.length; _i++) {
        var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
          key = _Object$entries$_i[0],
          value = _Object$entries$_i[1];
        errorText += "<li>".concat(value, "</li>");
      }
      errorText += '</ul>';
      Swal.fire({
        icon: 'error',
        title: 'Validation Errors',
        html: errorText
      });
    },
    resetForm: function resetForm(formId) {
      // for metronic bootstrap select
      $(formId).trigger("reset");
      try {
        // for images
        $(formId + ' img').attr('src', '');
        $(formId + ' .image-input-outline').css('background-image', 'url(' + defaultImage + ')');
        $(formId + ' .image-input-wrapper').css('background-image', 'url(' + defaultImage + ')');

        // for Mertonic avatar
        $(formId + ' ._avatar__holder').attr('style', 'background-image:url("/cpanel/media/avatars/blank.png")');
        $(formId + ' [type="checkbox"]').attr("checked", null);
        $(formId + ' [type="radio"]').attr("checked", null);
      } catch (error) {
        helperJS.consoleLog('resetForm[error]: ' + error);
      }
    },
    submitOnEnter: function submitOnEnter(formId, callback) {
      $(document).on('keypress', formId + ' input', function (event) {
        var keycode = event.keyCode ? event.keyCode : event.which;
        if (keycode == '13') {
          event.preventDefault();
          callback();
        }
      });
    },
    preventOnEnter: function preventOnEnter(form) {
      $(document).on('keypress', form + ' input', function (event) {
        var keycode = event.keyCode ? event.keyCode : event.which;
        if (keycode == '13') {
          event.preventDefault();
        }
      });
    },
    onlyEnglishLetters: function onlyEnglishLetters() {
      $(document).on('keypress', '.english_letters_only', function (event) {
        var ew = event.which;
        if (ew == 32) {
          return true;
        }
        if (48 <= ew && ew <= 57) {
          return true;
        }
        if (65 <= ew && ew <= 90) {
          return true;
        }
        if (97 <= ew && ew <= 122) {
          return true;
        }
        return false;
      });
    },
    restrictInputOtherThanArabicAndEnglish: function restrictInputOtherThanArabicAndEnglish() {
      // Arabic characters fall in the Unicode range 0600 - 06FF
      var arabicCharUnicodeRange = /[\u0600-\u06FFa-zA-Z]/;
      $(document).bind("keypress", '.arabic_english_letters_only', function (event) {
        var key = event.which;
        // 0 = numpad
        // 8 = backspace
        // 32 = space
        if (key == 8 || key == 0 || key === 32) {
          return true;
        }
        var str = String.fromCharCode(key);
        if (arabicCharUnicodeRange.test(str)) {
          return true;
        }
        return false;
      });
    },
    preventHindiNumber: function preventHindiNumber() {
      $(document).on('keyup', 'input', function () {
        $(this).val(helperJS.parseArabic(this.value));
      });
    }
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!*******************************************!*\
  !*** ./resources/I7_Helpers/helper_js.js ***!
  \*******************************************/
helperJS = function () {
  return {
    consoleLog: function consoleLog() {
      if (APP_DEBUG) {
        for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
          args[_key] = arguments[_key];
        }
        console.log(args);
      }
    },
    // this function used to merge to objects used like helperJS.merge2Objects
    merge2Objects: function merge2Objects(obj1, obj2) {
      // jQuery.extend(true, obj1, obj2);
      for (var p in obj2) {
        try {
          // Property in destination object set; update its value.
          obj1[p] = obj2[p];
        } catch (e) {
          // // Property in destination object not set; create it and set its value.
          // obj1[p] = obj2[p];
        }
      }
      return obj1;
    },
    isObject: function isObject(obj) {
      return obj != null && obj.constructor.name === "Object";
    },
    delay: function delay(callback, ms) {
      var timer = 0;
      return function () {
        var context = this,
          args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
          callback.apply(context, args);
        }, ms || 0);
      };
    },
    basename: function basename(str) {
      var sep = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '/';
      return str.substr(str.lastIndexOf(sep) + 1);
    },
    getUrlQueryString: function getUrlQueryString() {
      var vars = [],
        hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    },
    parseArabic: function parseArabic(str) {
      var result = str.replace(/[٠١٢٣٤٥٦٧٨٩]/g, function (d) {
        return d.charCodeAt(0) - 1632; // Convert Arabic numbers
      }).replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function (d) {
        return d.charCodeAt(0) - 1776; // Convert Persian numbers
      });
      return result;
    },
    convertNumbers2English: function convertNumbers2English(string) {
      return string.replace(/[\u0660-\u0669]/g, function (c) {
        return c.charCodeAt(0) - 0x0660;
      }).replace(/[\u06f0-\u06f9]/g, function (c) {
        return c.charCodeAt(0) - 0x06f0;
      });
    },
    customRound: function customRound(value) {
      var result = null;
      var precision = 2;
      try {
        result = value.toFixed(precision);
      } catch (error) {
        result = value;
      }
      return result;
    },
    redirectTo: function redirectTo(url) {
      window.location.href = url;
    },
    checkIfObjectsEquivalent: function checkIfObjectsEquivalent(a, b) {
      // Create arrays of property names
      var aProps = Object.getOwnPropertyNames(a);
      var bProps = Object.getOwnPropertyNames(b);

      // If number of properties is different,
      // objects are not equivalent
      if (aProps.length != bProps.length) {
        return false;
      }
      for (var i = 0; i < aProps.length; i++) {
        var propName = aProps[i];

        // If values of same property are not equal,
        // objects are not equivalent
        if (a[propName] !== b[propName]) {
          return false;
        }
      }

      // If we made it this far, objects
      // are considered equivalent
      return true;
    },
    printSectionAsPDF: function printSectionAsPDF(elementId) {
      var printContents = document.getElementById(elementId).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;

      // Use a media query to specify the print styles
      var mediaQuery = window.matchMedia('print');
      mediaQuery.addEventListener('change', function (mql) {
        if (!mql.matches) {
          // Restore the original contents when not printing
          document.body.innerHTML = originalContents;
        }
      });
      window.print();
    },
    formatDate: function formatDate(date) {
      var format = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'd M, Y H:i:s';
      if (!date) return '---';
      var dateObj = new Date(date);
      var options = {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      };
      return dateObj.toLocaleDateString('en-GB', options);
    }
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!*********************************************!*\
  !*** ./resources/I7_Helpers/helper_swal.js ***!
  \*********************************************/
helperSwal = function () {
  return {
    exception: function exception(msg) {
      swal.fire({
        text: msg !== null && msg !== void 0 ? msg : Lang.get('cpanel.internet_error'),
        icon: "error",
        timer: 50000,
        showCancelButton: false,
        showConfirmButton: true,
        confirmButtonText: Lang.get('cpanel.ok')
      });
    },
    success: function success() {
      var msg = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      var title = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      swal.fire({
        title: title,
        text: msg ? msg : Lang.get('cpanel.operation_done'),
        icon: "success",
        timer: 50000,
        showCancelButton: false,
        showConfirmButton: true,
        confirmButtonText: Lang.get('cpanel.ok')
      });
    },
    warning: function warning() {
      var msg = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      var title = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      swal.fire({
        title: title,
        text: msg ? msg : Lang.get('cpanel.warning'),
        icon: "warning",
        timer: 50000,
        showCancelButton: false,
        showConfirmButton: true,
        confirmButtonText: Lang.get('cpanel.ok')
      });
    },
    info: function info() {
      var msg = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      var title = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      swal.fire({
        title: title,
        text: msg ? msg : Lang.get('cpanel.operation_done'),
        icon: "info",
        timer: 50000,
        showCancelButton: false,
        showConfirmButton: true,
        confirmButtonText: Lang.get('cpanel.ok')
      });
    },
    timeLoader: function timeLoader() {
      var title = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      var timer = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1000;
      var timerInterval;
      Swal.fire({
        title: title ? title : 'Waiting ... processing!',
        html: 'just a few seconds <b></b>',
        timer: timer,
        timerProgressBar: true,
        didOpen: function didOpen() {
          Swal.showLoading();
          var b = Swal.getHtmlContainer().querySelector('b');
          timerInterval = setInterval(function () {
            b.textContent = Swal.getTimerLeft();
          }, 100);
        },
        willClose: function willClose() {
          clearInterval(timerInterval);
        }
      }).then(function (result) {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {}
      });
    },
    upgrade: function upgrade() {
      var msg = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      var upgradeLink = ", you can click <strong><a href=\"".concat(baseUrl, "/manager/profile/billing/upgradePlan\">here</a></strong> to upgrade \u263A");
      if (msg === '') {
        msg = "To use this feature, you must upgrade your subscription" + upgradeLink;
      }
      Swal.fire({
        html: msg + upgradeLink,
        icon: "info",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Upgrade!",
        cancelButtonText: 'Nope, cancel it',
        customClass: {
          confirmButton: "btn btn-primary",
          cancelButton: 'btn btn-danger'
        },
        preConfirm: function preConfirm() {
          window.location.href = "".concat(baseUrl, "/manager/profile/billing/upgradePlan");
        }
      });
    },
    html: function html(_html, icon) {
      var options = {
        html: _html,
        buttonsStyling: false,
        showCancelButton: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
          confirmButton: "btn btn-primary"
        }
      };
      if (icon) {
        options.icon = icon;
      }
      Swal.fire(options);
    }
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!*******************************************!*\
  !*** ./resources/I7_Helpers/helper_ui.js ***!
  \*******************************************/
helperUI = function () {
  return {
    //note:: used in init
    markAsideActiveMenuItem: function markAsideActiveMenuItem() {
      var path = window.location.href;
      $('#kt_aside_menu_wrapper .menu-link').filter(function () {
        return this.href == path;
      }).addClass('active');
      $('#kt_header_nav .menu-link').filter(function () {
        return this.href == path;
      }).addClass('active');
    },
    scrollTop: function scrollTop() {
      $('html, body').animate({
        scrollTop: 0
      }, 700);
    },
    scrollBottom: function scrollBottom() {
      $('html, body').animate({
        scrollTop: $(document).height()
      }, 700);
    },
    fixBootstrapModal: function fixBootstrapModal() {
      // call this before showing SweetAlert:
      var modalNode = document.querySelector('.modal[tabindex="-1"]');
      if (!modalNode) {
        return;
      }
      modalNode.removeAttribute('tabindex');
      modalNode.classList.add('js-swal-fixed');
    },
    restoreBootstrapModal: function restoreBootstrapModal() {
      // call this before hiding SweetAlert (inside done callback):
      var modalNode = document.querySelector('.modal.js-swal-fixed');
      if (!modalNode) {
        return;
      }
      modalNode.setAttribute('tabindex', '-1');
      modalNode.classList.remove('js-swal-fixed');
    },
    findPos: function findPos(obj) {
      //Finds y value of given object
      var curtop = 0;
      if (obj.offsetParent) {
        do {
          curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);
        return curtop;
      }
    },
    fixMultiModalOverlay: function fixMultiModalOverlay() {
      $(document).on('shown.bs.modal', '.modal', function (e) {
        $('.modal.show').each(function (index) {
          if (index > 0) {
            $(this).css('z-index', 1101 + index * 2);
          }
        });
        $('.modal-backdrop').each(function (index) {
          if (index > 0) {
            $(this).css('z-index', 1101 + index * 2 - 1);
          }
        });
      });
    }
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!***********************************************!*\
  !*** ./resources/I7_Helpers/helper_inputs.js ***!
  \***********************************************/
helperInputs = function () {
  return {
    initEmojiPicker: function initEmojiPicker() {
      var createPopup = window.picmoPopup.createPopup;
      var emojiInputs = $('.emoji_picker_input');

      // Loop through each div element
      emojiInputs.each(function (index) {
        var _$$attr,
          _this = this;
        var trigger = $(this).find('.picker_btn');
        //note:: for usage in modal
        // data-modal-id="#your_modal_id" put this in the html tag have class emoji_picker_input
        var rootElement = (_$$attr = $(this).attr('data-modal-id')) !== null && _$$attr !== void 0 ? _$$attr : null;
        helperJS.consoleLog(rootElement);
        var extraOptions = {};
        if (rootElement) {
          extraOptions = {
            rootElement: document.querySelector(rootElement)
          };
        }
        var options = {
          referenceElement: trigger[0],
          triggerElement: trigger[0],
          position: 'right-end'
        };
        var newOptions = helperJS.merge2Objects(options, extraOptions);
        helperJS.consoleLog(newOptions);
        var picker = createPopup({}, newOptions);
        trigger.on('click', function () {
          picker.toggle();
        });
        picker.addEventListener('emoji:select', function (selection) {
          // $(this).find('input').val(selection.emoji + " " + selection.label);
          $(_this).find('input').val(selection.emoji);
        });
      });
    },
    initMobileMask: function initMobileMask() {
      Inputmask({
        "mask": "(+999) 999-9999",
        "placeholder": "(+___) ___-____"
      }).mask(".mobile_mask");
    },
    initIntegerMask: function initIntegerMask() {
      Inputmask({
        "mask": "9",
        "repeat": 10,
        "greedy": false
      }).mask(".integer_mask");
    },
    initSignedIntegerMask: function initSignedIntegerMask() {
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
    initDecimalMask: function initDecimalMask() {
      Inputmask("decimal", {
        "rightAlignNumerics": false
      }).mask(".decimal_mask");
    },
    initEmailMask: function initEmailMask() {
      Inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
        greedy: false,
        onBeforePaste: function onBeforePaste(pastedValue, opts) {
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
    initDateMask: function initDateMask() {
      Inputmask({
        "mask": "9999-99-99",
        "placeholder": "dd-mm-yyyy"
      }).mask(".date_mask");
    },
    initPaymentCardMask: function initPaymentCardMask() {
      Inputmask({
        "mask": "9999 9999 9999 9999",
        "placeholder": "____ ____ ____ ____"
      }).mask(".payment_card_mask");
    },
    initTimePicker: function initTimePicker() {
      var el = $(".time_picker");
      if (el.length > 0) {
        el.flatpickr({
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i"
        });
      }
    },
    initDateTimePicker: function initDateTimePicker() {
      var el = $(".date_time_picker");
      if (el.length > 0) {
        el.flatpickr({
          enableTime: true,
          dateFormat: "Y-m-d H:i"
        });
      }
    },
    initDatePickerWithMaskMinDateToday: function initDatePickerWithMaskMinDateToday() {
      var el = $(".date_picker_min_today_mask");
      if (el.length > 0) {
        Inputmask("9999-99-99", {
          placeholder: "YYYY-MM-DD",
          clearIncomplete: true
        }).mask(el);
        el.flatpickr({
          dateFormat: "Y-m-d",
          minDate: "today",
          allowInput: true
        });
      }
    },
    initDatePickerWithMask: function initDatePickerWithMask() {
      var el = $(".date_picker_mask");
      if (el.length > 0) {
        Inputmask("9999-99-99", {
          placeholder: "YYYY-MM-DD",
          clearIncomplete: true
        }).mask(el);
        el.flatpickr({
          dateFormat: "Y-m-d",
          allowInput: true
        });
      }
    },
    initDatePicker: function initDatePicker() {
      var el = $(".date_picker");
      if (el.length > 0) {
        el.flatpickr({
          dateFormat: "Y-m-d"
        });
      }
    },
    initDateRangePicker: function initDateRangePicker() {
      var el = $(".date_range_picker");
      if (el.length > 0) {
        el.flatpickr({
          altInput: true,
          altFormat: "F j, Y",
          dateFormat: "Y-m-d",
          mode: "range"
        });
      }
    },
    initTinymce: function initTinymce() {
      var h = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 300;
      var el = $(".tinymce_main");
      if (el.length > 0) {
        tinymce.init({
          selector: ".tinymce_main",
          menubar: false,
          toolbar: ["styleselect fontselect fontsizeselect", "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify", "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview"],
          plugins: "advlist autolink link image lists charmap print preview code",
          height: h
        });
      }
    },
    initMaxLength: function initMaxLength() {
      var h = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 300;
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
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!********************************************************!*\
  !*** ./resources/I7_Helpers/toastr_general_options.js ***!
  \********************************************************/
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toastr-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!**************************************************!*\
  !*** ./resources/I7_Helpers/global_JS/global.js ***!
  \**************************************************/
KTUtil.onDOMContentLoaded(function () {
  var _localStorage$getItem;
  var mode = (_localStorage$getItem = localStorage.getItem("theme_mode")) !== null && _localStorage$getItem !== void 0 ? _localStorage$getItem : $(this).attr('data-mode');
  KTApp.setThemeMode(mode);
  $(document).on('click', '#theme_mode_btn', function () {
    mode = localStorage.getItem("theme_mode");
    if (mode === 'dark') {
      $(this).attr('data-mode', 'light');
      KTApp.setThemeMode("light", function () {
        localStorage.setItem("theme_mode", "light");
      }); // set light mode
    } else {
      $(this).attr('data-mode', 'dark');
      KTApp.setThemeMode("dark", function () {
        localStorage.setItem("theme_mode", "dark");
      }); // set dark mode
    }
  });
});
})();

/******/ })()
;