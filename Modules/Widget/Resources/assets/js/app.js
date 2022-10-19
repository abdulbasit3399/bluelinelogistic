
var trans = window.widget_translations
var timerHideNewSection = 2000

// toggle open sidebar
$('#sidebar_list .sidebar .sidebar-header').on('click', function () {
    let parent = $(this).parents('.sidebar');
    parent.toggleClass('opened')
    parent.find('.sidebar-body').slideToggle(200)
    parent.find('.sidebar-icon').toggleClass('flip-icon')
});
/********************************************************************************/

// toggle open sidebar
$(document).on('click', '#sidebar_list .sidebar-body .widget-component .widget-component-header', function (e) {
    if (!$(e.target).parents('.widget-component-control').length || $(e.target).hasClass('widget-component-toggle') || $(e.target).hasClass('widget-component-toggle-icon')) {
        let parent = $(this).parents('.widget-component')
        parent.find('.widget-component-wrapper-forms').slideToggle(200)
        $(this).find('.widget-component-toggle i').toggleClass('rotate-180')
    }
});
/********************************************************************************/



// open widget list
$('.add_new_widget_btn').on('click', function(e) {
    e.stopPropagation()
    var self                = $(this),
        sidebarId           = self.parents('.sidebar').data('sidebar-id'),
        sidebarTheme        = self.parents('.sidebar').data('sidebar-theme'),
        widget_class_list   = $('#widget_class_list');
    widget_class_list.attr('data-sidebar-id', sidebarId).attr('data-sidebar-theme', sidebarTheme).addClass('open')
});

// close widget list
$('#widget_class_list').on('click', function(e) {
    if ($(e.target).attr('id') == 'widget_class_list') {
        $(this).removeClass('open');
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

// add new widget
$('#widget_class_list .widget-list .widget-box').on('click', function(e) {
    var self                    = $(this),
        sidebarId               = self.parents('#widget_class_list').attr('data-sidebar-id'),
        sidebarSelected         = $('#sidebar_list .sidebar').filter(`[data-sidebar-id="${sidebarId}"]`),
        widgetListSelected      = sidebarSelected.find('.sidebar-body .widget_list'),
        dataForm = {
            title: self.data('title'),
            // name: self.attr('data-name'),
            namespace: self.data('namespace'),
            form: self.data('form'),
        },
        widgetFormRendred = widgetForm(dataForm);
    // add widget form
    widgetListSelected.append(widgetFormRendred);
    let widgetCreated = widgetListSelected.children('.widget-component').last()
    if (!sidebarSelected.hasClass('opened')) {
        sidebarSelected.find('.sidebar-header').click();
    }
    
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
            class="widget-component shadow"
            data-widget="${namespace}"
        >
            <div class="widget-component-header">
                <div class="widget-component-title">
                    <h4 class="title">${title}</h4>
                </div>
                <div class="widget-component-control">
                    <div class="widget-component-control-view">
                        <div class="btns-moving">
                            <div class="btn btn-secondary btn-moving mx-1" data-move="top">
                                ${trans.to_top}
                            </div>
                            <div class="btn btn-secondary btn-moving mx-1" data-move="bottom">
                                ${trans.to_bottom}
                            </div>
                            <div class="btn-moving mx-1" data-move="up" title="${trans.move_up}">
                                <i class="fas fa-arrow-up fa-fw"></i>
                            </div>
                            <div class="btn-moving mx-1" data-move="down" title="${trans.move_down}">
                                <i class="fas fa-arrow-down fa-fw"></i>
                            </div>
                        </div>
                        <div class="dropdown ms-2">
                            <div class="btn-menu" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item duplicate-widget" href="javascript:void()">
                                        <i class="fas fa-copy fa-fw"></i>
                                        ${trans.duplicate}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item remove-widget" href="javascript:void()">
                                        <i class="fas fa-trash fa-fw"></i>
                                        ${trans.remove_widget}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-component-toggle p-2 ms-2">
                            <i class="fas fa-chevron-down fa-fw widget-component-toggle-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-component-wrapper-forms" style="display: block;">
                <div class="widget-component-form">
                    ${form}
                </div>
            </div>
        </div>
    `;
}
/********************************************************************************/

// duplicate widget
$(document).on('click', '.widget-component-control .duplicate-widget', function(e) {
    e.preventDefault();
    var self            = $(this),
        parentSelf      = self.parents('.widget-component'),
        parentWidgetList = self.parents('.widget_list'),
        widgetCloned = parentSelf.clone();
        
    widgetCloned.removeAttr('data-id');
    parentSelf.after(widgetCloned)

    let widgetDuplicated = parentSelf.next('.widget-component');

    widgetDuplicated.find('.widget-component-wrapper-forms').slideDown(200)
    $('html, body').animate({
        scrollTop: widgetDuplicated.offset().top - 200
    }, 400)
    widgetDuplicated.addClass('new moving')
    setTimeout(() => {
        widgetDuplicated.removeClass('moving')
    }, 200)
    setTimeout(() => {
        widgetDuplicated.removeClass('new')
    }, timerHideNewSection)
})
/********************************************************************************/

// remove widget
var widget_list_removed = []
$(document).on('click', '.widget-component-control .remove-widget', function(e) {
    e.preventDefault();
    var self            = $(this),
        parentSelf      = self.parents('.widget-component');
        if (parentSelf.attr('data-id')) {
            widget_list_removed.push(parentSelf.attr('data-id'))
        }
    parentSelf.addClass('deleting')
    setTimeout(() => {
        parentSelf.remove()
    }, 350)
})
/********************************************************************************/

// moving widget
$(document).on('click', '.widget-component-control .btns-moving .btn-moving', function(e) {
    e.preventDefault();
    var self            = $(this),
        movied          = false,
        typeMove        = self.data('move'),
        parentSelf      = self.parents('.widget-component'),
        widgetList      = parentSelf.parents('.widget_list');

    if (widgetList.children().length > 1) {
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
            if ((parentSelf.index() + 1) != widgetList.children().length) {
                movied = true
                parentSelf.appendTo(widgetList)
            }
        } else if (typeMove == 'top') {
            if (parentSelf.index() != 0) {
                movied = true
                parentSelf.prependTo(widgetList)
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
/********************************************************************************/

// update all widgets
$('#update_widgets').on('click', function (e) {
    e.preventDefault();
    var self            = $(this),
        url             = self.attr('href'),
        loading         = self.find('.loading-in-btn'),
        data            = [];
        
    $('.sidebar .widget_list .widget-component').each(function (i) {
        var WC                  = $(this),
            sidebarParent       = WC.parents('.sidebar'),
            dataFormSerialized  = WC.find('.widget-component-form form').serializeArray(),
            dataForm            = {},
            dataWC              = {
                id:             WC.data('id') ?? null,
                widget:         WC.data('widget'),
                // name:           WC.data('name'),
                index:          WC.index(),
                sidebarId:      sidebarParent.data('sidebar-id'),
                sidebarTheme:   sidebarParent.data('sidebar-theme'),
            };

        dataFormSerialized.forEach(field => {
            dataForm[field.name] = field.value
        })
        dataWC.form = dataForm
        data.push(dataWC)
    });

    // update widgets ajax
    loading.removeClass('d-none');
    self.addClass('disabled');
    axios.put(url, {data: data, 'widget_list_removed': widget_list_removed}).then(res => {
        Toast.fire({
            icon: 'success',
            title: res.data.message ? res.data.message : `Widgets has been updated successfully`
        })
        removeErrorMessages();
        setTimeout(() => {
            window.location.reload()
        }, 2000)
    }).catch(error => {
        loading.addClass('d-none');
        self.removeClass('disabled');
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
});
/********************************************************************************/
// handle error when update widgets

function handleError(errors) {
    removeErrorMessages();
    errors.forEach(errBag => {
        var WCF = $('.sidebar').filter(`[data-sidebar-id="${errBag.sidebarId}"]`).find('.widget_list .widget-component').eq(errBag.index)
        for (field in errBag.errors) {
            var errorMsg = errBag.errors[field][0],
                inputFound = WCF.find(`[name="${field}"]`);
            inputFound.addClass('is-invalid').after(`<div class="invalid-feedback">${errorMsg}</div>`)
        }
    })
}
function removeErrorMessages() {
    $('.widget_list .invalid-feedback').remove();
    $('.widget_list .is-invalid').removeClass('is-invalid');
}
/********************************************************************************/