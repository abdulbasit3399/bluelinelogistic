




$(document).on('change', '.switch_table', function(e) {
    var self = $(this),
        url = self.data('url'),
        modelId = self.data('model-id'),
        parentEle = self.data('parent'),
        timeAlert = 2000,
        data = {
            _token: _csrf_token,
        };
        axios.post(url, data).then(res => {
            Toast.fire({
                icon: 'success',
                title: res.data.message ? res.data.message : `Language has been set default successfully.`,
                timer: timeAlert
            })
            var current_switch_table_checkbox = $(parentEle).find('#switch_table_' + modelId);
            current_switch_table_checkbox.attr('disabled', true);
            var all_switch_table_checkbox = $(parentEle).find('.switch_table').not(current_switch_table_checkbox)
            all_switch_table_checkbox.removeAttr('disabled').removeAttr('checked')
            all_switch_table_checkbox.each(function(i, checkbox) {
                checkbox.checked = false
            })
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