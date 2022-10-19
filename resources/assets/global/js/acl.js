
var classCardPermissions = '.card-permissions',
    classCheckboxPermission = '.select-single-permission',
    classCheckboxGroup = '.select-all-groups';

function checkSelected(cardPermissions) {
    var selected = [];
    cardPermissions.find(classCheckboxPermission).each(function (i, e) {
        if ($(this)[0].checked) {
            selected.push(i)
        }
    })
    return selected.length == cardPermissions.find(classCheckboxPermission).length;
}

function toggleSelectAll(cardPermissions) {
    var checkboxAllGroup = cardPermissions.find(classCheckboxGroup)

    setTimeout(() => {
        if (checkSelected(cardPermissions)) {
            checkboxAllGroup.prop('checked', true)
        } else {
            checkboxAllGroup.prop('checked', false)
        }
    });
}

// choose all rows
$(classCardPermissions).find(classCheckboxGroup).on('change', function(e) {
        var self = $(this),
            selectedAll = self[0].checked,
            cardPermissions = self.parents(classCardPermissions),
            checkBoxPermissionNotSelected = cardPermissions.find(classCheckboxPermission + ':not(:checked)'),
            checkBoxPermissionSelected = cardPermissions.find(classCheckboxPermission + ':checked');

    if (selectedAll) {
        // toggle not seleced only
        checkBoxPermissionNotSelected.click()
    } else {
        // toggle selected only
        checkBoxPermissionSelected.click();
    }
});

// choose one row
$(classCardPermissions).find(classCheckboxPermission).on('change', function(e) {
    var cardPermissions = $(this).parents(classCardPermissions);
    toggleSelectAll(cardPermissions);
});