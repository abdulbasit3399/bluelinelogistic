/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./Modules/Widget/Resources/assets/js/app.js ***!
  \***************************************************/
var trans = window.widget_translations;
var timerHideNewSection = 2000; // toggle open sidebar

$('#sidebar_list .sidebar .sidebar-header').on('click', function () {
  var parent = $(this).parents('.sidebar');
  parent.toggleClass('opened');
  parent.find('.sidebar-body').slideToggle(200);
  parent.find('.sidebar-icon').toggleClass('flip-icon');
});
/********************************************************************************/
// toggle open sidebar

$(document).on('click', '#sidebar_list .sidebar-body .widget-component .widget-component-header', function (e) {
  if (!$(e.target).parents('.widget-component-control').length || $(e.target).hasClass('widget-component-toggle') || $(e.target).hasClass('widget-component-toggle-icon')) {
    var parent = $(this).parents('.widget-component');
    parent.find('.widget-component-wrapper-forms').slideToggle(200);
    $(this).find('.widget-component-toggle i').toggleClass('rotate-180');
  }
});
/********************************************************************************/
// open widget list

$('.add_new_widget_btn').on('click', function (e) {
  e.stopPropagation();
  var self = $(this),
      sidebarId = self.parents('.sidebar').data('sidebar-id'),
      sidebarTheme = self.parents('.sidebar').data('sidebar-theme'),
      widget_class_list = $('#widget_class_list_widgets');
  widget_class_list.attr('data-sidebar-id', sidebarId).attr('data-sidebar-theme', sidebarTheme).addClass('open');
}); // close widget list

$('#widget_class_list_widgets').on('click', function (e) {
  if ($(e.target).attr('id') == 'widget_class_list_widgets') {
    $(this).removeClass('open');
  }
});
/********************************************************************************/
// search in widget list

$('#widget_class_list_widgets .widgets-search .widgets-search-input').on('input', function (e) {
  e.preventDefault();
  var self = $(this),
      searchValue = self.val().trim().toLowerCase(),
      boxClass = '.widget-list .widget-box',
      notMatchedSearch = $(boxClass).filter(":not([data-title-search*=\"".concat(searchValue, "\"])")); // hide widget box

  $(boxClass).removeClass('hide-box'); // show all

  if (searchValue != '') {
    notMatchedSearch.addClass('hide-box'); // hide not matched only 
  } // hide group title


  $('.widget-groups .widget-list').each(function () {
    var countChildren = $(this).find('.widget-box').length;
    var countBoxHide = $(this).find('.widget-box').filter('.hide-box').length;

    if (countChildren == countBoxHide) {
      $(this).prev('.group-title').addClass('hide-box');
    } else {
      $(this).prev('.group-title').removeClass('hide-box');
    }
  });
});
/********************************************************************************/
// add new widget

$('#widget_class_list_widgets .widget-list .widget-box').on('click', function (e) {
  var self = $(this),
      sidebarId = self.parents('#widget_class_list_widgets').attr('data-sidebar-id'),
      sidebarSelected = $('#sidebar_list .sidebar').filter("[data-sidebar-id=\"".concat(sidebarId, "\"]")),
      widgetListSelected = sidebarSelected.find('.sidebar-body .widget_list'),
      dataForm = {
    title: self.data('title'),
    // name: self.attr('data-name'),
    namespace: self.data('namespace'),
    form: self.data('form')
  },
      widgetFormRendred = widgetForm(dataForm); // add widget form

  widgetListSelected.append(widgetFormRendred);
  var widgetCreated = widgetListSelected.children('.widget-component').last();

  if (!sidebarSelected.hasClass('opened')) {
    sidebarSelected.find('.sidebar-header').click();
  }

  $('html, body').animate({
    scrollTop: widgetCreated.offset().top - 200
  }, 400);
  setTimeout(function () {
    widgetCreated.addClass('new');
    setTimeout(function () {
      widgetCreated.removeClass('new');
    }, timerHideNewSection);
  }, 300); // hide widget list

  $('#widget_class_list_widgets').removeClass('open');
});
/********************************************************************************/
// transfrom widget form

function widgetForm(_ref) {
  var title = _ref.title,
      namespace = _ref.namespace,
      form = _ref.form;
  return "\n        <div\n            class=\"widget-component shadow\"\n            data-widget=\"".concat(namespace, "\"\n        >\n            <div class=\"widget-component-header\">\n                <div class=\"widget-component-title\">\n                    <h4 class=\"title\">").concat(title, "</h4>\n                </div>\n                <div class=\"widget-component-control\">\n                    <div class=\"widget-component-control-view\">\n                        <div class=\"btns-moving\">\n                            <div class=\"btn btn-secondary btn-moving mx-1\" data-move=\"top\">\n                                ").concat(trans.to_top, "\n                            </div>\n                            <div class=\"btn btn-secondary btn-moving mx-1\" data-move=\"bottom\">\n                                ").concat(trans.to_bottom, "\n                            </div>\n                            <div class=\"btn-moving mx-1\" data-move=\"up\" title=\"").concat(trans.move_up, "\">\n                                <i class=\"fas fa-arrow-up fa-fw\"></i>\n                            </div>\n                            <div class=\"btn-moving mx-1\" data-move=\"down\" title=\"").concat(trans.move_down, "\">\n                                <i class=\"fas fa-arrow-down fa-fw\"></i>\n                            </div>\n                        </div>\n                        <div class=\"dropdown ms-2\">\n                            <div class=\"btn-menu\" role=\"button\" data-bs-toggle=\"dropdown\">\n                                <i class=\"fas fa-ellipsis-v fa-fw\"></i>\n                            </div>\n                            <ul class=\"dropdown-menu\">\n                                <li>\n                                    <a class=\"dropdown-item duplicate-widget\" href=\"javascript:void()\">\n                                        <i class=\"fas fa-copy fa-fw\"></i>\n                                        ").concat(trans.duplicate, "\n                                    </a>\n                                </li>\n                                <li>\n                                    <a class=\"dropdown-item remove-widget\" href=\"javascript:void()\">\n                                        <i class=\"fas fa-trash fa-fw\"></i>\n                                        ").concat(trans.remove_widget, "\n                                    </a>\n                                </li>\n                            </ul>\n                        </div>\n                        <div class=\"widget-component-toggle p-2 ms-2\">\n                            <i class=\"fas fa-chevron-down fa-fw widget-component-toggle-icon\"></i>\n                        </div>\n                    </div>\n                </div>\n            </div>\n            <div class=\"widget-component-wrapper-forms\" style=\"display: block;\">\n                <div class=\"widget-component-form\">\n                    ").concat(form, "\n                </div>\n            </div>\n        </div>\n    ");
}
/********************************************************************************/
// duplicate widget


$(document).on('click', '.widget-component-control .duplicate-widget', function (e) {
  e.preventDefault();
  var self = $(this),
      parentSelf = self.parents('.widget-component'),
      parentWidgetList = self.parents('.widget_list'),
      widgetCloned = parentSelf.clone();
  widgetCloned.removeAttr('data-id');
  parentSelf.after(widgetCloned);
  var widgetDuplicated = parentSelf.next('.widget-component');
  widgetDuplicated.find('.widget-component-wrapper-forms').slideDown(200);
  $('html, body').animate({
    scrollTop: widgetDuplicated.offset().top - 200
  }, 400);
  widgetDuplicated.addClass('new moving');
  setTimeout(function () {
    widgetDuplicated.removeClass('moving');
  }, 200);
  setTimeout(function () {
    widgetDuplicated.removeClass('new');
  }, timerHideNewSection);
});
/********************************************************************************/
// remove widget

var widget_list_removed = [];
$(document).on('click', '.widget-component-control .remove-widget', function (e) {
  e.preventDefault();
  var self = $(this),
      parentSelf = self.parents('.widget-component');

  if (parentSelf.attr('data-id')) {
    widget_list_removed.push(parentSelf.attr('data-id'));
  }

  parentSelf.addClass('deleting');
  setTimeout(function () {
    parentSelf.remove();
  }, 350);
});
/********************************************************************************/
// moving widget

$(document).on('click', '.widget-component-control .btns-moving .btn-moving', function (e) {
  e.preventDefault();
  var self = $(this),
      movied = false,
      typeMove = self.data('move'),
      parentSelf = self.parents('.widget-component'),
      widgetList = parentSelf.parents('.widget_list');

  if (widgetList.children().length > 1) {
    if (typeMove == 'up') {
      if (parentSelf.prev().length) {
        parentSelf.insertBefore(parentSelf.prev()[0]);
        movied = true;
      }
    } else if (typeMove == 'down') {
      if (parentSelf.next().length) {
        movied = true;
        parentSelf.insertAfter(parentSelf.next()[0]);
      }
    } else if (typeMove == 'bottom') {
      if (parentSelf.index() + 1 != widgetList.children().length) {
        movied = true;
        parentSelf.appendTo(widgetList);
      }
    } else if (typeMove == 'top') {
      if (parentSelf.index() != 0) {
        movied = true;
        parentSelf.prependTo(widgetList);
      }
    }
  }

  if (movied) {
    $('html, body').animate({
      scrollTop: parentSelf.offset().top - 200
    }, 200);
    parentSelf.addClass('new moving');
    setTimeout(function () {
      parentSelf.removeClass('moving');
    }, 200);
    setTimeout(function () {
      parentSelf.removeClass('new');
    }, timerHideNewSection);
  }
});
/********************************************************************************/
// update all widgets

$('#update_widgets').on('click', function (e) {
  e.preventDefault();
  var self = $(this),
      url = self.attr('href'),
      loading = self.find('.loading-in-btn'),
      data = [];
  $('.sidebar .widget_list .widget-component').each(function (i) {
    var _WC$data;

    var WC = $(this),
        sidebarParent = WC.parents('.sidebar'),
        dataFormSerialized = WC.find('.widget-component-form form').serializeArray(),
        dataForm = {},
        dataWC = {
      id: (_WC$data = WC.data('id')) !== null && _WC$data !== void 0 ? _WC$data : null,
      widget: WC.data('widget'),
      // name:           WC.data('name'),
      index: WC.index(),
      sidebarId: sidebarParent.data('sidebar-id'),
      sidebarTheme: sidebarParent.data('sidebar-theme')
    };

    let titles = {};
    dataFormSerialized.forEach(function (field) {
      if (field.name.includes("section_title")){
        let lang = field.name.substring(
            field.name.indexOf("[") + 1, 
            field.name.lastIndexOf("]")
        );
        titles[lang] = field.value;
      }else{
        dataForm[field.name] = field.value;
      }
    });
    if(!jQuery.isEmptyObject(titles)){
      dataForm['section_title'] = titles;
    }
    dataWC.form = dataForm;
    data.push(dataWC);
  }); // update widgets ajax

  loading.removeClass('d-none');
  self.addClass('disabled');
  axios.put(url, {
    data: data,
    'widget_list_removed': widget_list_removed
  }).then(function (res) {
    Toast.fire({
      icon: 'success',
      title: res.data.message ? res.data.message : "Widgets has been updated successfully"
    });
    removeErrorMessages();
    setTimeout(function () {
      window.location.reload();
    }, 2000);
  })["catch"](function (error) {
    loading.addClass('d-none');
    self.removeClass('disabled');

    if (error.response && error.response.status) {
      if (error.response.status == 403) {
        if (error.response.data.message) {
          Toast.fire({
            icon: 'error',
            title: error.response.data.message
          });
        }
      } else if (error.response.status == 500) {
        Toast.fire({
          icon: 'error',
          title: 'Server Error!'
        });
      } else if (error.response.status == 422) {
        Toast.fire({
          icon: 'error',
          title: error.response.data.message
        });
        handleError(error.response.data.errors);
      } else if (error.response.status == 404) {
        Toast.fire({
          icon: 'error',
          title: 'Request not found'
        });
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
  errors.forEach(function (errBag) {
    var WCF = $('.sidebar').filter("[data-sidebar-id=\"".concat(errBag.sidebarId, "\"]")).find('.widget_list .widget-component').eq(errBag.index);

    for (field in errBag.errors) {
      var errorMsg = errBag.errors[field][0],
          inputFound = WCF.find("[name=\"".concat(field, "\"]"));
      inputFound.addClass('is-invalid').after("<div class=\"invalid-feedback\">".concat(errorMsg, "</div>"));
    }
  });
}

function removeErrorMessages() {
  $('.widget_list .invalid-feedback').remove();
  $('.widget_list .is-invalid').removeClass('is-invalid');
}
/********************************************************************************/
/******/ })()
;
//# sourceMappingURL=widget.js.map