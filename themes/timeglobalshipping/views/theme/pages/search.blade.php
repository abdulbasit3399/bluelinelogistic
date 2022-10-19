@extends('theme.layout.layout-pages')


@section('page-content')


<div class="bd-main">
    <div class="wrapper-search">
        <form class="form-search" method="get" action="{{ fr_route('search-post') }}">
            <input
                type="text"
                class="bbd-search-field search-live input-search"
                name="q"
                placeholder="@lang('view.search')"
                value="{{ $search_value }}"  
            >
            <button type="submit" class="bbd-search-btn btn-search"><span class="bdaia-io bdaia-io-ion-ios-search-strong"></span></button>
        </form>
    </div>

    <header class="content-only title-outer">
        <h3 class="page-title">
            @lang('view.search_result_for'): <span style="color: #1f323f;"> {{ $search_value }} </span>
        </h3>
    </header>
    
    {{-- <script>var js_cat_box = {"post_meta":true,"excerpt":"true","excerpt_length":null,"offest":0,"paged":1,"read_more":true,"layout":"blockStyle4","block":"block614"};</script> --}}

    <div id="cat-uid-13" class="articles-box-load_more content-only articles-box articles-box-block614" data-page="1" style="--blocks-color: #105EFB">
        @if ($search_value && count($posts))
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
                                        <a href="{{ fr_route('post-page', ['slug' => $post['slug']]) }}" title="{{ $post['title'] }}">
                                            <img 
                                                width="406"
                                                height="233"
                                                src="{{ $post['image_url'] }}"
                                                class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image visible full-visible"
                                                alt="{{ $post['title'] }}"
                                                style="display: block;">
                                        </a>
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
                        data-text="Load More"
                        data-csrf="{{ csrf_token() }}"
                    >
                        Load More
                    </a>
                </div> --}}

            </div>
        @else
            <div class="not-found-result">
                <div class="message">
                    @lang('view.not_found_result')
                </div>
            </div>
        @endif
    </div>
</div>


@endsection