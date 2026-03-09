helperConfirm = function ()
{
    return {
        delete        : function (id, link, callback, callbackParams = [])
        {

            swal.fire({
                title             : Lang.get('cpanel.delete_title'),
                text              : Lang.get('cpanel.delete_confirmation'),
                icon              : "warning",
                showCancelButton  : true,
                confirmButtonColor: '#3cc4fa',
                cancelButtonColor : '#ff3e51',
                confirmButtonText : Lang.get('cpanel.yes_delete'),
                cancelButtonText  : Lang.get('cpanel.cancel'),

            })
                .then(willDelete =>
                {
                    if (willDelete.value)
                    {
                        $.ajax({
                            url     : baseUrl + '/' + link,
                            type    : "DELETE",
                            data    : {
                                id: id
                            },
                            success : function (result)
                            {
                                if (result.status)
                                {
                                    let msg = result.msg ?? Lang.get('cpanel.deleted_success');
                                    toastr.success(msg);
                                }
                                else
                                {
                                    let msg = result.msg ?? Lang.get('cpanel.error');
                                    const htmlRegex = /<([A-Z][A-Z0-9]*)\b[^>]*>(.*?)<\/\1>/i;
                                    if (htmlRegex.test(msg)) {
                                        helperSwal.html(msg,'warning');

                                    } else {
                                        helperSwal.warning(msg);
                                    }
                                }

                                if (callback)
                                {
                                    callback.apply(this, callbackParams);
                                }

                            },
                            error   : function (xhr, ajaxOptions, thrownError)
                            {
                                helperSwal.exception(thrownError);
                            },
                            complete: function ()
                            {
                            }
                        });
                    }
                });


        },
        cancel        : function (id, link, callback, callbackParams = [])
        {

            swal.fire({
                title             : 'Cancel Confirmation',
                text              : 'Are you sure about canceling this item?',
                icon              : "warning",
                showCancelButton  : true,
                confirmButtonColor: '#3cc4fa',
                cancelButtonColor : '#ff3e51',
                confirmButtonText : 'Yes, Cancel it',
                cancelButtonText  : 'Back',

            })
                .then(willDelete =>
                {
                    if (willDelete.value)
                    {
                        $.ajax({
                            url     : baseUrl + '/' + link,
                            type    : "DELETE",
                            data    : {
                                id: id
                            },
                            success : function (result)
                            {
                                if (result.status)
                                {
                                    let msg = result.msg ?? Lang.get('cpanel.deleted_success');
                                    toastr.success(msg);
                                }
                                else
                                {
                                    let msg = result.msg ?? Lang.get('cpanel.error');
                                    const htmlRegex = /<([A-Z][A-Z0-9]*)\b[^>]*>(.*?)<\/\1>/i;
                                    if (htmlRegex.test(msg)) {
                                        helperSwal.html(msg,'warning');

                                    } else {
                                        helperSwal.warning(msg);
                                    }
                                }

                                if (callback)
                                {
                                    callback.apply(this, callbackParams);
                                }

                            },
                            error   : function (xhr, ajaxOptions, thrownError)
                            {
                                helperSwal.exception(thrownError);
                            },
                            complete: function ()
                            {
                            }
                        });
                    }
                });


        },
        confirmProcess: function (title, text,
                                  confirmCallback = null,
                                  confirmCallbackParams = [],
                                  cancelCallback = null,
                                  cancelCallbackParams = [],
                                  confirmRedirectLink = null,
                                  cancelRedirectLink = null,
                                  openRedirectLinkInNewTab = false)
        {

            swal.fire({
                title             : title,
                text              : text,
                icon              : "warning",
                dangerMode        : true,
                showCancelButton  : true,
                confirmButtonColor: '#0abb87',
                cancelButtonColor : '#d33',
                confirmButtonText : 'Ok',
                cancelButtonText  : 'Cancel',

            })
                .then(willDelete =>
                {
                    if (willDelete.value)
                    {
                        if (confirmCallback)
                        {
                            confirmCallback.apply(this, confirmCallbackParams);
                        }
                        else if (confirmRedirectLink)
                        {
                            if (openRedirectLinkInNewTab)
                            {
                                window.open(confirmRedirectLink, '_blank');
                            }
                            else
                            {
                                window.location.href = confirmRedirectLink;
                            }
                        }
                    }
                    else
                    {
                        if (cancelCallback)
                        {
                            cancelCallback.apply(this, cancelCallbackParams);
                        }
                        else if (cancelRedirectLink)
                        {
                            if (openRedirectLinkInNewTab)
                            {
                                window.open(cancelRedirectLink, '_blank');
                            }
                            else
                            {
                                window.location.href = cancelRedirectLink;
                            }
                        }
                    }
                });
        },

    }
}();
