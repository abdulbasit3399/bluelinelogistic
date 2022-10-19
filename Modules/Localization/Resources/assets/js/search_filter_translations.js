
var translationsSearch = $('#translations_search');

translationsSearch.on('input', function(e) {
    e.preventDefault();
    var self                    = $(this),
        searchValue             = self.val().trim().toLowerCase(),
        translationsCard        = $('#translations_card'),
        fieldTranslationClass   = '.field-translation',
        notMatchedSearch           = $(fieldTranslationClass).filter(`:not([data-phrase*="${searchValue}"])`);

    $(fieldTranslationClass).removeClass('hide-field'); // show all
    if (searchValue != '') {
        notMatchedSearch.addClass('hide-field'); // hide not matched only 
    }
});