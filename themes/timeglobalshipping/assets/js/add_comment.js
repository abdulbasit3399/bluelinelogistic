
var trans = window.blog_translation;
var defaultImage = window.defaultImage;

$(document).on('click', '.comment-reply-btn', function(e) {
    e.preventDefault();
    var self = $(this),
        commentId = self.data('comment-id'),
        replyTo = self.attr('data-reply-to'),
        level = self.attr('data-level'),
        respond    = $('#respond');

    self.parents('#comment-' + commentId).append(respond);
    var form = $('#commentform'),
        cancelReply = $('#reply-title .cancel-comment-reply-link'),
        titleReplyTo = $('#reply-title .text-title');

    $('html, body').animate({scrollTop: respond.offset().top - 150}, 500)
    $('#comment_content').focus();
        
    cancelReply.show();
    titleReplyTo.text(replyTo);
    form.attr('data-comment-id', commentId);
    form.attr('data-level', level);
});


$(document).on('click', '.cancel-comment-reply-link', function(e) {
    e.preventDefault();
    var respond         = $('#respond'),
        form            = $('#commentform'),
        cancelReply     = $('#reply-title .cancel-comment-reply-link'),
        titleReplyTo    = $('#reply-title .text-title');

    $('#parent-respond').append(respond);
    cancelReply.hide();
    titleReplyTo.text('Leave a Reply');
    form.removeAttr('data-comment-id');
    form.attr('data-level', 1);
});



$('#commentform').on('submit', function(e) {
    e.preventDefault();
    var form                    = $(this),
        formData                = new FormData(form[0]),
        url                     = form.attr('action'),
        postId                  = form.attr('data-post-id'),
        commentId               = form.attr('data-comment-id'),
        level                   = form.attr('data-level'),
        authorpage              = form.attr('data-author-page'),
        commentAuthorCookies    = form.attr('data-comment-author-cookies') ? JSON.parse(form.attr('data-comment-author-cookies')) : null,
        authId                  = form.data('auth-id'),
        comments_list_level1    = $('.comments_list.level1'),
        comments_list_level2    = $('.comments_list.level2'),
        comments_list_level3    = $('.comments_list.level3'),
        addCommentEle           = level == 1 ? comments_list_level1 : (level == 2 ? comments_list_level2 : comments_list_level3),
        isReply                 = level == 1 || level == 2 ? true : false,
        commentLevel            = level == 1 ? 2 : (level == 2 ? 3 : null),
        btnSubmit               = form.find('.form-submit .btn-submit'),
        loadingIcon             = btnSubmit.find('.loading-icon'),
        commentCountShow        = $('#comment_count_show');

    if (level != 1) {
        addCommentEle = addCommentEle.filter(`[data-comment-id="${commentId}"]`);
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

        beforeSend: function(data) {
            btnSubmit.addClass('disabled');
            loadingIcon.removeClass('hide-load');
        },

        success: function(data) {
            btnSubmit.removeClass('disabled');
            loadingIcon.addClass('hide-load');

            var comment = data.comment;
            addCommentEle.append(newComment(comment, authorpage, isReply, commentLevel));
            var commentEle = $(`#div-comment-${comment.id}`);
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

        error: function(error) {
            btnSubmit.removeClass('disabled');
            loadingIcon.addClass('hide-load');
            
            if (error && error.status) {
                if (error.status == 500) {
                    toggleAlertError('Server Error!');
                } else if (error.status == 422) {
                    handleErrorsValidation(error.responseJSON.errors)
                } else if (error.status == 404) {
                    toggleAlertError('Request not found!');
                } else if (error.status == 401) {
                    window.location.reload();
                }
            }
        },
    });

});




function newComment(comment, authorpage, isReply, commentLevel) {
    return `
    <li id="comment-${comment.id}"
        class="comment byuser comment-author-admin bypostauthor even depth-3">
        <article id="div-comment-${comment.id}" class="comment-body ${comment.approved == 0 ? 'pending' : ''}">
            ${
                comment.approved == 0 ?
                `<div class="pending-badge">
                    <div class="text-badge">
                        Waiting for approval
                    </div>
                </div>` 
                : 
                ''
            }
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <img alt="${comment.creator ? comment.creator.name : 'not auth'}"
                        data-srcset="${comment.creator ? comment.creator.avatar_image : defaultImage }"
                        height="50" width="50"
                        data-src="${comment.creator ? comment.creator.avatar_image : defaultImage }"
                        class="avatar avatar-50 photo lazyloaded visible full-visible"
                        src="${comment.creator ? comment.creator.avatar_image : defaultImage }"
                        loading="lazy"
                        srcset="${comment.creator ? comment.creator.avatar_image : defaultImage }"
                    >
                        <b class="fn">
                            ${
                                comment.creator ?
                                `<a href="${authorpage + '/' + comment.creator.name}" rel="external nofollow ugc" class="url">
                                    ${comment.creator.name + youAuth(comment.creator)}
                                </a>`
                                : 
                                `<span class="url">
                                    ${comment.author_name + youAuth(comment, true)}
                                </span>`
                            }
                        </b>
                    </div>
                <div class="comment-metadata">
                    <time datetime="${comment.created_at}">
                        ${comment.date}
                    </time>
                </div>
            </footer>
            <div class="comment-content">
                <p> ${comment.content} </p>
            </div>

            ${
                isReply ? 
                `<div class="reply">
                    <a 
                        rel="nofollow" class="comment-reply-btn"
                        href="javascript:void()"
                        data-comment-id="${comment.id}"
                        data-level="${commentLevel}"
                        data-reply-to="Reply to ${comment.creator ? comment.creator.name : comment.author_name}"
                    >
                        Reply
                    </a>
                </div>`
                : ''
            }
            ${ commentLevel ? `<ol class="children comments_list level${commentLevel}" data-comment-id="${comment.id}"></ol>` : '' }

        </article>
    </li>
    `;
}

function youAuth(creator, creator_cookie = false) {
    let you = false;
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


function handleErrorsValidation(errors = {}) {
    var keys = ['content', 'author_name', 'author_email', 'author_website'];
    for (let i = 0; i < keys.length; i++) {
        let fieldName = keys[i];
        if (errors[fieldName]) {
            $(`[name="${fieldName}"]`).addClass('is-invalid').next('.invalid-feedback').text(errors[fieldName]);
            $(`.label_${fieldName}`).addClass('label-is-invalid');
        } else {
            $(`[name="${fieldName}"]`).removeClass('is-invalid').next('.invalid-feedback').text('');
            $(`.label_${fieldName}`).removeClass('label-is-invalid');
        }
    }
}

function toggleAlertError(message = null) {
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