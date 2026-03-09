"use strict";

$(document).ready(function() {
    $(document).on('click', '#sort_items_btn', function() {
        var sortModal = new bootstrap.Modal(document.getElementById('sort_items_modal'), { keyboard: false });

        $.ajax({
            url: baseUrl + '/developer/crudWithSort/get',
            type: 'GET',
            success: function(result) {
                var container = $('#sort_items_container');
                container.html(result.data);
                sortModal.show();

                // Initialize jQuery UI Sortable
                container.sortable({
                    stop: function(event, ui) {
                        var ids = [];
                        container.find('.ui-state-default').each(function() {
                            var id = $(this).attr('id').replace('item_id_', '');
                            ids.push(id);
                        });

                        helperJS.consoleLog('Sort order: ' + ids.join(','));

                        $.ajax({
                            url: baseUrl + '/developer/crudWithSort/sort',
                            type: 'POST',
                            data: { ids: ids },
                            success: function(result) {
                                if (result.status) {
                                    toastr.success('Sort order updated');
                                    try {
                                        $('#durations_datatable').DataTable().ajax.reload();
                                    } catch (e) {}
                                }
                            },
                            error: function(error) {
                                helperSwal.exception(error);
                            }
                        });
                    }
                });
            },
            error: function(error) {
                helperSwal.exception(error);
            }
        });
    });
});
