"use strict";

$('body').on('click', '.btn-single-action', function(e) {
    e.preventDefault();
    let self = $(this),
        url = self.data('url'),
        action = self.data('action'),
        callback = self.data('callback'),
        modelName = self.data('model-name'),
        modalMessage = self.data('modal-message'),
        modalAction = self.data('modal-action'),
        tableId = self.data('table-id'),
        requestDataParent = $(`#${tableId}_selected_component`).attr('data-request-data'),
        requestDataSelf = self.attr('data-request-data'),
        multiRows = self.data('multi-rows'),
        timeAlert = self.data('time-alert') ?? _timerAlert;

    Swal.fire({
        title: `${modalAction} ${modelName}!`,
        'text': `${modalMessage} ${modelName}?`,
        icon: action == 'approve' ? 'success' : (action == 'reject' ? 'error' : 'info'),
        showCancelButton: true,
        // buttonsStyling: false,
        confirmButtonText: `${modalAction}!`,
        customClass: {
            confirmButton: `btn btn-${action == 'approve' ? 'success' : 'danger'}`,
            cancelButton: "btn btn-secondary"
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            let requestData = multiRows == true ? requestDataParent : requestDataSelf;
            let ids = requestData && requestData != '' ? JSON.parse(requestData) : {};
            let data = {
                ids: ids,
                multi: multiRows && multiRows == true,
                action: action,
                _token: _csrf_token
            }
            // ajax delete
            axios.post(url, data).then(res => {
                Toast.fire({
                    icon: 'success',
                    title: res.data.message ? res.data.message : `${modelName} has been updated successfully`,
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
                if (multiRows && multiRows == true) {
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
