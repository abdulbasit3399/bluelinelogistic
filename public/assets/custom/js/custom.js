/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/custom/js/comment_approval.js":
/*!********************************************************!*\
  !*** ./resources/assets/custom/js/comment_approval.js ***!
  \********************************************************/
/***/ (() => {

$(document).on('change', '.comment_approval', function (e) {
  var self = $(this),
      currentValue = self[0].checked,
      action = currentValue ? 'approve' : 'reject',
      url = self.data('url'),
      approvedText = self.data('approved-text'),
      rejectedText = self.data('rejected-text'),
      class_approved = action == 'approve' ? 'success' : 'danger',
      text_approved = action == 'approve' ? approvedText : rejectedText,
      modelId = self.data('model-id'),
      timeAlert = 2000,
      data = {
    ids: [modelId],
    action: action,
    _token: _csrf_token
  };
  axios.post(url, data).then(function (res) {
    Toast.fire({
      icon: 'success',
      title: res.data.message ? res.data.message : "Comment has been updated successfully",
      timer: timeAlert
    });
    var badge = "<span class=\"badge fs-9 badge-".concat(class_approved, "\">\n                            ").concat(text_approved, "\n                        </span>");
    $('.approval-status').filter(".model-id-".concat(modelId)).html(badge);
  })["catch"](function (error) {
    if (error.response && error.response.status) {
      if (error.response.status == 403) {
        if (error.response.data.message) {
          Toast.fire({
            icon: 'error',
            title: error.response.data.message,
            timer: timeAlert
          });
        }
      } else if (error.response.status == 500) {
        Toast.fire({
          icon: 'error',
          title: 'Server Error!',
          timer: timeAlert
        });
      } else if (error.response.status == 422) {
        Toast.fire({
          icon: 'error',
          title: error.response.data.message,
          timer: timeAlert
        });
      } else if (error.response.status == 404) {
        Toast.fire({
          icon: 'error',
          title: 'Request not found',
          timer: timeAlert
        });
      } else if (error.response.status == 401) {
        window.location.reload();
      }
    }
  });
});

/***/ }),

/***/ "./resources/assets/custom/js/multilingual-selector.js":
/*!*************************************************************!*\
  !*** ./resources/assets/custom/js/multilingual-selector.js ***!
  \*************************************************************/
/***/ (() => {

$(document).ready(function () {
  /*!*******************************************************!*\
    !*** Changing current language for inputs ***!
    \*******************************************************/
  $(document).on('change', '.change_language', function (e) {
    var self = $(this);
    self.parent('.lang_container').find('.form-control-multilingual').addClass('d-none');
    self.parent('.lang_container').find('.form-control-' + self.val()).removeClass('d-none').focus();

    if (self.parent('.lang_container').find('.editor_container').length > 0) {
      self.parent('.lang_container').find('.editor_container').addClass('d-none');
      self.parent('.lang_container').find('#editor_container_' + self.val()).removeClass('d-none').focus();
    }
  });
  $(".change_language").select2({
    templateResult: formatFlag,
    templateSelection: formatState,
    minimumResultsForSearch: -1,
    width: '100%'
  });
});

function formatFlag(lang) {
  if (!lang.id) {
    return lang.text;
  }

  var $img = $(lang.element).attr("data-flag");

  if ($img) {
    var $lang = $('<span ><img sytle="display: inline-block;" src=" ' + $(lang.element).attr("data-flag") + ' " />&emsp;' + lang.text + '</span>');
  } else {
    var $lang = $('<span >' + lang.text + '</span>');
  }

  return $lang;
}

function formatState(lang) {
  if (!lang.id) {
    return lang.text;
  }

  var $img = $(lang.element).attr("data-flag");

  if ($img) {
    var $lang = $('<span ><img sytle="display: inline-block;" src=" ' + $(lang.element).attr("data-flag") + ' " />&emsp;' + lang.text + '</span>');
  } else {
    var $lang = $('<span >' + lang.text + '</span>');
  }

  return $lang;
}

;

/***/ }),

/***/ "./resources/assets/custom/js/settings-fields.js":
/*!*******************************************************!*\
  !*** ./resources/assets/custom/js/settings-fields.js ***!
  \*******************************************************/
/***/ (() => {

$(document).ready(function () {
  /*!*******************************************************!*\
    !*** Select fields ***!
    \*******************************************************/
  $("select.form-select").select2();

  if (typeof formatFlag !== 'undefined') {
    $(".change_language").select2({
      templateResult: formatFlag,
      templateSelection: formatState,
      minimumResultsForSearch: -1,
      width: '100%'
    });
  }
  /*!*******************************************************!*\
    !*** Color picker fields ***!
    \*******************************************************/


  if (typeof spectrum === 'function') {
    $('.color_picker_input').spectrum({
      type: "component",
      showInput: true,
      showInitial: true,
      clickoutFiresChange: true,
      allowEmpty: true,
      maxSelectionSize: 8
    });
  }
});

/***/ }),

/***/ "./resources/assets/custom/js/switch-in-table.js":
/*!*******************************************************!*\
  !*** ./resources/assets/custom/js/switch-in-table.js ***!
  \*******************************************************/
/***/ (() => {

$(document).on('change', '.switch_table', function (e) {
  var self = $(this),
      url = self.data('url'),
      modelId = self.data('model-id'),
      parentEle = self.data('parent'),
      timeAlert = 2000,
      data = {
    _token: _csrf_token
  };
  axios.post(url, data).then(function (res) {
    Toast.fire({
      icon: 'success',
      title: res.data.message ? res.data.message : "Language has been set default successfully.",
      timer: timeAlert
    });
    var current_switch_table_checkbox = $(parentEle).find('#switch_table_' + modelId);
    current_switch_table_checkbox.attr('disabled', true);
    var all_switch_table_checkbox = $(parentEle).find('.switch_table').not(current_switch_table_checkbox);
    all_switch_table_checkbox.removeAttr('disabled').removeAttr('checked');
    all_switch_table_checkbox.each(function (i, checkbox) {
      checkbox.checked = false;
    });
  })["catch"](function (error) {
    if (error.response && error.response.status) {
      if (error.response.status == 403) {
        if (error.response.data.message) {
          Toast.fire({
            icon: 'error',
            title: error.response.data.message,
            timer: timeAlert
          });
        }
      } else if (error.response.status == 500) {
        Toast.fire({
          icon: 'error',
          title: 'Server Error!',
          timer: timeAlert
        });
      } else if (error.response.status == 422) {
        Toast.fire({
          icon: 'error',
          title: error.response.data.message,
          timer: timeAlert
        });
      } else if (error.response.status == 404) {
        Toast.fire({
          icon: 'error',
          title: 'Request not found',
          timer: timeAlert
        });
      } else if (error.response.status == 401) {
        window.location.reload();
      }
    }
  });
});

/***/ }),

/***/ "./resources/assets/custom/js/url-selector.js":
/*!****************************************************!*\
  !*** ./resources/assets/custom/js/url-selector.js ***!
  \****************************************************/
/***/ (() => {

$(document).ready(function () {
  /*!*******************************************************!*\
  !*** Changing current url type for inputs ***!
  \*******************************************************/
  $(document).on('change', '.change_url_type', function (e) {
    var self = $(this);
    self.parent('.url_input_container').find('.form-control-choose-type').addClass('d-none');
    self.parent('.url_input_container').find('.form-control-' + self.val()).removeClass('d-none').focus();
  });
  $(".change_url_type").select2({
    minimumResultsForSearch: -1
  });
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************************************!*\
  !*** ./resources/assets/custom/js/custom.js ***!
  \**********************************************/
__webpack_require__(/*! ./comment_approval */ "./resources/assets/custom/js/comment_approval.js");

__webpack_require__(/*! ./switch-in-table */ "./resources/assets/custom/js/switch-in-table.js");

__webpack_require__(/*! ./multilingual-selector */ "./resources/assets/custom/js/multilingual-selector.js");

__webpack_require__(/*! ./url-selector */ "./resources/assets/custom/js/url-selector.js");

__webpack_require__(/*! ./settings-fields */ "./resources/assets/custom/js/settings-fields.js");
})();

/******/ })()
;
//# sourceMappingURL=custom.js.map