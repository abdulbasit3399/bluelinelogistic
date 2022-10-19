<div class="wpb_widgetised_column">
    <div class="content-only widget bdaia-widget bdaia-box3">
        <div class="widget-box-title widget-box-title-s4">
            <h3>{{ $data['section_title'][app()->getLocale()] ?? '' }}</h3>
        </div>
        <div class="widget-inner">
            <div data-box_nu="wb3" data-box_id="bdaia-wb-idsQb59" data-paged="1" data-sort_order="popular"
                data-ajax_pagination="load_more" data-num_posts="4" data-tag_slug="" data-cat_uid="" data-cat_uids="4"
                data-max_nu="4" data-total_posts_num="15" data-posts="" data-com_meta="" data-thumbnail=""
                data-author_meta="" data-date_meta="" data-review=""
                class=" bdaia-wb-wrap bdaia-wb3 bdaia-wb-idsQb59 bdaia-ajax-pagination-load_more"
            >
                <div class="bdaia-wb-content">
                    <div class="bdaia-wb-inner">
                        {{-- <div class="bdaia-box-row"> --}}
                            @foreach($posts as $post)
                                @if (($loop->index % 2) === 0)
                                    <div class="bdaia-box-row">
                                @endif

                                <div class="bdaia-wb-article bdaia-wba-bigs bdaiaFadeIn">
                                    <article class="with-thumb">
                                        @if($post['image_url'])
                                            <div class="bwb-article-img-container">
                                                <a
                                                    href="{{ fr_route('post-page', ['slug' => $post['slug'] ]) }}" target="_blank"
                                                    class=""
                                                >
                                                    <img
                                                        style="max-height: 100px;"
                                                        src="{{ $post['image_url'] }}"
                                                        data-src="{{ $post['image_url'] }}"
                                                        alt=""
                                                        class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image visible"
                                                    >
                                                </a>
                                            </div>
                                        @endif
                                        <div class="bwb-article-content-wrapper">
                                            <header>
                                                <h3 class="entry-title">
                                                    <a href="{{ fr_route('post-page', ['slug' => $post['slug'] ]) }}">
                                                        <span>{{ $post['title'] }}</span>
                                                    </a>
                                                </h3>
                                            </header>
                                        </div>
                                    </article>
                                </div>

                                @if (($loop->index % 2) === 1)
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <!-- end row -->
                    {{-- </div> --}}
                    <div class="bdayh-posts-load-wait">
                        <div class="sk-circle">
                            <div class="sk-circle1 sk-child"></div>
                            <div class="sk-circle2 sk-child"></div>
                            <div class="sk-circle3 sk-child"></div>
                            <div class="sk-circle4 sk-child"></div>
                            <div class="sk-circle5 sk-child"></div>
                            <div class="sk-circle6 sk-child"></div>
                            <div class="sk-circle7 sk-child"></div>
                            <div class="sk-circle8 sk-child"></div>
                            <div class="sk-circle9 sk-child"></div>
                            <div class="sk-circle10 sk-child"></div>
                            <div class="sk-circle11 sk-child"></div>
                            <div class="sk-circle12 sk-child"></div>
                        </div>
                    </div>
                </div>

                @if (isset($data['display_load_posts_button']) && $data['display_load_posts_button'] == 1)
                    <div id="bdaia-more-sQb59" class="bdaia-wb-more-btn">
                        <div class="bdaia-wb-mb-inner">
                            Load more
                            <span class="bdaia-io bdaia-io-angle-down"></span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="widget content-only"></div>
</div>
