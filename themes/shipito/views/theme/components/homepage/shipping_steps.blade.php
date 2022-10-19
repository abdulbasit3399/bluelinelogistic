@php

    $cardTitleColor = array_key_exists('card_title_color', $data) && $data['card_title_color'] ? "color: {$data['card_title_color']} !important;" : '';
    $titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';

    $data = theme_setting('homepage.shipping_steps');
@endphp


<!-- why-us section -->
@if(array_key_exists('display', $data) && $data['display'])
    <div class="container columns top-steps" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">

        @php
            $col_width = 'col-lg-12';
            if(isset($data['services_count']) && $data['services_count'] > 2) {
                $col_width = 'col-lg-4';
            }elseif(isset($data['services_count']) && $data['services_count'] > 1) {
                $col_width = 'col-lg-6';
            }
        @endphp

        <div class="not-mobile">

            <div class="row">
                <div class="{{$col_width}} col-md-6 text-center">
                    <img src="{{ theme_setting_image($section->id,'shipping_steps_1_img') != '' ? theme_setting_image($section->id,'shipping_steps_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/weshop/step1.svg'))) }}" class="step-image img-responsive" />
                </div>
            @if (isset($data['services_count']) && $data['services_count'] > 1)
                <div class="{{$col_width}} col-md-6 text-center">
                    <img src="{{ theme_setting_image($section->id,'shipping_steps_2_img') != '' ? theme_setting_image($section->id,'shipping_steps_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/weshop/step1.svg'))) }}" class="step-image img-responsive" />
                </div>
            @endif
            @if (isset($data['services_count']) && $data['services_count'] > 2)
                <div class="{{$col_width}} col-md-6 text-center">
                    <img src="{{ theme_setting_image($section->id,'shipping_steps_3_img') != '' ? theme_setting_image($section->id,'shipping_steps_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/weshop/step1.svg'))) }}"  class="step-image img-responsive" />
                </div>
            @endif
            </div>

            <div class="row">
                <div class="{{$col_width}} col-md-6 text-center">
                    <div class="step-header" style="{{ $titleColor }}" >
                    <div> {{$data['title_1_shipping_steps'][app()->getLocale()] ?? ''}} </div>
                    </div>
                </div>
            @if (isset($data['services_count']) && $data['services_count'] > 1)
                <div class="{{$col_width}} col-md-6 text-center">
                    <div class="step-header" style="{{ $titleColor }}">
                    <div> {{$data['title_2_shipping_steps'][app()->getLocale()] ?? ''}}  </div>
                    </div>
                </div>
            @endif
            @if (isset($data['services_count']) && $data['services_count'] > 2)
                <div class="{{$col_width}} col-md-6 text-center">
                    <div class="step-header" style="{{ $titleColor }}">
                    <div> {{$data['title_3_shipping_steps'][app()->getLocale()] ?? ''}}  </div>
                    </div>
                </div>
            @endif
            </div>

        </div>

        <div class="row top-steps-row mobile-only">

            <div class="{{$col_width}} col-md-6 text-center">
                <div class="step-header" style="{{ $titleColor }}" >
                    <div> {{$data['title_1_shipping_steps'][app()->getLocale()] ?? ''}}</div>
                </div>

                <div class="step-description light">
                    <div class="row mobile-only">
                        <div class="col-xs-6">
                            <img  src="{{ theme_setting_image($section->id,'shipping_steps_1_img') != '' ? theme_setting_image($section->id,'shipping_steps_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/weshop/step1.svg'))) }}"  width="190px" style="margin-left: -30px" class="mobile-only" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="{{$col_width}} col-md-6 text-center middle-column">
                <div class="step-header" style="{{ $titleColor }}">
                    <div>  {{$data['title_2_shipping_steps'][app()->getLocale()] ?? ''}}  </div>
                </div>
                <div class="step-description light">
                    <div class="row mobile-only">
                        <div class="col-xs-6">
                            <img src="{{ theme_setting_image($section->id,'shipping_steps_2_img') != '' ? theme_setting_image($section->id,'shipping_steps_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/weshop/step1.svg'))) }}"  width="190px" style="margin-left: -30px" class="mobile-only" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="{{$col_width}} col-md-6 text-center">
                <div class="step-header" style="{{ $titleColor }}">
                    <div> {{$data['title_3_shipping_steps'][app()->getLocale()] ?? ''}}   </div>
                </div>
                <div class="step-description light">
                    <div class="row mobile-only">
                        <div class="col-xs-6">
                            <img  src="{{ theme_setting_image($section->id,'shipping_steps_3_img') != '' ? theme_setting_image($section->id,'shipping_steps_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/weshop/step1.svg'))) }}"  width="190px" style="margin-left: -37px" class="mobile-only" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif

