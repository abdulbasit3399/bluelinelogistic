<div class="bd-sidebar theia_sticky is-fixed mt-5 mb-5">
    <div class="vc_column-inner">
        <div class="wpb_wrapper">
            <div class="wpb_widgetised_column wpb_content_element">
                <div class="wpb_wrapper">
                    
                    {!! get_sidebar('main_sidebar') !!}
                    
                    
                    
                    
                    {{-- <div id="bdaia-widget-counter-2" class="content-only widget bdaia-widget bdaia-widget-counter">
                        <div class="widget-box-title widget-box-title-s4"><h3>Stay Connected</h3></div>
                        <div class="widget-inner">
                            <div class="bdaia-wc-inner bdaia-wc-style9">
                                <ul class="social-counter-widget">
                                    <li class="social-counter-facebook">
                                        <a href="#" target="_blank"><span class="bdaia-io bdaia-io-facebook"></span><span class="sc-num">68,421</span><small>Fans</small></a>
                                    </li>
                                    <li class="social-counter-twitter">
                                        <a href="#" target="_blank"><span class="bdaia-io bdaia-io-twitter"></span><span class="sc-num">68,421</span><small>Followers</small></a>
                                    </li>
                                    <li class="social-counter-youtube">
                                        <a href="#" target="_blank">
                                            <span class="bdaia-io bdaia-io-youtube"></span><span class="sc-num">36,300</span><small>Subscribers</small>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Social Counter/-->
                        </div>
                    </div> --}}

{{-- 
                    <script>
                        jQuery(document).ready(function ($) {
                            jQuery(".bdaia-widget-tabs#tabs-bdaia-tabs-2").each(function () {
                                var $tab = jQuery(this);
                                $tab.find(".bdaia-tabs-nav li:first").addClass("active");
                                $tab.find(".bdaia-tabs-nav li").on("click", function () {
                                    var $tabTitle = jQuery(this);
                                    if (!$tabTitle.hasClass("active")) {
                                        $tabTitle.parent().find("li").removeClass("active");
                                        $tabTitle.addClass("active");

                                        jQuery(this).parents(".bdaia-widget-tabs#tabs-bdaia-tabs-2").find(".bdaia-tab-container").hide();
                                        var currentTab = $tabTitle.find("a").attr("href"),
                                            activeTab = jQuery(currentTab).show();

                                        activeTab.find(".bdaia-wb-article, .bdaia-wb-comments, .tagcloud").velocity("stop").velocity("transition.slideUpIn", { stagger: 100, duration: 500 });

                                        activeTab.find(".lazy-img, .img-lazy").each(function () {
                                            jQuery(this).attr("src", jQuery(this).attr("data-src")).removeAttr("data-src");
                                        });
                                    }
                                    return false;
                                });
                            });
                        });
                    </script>

                    <div id="bdaia-tabs-2" class="content-only widget bdaia-widget">
                        <div class="bdaia-widget-tabs" id="tabs-bdaia-tabs-2">
                            <div class="bdaia-wt-inner">
                                <ul class="bdaia-tabs-nav with-popular with-recent">
                                    <li class="active">
                                        <a href="#tab1-bdaia-tabs-2"> Popular </a>
                                    </li>

                                    <li>
                                        <a href="#tab2-bdaia-tabs-2"> Recent </a>
                                    </li>
                                </ul>

                                <div class="bdaia-tab-content">
                                    <div class="bdaia-tab-container" id="tab1-bdaia-tabs-2">
                                        <div class="widget-inner">
                                            <div class="bdaia-wb-wrap bdaia-wb1">
                                                <div class="bdaia-wb-content">
                                                    <div class="bdaia-wb-inner">
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ asset('themes/html/assets/images/demo/23-104x74.jpg') }}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Facebook&#8217;s fundraisers now help you raise money</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">November 22, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ asset('themes/html/assets/images/demo/img-02-104x74.jpg') }}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Back these dreamy solar lanterns on Kickstarter</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 5, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ asset('themes/html/assets/images/demo/img-04-104x74.jpg') }}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>ClassPass will let you live stream fitness classes</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 18, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ asset('themes/html/assets/images/demo/james-zwadlo-190040-104x74.jpg') }}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>YouTube debuts inspiring Pride Month video to highlight</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">March 2, 2016</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/TAB1-->

                                    <div class="bdaia-tab-container" id="tab2-bdaia-tabs-2">
                                        <div class="widget-inner">
                                            <div class="bdaia-wb-wrap bdaia-wb1">
                                                <div class="bdaia-wb-content">
                                                    <div class="bdaia-wb-inner">
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ asset('themes/html/assets/images/demo/img-04-104x74.jpg') }}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>ClassPass will let you live stream fitness classes</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 18, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ asset('themes/html/assets/images/demo/img-07-104x74.jpg') }}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Oppo Given Green Clearance to Set Up Manufacturing</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 12, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ asset('themes/html/assets/images/demo/david-marcu-5437-104x74.jpg') }}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Facebook Testing Greetings Feature to Give Poke</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 12, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ asset('themes/html/assets/images/demo/luke-chesser-48-104x74.jpg') }}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Tom Kerridge&#8217;s spiced orange cake with plum sauce</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 12, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/TAB2-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="bdaia-widget-box2-2" class="content-only widget bdaia-widget bdaia-box2">
                        <div class="widget-box-title widget-box-title-s4"><h3>Must Rating</h3></div>
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
                                        <div class="bdaia-wb-article bdaia-wba-big bdaiaFadeIn">
                                            <article class="with-thumb">
                                                <div class="bwb-article-img-container">
                                                    <a href="single-page.html">
                                                        <img
                                                                width="406"
                                                                height="233"
                                                                src="{{ asset('themes/html/assets/images/img-empty.png') }}"
                                                                class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                alt=""
                                                                data-src="{{ asset('themes/html/assets/images/demo/aaron-burden-107384-406x233.jpg') }}"
                                                        />
                                                    </a>
                                                </div>

                                                <div class="bwb-article-content-wrapper">
                                                    <header>
                                                        <h3 class="entry-title">
                                                            <a href="single-page.html">
                                                                <span>Sparky Linux 5 : Great All-Purpose Distro</span>
                                                            </a>
                                                        </h3>
                                                    </header>

                                                    <footer>
                                                        <div class="bdaia-post-rating">
                                                            <span class="bd-star-rating" title="nice!"><span style="width: 91%;"></span></span>
                                                        </div>
                                                    </footer>
                                                    <p class="block-exb">I recently had the enviable task of reading nearly every story Richard Matheson ever &hellip;</p>
                                                </div>
                                            </article>
                                        </div>

                                        <div class="bdaia-wb-article bdaia-wba-small bdaiaFadeIn">
                                            <article class="with-thumb">
                                                <div class="bwb-article-img-container">
                                                    <a href="single-page.html">
                                                        <img
                                                                width="104"
                                                                height="74"
                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                alt=""
                                                                data-src="{{ asset('themes/html/assets/images/demo/annie-spratt-294450-104x74.jpg') }}"
                                                        />
                                                    </a>
                                                </div>

                                                <div class="bwb-article-content-wrapper">
                                                    <header>
                                                        <h3 class="entry-title">
                                                            <a href="single-page.html">
                                                                <span>Going Mainstream: A Real Estate Development In Dubai</span>
                                                            </a>
                                                        </h3>
                                                    </header>

                                                    <footer>
                                                        <div class="bdaia-post-rating">
                                                            <span class="bd-star-rating" title="nice!"><span style="width: 86%;"></span></span>
                                                        </div>
                                                    </footer>
                                                </div>
                                            </article>
                                        </div>

                                        <div class="bdaia-wb-article bdaia-wba-small bdaiaFadeIn">
                                            <article class="with-thumb">
                                                <div class="bwb-article-img-container">
                                                    <a href="single-page.html">
                                                        <img
                                                                width="104"
                                                                height="74"
                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                alt=""
                                                                data-src="{{ asset('themes/html/assets/images/demo/james-bold-304908-104x74.jpg') }}"
                                                        />
                                                    </a>
                                                </div>

                                                <div class="bwb-article-content-wrapper">
                                                    <header>
                                                        <h3 class="entry-title">
                                                            <a href="single-page.html">
                                                                <span>This mobile game lets you &#8216;clean up&#8217; plastic pollution</span>
                                                            </a>
                                                        </h3>
                                                    </header>

                                                    <footer>
                                                        <div class="bdaia-post-rating">
                                                            <span class="bd-star-rating" title="THE BREAKDOWN"><span style="width: 83%;"></span></span>
                                                        </div>
                                                    </footer>
                                                </div>
                                            </article>
                                        </div>

                                        <div class="bdaia-wb-article bdaia-wba-small bdaiaFadeIn">
                                            <article class="with-thumb">
                                                <div class="bwb-article-img-container">
                                                    <a href="single-page.html">
                                                        <img
                                                                width="104"
                                                                height="74"
                                                                src="{{ asset('themes/html/assets/images/img-empty-small.png') }}"
                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                alt=""
                                                                data-src="{{ asset('themes/html/assets/images/demo/lifesimply-rocks-99706-104x74.jpg') }}"
                                                        />
                                                    </a>
                                                </div>

                                                <div class="bwb-article-content-wrapper">
                                                    <header>
                                                        <h3 class="entry-title">
                                                            <a href="single-page.html">
                                                                <span>7 influential feminists share the most powerful thing woman</span>
                                                            </a>
                                                        </h3>
                                                    </header>

                                                    <footer>
                                                        <div class="bdaia-post-rating">
                                                            <span class="bd-star-rating" title="nice!"><span style="width: 83%;"></span></span>
                                                        </div>
                                                    </footer>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
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
                            </div>
                        </div>
                    </div>
                    
                    <div id="mc4wp_form_widget-2" class="content-only widget bdaia-widget widget_mc4wp_form_widget">
                        <div class="widget-box-title widget-box-title-s4"><h3>Newsletter</h3></div>
                        <div class="widget-inner">
                            <script>
                                (function () {
                                    if (!window.mc4wp) {
                                        window.mc4wp = {
                                            listeners: [],
                                            forms: {
                                                on: function (event, callback) {
                                                    window.mc4wp.listeners.push({
                                                        event: event,
                                                        callback: callback,
                                                    });
                                                },
                                            },
                                        };
                                    }
                                })();
                            </script>
                            <!-- Mailchimp for WordPress v4.7.4 - https://wordpress.org/plugins/mailchimp-for-wp/ -->
                            <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-66" method="post" data-id="66" data-name="">
                                <div class="bdaia-mc4wp-form-icon"><span class="bdaia-io bdaia-io-ion-paper-airplane"></span></div>
                                <p class="bdaia-mc4wp-bform-p bd1-font">Get Even More</p>
                                <p class="bdaia-mc4wp-bform-p2 bd2-font">Subscribe to our mailing list to get the new updates!</p>
                                <p class="bdaia-mc4wp-bform-p3 bd3-font">Lorem ipsum dolor sit amet, consectetur.</p>
                                <div class="mc4wp-form-fields">
                                    <p>
                                        <label>Email address: </label>
                                        <input type="email" name="EMAIL" placeholder="Your email address" required />
                                    </p>

                                    <p>
                                        <input type="submit" value="Sign up" />
                                    </p>
                                </div>
                                <label style="display: none !important;">
                                    Leave this field empty if you're human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" />
                                </label>
                                <input type="hidden" name="_mc4wp_timestamp" value="1604594626" /><input type="hidden" name="_mc4wp_form_id" value="66" />
                                <input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1" />
                                <div class="mc4wp-response"></div>
                                <p class="bdaia-mc4wp-bform-p4 bd4-font">Don&#039;t worry, we don&#039;t spam.</p>
                            </form>
                            <!-- / Mailchimp for WordPress Plugin -->
                        </div>
                    </div> --}}


                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>