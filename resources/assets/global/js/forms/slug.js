
$(window).on('load', function() {
    
    var slugContent = $('[data-slug-content]');
    var slugInject = $('[data-slug-inject]');

    if (slugContent) {
        slugContent.on('input', function() {
            var self = $(this),
                value = self.val(),
                slugName = self.data('slug-content'),
                getSlugInject = $(`[data-slug-inject="${slugName}"]`);

            if (!getSlugInject.hasClass('edited')) {
                getSlugInject.val(slug(value));
            }
        })
    }

    if (slugInject) {
        slugInject.on('input', function() {
            var self = $(this)
            if (!self.hasClass('edited')) {
                self.addClass('edited');
            }
        });
    }

});