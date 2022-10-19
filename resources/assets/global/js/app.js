// setup js
require('./setup')


// global js
require('./global')

// axios config
require('./axios')

// sweetalert config
require('./sweetalert')

// Trigger plugins
require('./trigger-plugins')

// logout form
require('./logout')

// roles and permissions
require('./acl')

// setting module
require('./setting_module')





// Delete row from any datatable
require('./datatables/delete_row')


// Approve or Reject row from any datatable
require('./datatables/approval_row')

// Datatable execute code for all tables
require('./datatables/datatable')

// manage show and hide fields of translation in database
require('./forms/translate_form')

// manage show and hide fields of translation in database
require('./forms/slug')

// watch inputs
require('./forms/watch_input')


require('./theme_setting')

// toggle tabs
$('.children-setting-navs .btn-child').on('click', function(e) {
    e.preventDefault()
    var self = $(this),
        slug = self.data('slug');
    if (!self.hasClass('active')) {
        self.addClass('active').parent('.nav-item').siblings().children('.btn-child').removeClass('active')
        $('.wrapper-settings .child-setting-form').filter(`[data-slug="${slug}"]`).fadeIn(250).siblings().fadeOut(250);
    }
});
/********************************************************************************/