helperSwal = function ()
{
    return {
        exception : function (msg)
        {
            swal.fire(
                {
                    text: msg ?? Lang.get('cpanel.internet_error'),
                    icon: "error",
                    timer: 50000,
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: Lang.get('cpanel.ok'),
                }
            );
        },

        success : function(msg='', title = '')
        {
            swal.fire(
                {
                    title: title,
                    text: msg ? msg :Lang.get('cpanel.operation_done'),
                    icon: "success",
                    timer: 50000,
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: Lang.get('cpanel.ok'),
                }
            );
        },

        warning : function(msg='', title = '')
        {
            swal.fire(
                {
                    title: title,
                    text: msg ? msg :Lang.get('cpanel.warning'),
                    icon: "warning",
                    timer: 50000,
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: Lang.get('cpanel.ok'),
                }
            );
        },

        info : function(msg='', title = '')
        {
            swal.fire(
                {
                    title: title,
                    text: msg ? msg :Lang.get('cpanel.operation_done'),
                    icon: "info",
                    timer: 50000,
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: Lang.get('cpanel.ok'),
                }
            );
        },


        timeLoader : function(title = '',timer = 1000)
        {
            let timerInterval
            Swal.fire({
                title: title ? title : 'Waiting ... processing!',
                html: 'just a few seconds <b></b>',
                timer: timer,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                }
            })
        },

        upgrade: function(msg = '') {
            let upgradeLink = `, you can click <strong><a href="${baseUrl}/manager/profile/billing/upgradePlan">here</a></strong> to upgrade ☺`;

            if (msg === '') {
                msg = `To use this feature, you must upgrade your subscription` + upgradeLink;
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
                preConfirm: () => {
                    window.location.href = `${baseUrl}/manager/profile/billing/upgradePlan`;
                }
            });
        },

        html: function(html,icon) {
            let options = {
                html: html,
                buttonsStyling: false,
                showCancelButton: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary",
                }
            };
            if (icon) {
                options.icon = icon;
            }
            Swal.fire(options);
        },

    }
}();


