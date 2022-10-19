var $trans = ''
var $place = window.place
var timerHideNewSection = 2000

// toggle open according
$('#tab_list .tab .tab-header').on('click', function () {
    let parent = $(this).parents('.tab');
    parent.toggleClass('opened')
    parent.find('.tab-body').slideToggle(200)
    parent.find('.tab-icon').toggleClass('flip-icon')
});
/********************************************************************************/


// toggle open sidebar
$(document).on('click', '.section-component:not(.container_section) > .section-component-header', function (e) {
    if (!$(e.target).parents('.section-component-control').length || $(e.target).hasClass('section-component-toggle') || $(e.target).hasClass('section-component-toggle-icon')) {
        let parent = $(this).parents('.section-component:not(.container_section)')
        parent.find('.section-component-wrapper-forms:not(.wrapper-sections)').slideToggle(200)
        $(this).find('.section-component-toggle i').toggleClass('rotate-180')
    }
});
$(document).on('click', '.section-component.container_section > .section-component-header', function (e) {
    if (!$(e.target).parents('.section-component-control').length || $(e.target).hasClass('section-component-toggle') || $(e.target).hasClass('section-component-toggle-icon')) {
        let parent = $(this).parents('.section-component.container_section')
        parent.find('.section-component-wrapper-forms.wrapper-sections').slideToggle(200)
        $(this).find('.section-component-toggle i').toggleClass('rotate-180')
    }
});
$('#containers .section-component.container_section').each(function (i) {
    if (i === 0) {
        if ($(this).children('.section-component-header').length) {
            $($(this).children('.section-component-header')[0]).click();
        }
    }
})
/********************************************************************************/



// open section list
$(document).on('click', '.add_new_section_btn', function(e) {
    e.stopPropagation()
    var containerId = $(this).parents('.container_section').data('id');
    $('#section_class_list').attr('data-container-id', containerId).addClass('open');
    window.livewire.rescan();
});

// close section list
$('#section_class_list').on('click', function(e) {
    if ($(e.target).attr('id') == 'section_class_list') {
        $(this).removeClass('open');
    }
});
/********************************************************************************/

// open widget list
$(document).on('click', '.add_new_widget_btn', function(e) {
    e.stopPropagation()
    var containerId = $(this).parents('.container_section').data('id');
    $('#widget_class_list').attr('data-container-id', containerId).addClass('open');
    window.livewire.rescan();
});

// close widget list
$('#widget_class_list').on('click', function(e) {
    if ($(e.target).attr('id') == 'widget_class_list') {
        $(this).removeClass('open');
    }
});
/********************************************************************************/


// add new container
$('.add_new_container_btn').on('click', function (e) {
    e.stopPropagation();
    var containerId = 'container_id_' + Math.floor(Math.random() * 500000),
        containers = $('#containers'),
        childrenLength = containers.find('.container_section').length,
        containerClone = $('.container_clone .container_section').clone();
    containerClone.attr('data-id', containerId);
    containerClone.find('.section-component-header .title').text($trans.container + ' ' + (childrenLength + 1));
    containerClone.find('.container_width').each(function () {
        $(this).attr('id', $(this).val()+'_'+containerId);
    });
    $('.empty-containers').addClass('d-none');
    $('.hide-when-not-containers').removeClass('d-none');
    containers.append(containerClone);
    var containerCreated = containers.children('.container_section').last();
    containerCreated.find('.section-component-header').click();
    $('html, body').animate({
      scrollTop: containerCreated.offset().top - 200
    }, 400);
    setTimeout(function () {
      containerCreated.addClass('new');
      setTimeout(function () {
        containerCreated.removeClass('new');
      }, timerHideNewSection);
    }, 300);
}); // search in section list





// search in section list
$('#section_class_list .sections-search .sections-search-input').on('input', function (e) {
    e.preventDefault();
    var self                    = $(this),
        searchValue             = self.val().trim().toLowerCase(),
        boxClass                = '.section-list .section-box',
        notMatchedSearch        = $('#section_class_list').find(boxClass).filter(`:not([data-title-search*="${searchValue}"])`);

    // hide section box
    $(boxClass).removeClass('hide-box'); // show all
    if (searchValue != '') {
        notMatchedSearch.addClass('hide-box'); // hide not matched only 
    }
});
/********************************************************************************/


// search in widget list
$('#widget_class_list .widgets-search .widgets-search-input').on('input', function (e) {
    e.preventDefault();
    var self                    = $(this),
        searchValue             = self.val().trim().toLowerCase(),
        boxClass                = '.widget-list .widget-box',
        notMatchedSearch        = $(boxClass).filter(`:not([data-title-search*="${searchValue}"])`);

    // hide widget box
    $(boxClass).removeClass('hide-box'); // show all
    if (searchValue != '') {
        notMatchedSearch.addClass('hide-box'); // hide not matched only 
    }
    // hide group title
    $('.widget-groups .widget-list').each(function () {
        var countChildren = $(this).find('.widget-box').length
        var countBoxHide = $(this).find('.widget-box').filter('.hide-box').length
        if (countChildren == countBoxHide) {
            $(this).prev('.group-title').addClass('hide-box')
        } else {
            $(this).prev('.group-title').removeClass('hide-box')
        }
    });
});
/********************************************************************************/

// add new section
$('#section_class_list .section-list .section-box').on('click', function(e) {
    var self                    = $(this),
        containerId               = self.parents('#section_class_list').attr('data-container-id'),
        containerSelected         = $('#containers .container_section').filter(`[data-id="${containerId}"]`),
        sectionListSelected      = containerSelected.find('.wrapper_section_list'),
        dataForm = {
            title: self.data('title'),
            name: self.data('name'),
            form: self.data('form'),
        },
        sectionFormRendred = sectionForm(dataForm);
    // add section form
    sectionListSelected.next('.no-sections').hide()
    sectionListSelected.append(sectionFormRendred);
    let sectionCreated = sectionListSelected.children('.section-component').last()
    sectionCreated.attr('data-container-id', containerId)
    $('html, body').animate({
        scrollTop: sectionCreated.offset().top - 200
    }, 400)

    setTimeout(() => {
        sectionCreated.addClass('new')
        setTimeout(() => {
            sectionCreated.removeClass('new')
        }, timerHideNewSection)
    }, 300)

    
    // hide section list
    $('#section_class_list').removeClass('open');
});
/********************************************************************************/

// transfrom section form
function sectionForm({title, name, form}) {
    return `
        <div
            class="section-component shadow theme-setting-section"
            data-section="${name}"
        >
            <div class="section-component-header">
                <div class="section-component-title">
                    <h4 class="title">${title}</h4>
                </div>
                <div class="section-component-control">
                    <div class="section-component-control-view">
                        <div class="btns-moving">
                            <div class="btn btn-secondary btn-moving mx-1" data-move="top">
                                ${$trans.to_top}
                            </div>
                            <div class="btn btn-secondary btn-moving mx-1" data-move="bottom">
                                ${$trans.to_bottom}
                            </div>
                            <div class="btn-moving mx-1" data-move="up" title="${$trans.move_up}">
                                <i class="fas fa-arrow-up fa-fw"></i>
                            </div>
                            <div class="btn-moving mx-1" data-move="down" title="${$trans.move_down}">
                                <i class="fas fa-arrow-down fa-fw"></i>
                            </div>
                        </div>
                        <div class="dropdown ms-2">
                            <div class="btn-menu" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item duplicate-section" href="javascript:void()">
                                        <i class="fas fa-copy fa-fw"></i>
                                        ${$trans.duplicate}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item remove-section" href="javascript:void()">
                                        <i class="fas fa-trash fa-fw"></i>
                                        ${$trans.remove_section}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="section-component-toggle p-2 ms-2">
                            <i class="fas fa-chevron-down fa-fw section-component-toggle-icon rotate-180"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-component-wrapper-forms" style="display: block;">
                <form class="section-component-form">
                    ${form}
                </form>
            </div>
        </div>
    `;
}
/********************************************************************************/

// add new widget
$('#widget_class_list .widget-list .widget-box').on('click', function(e) {
    var self                    = $(this),
        containerId               = self.parents('#widget_class_list').attr('data-container-id'),
        containerSelected         = $('#containers .container_section').filter(`[data-id="${containerId}"]`),
        sectionListSelected      = containerSelected.find('.wrapper_section_list'),
        dataForm = {
            title: self.data('title'),
            namespace: self.data('namespace'),
            form: self.data('form'),
        },
        widgetFormRendred = widgetForm(dataForm);
    // add widget form
    sectionListSelected.next('.no-sections').hide()
    sectionListSelected.append(widgetFormRendred);
    let widgetCreated = sectionListSelected.children('.section-component').last()

    widgetCreated.attr('data-container-id', containerId)
    
    $('html, body').animate({
        scrollTop: widgetCreated.offset().top - 200
    }, 400)

    setTimeout(() => {
        widgetCreated.addClass('new')
        setTimeout(() => {
            widgetCreated.removeClass('new')
        }, timerHideNewSection)
    }, 300)

    // hide widget list
    $('#widget_class_list').removeClass('open');
});
/********************************************************************************/

// transfrom widget form
function widgetForm({title, namespace, form}) {
    return `
        <div
            class="section-component shadow theme-setting-section widget_section"
            data-widget="${namespace}"
        >
            <div class="section-component-header">
                <div class="section-component-title">
                    <h4 class="title">${title}</h4>
                    <span class="badge badge-info">${$trans.widget}</span>
                </div>
                <div class="section-component-control">
                    <div class="section-component-control-view">
                        <div class="btns-moving">
                            <div class="btn btn-secondary btn-moving mx-1" data-move="top">
                                ${$trans.to_top}
                            </div>
                            <div class="btn btn-secondary btn-moving mx-1" data-move="bottom">
                                ${$trans.to_bottom}
                            </div>
                            <div class="btn-moving mx-1" data-move="up" title="${$trans.move_up}">
                                <i class="fas fa-arrow-up fa-fw"></i>
                            </div>
                            <div class="btn-moving mx-1" data-move="down" title="${$trans.move_down}">
                                <i class="fas fa-arrow-down fa-fw"></i>
                            </div>
                        </div>
                        <div class="dropdown ms-2">
                            <div class="btn-menu" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item duplicate-section" href="javascript:void()">
                                        <i class="fas fa-copy fa-fw"></i>
                                        ${$trans.duplicate}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item remove-section" href="javascript:void()">
                                        <i class="fas fa-trash fa-fw"></i>
                                        ${$trans.remove_section}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="section-component-toggle p-2 ms-2">
                            <i class="fas fa-chevron-down fa-fw section-component-toggle-icon rotate-180"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-component-wrapper-forms" style="display: block;">
                <form class="section-component-form">
                    ${form}
                </form>
            </div>
        </div>
    `;
}
/********************************************************************************/

// duplicate section
$(document).on('click', '.section-component:not(.container_section) .section-component-header .section-component-control .duplicate-section', function(e) {
    e.preventDefault();
    var self            = $(this),
        parentSelf      = self.parents('.section-component:not(.container_section)'),
        sectionCloned = parentSelf.clone();
        
    sectionCloned.removeAttr('data-id');
    sectionCloned.removeAttr('data-widget-id');
    parentSelf.after(sectionCloned)

    let sectionDuplicated = parentSelf.next('.section-component');

    sectionDuplicated.find('.section-component-wrapper-forms').slideDown(200)
    $('html, body').animate({
        scrollTop: sectionDuplicated.offset().top - 200
    }, 400)
    sectionDuplicated.addClass('new moving')
    setTimeout(() => {
        sectionDuplicated.removeClass('moving')
    }, 200)
    setTimeout(() => {
        sectionDuplicated.removeClass('new')
    }, timerHideNewSection)
})
/********************************************************************************/

// duplicate section
$(document).on('click', '.section-component.container_section > .section-component-header .section-component-control .duplicate-section', function(e) {
    e.preventDefault();
    var self            = $(this),
        parentSelf      = self.parents('.section-component.container_section'),
        sectionCloned = parentSelf.clone();
        
    sectionCloned.removeAttr('data-id');
    parentSelf.after(sectionCloned)

    resetContainerNames();

    let sectionDuplicated = parentSelf.next('.section-component');
    sectionDuplicated.find('.section-component').removeAttr('data-id').removeAttr('data-widget-id');

    sectionDuplicated.find('.section-component-wrapper-forms.wrapper-sections').slideDown(200)
    $('html, body').animate({
        scrollTop: sectionDuplicated.offset().top - 200
    }, 400)
    sectionDuplicated.addClass('new moving')
    setTimeout(() => {
        sectionDuplicated.removeClass('moving')
    }, 200)
    setTimeout(() => {
        sectionDuplicated.removeClass('new')
    }, timerHideNewSection)
})
/********************************************************************************/



// remove section
var section_list_removed = []
var widget_list_removed = []
var container_list_removed = []
$(document).on('click', '.section-component:not(.container_section) .section-component-header .section-component-control .remove-section', function(e) {
    e.preventDefault();
    var self            = $(this),
        parentSelf      = self.parents('.section-component:not(.container_section)'),
        sectionList     = parentSelf.parents('.wrapper_section_list');
        if (parentSelf.attr('data-id')) {
            section_list_removed.push(parentSelf.attr('data-id'))
        }
        if (parentSelf.attr('data-widget-id')) {
            widget_list_removed.push(parentSelf.attr('data-widget-id'))
        }
    parentSelf.addClass('deleting')

    if (sectionList.find('.section-component').length == 1) {
        sectionList.next('.no-sections').show()
    }
    setTimeout(() => {
        parentSelf.remove()
    }, 350)
})

$(document).on('click', '.section-component.container_section > .section-component-header .section-component-control .remove-section', function(e) {
    e.preventDefault();
    var self            = $(this),
        parentSelf      = self.parents('.section-component.container_section'),
        containers     = parentSelf.parents('#containers');
        if (parentSelf.attr('data-id') && parentSelf.attr('data-id').indexOf('container_id') == -1) {
            container_list_removed.push(parentSelf.attr('data-id'))
        }

    parentSelf.addClass('deleting')

    if (containers.find('.container_section').length == 1) {
        $('.empty-containers').removeClass('d-none')
        $('.hide-when-not-containers').addClass('d-none')
    }
    setTimeout(() => {
        parentSelf.remove()
        resetContainerNames();
    }, 350)
})
/********************************************************************************/

// moving section
$(document).on('click', '.section-component:not(.container_section) .section-component-header .section-component-control .btns-moving .btn-moving', function(e) {
    e.preventDefault();
    var self            = $(this),
        movied          = false,
        typeMove        = self.data('move'),
        parentSelf      = self.parents('.section-component:not(.container_section)'),
        sectionList      = parentSelf.parents('.wrapper_section_list');

    if (sectionList.children().length > 1) {
        if (typeMove == 'up') {
            if (parentSelf.prev().length) {
                parentSelf.insertBefore(parentSelf.prev()[0])
                movied = true
            }
        } else if (typeMove == 'down') {
            if (parentSelf.next().length) {
                movied = true
                parentSelf.insertAfter(parentSelf.next()[0])
            }
        } else if (typeMove == 'bottom') {
            if ((parentSelf.index() + 1) != sectionList.children().length) {
                movied = true
                parentSelf.appendTo(sectionList)
            }
        } else if (typeMove == 'top') {
            if (parentSelf.index() != 0) {
                movied = true
                parentSelf.prependTo(sectionList)
            }
        }
    }
   
    if (movied) {
        $('html, body').animate({
            scrollTop: parentSelf.offset().top - 200
        }, 200)
    
        parentSelf.addClass('new moving')
        setTimeout(() => {
            parentSelf.removeClass('moving')
        }, 200)
        setTimeout(() => {
            parentSelf.removeClass('new')
        }, timerHideNewSection)
    }
})

// moving section
$(document).on('click', '.section-component.container_section > .section-component-header .section-component-control .btns-moving .btn-moving', function(e) {
    e.preventDefault();
    var self            = $(this),
        movied          = false,
        typeMove        = self.data('move'),
        parentSelf      = self.parents('.section-component.container_section'),
        sectionList      = parentSelf.parents('#containers');

    if (sectionList.children().length > 1) {
        if (typeMove == 'up') {
            if (parentSelf.prev().length) {
                parentSelf.insertBefore(parentSelf.prev()[0])
                movied = true
            }
        } else if (typeMove == 'down') {
            if (parentSelf.next().length) {
                movied = true
                parentSelf.insertAfter(parentSelf.next()[0])
            }
        } else if (typeMove == 'bottom') {
            if ((parentSelf.index() + 1) != sectionList.children().length) {
                movied = true
                parentSelf.appendTo(sectionList)
            }
        } else if (typeMove == 'top') {
            if (parentSelf.index() != 0) {
                movied = true
                parentSelf.prependTo(sectionList)
            }
        }
        resetContainerNames();
    }
   
    if (movied) {
        $('html, body').animate({
            scrollTop: parentSelf.offset().top - 200
        }, 200)
    
        parentSelf.addClass('new moving')
        setTimeout(() => {
            parentSelf.removeClass('moving')
        }, 200)
        setTimeout(() => {
            parentSelf.removeClass('new')
        }, timerHideNewSection)
    }
})
/********************************************************************************/

// update all sections
$('.update_theme_setting').on('click', function (e) {
    e.preventDefault();
    var self            = $(this),
        url             = self.attr('href'),
        btnUpdate       = $('.update_theme_setting'),
        loading         = btnUpdate.find('.loading-in-btn'),
        data            = [],
        widgets         = [],
        containers      = [];

    $('.theme-setting-section').each(function (i) {
        var WC                  = $(this),
            dataFormSerialized  = WC.find('.section-component-form').serializeArray(),
            dataForm            = {},
            dataWC              = {
                id:             WC.data('id') ?? null,
                container_id:   WC.data('container-id') ?? null,
                index:          WC.index()
            },
            inputFiles = WC.find('.section-component-form').find('input[type="file"]'),
            inputSelectMultiple = WC.find('.section-component-form').find('select[multiple]');
            inputArray = WC.find('.section-component-form').find('input[data-type="array"],select[data-type="array"]');
            inputLocalText = WC.find('.section-component-form').find('.form-control-multilingual');

        inputFiles.each(function() {
            var self = $(this),
                selfEle = self[0];

            if (selfEle.files.length) {
                const reader = new FileReader();
                const file = selfEle.files[0]
                reader.onloadend = function() {
                    dataForm[self.attr('name')] = reader.result
                }
                reader.readAsDataURL(file);
            }
        })
        dataFormSerialized.forEach(field => {
            dataForm[field.name] = field.value


            var name = field.name;
            if(name.includes('][')){
                name = name.replace(']','').replace(']','').split('[');
                delete dataForm[field.name];

                if (typeof dataForm[name[0]] === 'undefined') {
                    dataForm[name[0]] = {};
                }
                if (typeof dataForm[name[0]][name[1]] === 'undefined') {
                    dataForm[name[0]][name[1]] = {};
                }
                if (typeof dataForm[name[0]][name[1]] === 'undefined') {
                    dataForm[name[0]][name[1]] = {};
                }
                dataForm[name[0]][name[1]][name[2]] = field.value;
            }
            
        })
        inputSelectMultiple.each(function() {
            var self = $(this),
                value = self.val();
            dataForm[self.attr('name')] = value
        })
        inputLocalText.each(function () {
          var self = $(this),
              value = self.val(),
              lang = self.attr('title');
          if (typeof dataForm[self.attr('name').replace("["+self.attr('title')+"]",'')] === 'undefined') {
            dataForm[self.attr('name').replace("["+self.attr('title')+"]",'')] = {};
          }
          delete dataForm[self.attr('name')];
          dataForm[self.attr('name').replace("["+self.attr('title')+"]",'')][lang] = value;
        })
        inputArray.each(function () {
          var self = $(this),
              value = self.val(),
              type = self.attr('data-title');
          if (typeof dataForm[self.attr('name').replace("["+self.attr('data-title')+"]",'')] === 'undefined') {
            dataForm[self.attr('name').replace("["+self.attr('data-title')+"]",'')] = {};
          }
          delete dataForm[self.attr('name')];
          dataForm[self.attr('name').replace("["+self.attr('data-title')+"]",'')][type] = value;
        })
        dataWC.form = dataForm

        if (WC.hasClass('widget_section')) {
            dataWC.widget = WC.data('widget')
            dataWC.widget_id = WC.data('widget-id') ?? null
            widgets.push(dataWC)
        } else {
            dataWC.section = WC.data('section')
            data.push(dataWC)
        }
    });

    $('#containers .container_section').each(function (i) {
        var CS                  = $(this),
            containerDataFormSerialized  = CS.find('.wrapper-container-setting .container_form').serializeArray(),
            containerForm            = {},
            containerDataCS          = {
                id:             CS.data('id') ?? null,
                index:          CS.index()
            };

        containerDataFormSerialized.forEach(field => {
            containerForm[field.name] = field.value
        })
        containerDataCS.form = containerForm
        containers.push(containerDataCS)
    });

    // update sections ajax
    loading.removeClass('d-none');
    btnUpdate.addClass('disabled');

    const ajaxData = {
        sections: data,
        section_list_removed: section_list_removed,
        widgets: widgets,
        widget_list_removed: widget_list_removed,
        containers: containers,
        container_list_removed: container_list_removed,
    }
    setTimeout(() => {
        axios.put(url, ajaxData).then(res => {
        Toast.fire({
            icon: 'success',
            title: res.data.message ? res.data.message : `Settings has been updated successfully`
        })
        removeErrorMessages();
        setTimeout(() => {
            window.location.reload()
        }, 2000)
        }).catch(error => {
            loading.addClass('d-none');
            btnUpdate.removeClass('disabled');
            if (error.response && error.response.status) {
                if (error.response.status == 403) {
                    if (error.response.data.message) {
                        Toast.fire({
                            icon: 'error',
                            title: error.response.data.message
                        })
                    }
                } else if (error.response.status == 500) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Server Error!'
                    })
                } else if (error.response.status == 422) {
                    Toast.fire({
                        icon: 'error',
                        title: error.response.data.message
                    })
                    handleError(error.response.data.errors)
                } else if (error.response.status == 404) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Request not found'
                    })
                } else if (error.response.status == 401) {
                    window.location.reload();
                }
            }
        });
    }, 100)

});
/********************************************************************************/
// handle error when update sections

function handleError(errors) {
    removeErrorMessages();
    let firstInputFound = null
    errors.forEach(errBag => {
        var container = $('#containers .container_section').filter(`[data-id="${errBag.container_id}"]`),
            WCF = container.find('.theme-setting-section').eq(errBag.index);
        
        if (!container.children('.section-component-header').find('.section-component-toggle i').hasClass('rotate-180')) {
            container.children('.section-component-header').click()
        }
        if (!WCF.children('.section-component-header').find('.section-component-toggle i').hasClass('rotate-180')) {
            WCF.children('.section-component-header').click()
        }
        for (field in errBag.errors) {
            var errorMsg = errBag.errors[field][0],
                inputFound = WCF.find(`[name="${field}"]`);
            if (!firstInputFound) {
                firstInputFound = inputFound
            }
            inputFound.addClass('is-invalid').after(`<div class="invalid-feedback">${errorMsg}</div>`)
        }
    })
    $('html, body').animate({
        scrollTop: firstInputFound.offset().top - 170
    }, 400)
}
function removeErrorMessages() {
    $('.theme-setting-section .invalid-feedback').remove();
    $('.theme-setting-section .is-invalid').removeClass('is-invalid');
}
/********************************************************************************/
function resetContainerNames() {
    $('#containers .container_section').each(function (i) {
        $(this).children('.section-component-header').find('.section-component-title .title').text($trans.container + ' ' + (i + 1))
    });
}
window.resetContainerNames = resetContainerNames
/********************************************************************************/