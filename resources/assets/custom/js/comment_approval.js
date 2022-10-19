




$(document).on('change', '.comment_approval', function(e) {
    var self = $(this),
        currentValue = self[0].checked,
        action = currentValue ? 'approve' : 'reject',
        url = self.data('url'),
        approvedText = self.data('approved-text'),
        rejectedText = self.data('rejected-text'),
        class_approved = action == 'approve' ? 'success' : 'danger',
        text_approved = action == 'approve' ? approvedText : rejectedText,
        modelId = self.data('model-id'),
        timeAlert = 2000,
        data = {
            ids: [modelId],
            action: action,
            _token: _csrf_token,
        };
        axios.post(url, data).then(res => {
            Toast.fire({
                icon: 'success',
                title: res.data.message ? res.data.message : `Comment has been updated successfully`,
                timer: timeAlert
            })
            var badge = `<span class="badge fs-9 badge-${class_approved}">
                            ${text_approved}
                        </span>`;
            $('.approval-status').filter(`.model-id-${modelId}`).html(badge);

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
        });

});