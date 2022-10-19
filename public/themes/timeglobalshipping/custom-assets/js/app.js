/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./themes/easyship/assets/js/add_comment.js":
/*!**************************************************!*\
  !*** ./themes/easyship/assets/js/add_comment.js ***!
  \**************************************************/
/***/ (() => {

var trans = window.blog_translation;
var defaultImage = window.defaultImage;
$(document).on('click', '.comment-reply-btn', function (e) {
  e.preventDefault();
  var self = $(this),
      commentId = self.data('comment-id'),
      replyTo = self.attr('data-reply-to'),
      level = self.attr('data-level'),
      respond = $('#respond');
  self.parents('#comment-' + commentId).append(respond);
  var form = $('#commentform'),
      cancelReply = $('#reply-title .cancel-comment-reply-link'),
      titleReplyTo = $('#reply-title .text-title');
  $('html, body').animate({
    scrollTop: respond.offset().top - 150
  }, 500);
  $('#comment_content').focus();
  cancelReply.show();
  titleReplyTo.text(replyTo);
  form.attr('data-comment-id', commentId);
  form.attr('data-level', level);
});
$(document).on('click', '.cancel-comment-reply-link', function (e) {
  e.preventDefault();
  var respond = $('#respond'),
      form = $('#commentform'),
      cancelReply = $('#reply-title .cancel-comment-reply-link'),
      titleReplyTo = $('#reply-title .text-title');
  $('#parent-respond').append(respond);
  cancelReply.hide();
  titleReplyTo.text('Leave a Reply');
  form.removeAttr('data-comment-id');
  form.attr('data-level', 1);
});
$('#commentform').on('submit', function (e) {
  e.preventDefault();
  var form = $(this),
      formData = new FormData(form[0]),
      url = form.attr('action'),
      postId = form.attr('data-post-id'),
      commentId = form.attr('data-comment-id'),
      level = form.attr('data-level'),
      authorpage = form.attr('data-author-page'),
      commentAuthorCookies = form.attr('data-comment-author-cookies') ? JSON.parse(form.attr('data-comment-author-cookies')) : null,
      authId = form.data('auth-id'),
      comments_list_level1 = $('.comments_list.level1'),
      comments_list_level2 = $('.comments_list.level2'),
      comments_list_level3 = $('.comments_list.level3'),
      addCommentEle = level == 1 ? comments_list_level1 : level == 2 ? comments_list_level2 : comments_list_level3,
      isReply = level == 1 || level == 2 ? true : false,
      commentLevel = level == 1 ? 2 : level == 2 ? 3 : null,
      btnSubmit = form.find('.form-submit .btn-submit'),
      loadingIcon = btnSubmit.find('.loading-icon'),
      commentCountShow = $('#comment_count_show');

  if (level != 1) {
    addCommentEle = addCommentEle.filter("[data-comment-id=\"".concat(commentId, "\"]"));
  }

  formData.append('post_id', postId);

  if (commentId) {
    formData.append('parent_id', commentId);
  }

  $.ajax({
    url: url,
    data: formData,
    dataType: 'json',
    'method': 'POST',
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function beforeSend(data) {
      btnSubmit.addClass('disabled');
      loadingIcon.removeClass('hide-load');
    },
    success: function success(data) {
      btnSubmit.removeClass('disabled');
      loadingIcon.addClass('hide-load');
      var comment = data.comment;
      addCommentEle.append(newComment(comment, authorpage, isReply, commentLevel));
      var commentEle = $("#div-comment-".concat(comment.id));
      setTimeout(function () {
        commentEle.addClass('comment-added-animate');
        setTimeout(function () {
          commentEle.removeClass('comment-added-animate');
        }, 3000);
      }, 200);
      resetFormComment(form);
      $('.cancel-comment-reply-link').click();
      commentCountShow.text(parseInt(commentCountShow.text()) + 1);
      toggleAlertError();
      handleErrorsValidation();
    },
    error: function error(_error) {
      btnSubmit.removeClass('disabled');
      loadingIcon.addClass('hide-load');

      if (_error && _error.status) {
        if (_error.status == 500) {
          toggleAlertError('Server Error!');
        } else if (_error.status == 422) {
          handleErrorsValidation(_error.responseJSON.errors);
        } else if (_error.status == 404) {
          toggleAlertError('Request not found!');
        } else if (_error.status == 401) {
          window.location.reload();
        }
      }
    }
  });
});

function newComment(comment, authorpage, isReply, commentLevel) {
  return "\n    <li id=\"comment-".concat(comment.id, "\"\n        class=\"comment byuser comment-author-admin bypostauthor even depth-3\">\n        <article id=\"div-comment-").concat(comment.id, "\" class=\"comment-body ").concat(comment.approved == 0 ? 'pending' : '', "\">\n            ").concat(comment.approved == 0 ? "<div class=\"pending-badge\">\n                    <div class=\"text-badge\">\n                        Waiting for approval\n                    </div>\n                </div>" : '', "\n            <footer class=\"comment-meta\">\n                <div class=\"comment-author vcard\">\n                    <img alt=\"").concat(comment.creator ? comment.creator.name : 'not auth', "\"\n                        data-srcset=\"").concat(comment.creator ? comment.creator.avatar_image : defaultImage, "\"\n                        height=\"50\" width=\"50\"\n                        data-src=\"").concat(comment.creator ? comment.creator.avatar_image : defaultImage, "\"\n                        class=\"avatar avatar-50 photo lazyloaded visible full-visible\"\n                        src=\"").concat(comment.creator ? comment.creator.avatar_image : defaultImage, "\"\n                        loading=\"lazy\"\n                        srcset=\"").concat(comment.creator ? comment.creator.avatar_image : defaultImage, "\"\n                    >\n                        <b class=\"fn\">\n                            ").concat(comment.creator ? "<a href=\"".concat(authorpage + '/' + comment.creator.name, "\" rel=\"external nofollow ugc\" class=\"url\">\n                                    ").concat(comment.creator.name + youAuth(comment.creator), "\n                                </a>") : "<span class=\"url\">\n                                    ".concat(comment.author_name + youAuth(comment, true), "\n                                </span>"), "\n                        </b>\n                    </div>\n                <div class=\"comment-metadata\">\n                    <time datetime=\"").concat(comment.created_at, "\">\n                        ").concat(comment.date, "\n                    </time>\n                </div>\n            </footer>\n            <div class=\"comment-content\">\n                <p> ").concat(comment.content, " </p>\n            </div>\n\n            ").concat(isReply ? "<div class=\"reply\">\n                    <a \n                        rel=\"nofollow\" class=\"comment-reply-btn\"\n                        href=\"javascript:void()\"\n                        data-comment-id=\"".concat(comment.id, "\"\n                        data-level=\"").concat(commentLevel, "\"\n                        data-reply-to=\"Reply to ").concat(comment.creator ? comment.creator.name : comment.author_name, "\"\n                    >\n                        Reply\n                    </a>\n                </div>") : '', "\n            ").concat(commentLevel ? "<ol class=\"children comments_list level".concat(commentLevel, "\" data-comment-id=\"").concat(comment.id, "\"></ol>") : '', "\n\n        </article>\n    </li>\n    ");
}

function youAuth(creator) {
  var creator_cookie = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var you = false;

  if (creator_cookie) {
    you = creator.author_email == (window.commentAuthorCookies ? window.commentAuthorCookies.author_email : null);
  } else {
    if (window.authId) {
      you = creator.id == window.authId;
    }
  }

  return you ? ' (' + trans.you + ')' : '';
}

window.youAuth = youAuth;

function resetFormComment(form) {
  var data = new FormData(form[0]),
      comment_cookies = data.get('comment_cookies');

  if (comment_cookies) {
    form.find('#comment_content').val('');
  } else {
    form.find('#comment_content').val('');
    form.find('#comment_author_name').val('');
    form.find('#comment_author_email').val('');
    form.find('#comment_author_website').val('');
  }
}

function handleErrorsValidation() {
  var errors = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  var keys = ['content', 'author_name', 'author_email', 'author_website'];

  for (var i = 0; i < keys.length; i++) {
    var fieldName = keys[i];

    if (errors[fieldName]) {
      $("[name=\"".concat(fieldName, "\"]")).addClass('is-invalid').next('.invalid-feedback').text(errors[fieldName]);
      $(".label_".concat(fieldName)).addClass('label-is-invalid');
    } else {
      $("[name=\"".concat(fieldName, "\"]")).removeClass('is-invalid').next('.invalid-feedback').text('');
      $(".label_".concat(fieldName)).removeClass('label-is-invalid');
    }
  }
}

function toggleAlertError() {
  var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
  var alertError = $('#alert-error-new-comment'),
      status = message != null ? 'show' : 'hide';

  if (status == 'show') {
    alertError.removeClass('hide');
    alertError.find('.text-error').text(message);
  } else {
    alertError.addClass('hide');
    alertError.find('.text-error').text('');
  }
}

/***/ }),

/***/ "./themes/easyship/assets/js/load_more_comments.js":
/*!*********************************************************!*\
  !*** ./themes/easyship/assets/js/load_more_comments.js ***!
  \*********************************************************/
/***/ (() => {

var youAuth = window.youAuth;
var trans = window.blog_translation;
var defaultImage = window.defaultImage;
var urlLoadMoreReplies = window.urlLoadMoreReplies;
$('#get_prev_comment_btn').on('click', function (e) {
  e.preventDefault();
  var self = $(this),
      url = self.attr('data-url'),
      postId = self.attr('data-post-id'),
      commentsCount = self.data('comments-count'),
      commentsOffset = self.attr('data-comments-offset'),
      commentsList = $('.comments_list.level1'),
      // loading         = $('.comments-loading');
  loading = self.find('.loading-icon');
  var data = {
    post_id: postId,
    comments_offset: commentsOffset
  };
  $.ajax({
    url: url,
    data: data,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    'method': 'POST',
    cache: false,
    beforeSend: function beforeSend(data) {
      self.addClass('disabled');
      loading.removeClass('hide-load');
    },
    success: function success(data) {
      self.removeClass('disabled');
      loading.addClass('hide-load');
      var comments = data.comments;

      for (var i = 0; i < comments.length; i++) {
        var comment = comments[i];
        commentsList.prepend(newComment(comment));
        commentsList.find(".div-comment-".concat(comment.id)).addClass('comment-added-animate');
      }

      setTimeout(function () {
        commentsList.find('.comment-body').removeClass('comment-added-animate');
      }, 700);
      var comments_count_ele = commentsList.children('li.comment').length;
      self.attr('data-comments-offset', comments_count_ele);

      if (comments_count_ele == commentsCount) {
        self.remove();
      }
    }
  });
});
$(document).on('click', '.get-prev-replies-btn', function (e) {
  e.preventDefault();
  var self = $(this),
      url = self.attr('data-url'),
      commentId = self.attr('data-comment-id'),
      commentsCount = self.data('comments-count'),
      level = self.data('replies-level'),
      commentsOffset = self.attr('data-comments-offset'),
      commentsList = $("#comment-".concat(commentId, " > .comments_list.level").concat(level)),
      loading = self.find('.loading-icon');
  var data = {
    comment_id: commentId,
    level: level,
    comments_offset: commentsOffset
  };
  $.ajax({
    url: url,
    data: data,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    dataType: 'json',
    'method': 'POST',
    cache: false,
    beforeSend: function beforeSend(data) {
      self.addClass('disabled');
      loading.removeClass('hide-load');
    },
    success: function success(data) {
      self.removeClass('disabled');
      loading.addClass('hide-load');
      var replies = data.comments;

      for (var i = 0; i < replies.length; i++) {
        var reply = replies[i];
        commentsList.prepend(newReplies(reply));
        commentsList.find(".div-comment-".concat(reply.id)).addClass('comment-added-animate');
      }

      setTimeout(function () {
        commentsList.find('.comment-body').removeClass('comment-added-animate');
      }, 700);
      var comments_count_ele = commentsList.children('li.comment').length;
      self.attr('data-comments-offset', comments_count_ele);

      if (comments_count_ele == commentsCount) {
        self.remove();
      }
    }
  });
});

function newComment(comment) {
  var list = "<li id=\"comment-".concat(comment.id, "\" class=\"comment byuser comment-author-admin bypostauthor even thread-odd thread-alt depth-1 parent\">");
  list += commentArticle(comment);
  list += "".concat(newSubComments(comment), " </li>");
  console.log(list);
  return list;
}

function newSubComments(parent_comment) {
  var revevedComments = parent_comment.comments.reverse();
  var childrenComments = parent_comment.level != 3 ? "<ol class=\"children comments_list level".concat(parent_comment.level + 1, "\" data-comment-id=\"").concat(parent_comment.id, "\">") : '';

  for (var i = 0; i < revevedComments.length; i++) {
    var comment = revevedComments[i];
    childrenComments += "<li id=\"comment-".concat(comment.id, "\" class=\"comment\">");
    childrenComments += commentArticle(comment);
    childrenComments += "".concat(newSubComments(comment), "  </li>");
  }

  childrenComments += parent_comment.level != 3 ? "</ol>" : '';
  return childrenComments;
}

function newReplies(parent_reply) {
  var resultReply = "<li id=\"comment-".concat(parent_reply.id, "\" class=\"comment\">");
  resultReply += commentArticle(parent_reply);
  resultReply += "".concat(newSubComments(parent_reply), "  </li>");
  return resultReply;
}

function commentArticle(comment) {
  return "\n        <article id=\"div-comment-".concat(comment.id, "\" class=\"comment-body div-comment-").concat(comment.id, " ").concat(comment.approved == 0 ? 'pending' : '', "\">\n        ").concat(comment.approved == 0 ? "<div class=\"pending-badge\">\n                <div class=\"text-badge\">\n                    Waiting for approval\n                </div>\n            </div>" : '', "\n        <footer class=\"comment-meta\">\n            <div class=\"comment-author vcard\">\n                <img alt=\"").concat(comment.creator ? comment.creator.name : 'not auth', "\"\n                    data-srcset=\"").concat(comment.creator ? comment.creator.avatar_image : defaultImage, "\"\n                    height=\"50\" width=\"50\"\n                    data-src=\"").concat(comment.creator ? comment.creator.avatar_image : defaultImage, "\"\n                    class=\"avatar avatar-50 photo lazyloaded visible full-visible\"\n                    src=\"").concat(comment.creator ? comment.creator.avatar_image : defaultImage, "\"\n                    loading=\"lazy\"\n                    srcset=\"").concat(comment.creator ? comment.creator.avatar_image : defaultImage, "\"\n                >\n                    <b class=\"fn\">\n\n                        ").concat(comment.creator ? "<a href=\"".concat(comment.creator.author_page, "\" rel=\"external nofollow ugc\" class=\"url\">\n                                ").concat(comment.creator.name + youAuth(comment.creator), "\n                            </a>") : "<span class=\"url\">\n                                ".concat(comment.author_name + youAuth(comment, true), "\n                            </span>"), "\n                    </b>\n                </div>\n            <div class=\"comment-metadata\">\n                <time datetime=\"").concat(comment.created_at, "\">\n                    ").concat(comment.date, "\n                </time>\n            </div>\n        </footer>\n        <div class=\"comment-content\">\n            <p> ").concat(comment.content, " </p>\n        </div>\n        ").concat(comment.level == 1 || comment.level == 2 ? "<div class=\"reply\">\n                <a\n                    rel=\"nofollow\" class=\"comment-reply-btn\"\n                    href=\"javascript:void()\"\n                    data-comment-id=\"".concat(comment.id, "\"\n                    data-level=\"").concat(comment.level + 1, "\"\n                    data-reply-to=\"Reply to ").concat(comment.creator ? comment.creator.name : comment.author_name, "\"\n                >\n                    Reply\n                </a>\n            </div>") : '', "\n    </article>\n    ").concat((comment.level == 1 || comment.level == 2) && comment.comments_count > 3 ? "<div class=\"get-perv-replies\">\n                <a\n                    rel=\"nofollow\"\n                    class=\"get-prev-comments get-prev-replies-btn\"\n                    href=\"javascript:void()\"\n                    data-url=\"".concat(urlLoadMoreReplies, "\"\n                    data-comment-id=\"").concat(comment.id, "\"\n                    data-replies-level=\"").concat(comment.level + 1, "\"\n                    data-comments-count=\"").concat(comment.comments_count, "\"\n                    data-comments-offset=\"").concat(comment.comments.length, "\"\n                >\n                    View previous replies\n                    <span class=\"loading-icon hide-load\">\n                        <i class=\"fa fa-circle-o-notch fa-spin\"></i>\n                    </span>\n                </a>\n            </div>") : '', "\n    ");
}

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
/*!******************************************!*\
  !*** ./themes/easyship/assets/js/app.js ***!
  \******************************************/
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
__webpack_require__(/*! ./add_comment */ "./themes/easyship/assets/js/add_comment.js");

__webpack_require__(/*! ./load_more_comments */ "./themes/easyship/assets/js/load_more_comments.js");
})();

/******/ })()
;
//# sourceMappingURL=app.js.map