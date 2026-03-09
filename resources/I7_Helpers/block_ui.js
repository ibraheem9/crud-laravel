var buttons = {};
$(document).ready(function ()
{
    $.ajaxSetup({

        beforeSend: function (xhr, settings)
        {

            if (settings.btn)
            {
                let btn = settings.btn;
                buttons[btn.attr('id')] = {
                    button: btn, // Store the button element
                    html  : btn.html() // Store the button HTML
                };
                if (btn)
                {
                    btn.prop('disabled', true);
                    btn.html(`
                                <span>Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2">
                                    </span>
                                </span>
                                `);
                }
            }

            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        statusCode: {
            419: function ()
            {
                window.location.reload();

            },
            401: function ()
            {
                window.location.reload();

            },
            404: function ()
            {
                // helperSwal.exception(Lang.get('cpanel.no_data'))
            },
            500: function ()
            {

                // helperSwal.exception(Lang.get('cpanel.error'))
            }
        }
    });
    $(document).ajaxComplete(function (event, request, settings)
    {
        Object.keys(buttons).forEach(function(btnId) {
            let buttonData = buttons[btnId];
            if (buttonData && buttonData.button) {
                buttonData.button.html(buttonData.html ?? 'Save');
                buttonData.button.prop('disabled', false);
            }
        });

    });

    $(document).ajaxSuccess(function (event, request, settings)
    {
        helperForm.removeValidationErrors();
    });


    // Handle offline and online events
    window.addEventListener('offline', function () {
        // Disable all submit buttons on the page when offline
        $('button[type="submit"], input[type="submit"]').each(function () {
            let btn = $(this);
            buttons[btn.attr('id')] = {
                button: btn, // Store the button element
                html: btn.html() // Store the button HTML content
            };
            btn.prop('disabled', true); // Disable the button
        });

        // Show "No Internet" message using helperSwal
        let offlineAlertHTML = `
            <div class="text-center">
                <i class="fa fa-wifi fa-3x text-danger"></i>
                <h5 class="mt-2">No Internet Connection</h5>
                <p class="text-muted">You are currently offline. Please check your connection.</p>
            </div>
        `;
        helperSwal.html(offlineAlertHTML);
    });

    window.addEventListener('online', function () {
        // Re-enable all submit buttons and show success message
        Object.keys(buttons).forEach(function (btnId) {
            let buttonData = buttons[btnId];
            if (buttonData && buttonData.button) {
                buttonData.button.html(buttonData.html || 'Save'); // Reset the button HTML content
                buttonData.button.prop('disabled', false); // Re-enable the button
            }
        });

        // Show "Connection Restored" message using helperSwal
        let onlineAlertHTML = `
            <div class="text-center">
                <i class="fa fa-wifi fa-3x text-success"></i>
                <h5 class="mt-2">Connection Restored</h5>
                <p class="text-muted">You are back online!</p>
            </div>
        `;
        helperSwal.html(onlineAlertHTML);
    });
});


