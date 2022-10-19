<div class="wpb_widgetised_column">
    <div class="content-only widget bdaia-widget bdaia-box1">
        <div class="widget-box-title widget-box-title-s4">
            <h3>{{ $data['section_title'][app()->getLocale()] ?? '' }}</h3>
        </div>
        <div class="widget-inner">
            <div
                    class="bdaia-wb-wrap bdaia-wb1 bdaia-wb-idwCOd2 bdaia-ajax-pagination-"
                    data-box_nu="wb1"
                    data-box_id="bdaia-wb-idwCOd2"
                    data-paged="1"
                    data-sort_order="review_high"
                    data-ajax_pagination=""
                    data-num_posts="3"
                    data-tag_slug=""
                    data-cat_uid=""
                    data-cat_uids="5"
                    data-max_nu="4"
                    data-total_posts_num="12"
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
                            <div class="bdaia-wb-article bdaia-wba-small bdaiaFadeIn">
                                <article class="with-thumb">
                                    @if($post['image_url'])
                                        <div class="bwb-article-img-container">
                                            <a href="{{ fr_route('post-page', ['slug' => $post['slug'] ]) }}" >
                                                <img
                                                    style="width: 104px; height: 74px;"
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
                                                <a href="{{ fr_route('post-page', ['slug' => $post['slug'] ]) }}" >
                                                    <span>{{ $post['title'] }}</span>
                                                </a>
                                            </h3>
                                        </header>
                                        <footer>
                                            @if (isset($data['display_rating']) && $data['display_rating'] == 1)
                                                <div class="bdaia-post-rating" style="margin-bottom: 6px;">
                                                    <span class="bd-star-rating" title="nice!"><span style="width: 91%;"></span></span>
                                                </div>
                                            @endif
                                            @if (isset($data['display_category']) && $data['display_category'] == 1 && $post['category'])
                                                <div class="bdaia-post-cat-list">
                                                    <a
                                                        class="bd-cat-link bd-cat-11"
                                                        href="{{ fr_route('category-page', ['slug' => $post['category']['slug'] ]) }}"

                                                        style="color: #FFF;"
                                                    >
                                                        {{ $post['category']['name'] }}
                                                    </a>
                                                </div>
                                            @endif
                                        </footer>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget content-only"></div>
</div>
