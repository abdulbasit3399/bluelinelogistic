@extends('theme.layout.layout-pages')


@section('page-title', \Str::title(trim($post['seo_title'])))

@section('page-description', trim(strip_tags($post['seo_description'])))

@section('page-keywords', $post_tags->implode('name', ', '))

@section('page-type', 'article')

@section('page-image', $post['image_url'])


@section('styles')
    <link rel="stylesheet" href="{{ asset('themes/html/custom-assets/plugins/quill.css') }}">
@endsection

@section('page-content')

<div class="bd-main mt-5 mb-5">
    <div id="content" role="main">
        @if ($post['image_url'])
            <div class="bdaia-post-heading">
                <div class="bdaia-post-featured-image">
                    <a href="{{ $post['image_url'] }}"
                        data-caption="" class="post_content_image">
                        <figure>
                            <img width="1280" height="848" src="{{ $post['image_url'] }}"
                                class="attachment-full size-full img-lazy wp-post-image visible full-visible"
                                alt="{{ $post['title'] }}"
                                style="">
                            </figure>
                    </a>
                </div>
            </div>
            <br>
        @endif
        <div class="bdaia-crumb-container">
            <span>
                <a class="crumbs-home" href="{{ fr_route('home') }}">@lang('blog::front.home')</a>
            </span>
            <span class="delimiter">
                <span class="bdaia-io bdaia-io-angle-double-right"></span>
            </span>


            <span typeof="v:Breadcrumb">
                <a rel="v:url" property="v:title" href="{{ fr_route('blog-page') }}"> {{__('blog::view.blog')}} </a>
            </span>
            <span class="delimiter">
                <span class="bdaia-io bdaia-io-angle-double-right"></span>
            </span>

            @foreach($category_parents as $categoryParent)  
                <span>
                    <a href="{{ fr_route('category-page', ['slug' => $categoryParent->slug ]) }}">{{ $categoryParent->name }}</a>
                </span>
                <span class="delimiter">
                    <span class="bdaia-io bdaia-io-angle-double-right"></span>
                </span>
            @endforeach

            @if ($category_post)
                <span>
                    <a href="{{ fr_route('category-page', ['slug' => $category_post['slug'] ]) }}">{{ $category_post['name'] }}</a>
                </span>
                <span class="delimiter">
                    <span class="bdaia-io bdaia-io-angle-double-right"></span>
                </span>
            @endif


            <span class="current">
                {{ $post['title'] }}
            </span>
        </div>
        <article id="post-12"
            class="hentry post-12 post type-post status-publish format-standard has-post-thumbnail category-bd-travel tag-22 tag-apple tag-books tag-cool tag-fantasy tag-fashion tag-food tag-football tag-funny tag-horror tag-reviews tag-social tag-video tag-wordpress tag-wow">
            <header class="bdaia-post-header">
                <div class="top-meta-info">
                    @if ($category_post)
                        <span class="meta-cat-info">
                            <a class="cat-12" href="{{ fr_route('category-page', ['slug' => $category_post['slug'] ]) }}">
                                {{ \Str::title($category_post['name'])  }}
                            </a>
                            - 
                        </span>
                    @endif
                    <span class="meta-date-info">
                        <span class="date meta-item">
                            <span> {{ $post['title'] }} </span>
                        </span>
                    </span>
                </div>
                <div class="bdaia-post-title">
                    <h1 class="post-title entry-title">{{ $post['title'] }}</h1>
                </div>
                <div class="article-meta-info">
                    <div class="bd-alignleft">
                        <span class="">
                            <a href="{{ fr_route('author-page', ['username' => $post['creator']['name'] ]) }}">
                                <img alt="{{ $post['creator']['name'] }}"
                                    data-srcset="{{ $post['creator']['avatar_image'] ? $post['creator']['avatar_image'] : asset('assets/lte/media/avatars/blank.png')}}"
                                    style="width: 50px;height: 50px;"
                                    data-src="{{ $post['creator']['avatar_image'] ? $post['creator']['avatar_image'] : asset('assets/lte/media/avatars/blank.png')}}"
                                    class="avatar avatar-140 photo ls-is-cached lazyloaded visible full-visible"
                                    src="{{ $post['creator']['avatar_image'] ? $post['creator']['avatar_image'] : asset('assets/lte/media/avatars/blank.png')}}"
                                    loading="lazy"
                                    srcset="{{ $post['creator']['avatar_image'] ? $post['creator']['avatar_image'] : asset('assets/lte/media/avatars/blank.png')}}"
                                >
                            </a>
                        </span>
                        <span class="meta-author meta-item">
                            <a href="{{ fr_route('author-page', ['username' => $post['creator']['name'] ]) }}" class="author-name" title="{{ $post['creator']['name'] }}">
                                {{ $post['creator']['name'] }}
                            </a>
                        </span>
                        <span class="date meta-item">
                            <span class="bdaia-io bdaia-io-clock"></span>
                            <span> {{ $post['date'] }} </span>
                        </span>
                    </div>
                    <div class="bd-alignright">
                        <span class="meta-comment meta-item">
                            <a href="/main/facebooks-fundraisers-now-help-raise-money/#comments">
                                <span class="fa fa-comments"></span>
                                 {{ $post['comments_count'] }}
                            </a>
                        </span>
                        <span class="views meta-item warm">
                            <span class="bdaia-io bdaia-io-flame"></span>
                            <span> {{ $post['count_visitors'] }} </span>
                        </span>
                        {{-- <span class="reading-time meta-item">
                            <span class="fa fa-bookmark"></span>
                            <span>22&nbsp;min read</span>
                        </span> --}}
                    </div>
                    <div class="cfix"></div>
                </div>
            </header>
            <div class="bdaia-post-sharing bdaia-post-sharing-top">
                <ul>
                    <li class="facebook"> <a title="facebook"
                            onclick="window.open('http://www.facebook.com/sharer.php?u={{url()->current()}}','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"
                            href="https://www.facebook.com/sharer.php?u={{url()->current()}}">
                            <span class="bdaia-io bdaia-io-facebook"></span> <span class="soical-text"><small>Share on
                                </small> Facebook</span> </a> </li>
                    <li class="twitter"> <a title="twitter"
                            onclick="window.open('http://twitter.com/share?url={{url()->current()}}&amp;text=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"
                            href="https://twitter.com/share?url={{url()->current()}}&amp;text=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money">
                            <span class="bdaia-io bdaia-io-twitter"></span> <span class="soical-text"><small>Share on
                                </small> Twitter</span> </a> </li>
                    <li class="google"> <a title="google"
                            onclick="window.open('https://plus.google.com/share?url={{url()->current()}}','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;"
                            href="https://plus.google.com/share?url={{url()->current()}}">
                            <span class="bdaia-io bdaia-io-google-plus"></span> <span class="soical-text">Google+</span>
                        </a> </li>
                    <li class="reddit"> <a title="reddit"
                            onclick="window.open('http://reddit.com/submit?url={{url()->current()}}&amp;title=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money','Reddit','width=617,height=514,left='+(screen.availWidth/2-308)+',top='+(screen.availHeight/2-257)+''); return false;"
                            href="https://reddit.com/submit?url={{url()->current()}}&amp;title=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money">
                            <span class="bdaia-io bdaia-io-reddit"></span> <span class="soical-text">Reddit</span> </a>
                    </li>
                    <li class="pinterest"> <a title="pinterest"
                            href="https://pinterest.com/pin/create/button/?url={{url()->current()}}&amp;description=Facebook%27s+fundraisers+now+help+you+raise+money&amp;media=https%3A%2F%2Fkolyoum.bdaia.com%2Fmain%2Fwp-content%2Fuploads%2Fsites%2F2%2F2017%2F11%2F23.jpg">
                            <span class="bdaia-io bdaia-io-social-pinterest"></span> <span
                                class="soical-text">Pinterest</span> </a> </li>
                    <li class="linkedin"> <a title="linkedin"
                            onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;"
                            href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}">
                            <span class="bdaia-io bdaia-io-linkedin2"></span> <span class="soical-text">Linkedin</span>
                        </a> </li>
                    <li class="tumblr"> <a title="tumblr"
                            onclick="window.open('http://www.tumblr.com/share/link?url={{url()->current()}}&amp;name=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money','Tumblr','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"
                            href="https://www.tumblr.com/share/link?url={{url()->current()}}&amp;name=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money">
                            <span class="bdaia-io bdaia-io-tumblr"></span> <span class="soical-text">Tumblr</span> </a>
                    </li>
                    <li class="whatsapp"><a
                            href="whatsapp://send?text=Facebook%27s+fundraisers+now+help+you+raise+money%20-%20{{url()->current()}}"><span
                                class="bdaia-io bdaia-io-whatsapp"></span></a> </li>
                    <li class="telegram"><a
                            href="tg://msg?text=Facebook%27s+fundraisers+now+help+you+raise+money%20-%20{{url()->current()}}"><span
                                class="bdaia-io bdaia-io-telegram"></span></a> </li>
                </ul>
            </div>
            <div class="bdaia-post-content">
                <div class="ql-editor" style="height: auto;">
                    {!! $post['content'] !!}
                </div>
            </div>


            <div class="cfix"></div>
            <footer>
                @if($post_tags && count($post_tags) > 0)
                <div class="article-bottom-links article-tag-cloud">
                    <span class="title">@lang('blog::front.tags')</span>
                    @foreach($post_tags as $tag)
                        <a target="_blank" href="{{ fr_route('tag-page', ['slug' => $tag->slug]) }}" rel="tag">{{ $tag->name }}</a>
                    @endforeach
                </div>
                @endif

                <div class="article-bottom-links article-share"><span class="title">@lang('blog::front.share')</span>
                    <ul>
                        <li class="facebook"> <a title="facebook"
                                onclick="window.open('http://www.facebook.com/sharer.php?u={{url()->current()}}','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"
                                href="https://www.facebook.com/sharer.php?u={{url()->current()}}">
                                <span class="bdaia-io bdaia-io-facebook"></span> <span class="soical-text"><small>Share
                                        on </small> Facebook</span> </a> </li>
                        <li class="twitter"> <a title="twitter"
                                onclick="window.open('http://twitter.com/share?url={{url()->current()}}&amp;text=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"
                                href="https://twitter.com/share?url={{url()->current()}}&amp;text=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money">
                                <span class="bdaia-io bdaia-io-twitter"></span> <span class="soical-text"><small>Share
                                        on </small> Twitter</span> </a> </li>
                        <li class="google"> <a title="google"
                                onclick="window.open('https://plus.google.com/share?url={{url()->current()}}','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;"
                                href="https://plus.google.com/share?url={{url()->current()}}">
                                <span class="bdaia-io bdaia-io-google-plus"></span> <span
                                    class="soical-text">Google+</span> </a> </li>
                        <li class="reddit"> <a title="reddit"
                                onclick="window.open('http://reddit.com/submit?url={{url()->current()}}&amp;title=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money','Reddit','width=617,height=514,left='+(screen.availWidth/2-308)+',top='+(screen.availHeight/2-257)+''); return false;"
                                href="https://reddit.com/submit?url={{url()->current()}}&amp;title=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money">
                                <span class="bdaia-io bdaia-io-reddit"></span> <span class="soical-text">Reddit</span>
                            </a> </li>
                        <li class="pinterest"> <a title="pinterest"
                                href="https://pinterest.com/pin/create/button/?url={{url()->current()}}&amp;description=Facebook%27s+fundraisers+now+help+you+raise+money&amp;media=https%3A%2F%2Fkolyoum.bdaia.com%2Fmain%2Fwp-content%2Fuploads%2Fsites%2F2%2F2017%2F11%2F23.jpg">
                                <span class="bdaia-io bdaia-io-social-pinterest"></span> <span
                                    class="soical-text">Pinterest</span> </a> </li>
                        <li class="linkedin"> <a title="linkedin"
                                onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;"
                                href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}">
                                <span class="bdaia-io bdaia-io-linkedin2"></span> <span
                                    class="soical-text">Linkedin</span> </a> </li>
                        <li class="tumblr"> <a title="tumblr"
                                onclick="window.open('http://www.tumblr.com/share/link?url={{url()->current()}}&amp;name=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money','Tumblr','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"
                                href="https://www.tumblr.com/share/link?url={{url()->current()}}&amp;name=Facebook%E2%80%99s+fundraisers+now+help+you+raise+money">
                                <span class="bdaia-io bdaia-io-tumblr"></span> <span class="soical-text">Tumblr</span>
                            </a> </li>
                        <li class="whatsapp"><a href="whatsapp://send?text={{ $post['title'] }} - {{url()->current()}}"><span class="bdaia-io bdaia-io-whatsapp"></span></a> </li>
                        <li class="telegram"><a href="tg://msg?text={{ $post['title'] }}- {{url()->current()}}"><span class="bdaia-io bdaia-io-telegram"></span></a> </li>
                    </ul>
                </div>
                @if ($prev_post || $next_post)
                    <div class="article-next-prev">
                        <div class="bdaia-post-prev-post">
                            @if ($prev_post)
                                <a href="{{ fr_route('post-page', ['slug' => $prev_post->slug]) }}" rel="prev">
                                    <span>@lang('blog::front.pervious_article')</span> 
                                    {{ $prev_post->title }}
                                </a> 
                            @else
                                <a href="#" class="disabled" rel="prev">
                                    <span>@lang('blog::front.pervious_article')</span>
                                </a> 
                            @endif
                        </div>
                        <div class="bdaia-post-next-post">
                            @if ($next_post)
                                <a href="{{ fr_route('post-page', ['slug' => $next_post->slug]) }}" rel="next">
                                    <span>@lang('blog::front.next_article')</span>
                                    {{ $next_post->title }}
                                </a>
                            @else
                                <a href="#" class="disabled" rel="next">
                                    <span>@lang('blog::front.next_article')</span>
                                </a> 
                            @endif
                        </div>
                    </div>
                @endif

            </footer>
        </article>



        @if (count($related_posts))
            <section id="bdaia-ralated-posts" class="article-ralated-posts bdaia-ralated-posts kolyoum-related-posts">
                <div class="bdaia-ralated-posts-head related-posts-nav">
                    <ul>
                        @if (count($related_posts))
                            <li id="nav-more-ralated">
                                <a href="#articles_box_ralated_tag" class="related-posts-link active">
                                    @lang('blog::front.related_article')
                                </a>
                            </li>
                        @endif
                        {{-- <li id="nav-more-author"> <a href="#articles_box_ralated_author" class="related-posts-link"> More
                                By&nbsp;Amr Sadek </a> </li> --}}
                    </ul>
                </div>

                @if (count($related_posts))
                    <div class="related-posts-container">
                        <div id="articles_box_ralated_tag" class="content-only scrolling-box articles-box-load_more articles-box articles-box-block645" data-speed="3000data-page=&quot;1&quot;" style="--blocks-color: #e81055;">
                            <div class="articles-box-container-wrapper">
                                <div class="articles-box-container">
                                    <div class="articles-box-content">
                                        <div class="articles-box-items articles-box-list-container scrolling-slider scrolling-box-slider clearfix slick-initialized slick-slider slick-dotted"
                                            role="toolbar" style="display: block;">
                                            <div aria-live="polite" class="slick-list draggable">
                                                <div class="slick-track" role="listbox" style="opacity: 1; width: 2010px; transform: translate3d(-603px, 0px, 0px);">
                                                    @foreach($related_posts as $related_post)
                                                        <div class="slide articles-box-item article-item-standard slick-slide slick-cloned"
                                                            tabindex="-1" role="option" aria-describedby="slick-slide01"
                                                            style="width: 177px;" data-slick-index="-3" id="" aria-hidden="true">
                                                            <div class="article-thumb kolyoum-blocks-large">
                                                                @if ($related_post['category'])
                                                                    <div class="block-info-cat">
                                                                        <a class="bd-cat-link cat-7" href="{{ fr_route('category-page', ['slug' => $related_post['category']['slug']]) }}" tabindex="-1">
                                                                            {{ $related_post['category']['name'] }}
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                                <a
                                                                    href="{{ fr_route('post-page', ['slug' => $related_post['slug']]) }}"
                                                                    title="{{ $related_post['title'] }}"
                                                                    tabindex="-1"
                                                                >
                                                                    <img
                                                                        width="406" height="233" 
                                                                        src="{{ $related_post['image_url'] }}" 
                                                                        data-src="{{ $related_post['image_url'] }}"
                                                                        class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                        alt="{{ $related_post['title'] }}"
                                                                    >
                                                                </a>
                                                            </div>

                                                            <div class="article-details">
                                                                <div class="article-meta-info">
                                                                    <div class="bd-alignleft"><span class="date meta-item"><span
                                                                                class="bdaia-io bdaia-io-clock"></span>
                                                                            <span>{{ $related_post['date'] }}</span></span></div>
                                                                    <div class="bd-alignright"><span
                                                                            class="meta-comment meta-item"><a
                                                                                href="{{ fr_route('post-page', ['slug' => $related_post['slug']]) }}#comments"
                                                                                tabindex="-1">
                                                                                <span class="fa fa-comments"></span>
                                                                                {{ $related_post['comments_count'] }}
                                                                            </a></span><span class="views meta-item warm"><span
                                                                                class="bdaia-io bdaia-io-flame"></span>
                                                                            <span>
                                                                                {{ $related_post['count_visitors'] }}
                                                                            </span></span></div>
                                                                    <div class="cfix"></div>
                                                                </div>
                                                                <h3 class="article-title"><a
                                                                        href="{{ fr_route('post-page', ['slug' => $related_post['slug']]) }}"
                                                                        title="{{ $related_post['title'] }}"
                                                                        tabindex="-1">{{ $related_post['title'] }}</a></h3>
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                            <ul class="slick-dots" role="tablist" style="">
                                                <li class="slick-active" aria-hidden="false" role="presentation"
                                                    aria-selected="true" aria-controls="navigation00" id="slick-slide00"><button
                                                        type="button" data-role="none" role="button" tabindex="0">1</button>
                                                </li>
                                                <li aria-hidden="true" role="presentation" aria-selected="false"
                                                    aria-controls="navigation01" id="slick-slide01"><button type="button"
                                                        data-role="none" role="button" tabindex="0">2</button></li>
                                            </ul>
                                        </div>
                                        <div class="end_posts"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="related-posts-container">
                    
                </div>
            </section>
        @endif


        {{-- begin::cover --}}
        @include('theme.components.comments.post-comments', ['comments' => $comments, 'post' => $post])
        {{-- end::cover --}}
    </div>
</div>


@endsection


@push('prepend-scripts')
<script>
    window.blog_translation = JSON.parse('{!! $blog_translation !!}');
</script>
@endpush