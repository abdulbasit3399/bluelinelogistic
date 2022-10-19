
$(document).ready(function(){
    /*!*******************************************************!*\
    !*** Changing current url type for inputs ***!
    \*******************************************************/
    $(document).on('change', '.change_url_type', function (e) {
        var self = $(this);
        self.parent('.url_input_container').find('.form-control-choose-type').addClass('d-none');
        self.parent('.url_input_container').find('.form-control-'+self.val()).removeClass('d-none').focus();
    });


    $(".change_url_type").select2({
        minimumResultsForSearch: -1,
    });
});