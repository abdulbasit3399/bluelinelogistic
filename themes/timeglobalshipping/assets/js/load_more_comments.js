

var youAuth = window.youAuth;
var trans = window.blog_translation;
var defaultImage = window.defaultImage;
var urlLoadMoreReplies = window.urlLoadMoreReplies;

$('#get_prev_comment_btn').on('click', function(e) {
    e.preventDefault();

    var self            = $(this),
        url             = self.attr('data-url'),
        postId          = self.attr('data-post-id'),
        commentsCount   = self.data('comments-count'),
        commentsOffset  = self.attr('data-comments-offset'),
        commentsList    = $('.comments_list.level1'),
        // loading         = $('.comments-loading');
        loading         = self.find('.loading-icon');


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

        beforeSend: function(data) {
            self.addClass('disabled')
            loading.removeClass('hide-load');
        },

        success: function(data) {
            self.removeClass('disabled')
            loading.addClass('hide-load');
            let comments = data.comments;
        
            for (let i = 0; i < comments.length; i++) {
                var comment = comments[i];
                commentsList.prepend(newComment(comment));
                commentsList.find(`.div-comment-${comment.id}`).addClass('comment-added-animate');
            }
            setTimeout(function () {
                commentsList.find('.comment-body').removeClass('comment-added-animate')
            }, 700);
            var comments_count_ele = commentsList.children('li.comment').length;
            self.attr('data-comments-offset', comments_count_ele);
            if (comments_count_ele == commentsCount) {
                self.remove();
            }
        }
    });

    
});



$(document).on('click', '.get-prev-replies-btn', function(e) {
    e.preventDefault();

    var self            = $(this),
        url             = self.attr('data-url'),
        commentId       = self.attr('data-comment-id'),
        commentsCount   = self.data('comments-count'),
        level           = self.data('replies-level'),
        commentsOffset  = self.attr('data-comments-offset'),
        commentsList    = $(`#comment-${commentId} > .comments_list.level${level}`),
        loading         = self.find('.loading-icon');


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

        beforeSend: function(data) {
            self.addClass('disabled')
            loading.removeClass('hide-load');
        },

        success: function(data) {
            self.removeClass('disabled')
            loading.addClass('hide-load');
            let replies = data.comments;

            for (let i = 0; i < replies.length; i++) {
                var reply = replies[i];
                commentsList.prepend(newReplies(reply));
                commentsList.find(`.div-comment-${reply.id}`).addClass('comment-added-animate');
            }
            setTimeout(function () {
                commentsList.find('.comment-body').removeClass('comment-added-animate')
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
    var list = `<li id="comment-${comment.id}" class="comment byuser comment-author-admin bypostauthor even thread-odd thread-alt depth-1 parent">`;
    list += commentArticle(comment);
    list += `${newSubComments(comment)} </li>`;
    console.log(list)
    return list;
}


function newSubComments(parent_comment) {
    var revevedComments = parent_comment.comments.reverse();
    var childrenComments = parent_comment.level != 3 ? `<ol class="children comments_list level${parent_comment.level + 1}" data-comment-id="${parent_comment.id}">` : '';
    for (let i = 0; i < revevedComments.length; i++) {
        var comment = revevedComments[i];
        childrenComments += `<li id="comment-${comment.id}" class="comment">`;
        childrenComments += commentArticle(comment);
        childrenComments += `${ newSubComments(comment) }  </li>`;
    }
    childrenComments += parent_comment.level != 3 ? `</ol>` : '';
    return childrenComments;
}


function newReplies(parent_reply) {
    var resultReply = `<li id="comment-${parent_reply.id}" class="comment">`;
    resultReply += commentArticle(parent_reply);
    resultReply += `${ newSubComments(parent_reply) }  </li>`;
    return resultReply;
}


function commentArticle(comment) {
    return `
        <article id="div-comment-${comment.id}" class="comment-body div-comment-${comment.id} ${comment.approved == 0 ? 'pending' : ''}">
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
                <img alt="${ comment.creator ? comment.creator.name : 'not auth' }"
                    data-srcset="${ comment.creator ? comment.creator.avatar_image : defaultImage }"
                    height="50" width="50"
                    data-src="${ comment.creator ? comment.creator.avatar_image : defaultImage }"
                    class="avatar avatar-50 photo lazyloaded visible full-visible"
                    src="${ comment.creator ? comment.creator.avatar_image : defaultImage }"
                    loading="lazy"
                    srcset="${ comment.creator ? comment.creator.avatar_image : defaultImage }"
                >
                    <b class="fn">

                        ${
                            comment.creator ?
                            `<a href="${comment.creator.author_page}" rel="external nofollow ugc" class="url">
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
                <time datetime="${ comment.created_at }">
                    ${ comment.date }
                </time>
            </div>
        </footer>
        <div class="comment-content">
            <p> ${ comment.content } </p>
        </div>
        ${
            comment.level == 1 || comment.level == 2 ?
            `<div class="reply">
                <a
                    rel="nofollow" class="comment-reply-btn"
                    href="javascript:void()"
                    data-comment-id="${ comment.id }"
                    data-level="${comment.level + 1}"
                    data-reply-to="Reply to ${ comment.creator ? comment.creator.name : comment.author_name }"
                >
                    Reply
                </a>
            </div>` 
            : ''
        }
    </article>
    ${
        (comment.level == 1 || comment.level == 2) && comment.comments_count > 3 ?
            `<div class="get-perv-replies">
                <a
                    rel="nofollow"
                    class="get-prev-comments get-prev-replies-btn"
                    href="javascript:void()"
                    data-url="${ urlLoadMoreReplies }"
                    data-comment-id="${ comment.id }"
                    data-replies-level="${ comment.level + 1 }"
                    data-comments-count="${ comment.comments_count }"
                    data-comments-offset="${ comment.comments.length }"
                >
                    View previous replies
                    <span class="loading-icon hide-load">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                </a>
            </div>`
        : ''
    }
    `;
}