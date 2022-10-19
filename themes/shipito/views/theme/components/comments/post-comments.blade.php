
@php
    function youAuth($creator, $creator_cookie = false) {
        $you = false;
        if ($creator_cookie) {
            $you = $creator->author_email == (get_comment_author() ? get_comment_author()->author_email : null);
        } else {
            if (auth()->check()) {
                $you = $creator->id == auth()->id();
            }
        }
        return $you ? ' (' . __('blog::front.you') . ')' : '';
    }
@endphp


<div id="comments" class="comments-container">
    <div class="widget-box-title widget-box-title-s4">
        <h3> <span id="comment_count_show">{{ $post['approved_comments_count'] }}</span> @lang('blog::front.comments') </h3>
    </div>

    <div class="get-perv-comments">
        @if ($post['comments_count'] > 10)
            <a
                rel="nofollow"
                class="get-prev-comments get-prev-comment-btn"
                id="get_prev_comment_btn"
                href="javascript:void()"
                data-url="{{ route('comments.loadMore') }}"
                data-post-id="{{ $post['id'] }}"
                data-comments-count="{{ $post['comments_count'] }}"
                data-comments-offset="{{ $comments->count() }}"
            >
                @lang('blog::front.view_prev_comments')
                <span class="loading-icon hide-load">
                    <i class="fa fa-circle-o-notch fa-spin"></i>
                </span>
            </a>
        @endif
    </div>

    {{-- <div class="comments-loading hide-load">
        <div class="loading-icon">
            <i class="fa fa-spinner fa-pulse"></i>
        </div>
    </div> --}}


    <ol class="comment-list comments_list level1">
        @foreach($comments as $comment)
            <li id="comment-{{$comment->id}}" class="comment byuser comment-author-admin bypostauthor even thread-odd thread-alt depth-1 parent">
                <article id="div-comment-{{$comment->id}}" class="comment-body {{ $comment->approved == 0 ? 'pending' : '' }}">
                    @if ($comment->approved == 0)
                        <div class="pending-badge">
                            <div class="text-badge">
                                @lang('blog::front.waiting_for_approval')
                            </div>
                        </div>
                    @endif
                    <footer class="comment-meta">
                        <div class="comment-author vcard">
                            <img alt="{{ $comment->creator ? $comment->creator->name : 'not auth' }}"
                                data-srcset="{{ $comment->creator ? $comment->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                style="width: 50px;height: 50px;"
                                data-src="{{ $comment->creator? $comment->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                class="avatar avatar-50 photo lazyloaded visible full-visible"
                                src="{{ $comment->creator ? $comment->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                loading="lazy"
                                srcset="{{ $comment->creator ? $comment->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                            >
                                <b class="fn">
                                    @if ($comment->creator)
                                        <a href="{{ route('author-page', ['username' => $comment->creator->name ]) }}" rel="external nofollow ugc" class="url">
                                            {{ $comment->creator->name . youAuth($comment->creator) }}
                                        </a>
                                    @else
                                        <span class="url">
                                            {{ $comment->author_name . youAuth($comment, true) }}
                                        </span>
                                    @endif
                                </b>
                            </div>
                        <div class="comment-metadata">
                            <time datetime="{{ $comment->created_at }}">
                                {{ $comment->date }}
                            </time>
                        </div>
                    </footer>
                    <div class="comment-content">
                        <p> {{ $comment->content }} </p>
                    </div>
                    <div class="reply">
                        <a
                            rel="nofollow" class="comment-reply-btn"
                            href="javascript:void()"
                            data-comment-id="{{ $comment->id }}"
                            data-level="2"
                            data-reply-to="@lang('blog::front.reply_to') {{ $comment->creator ? $comment->creator->name : $comment->author_name }}"
                        >
                            @lang('blog::front.reply')
                        </a>
                    </div>
                </article>

                @if ($comment->comments_count > 3)
                    <div class="get-perv-replies">
                        <a
                            rel="nofollow"
                            class="get-prev-comments get-prev-replies-btn"
                            href="javascript:void()"
                            data-url="{{ route('comments.loadMoreReplies') }}"
                            data-comment-id="{{ $comment->id }}"
                            data-replies-level="2"
                            data-comments-count="{{ $comment->comments_count }}"
                            data-comments-offset="{{ $comment->comments->count() }}"
                        >
                            @lang('blog::front.view_prev_replies')
                            <span class="loading-icon hide-load">
                                <i class="fa fa-circle-o-notch fa-spin"></i>
                            </span>
                        </a>
                    </div>
                @endif

                <ol class="children comments_list level2" data-comment-id="{{$comment->id}}">
                    @foreach($comment->comments->reverse() as $comment_2)
                        <li id="comment-{{$comment_2->id}}" class="comment">
                            <article id="div-comment-{{$comment_2->id}}" class="comment-body {{ $comment_2->approved == 0 ? 'pending' : '' }}">
                                @if ($comment_2->approved == 0)
                                    <div class="pending-badge">
                                        <div class="text-badge">
                                            @lang('blog::front.waiting_for_approval')
                                        </div>
                                    </div>
                                @endif
                                <footer class="comment-meta">
                                    <div class="comment-author vcard">
                                        <img alt="{{ $comment_2->creator ? $comment_2->creator->name : 'not auth' }}"
                                            data-srcset="{{ $comment_2->creator ? $comment_2->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                            style="width: 50px;height: 50px;"
                                            data-src="{{ $comment_2->creator ? $comment_2->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                            class="avatar avatar-50 photo lazyloaded visible full-visible"
                                            src="{{ $comment_2->creator ? $comment_2->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                            loading="lazy"
                                            srcset="{{ $comment_2->creator ? $comment_2->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                        >
                                            <b class="fn">
                                                @if ($comment_2->creator)
                                                    <a href="{{ route('author-page', ['username' => $comment_2->creator->name ]) }}" rel="external nofollow ugc" class="url">
                                                        {{ $comment_2->creator->name . youAuth($comment_2->creator) }}
                                                    </a>
                                                @else
                                                    <span class="url">
                                                        {{ $comment_2->author_name . youAuth($comment_2, true) }}
                                                    </span>
                                                @endif
                                            </b>
                                        </div>
                                    <div class="comment-metadata">
                                        <time datetime="{{ $comment_2->created_at }}">
                                            {{ $comment_2->date }}
                                        </time>
                                    </div>
                                </footer>
                                <div class="comment-content">
                                    <p> {{ $comment_2->content }} </p>
                                </div>
                                <div class="reply">
                                    <a
                                        rel="nofollow" class="comment-reply-btn"
                                        href="javascript:void()"
                                        data-comment-id="{{ $comment_2->id }}"
                                        data-level="3"
                                        data-reply-to="@lang('blog::front.reply_to') {{ $comment_2->creator ? $comment_2->creator->name : $comment_2->author_name }}"
                                        >
                                        @lang('blog::front.reply')
                                    </a>
                                </div>
                            </article>

                            <div class="get-perv-replies">
                                @if ($comment_2->comments_count > 3)
                                    <a
                                        rel="nofollow"
                                        class="get-prev-comments get-prev-replies-btn"
                                        href="javascript:void()"
                                        data-url="{{ route('comments.loadMoreReplies') }}"
                                        data-comment-id="{{ $comment_2->id }}"
                                        data-replies-level="3"
                                        data-comments-count="{{ $comment_2->comments_count }}"
                                        data-comments-offset="{{ $comment_2->comments->count() }}"
                                    >
                                        @lang('blog::front.view_prev_replies')
                                        <span class="loading-icon hide-load">
                                            <i class="fa fa-circle-o-notch fa-spin"></i>
                                        </span>
                                    </a>
                                @endif
                            </div>

                            <ol class="children comments_list level3" data-comment-id="{{$comment_2->id}}">
                                @foreach($comment_2->comments->reverse() as $comment_3)
                                    <li id="comment-{{ $comment_3->id }}" class="comment">
                                        <article id="div-comment-{{ $comment_3->id }}" class="comment-body {{ $comment_3->approved == 0 ? 'pending' : '' }}">
                                            @if ($comment_3->approved == 0)
                                                <div class="pending-badge">
                                                    <div class="text-badge">
                                                        @lang('blog::front.waiting_for_approval')
                                                    </div>
                                                </div>
                                            @endif
                                            <footer class="comment-meta">
                                                <div class="comment-author vcard">
                                                    <img alt="{{ $comment_3->creator ? $comment_3->creator->name : 'not auth' }}"
                                                        data-srcset="{{ $comment_3->creator ? $comment_3->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                                        style="width: 50px;height: 50px;"
                                                        data-src="{{ $comment_3->creator ? $comment_3->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                                        class="avatar avatar-50 photo lazyloaded visible full-visible"
                                                        src="{{ $comment_3->creator ? $comment_3->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                                        loading="lazy"
                                                        srcset="{{ $comment_3->creator ? $comment_3->creator->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/blank.png') }}"
                                                    >
                                                        <b class="fn">
                                                            @if ($comment_3->creator)
                                                                <a href="{{ route('author-page', ['username' => $comment_3->creator->name ]) }}" rel="external nofollow ugc" class="url">
                                                                    {{ $comment_3->creator->name . youAuth($comment_3->creator) }}
                                                                </a>
                                                            @else
                                                                <span class="url">
                                                                    {{ $comment_3->author_name . youAuth($comment_3, true) }}
                                                                </span>
                                                            @endif
                                                        </b>
                                                    </div>
                                                <div class="comment-metadata">
                                                    <time datetime="{{ $comment_3->created_at }}">
                                                        {{ $comment_3->date }}
                                                    </time>
                                                </div>
                                            </footer>
                                            <div class="comment-content">
                                                <p> {{ $comment_3->content }} </p>
                                            </div>
                                        </article>
                                    </li>
                                @endforeach
                            </ol>
                        </li>
                    @endforeach
                </ol>
            </li>
        @endforeach
    </ol>



    <div class="comments-navigation">
        <div class="alignleft"></div>
        <div class="alignright"></div>
    </div>

    <div id="parent-respond">
        <div id="respond" class="comment-respond">
            <div class="widget-box-title widget-box-title-s4">
                <h3 id="reply-title" class="comment-reply-title">
                    <span class="text-title">
                        @lang('blog::front.leave_reply')
                    </span>
                    <small>
                        <a
                            rel="nofollow"
                            class="cancel-comment-reply-link"
                            href="javascript:void()"
                            style="margin: 0 10px; display:none;"
                        >
                            @lang('blog::front.leave_reply')
                        </a>
                    </small>
                    </h3>
            </div>
            <form
                id="commentform"
                class="comment-form"
                action="{{ route('comments.store') }}"
                data-post-id="{{ $post['id'] }}"
                data-level="1"
                data-author-page="{{ url('author') }}"
                >
                @csrf
                <p class="comment-notes">
                    <span id="email-notes">
                    @lang('blog::front.msg_email_published')
                    </span>
                    @lang('blog::front.fields_are_marked')
                    <span class="required">*</span>
                </p>

                <p class="comment-form-comment">
                    <label class="label_content" for="comment_content">@lang('blog::front.field_comment')</label>
                    <textarea
                        placeholder="@lang('blog::front.field_comment')"
                        id="comment_content"
                        name="content"
                        cols="45"
                        rows="8"
                        maxlength="65000"
                        {{-- required="required" --}}
                    ></textarea>
                    <span class="invalid-feedback"></span>
                </p>

                @if (!auth()->check())

                    <p class="comment-form-author">
                        <label class="label_author_name" for="comment_author_name">@lang('blog::front.field_name') <span class="required">*</span></label>
                        <input
                            placeholder="@lang('blog::front.field_name')"
                            id="comment_author_name"
                            name="author_name"
                            type="text"
                            value="{{ get_comment_author() ? get_comment_author()->author_name : '' }}"
                            size="30"
                            maxlength="100"
                            {{-- required="required" --}}
                        >
                        <span class="invalid-feedback"></span>
                    </p>

                    <p class="comment-form-email">
                        <label class="label_author_email" for="comment_author_email">@lang('blog::front.field_email') <span class="required">*</span></label>
                        <input
                            placeholder="@lang('blog::front.field_email')"
                            id="comment_author_email"
                            name="author_email"
                            type="email"
                            value="{{ get_comment_author() ? get_comment_author()->author_email : '' }}"
                            size="30"
                            maxlength="100"
                            aria-describedby="email-notes"
                            {{-- required="required" --}}
                        >
                        <span class="invalid-feedback"></span>
                    </p>

                    <p class="comment-form-website">
                        <label class="label_author_website" for="comment_author_website">@lang('blog::front.field_website')</label>
                        <input
                            placeholder="@lang('blog::front.field_website')"
                            id="comment_author_website"
                            name="author_website"
                            type="url"
                            value="{{ get_comment_author() ? get_comment_author()->author_website : '' }}"
                            size="30"
                            maxlength="200"
                        >
                        <span class="invalid-feedback"></span>
                    </p>

                    <p class="comment-form-cookies-consent">
                        <input
                            id="comment_cookies"
                            name="comment_cookies"
                            type="checkbox"
                            {{ get_comment_author() ? 'checked="checked"' : '' }}
                            value="1"
                        >
                        <label for="comment_cookies">
                            @lang('blog::front.msg_save_author_data')
                        </label>
                    </p>

                @endif

                <div id="alert-error-new-comment" class="alert-error hide">
                    <div class="text-error"></div>
                </div>
                <p class="form-submit">
                    <button
                        name="submit"
                        type="submit"
                        id="submit"
                        class="btn btn-submit submit"
                    >
                        @lang('blog::front.post_comment')
                        <i class="loading-icon fa fa-circle-o-notch fa-spin hide-load"></i>
                    </button>
                </p>
            </form>
        </div>
    </div>

</div>



