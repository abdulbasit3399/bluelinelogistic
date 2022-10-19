




$(document).ready(function(){
    /*!*******************************************************!*\
      !*** Changing current language for inputs ***!
      \*******************************************************/
    $(document).on('change', '.change_language', function (e) {
        var self = $(this);
        self.parent('.lang_container').find('.form-control-multilingual').addClass('d-none');
        self.parent('.lang_container').find('.form-control-'+self.val()).removeClass('d-none').focus();

        if(self.parent('.lang_container').find('.editor_container').length > 0){
            self.parent('.lang_container').find('.editor_container').addClass('d-none');
            self.parent('.lang_container').find('#editor_container_'+self.val()).removeClass('d-none').focus();
        }
    });

    $(".change_language").select2({
        templateResult: formatFlag,
        templateSelection: formatState,
        minimumResultsForSearch: -1,
        width: '100%'
    });
});

function formatFlag (lang) {
    if (!lang.id) { return lang.text; }
    var $img    = $(lang.element).attr("data-flag");
    if($img) {
        var $lang = $(
            '<span ><img sytle="display: inline-block;" src=" '+ $(lang.element).attr("data-flag") +' " />&emsp;' + lang.text + '</span>'
        );
    }else{
        var $lang = $(
            '<span >' + lang.text + '</span>'
        );
    }
    return $lang;
}
function formatState (lang) {
    if (!lang.id) {
      return lang.text;
    }
    var $img    = $(lang.element).attr("data-flag");
    if($img) {
        var $lang = $(
            '<span ><img sytle="display: inline-block;" src=" '+ $(lang.element).attr("data-flag") +' " />&emsp;' + lang.text + '</span>'
        );
    }else{
        var $lang = $(
            '<span >' + lang.text + '</span>'
        );
    }
    return $lang;
};


