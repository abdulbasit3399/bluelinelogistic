
var classWrapperArrayValue = '.wrapper-array-value',
    classBtnAddItem = '.add-new-item-array .btn-add-item';
    classBtnRemoveItem = '.wrapper-array-value .array-item .btn-remove-item';



function newItem(field_key, placeholder) {
    return `
        <div class="array-item d-flex mb-4">
            <div class="input w-100">
                <input
                    type="text"
                    name="fields[${ field_key }][]"
                    class="form-control form-control-lg"
                    placeholder="${placeholder}"
                    value=""
                >
            </div>
            <button type="button" class="btn btn-active-light-danger btn-sm ms-2 btn-remove-item mh-45px">
                <i class="fas fa-times fs-3"></i>
            </button>
        </div>
    `;
}



$(classBtnAddItem).on('click', function() {
    var key = $(this).data('key'),
        wrapperArrayValue = $(classWrapperArrayValue).filter(`[data-key="${key}"]`),
        placeholder = wrapperArrayValue.data('placeholder'),
        arrayItemLength = wrapperArrayValue.find('.array-item').length;
    
    placeholder = placeholder + ' ' + (arrayItemLength + 1);
    wrapperArrayValue.append(newItem(key, placeholder))
});

$(document).on('click', classBtnRemoveItem, function () {
    var arrayItem = $(this).parents('.array-item')
    arrayItem.remove()
});

