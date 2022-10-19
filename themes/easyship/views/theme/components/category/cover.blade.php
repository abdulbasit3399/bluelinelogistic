@if (count($cover_posts))
    
<section id="i601-787" class="grid-3_articles cover-grid601  slider-area cover-grid" data-grid-id="i601">
    <div class="cover-wrapper">
        <div class="loader-overlay"><div class="bd-loading"></div></div>
        <div class="bd-container">
            <ul class="bd-grid-nav"></ul>
            <div class="cover-inner">
                @foreach($cover_posts as $post)
                        
                    <article class="cover-item cover-story article-item-standard">
                        <div class="lazy-bg story-inner">
                            <img src="" alt="" style="opacity: 1;" class="visible full-visible">
                            <div class="story-bg visible full-visible" style="background-image: url({{ $post['image_url'] }});"></div>
                            <a class="cover-trigger" href="{{ route('post-page', ['slug' => $post['slug']]) }}" title="{{ $post['title'] }}" tabindex="0"></a><!-- .cover-trigger -->
                            <div class="cover-overlay">
                                <div class="cover-overlay-inner">
                                    <div class="cover-overlay-content">
                                        <div class="cover-overlay-content-in">
                                            <h3 class="cover-overlay-title">
                                                <a href="{{ route('post-page', ['slug' => $post['slug']]) }}" title="{{ $post['title'] }}" tabindex="0">{{ $post['title'] }}</a>
                                            </h3>
                                            <div class="article-meta-info">
                                                <div class="bd-alignleft">
                                                    <span class="meta-author meta-item">
                                                        <a href="{{ route('author-page', ['username' => $post['creator']['name']]) }}" class="author-name" title="{{ $post['creator']['name'] }}" tabindex="0">
                                                            <span class="fa fa-user-o"></span>
                                                            {{ $post['creator']['name'] }}
                                                        </a>
                                                    </span>
                                                    <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>{{ $post['date'] }}</span></span>
                                                </div>
                                                <div class="bd-alignright"></div>
                                                <div class="cfix"></div>
                                            </div>
                                            <!--/.article-meta-info/-->
                                            {{-- <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever wrote and selecting 33 tales to be…</p> --}}
                                            <!-- .article-excerpt -->
                                        </div>
                                        <!-- .cover-overlay-content-in -->
                                    </div>
                                    <!-- .cover-overlay-content -->
                                </div>
                                <!-- .cover-overlay-inner -->
                            </div>
                            <!-- .cover-overlay -->
                        </div>
                        <!-- .story-inner -->
                    </article>

                @endforeach


                
                {{-- <article class="cover-item cover-story article-item-standard">
                    <div class="lazy-bg story-inner">
                        <img src="" alt="" style="opacity: 1;" class="visible full-visible">
                        <div class="story-bg visible full-visible" style="background-image: url({{ asset('themes/html/assets/images/demo/luke-chesser-48-616x482.jpg') }});"></div>
                        <a class="cover-trigger" href="single-page.html" title="Tom Kerridge’s spiced orange cake with plum sauce" tabindex="0"></a><!-- .cover-trigger -->
                        <div class="cover-overlay">
                            <div class="cover-overlay-inner">
                                <div class="cover-overlay-content">
                                    <div class="cover-overlay-content-in">
                                        <h3 class="cover-overlay-title"><a href="single-page.html" title="Tom Kerridge’s spiced orange cake with plum sauce" tabindex="0">Tom Kerridge’s spiced orange cake with plum sauce</a></h3>
                                        <div class="article-meta-info">
                                            <div class="bd-alignleft"><span class="meta-author meta-item"><a href="author-page.html" class="author-name" title="Amr Sadek" tabindex="0"><span class="fa fa-user-o"></span> Amr Sadek</a></span><span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 12, 2017</span></span></div>
                                            <div class="bd-alignright"></div>
                                            <div class="cfix"></div>
                                        </div>
                                        <!--/.article-meta-info/-->
                                        <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever wrote and selecting 33 tales to be…</p>
                                        <!-- .article-excerpt -->
                                    </div>
                                    <!-- .cover-overlay-content-in -->
                                </div>
                                <!-- .cover-overlay-content -->
                            </div>
                            <!-- .cover-overlay-inner -->
                        </div>
                        <!-- .cover-overlay -->
                    </div>
                    <!-- .story-inner -->
                </article>
                <article class="cover-item cover-story article-item-standard">
                    <div class="lazy-bg story-inner">
                        <img src="" alt="" class="visible full-visible" style="opacity: 1;">
                        <div class="story-bg visible full-visible" style="background-image: url({{ asset('themes/html/assets/images/demo/ds77-310x241.jpg') }});"></div>
                        <a class="cover-trigger" href="single-page.html" title="Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado" tabindex="0"></a><!-- .cover-trigger -->
                        <div class="cover-overlay">
                            <div class="cover-overlay-inner">
                                <div class="cover-overlay-content">
                                    <div class="cover-overlay-content-in">
                                        <h3 class="cover-overlay-title"><a href="single-page.html" title="Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado" tabindex="0">Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado</a></h3>
                                        <div class="article-meta-info">
                                            <div class="bd-alignleft"><span class="meta-author meta-item"><a href="author-page.html" class="author-name" title="Amr Sadek" tabindex="0"><span class="fa fa-user-o"></span> Amr Sadek</a></span><span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 11, 2017</span></span></div>
                                            <div class="bd-alignright"></div>
                                            <div class="cfix"></div>
                                        </div>
                                        <!--/.article-meta-info/-->
                                        <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever wrote and selecting 33 tales to be…</p>
                                        <!-- .article-excerpt -->
                                    </div>
                                    <!-- .cover-overlay-content-in -->
                                </div>
                                <!-- .cover-overlay-content -->
                            </div>
                            <!-- .cover-overlay-inner -->
                        </div>
                        <!-- .cover-overlay -->
                    </div>
                    <!-- .story-inner -->
                </article>
                <article class="cover-item cover-story article-item-standard">
                    <div class="lazy-bg story-inner">
                        <img src="" alt="" class="visible full-visible" style="opacity: 1;">
                        <div class="story-bg visible full-visible" style="background-image: url({{ asset('themes/html/assets/images/demo/kaboompics_Fruit-market-with-various-colorful-fresh-fruits-310x241.jpg') }});"></div>
                        <a class="cover-trigger" href="single-page.html" title="Individual Mediterranean Savoury Muffin Roasts with Olives" tabindex="0"></a><!-- .cover-trigger -->
                        <div class="cover-overlay">
                            <div class="cover-overlay-inner">
                                <div class="cover-overlay-content">
                                    <div class="cover-overlay-content-in">
                                        <h3 class="cover-overlay-title"><a href="single-page.html" title="Individual Mediterranean Savoury Muffin Roasts with Olives" tabindex="0">Individual Mediterranean Savoury Muffin Roasts with Olives</a></h3>
                                        <div class="article-meta-info">
                                            <div class="bd-alignleft"><span class="meta-author meta-item"><a href="author-page.html" class="author-name" title="Amr Sadek" tabindex="0"><span class="fa fa-user-o"></span> Amr Sadek</a></span><span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 11, 2017</span></span></div>
                                            <div class="bd-alignright"></div>
                                            <div class="cfix"></div>
                                        </div>
                                        <!--/.article-meta-info/-->
                                        <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever wrote and selecting 33 tales to be…</p>
                                        <!-- .article-excerpt -->
                                    </div>
                                    <!-- .cover-overlay-content-in -->
                                </div>
                                <!-- .cover-overlay-content -->
                            </div>
                            <!-- .cover-overlay-inner -->
                        </div>
                        <!-- .cover-overlay -->
                    </div>
                    <!-- .story-inner -->
                </article> --}}

            </div>
            <!-- .cover-inner -->
        </div>
        <!-- .bd-container -->
    </div>
    <!-- .cover-wrapper -->
</section>

@endif