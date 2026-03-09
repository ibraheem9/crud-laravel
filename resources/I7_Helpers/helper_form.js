helperForm = function ()
{
    return {
        showValidationErrors                  : function (errors, formId = null)
        {
            helperForm.removeValidationErrors(formId);

            if (errors && formId)
            {
                let i = 0;
                for (let key in errors)
                {

                    if (i == 0)
                    {
                        try
                        {
                            let input = $(formId).find('[name="' + key + '"]');
                            if (!input)
                            {
                                input = $(formId).find('[id="' + key + '"]');
                            }
                            if (!input)
                            {
                                input = $(formId).find('[class="' + key + '"]');
                            }
                            if (input)
                            {
                                $('html, body').animate({
                                    scrollTop: input.offset().top - 170
                                }, 2000);
                            }
                        } catch (e)
                        {
                            helperJS.consoleLog(e);
                        }


                    }
                    ++i;
                    $(formId).find('[name="' + key + '"]').parents('._input_group').find('._laravel_error')
                        .html(errors[key][0]);
                    $(formId).find('[id="' + key + '"]').parents('._input_group').find('._laravel_error')
                        .html(errors[key][0]);
                    $(formId).find('.' + key).parents('._input_group').find('._laravel_error').html(errors[key][0]);
                    $(formId).find('[name="' + key + '"]').addClass('is-invalid');
                    $(formId).find('[id="' + key + '"]').addClass('is-invalid');
                    $(formId).find('[class="' + key + '"]').addClass('is-invalid');


                }
            }
            else if (errors)
            {
                for (let key in errors)
                {
                    $('[name="' + key + '"]').parents('._input_group').find('._laravel_error').html(errors[key][0]);
                    $('[id="' + key + '"]').parents('._input_group').find('._laravel_error').html(errors[key][0]);
                    $('.' + key).parents('._input_group').find('._laravel_error').html(errors[key][0]);
                    $('[name="' + key + '"]').addClass('is-invalid');
                    $('[id="' + key + '"]').addClass('is-invalid');
                    $('[class="' + key + '"]').addClass('is-invalid');

                }
            }
        },
        removeValidationErrors                : function (formId = null)
        {
            if (formId)
            {
                $(formId).find('.is-invalid').removeClass('is-invalid');
                $(formId).find('._laravel_error').html('');
            }
            else
            {
                $('.is-invalid').removeClass('is-invalid');
                $('._laravel_error').html('');
            }
        },
        showValidationErrorsInSwal            : function (errors)
        {
            let errorText = '<ul>';
            for (const [key, value] of Object.entries(errors))
            {
                errorText += `<li>${value}</li>`;
            }
            errorText += '</ul>';

            Swal.fire({
                icon : 'error',
                title: 'Validation Errors',
                html : errorText,
            });
        },
        resetForm                             : function (formId)
        {

            // for metronic bootstrap select
            $(formId).trigger("reset");
            try
            {
                // for images
                $(formId + ' img').attr('src', '');
                $(formId + ' .image-input-outline').css('background-image', 'url(' + defaultImage + ')');
                $(formId + ' .image-input-wrapper').css('background-image', 'url(' + defaultImage + ')');


                // for Mertonic avatar
                $(formId + ' ._avatar__holder')
                    .attr('style', 'background-image:url("/cpanel/media/avatars/blank.png")');

                $(formId + ' [type="checkbox"]').attr("checked", null);
                $(formId + ' [type="radio"]').attr("checked", null);

            } catch (error)
            {
                helperJS.consoleLog('resetForm[error]: ' + error);
            }
        },
        submitOnEnter                         : function (formId, callback)
        {
            $(document).on('keypress', formId + ' input', function (event)
            {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13')
                {
                    event.preventDefault();
                    callback();
                }
            });

        },
        preventOnEnter                        : function (form)
        {
            $(document).on('keypress', form + ' input', function (event)
            {

                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13')
                {
                    event.preventDefault();
                }
            });
        },
        onlyEnglishLetters                    : function ()
        {
            $(document).on('keypress', '.english_letters_only', function (event)
            {
                var ew = event.which;
                if (ew == 32)
                {
                    return true;
                }
                if (48 <= ew && ew <= 57)
                {
                    return true;
                }
                if (65 <= ew && ew <= 90)
                {
                    return true;
                }
                if (97 <= ew && ew <= 122)
                {
                    return true;
                }
                return false;
            });
        },
        restrictInputOtherThanArabicAndEnglish: function ()
        {
            // Arabic characters fall in the Unicode range 0600 - 06FF
            var arabicCharUnicodeRange = /[\u0600-\u06FFa-zA-Z]/;

            $(document).bind("keypress", '.arabic_english_letters_only', function (event)
            {
                var key = event.which;
                // 0 = numpad
                // 8 = backspace
                // 32 = space
                if (key == 8 || key == 0 || key === 32)
                {
                    return true;
                }

                var str = String.fromCharCode(key);
                if (arabicCharUnicodeRange.test(str))
                {
                    return true;
                }

                return false;
            });
        },
        preventHindiNumber                    : function ()
        {
            $(document).on('keyup', 'input', function ()
            {
                $(this).val(helperJS.parseArabic(this.value));
            });
        }
    }
}();
