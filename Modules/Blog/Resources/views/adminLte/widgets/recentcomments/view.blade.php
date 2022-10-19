<section class="recentcomments-widget">
    <div class="wpb_widgetised_column">
        <div class="content-only widget bdaia-widget widget_recent_comments">
            <div class="widget-box-title widget-box-title-s4">
                <h3>@lang('blog::view.widget_recent_comments.recent_comments')</h3>
            </div>
            <div class="widget-inner">
                <ul id="recentcomments">
                    @foreach($comments as $comment)
                        <li class="recentcomments">
                            <span class="comment-author-link">
                                @if ($comment->creator)
                                <a href="{{ fr_route('author-page', ['username' => $comment->creator->name]) }}" rel="external nofollow ugc" class="url" target="_blank">
                                    {{ $comment->creator->name }}
                                </a>
                                @else 
                                    {{ $comment->author_name }}
                                @endif
                            </span>
                            @lang('blog::front.said')
                            <a href="{{ fr_route('post-page', ['slug' => $comment->commentable->slug]) }}" target="_blank">
                                {{ \Str::limit($comment->content, 100) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="widget content-only"></div>
    </div>
</section>