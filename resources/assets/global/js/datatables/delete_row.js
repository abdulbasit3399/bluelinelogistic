"use strict";

$('body').on('click', '.delete-row', function(e) {
    e.preventDefault();
    let self = $(this),
        url = self.data('action'),
        callback = self.data('callback'),
        modelName = self.data('model-name'),
        modalMessage = self.data('modal-message'),
        modalAction = self.data('modal-action'),
        tableId = self.data('table-id'),
        requestData = self.attr('data-request-data'),
        multiDelete = self.data('multi-delete'),
        timeAlert = self.data('time-alert') ?? _timerAlert;
    Swal.fire({
        title: `${modalAction} ${modelName}!`,
        'text': `${modalMessage} ${modelName}?`,
        icon: "error",
        showCancelButton: true,
        // buttonsStyling: false,
        confirmButtonText: `${modalAction}!`,
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-secondary"
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            let ids = requestData && requestData != '' ? JSON.parse(requestData) : {};
            let params = {ids: ids}
            let data = {params: params};
            Object.assign(data, {_token: _csrf_token})
            // ajax delete
            axios.delete(url, data).then(res => {
                Toast.fire({
                    icon: 'success',
                    title: res.data.message ? res.data.message : `${modelName} has been deleted successfully`,
                    timer: timeAlert
                })
                if (callback == 'reload-page') {
                    setTimeout(() => {
                        window.location.reload();
                    }, timeAlert)
                } else if (callback == 'reload-table') {
                    let table = $('#' + tableId)
                    table.DataTable().ajax.reload()
                } else if (callback == 'delete-row') {
                    let row = self.parents('table tbody tr')
                    row.fadeOut(400, function() {
                        $(this).remove();
                    })
                }

                // only for multi delete
                // show filter and hide action (delete button)
                if (multiDelete && multiDelete == true) {
                    var actions = $(`#${tableId}_selected_component`),
                        filter = $(`#${tableId}_custom_filter`),
                        checkboxAllRows = $(`#${tableId}_wrapper .checkbox-all-rows`);
                    actions.addClass('d-none')
                    filter.removeClass('d-none')
                    checkboxAllRows.prop('checked', false)
                }


            }).catch(error => {
                if (error.response && error.response.status) {
                    if (error.response.status == 403) {
                        if (error.response.data.message) {
                            Toast.fire({
                                icon: 'error',
                                title: error.response.data.message,
                                timer: timeAlert
                            })
                        }
                    } else if (error.response.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Server Error!',
                            timer: timeAlert
                        })
                    } else if (error.response.status == 422) {
                        Toast.fire({
                            icon: 'error',
                            title: error.response.data.message,
                            timer: timeAlert
                        })
                    } else if (error.response.status == 404) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Request not found',
                            timer: timeAlert
                        })
                    } else if (error.response.status == 401) {
                        window.location.reload();
                    }
                }
            })
        }
    });
});
