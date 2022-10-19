@php
    $footer_setting = theme_setting('footer.footer');
    if(!$footer_setting) $footer_setting = array();
@endphp
@if (array_key_exists('display_footer', $footer_setting) && $footer_setting['display_footer'])

<footer id="main-footer" class="{{(array_key_exists('footer_style', $footer_setting) && $footer_setting['footer_style'] == 'dark_style' ? $footer_setting['footer_style'] : 'light_style')}}">
    <div class="container">
        @if (array_key_exists('display_widgets', $footer_setting) && array_key_exists('widgets_count', $footer_setting) && $footer_setting['display_widgets'])

            @php
                $col_width = 'col-lg-12';
                if($footer_setting['widgets_count'] > 3) {
                    $col_width = 'col-lg-3';
                }elseif($footer_setting['widgets_count'] > 2) {
                    $col_width = 'col-lg-4';
                }elseif($footer_setting['widgets_count'] > 1) {
                    $col_width = 'col-lg-6';
                }
            @endphp 
            <div class="row footer-cols">
                <div class="{{$col_width}} col-md-6">
                    {!! get_sidebar('footer_sidebar_1') !!}
                </div>
                @if ($footer_setting['widgets_count'] > 1)
                    <div class="{{$col_width}} col-md-6">
                        {!! get_sidebar('footer_sidebar_2') !!}
                    </div>
                @endif
                @if ($footer_setting['widgets_count'] > 2)
                    <div class="{{$col_width}} col-md-6">
                        {!! get_sidebar('footer_sidebar_3') !!}
                    </div>
                @endif
                @if ($footer_setting['widgets_count'] > 3)
                    <div class="{{$col_width}} col-md-6">
                        {!! get_sidebar('footer_sidebar_4') !!}
                    </div>
                @endif
            </div>
        @endif

        <div class="footer-bottom d-flex">
            <!-- dropdowns -->
            @if (array_key_exists('display_copyright', $footer_setting) && $footer_setting['display_copyright'])
                <div class="footer-col1">
                    <p class="copyright mb-0">{!! $footer_setting['copyright'] !!}</p>
                </div>
            @endif

            <!-- social media -->
            @if (array_key_exists('display_social', $footer_setting) && $footer_setting['display_social'])
                <div class="footer-col3">
                    <div class="widget-social-links bdaia-social-io-colored">
                        <div class="bdaia-social-io bdaia-social-io-size-35">
                            @if($footer_setting['facebook_url'])
                                <a style="color: inherit;" class="none bdaia-io-url-facebook" title="Facebook" href="{{$footer_setting['facebook_url']}}" target="_blank"><span class="bdaia-io bdaia-io-facebook"></span></a>
                            @endif
                            @if($footer_setting['twitter_url'])
                                <a style="color: inherit;" class="none bdaia-io-url-twitter" title="Facebook" href="{{$footer_setting['twitter_url']}}" target="_blank"><span class="bdaia-io bdaia-io-twitter"></span></a>
                            @endif
                            @if($footer_setting['google_url'])
                                <a style="color: inherit;" class="none bdaia-io-url-google-plus" title="Facebook" href="{{$footer_setting['google_url']}}" target="_blank"><span class="bdaia-io bdaia-io-googleplus"></span></a>
                            @endif
                            @if($footer_setting['dribbble_url'])
                                <a style="color: inherit;" class="none bdaia-io-url-dribbble" title="Facebook" href="{{$footer_setting['dribbble_url']}}" target="_blank"><span class="bdaia-io bdaia-io-dribbble"></span></a>
                            @endif
                            @if($footer_setting['youtube_url'])
                                <a style="color: inherit;" class="none bdaia-io-url-youtube" title="Facebook" href="{{$footer_setting['youtube_url']}}" target="_blank"><span class="bdaia-io bdaia-io-youtube"></span></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</footer>
@endif
