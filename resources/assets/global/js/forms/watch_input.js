
$(window).on('load', function() {
    
    var modelContent = $('[data-model]');
    var modelInject = $('[data-model-inject]');

    if (modelContent) {
        modelContent.on('input', function() {
            var self = $(this),
                value = self.val(),
                modelName = self.data('model'),
                limit = self.data('model-limit'),
                getModelInject = $(`[data-model-inject="${modelName}"]`);

            if (!getModelInject.hasClass('edited')) {
                if (limit) {
                    getModelInject.val(value.substr(0, parseInt(limit)));
                } else {
                    getModelInject.val(value);
                }
            }
        })
    }

    if (modelInject) {
        modelInject.on('input', function() {
            var self = $(this)
            if (!self.hasClass('edited')) {
                self.addClass('edited');
            }
        });
    }

});