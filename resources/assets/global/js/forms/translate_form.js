var classBtnShowTranslateFields         = '.btn-show-translate-fields',
    classTranslateLabel                 = '.translate-label',
    classTranslateField                 = '.translate-field',
    classTranslateInput                 = '.translate-input',
    hashName                            = '#translation';




$(window).on('load', function() {
    var location = window.location,
        translateInput = $(classTranslateInput);
    if (location.hash == hashName) {
        toggleTranslationFields();
        translateInput.addClass('show-fields');
        translateInput.val('true');
    }
    setTimeout(() => {
        if ($(classTranslateInput).hasClass('show-fields')) {
            toggleTranslationFields();
        }
    }, 100)
});

$(classBtnShowTranslateFields).on('click', function (e) {
    var location = window.location,
        translateInput = $(classTranslateInput);
    if (translateInput.val() == 'true' || location.hash == hashName) {
        window.history.pushState(null, null, ' ')
        toggleTranslationFields('hide', 'slide');
        translateInput.val('false');
    } else {
        location.hash = hashName
        toggleTranslationFields('show', 'slide');
        translateInput.val('true');
    }
});

// toggle show / hide fields
function toggleTranslationFields(status = 'show', animation = 'fixed') {
    var selectEle = $(classTranslateField + ',' + classTranslateLabel);
    if (status == 'show') {
        if (animation == 'slide') {
            selectEle.slideDown(300);
        } else if (animation == 'fixed') {
            selectEle.show();
        }
        $(classBtnShowTranslateFields).find('.text-toggle').removeClass('hide');
    } else if (status == 'hide') {
        if (animation == 'slide') {
            selectEle.slideUp(300);
        } else if (animation == 'fixed') {
            selectEle.hide();
        }
        $(classBtnShowTranslateFields).find('.text-toggle').addClass('hide');
    }
}