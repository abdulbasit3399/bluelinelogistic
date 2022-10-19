@extends('theme.layout.layout-pages')


@section('page-title', \Str::title(trim($page['title'])))

@section('page-description', trim(strip_tags($page['seo_description'])))

@section('page-type', 'page')

@section('page-image', $page['image_url'])


@section('styles')
@endsection

@section('page-content')

<div class="bd-main mt-5 mb-5">
    <div id="content" role="main">
        @if($page['image_url'])
            <div class="bdaia-post-heading">
                <div class="bdaia-post-featured-image">
                    <a href="{{ $page['image_url'] }}"
                        data-caption="" class="post_content_image">
                        <figure>
                            <img
                                width="1280"
                                height="848"
                                src="{{ $page['image_url'] }}"
                                class="attachment-full size-full img-lazy wp-post-image visible full-visible"
                                alt="{{ $page['title'] }}"
                            >
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
            <span class="current">
                {{ $page['title'] }}
            </span>
        </div>


        <article id="post-12"
            class="hentry post-12 post type-post status-publish format-standard has-post-thumbnail category-bd-travel tag-22 tag-apple tag-books tag-cool tag-fantasy tag-fashion tag-food tag-football tag-funny tag-horror tag-reviews tag-social tag-video tag-wordpress tag-wow">
            <header class="bdaia-post-header">

                <div class="bdaia-post-title">
                    <h1 class="post-title entry-title">{{ $page['title'] }}</h1>
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
                    <li class="whatsapp"><a href="whatsapp://send?text={{ $page['title'] }} - {{url()->current()}}"><span class="bdaia-io bdaia-io-whatsapp"></span></a> </li>
                    <li class="telegram"><a href="tg://msg?text={{ $page['title'] }}- {{url()->current()}}"><span class="bdaia-io bdaia-io-telegram"></span></a> </li>
                </ul>
            </div>

            <div class="bdaia-post-content">
                <div class="ql-editor" style="height: auto;">
                    {!! $page['content'] !!}
                </div>
            </div>

            <div class="cfix"></div>
        </article>
    </div>
</div>
@endsection
