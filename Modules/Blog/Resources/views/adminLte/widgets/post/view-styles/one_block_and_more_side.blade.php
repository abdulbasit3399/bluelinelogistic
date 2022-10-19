<div class="wpb_widgetised_column">
    <div class="content-only widget bdaia-widget bdaia-box2">
        <div class="widget-box-title widget-box-title-s4"><h3>{{ $data['section_title'][app()->getLocale()] ?? '' }}</h3></div>
        <div class="widget-inner">
            <div
                    class="bdaia-wb-wrap bdaia-wb2 bdaia-wb-id97BaQ bdaia-ajax-pagination-"
                    data-box_nu="wb2"
                    data-box_id="bdaia-wb-id97BaQ"
                    data-paged="1"
                    data-sort_order="review_high"
                    data-ajax_pagination=""
                    data-num_posts="4"
                    data-tag_slug=""
                    data-cat_uid=""
                    data-cat_uids=""
                    data-max_nu="4"
                    data-total_posts_num="13"
                    data-posts=""
                    data-com_meta=""
                    data-thumbnail=""
                    data-author_meta="true"
                    data-date_meta="true"
                    data-review="true"
            >
                <div class="bdaia-wb-content">
                    <div class="bdaia-wb-inner">
                        @foreach($posts as $post)
                            <div class="bdaia-wb-article bdaiaFadeIn {{ $loop->index == 0 ? 'bdaia-wba-big' : 'bdaia-wba-small' }}">
                                <article class="with-thumb">
                                    @if($post['image_url'])
                                        <div class="bwb-article-img-container">
                                            <a href="{{ fr_route('post-page', ['slug' => $post['slug'] ]) }}" target="_blank">
                                                <img
                                                    style="width: {{ $loop->index == 0 ? '406px' : '104px' }}; height: {{ $loop->index == 0 ? '233px' : '74px' }};"
                                                    src="{{ $post['image_url'] }}"
                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                    alt=""
                                                    data-src="{{ $post['image_url'] }}"
                                                />
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


                                        @if (isset($data['display_rating']) && $data['display_rating'] == 1)
                                            <footer>
                                                <div class="bdaia-post-rating">
                                                    <span class="bd-star-rating" title="nice!"><span style="width: 91%;"></span></span>
                                                </div>
                                            </footer>
                                        @endif

                                        @if (isset($data['display_category']) && $data['display_category'] == 1 && $post['category'])
                                            <footer>
                                                <div class="bdaia-post-category">
                                                    <a
                                                        class="bd-cat-link bd-cat-11"
                                                        href="{{ fr_route('category-page', ['slug' => $post['category']['slug'] ]) }}"
                                                        target="_blank"
                                                        style="color: #FFF;"
                                                    >
                                                        {{ $post['category']['name'] }}
                                                    </a>
                                                </div>
                                            </footer>
                                        @endif

                                        {{-- <p class="block-exb">I recently had the enviable task of reading nearly every story Richard Matheson ever &hellip;</p> --}}
                                    </div>
                                </article>
                            </div>
                        @endforeach

                    </div>

                    {{-- <div class="bdayh-posts-load-wait">
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
                    </div> --}}


                </div>
            </div>
        </div>
    </div>
    <div class="widget content-only"></div>
</div>
