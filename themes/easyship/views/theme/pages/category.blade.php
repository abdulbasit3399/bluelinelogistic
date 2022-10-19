@extends('theme.layout.layout-pages')

@section('page-title', \Str::title(trim($category['name'])))

@section('page-description', trim($category['description']))


@section('before-content')

    {{-- begin::cover --}}
    @include('theme.components.category.cover')
    {{-- end::cover --}}

@endsection


@section('page-content')


<div class="bd-main mt-5 mb-5">
    <header class="content-only title-outer">
        <!-- Start Breadcrumbs -->

        <div xmlns:v="http://rdf.data-vocabulary.org/#" class="bdaia-crumb-container">
            <span typeof="v:Breadcrumb">
                <a rel="v:url" property="v:title" class="crumbs-home" href="{{ fr_route('home') }}">{{__('theme_easyship::view.home')}}</a>
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
            
            @foreach($categoryParents as $categoryParent)
                <span typeof="v:Breadcrumb">
                    <a rel="v:url" property="v:title" href="{{ fr_route('category-page', ['slug' => $categoryParent['slug']]) }}"> {{ $categoryParent['name'] }} </a>
                </span>
                <span class="delimiter">
                    <span class="bdaia-io bdaia-io-angle-double-right"></span>
                </span>
            @endforeach



            <span class="current"> {{ $category['name'] }} </span>
        </div>
        
        <!-- End Breadcrumbs -->

        <h1 class="page-title">
            {{ $category['name'] }}
        </h1>
    </header>
    
    {{-- <script>var js_cat_box = {"post_meta":true,"excerpt":"true","excerpt_length":null,"offest":0,"paged":1,"read_more":true,"layout":"blockStyle4","block":"block614"};</script> --}}

    <div id="cat-uid-13" class="articles-box-load_more content-only articles-box articles-box-block614" data-page="1" style="--blocks-color: #105EFB">
        <div class="articles-box-container-wrapper">
            <div class="articles-box-container">
                <div class="articles-box-content">
                    <ul class="articles-box-items articles-box-list-container articles-items-1 clearfix">

                        @foreach($posts as $post)
                            <li class="articles-box-item article-item-standard">
                                <div class="article-thumb kolyoum-blocks-large">
                                    @if ($post['category'])
                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-13" href="{{ fr_route('category-page', ['slug' => $post['category']['slug'] ]) }}">{{ $post['category']['name'] }}</a></div>
                                    @endif
                                    @if ($post->getFirstMediaUrl('featured_image'))
                                        <a href="{{ fr_route('post-page', ['slug' => $post['slug']]) }}" title="{{ $post['title'] }}">
                                            <img 
                                                width="406"
                                                height="233"
                                                src="{{ $post->getFirstMediaUrl('featured_image') }}"
                                                class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image visible full-visible"
                                                alt="{{ $post['title'] }}"
                                                style="display: block;">
                                        </a>
                                    @endif
                                </div>
                                <div class="article-details">
                                    <h3 class="article-title"><a href="{{ fr_route('post-page', ['slug' => $post['slug']]) }}" title="{{ $post['title'] }}">{{ $post['title'] }}</a></h3>
                                    <div class="article-meta-info">
                                        <div class="bd-alignleft">
                                            <span class="meta-author meta-item">
                                                <a href="{{ fr_route('author-page', ['username' => $post['creator']['name']]) }}" class="author-name" title="{{ $post['creator']['name'] }}" tabindex="0">
                                                    <span class="fa fa-user-o"></span>
                                                    {{ $post['creator']['name'] }}
                                                </a>
                                            </span>
                                            <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>{{ $post['date'] }}</span></span>
                                        </div>
                                        <div class="bd-alignright"><span class="meta-comment meta-item"><a href="{{ fr_route('post-page', ['slug' => $post['slug']]) }}"><span class="fa fa-comments"></span> {{ $post['comments_count'] }} </a></span></div>
                                        <div class="cfix"></div>
                                    </div>
                                    <!--/.article-meta-info/-->
                                </div>
                            </li>

                        @endforeach

                        
                    </ul>
                </div>
            </div>

            <div class="pagination-parent">
                {!! $posts->links('pagination::bootstrap-4') !!}
            </div>


            {{-- <div class="articles-box-load-more">
                <div style="display: none" class="bd-loading bd-loading-small"></div>
                <a 
                    class="load-more-btn general-more-btn"
                    data-query-vars="0"
                    data-url="{{ fr_route('load-posts') }}"
                    data-posts-per-page="12"
                    data-q="{'category_name':'bd-recipes','cat':13,'lazy_load_term_meta':true,'posts_per_page':12,'order':'DESC'}"
                    data-max-num="2"
                    data-latest="12"
                    data-page="1"
                    data-count="15"
                    data-type="category"
                    data-id="bd-recipes"
                    data-text="@lang('view.loadmore')"
                    data-csrf="{{ csrf_token() }}"
                >
                @lang('view.loadmore')
                </a>
            </div> --}}

        </div>
    </div>
</div>


@endsection