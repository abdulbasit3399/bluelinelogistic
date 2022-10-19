@php

    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';


    $cardTitleColor  = array_key_exists('card_title_color', $data) && $data['card_title_color'] ? "color: {$data['card_title_color']} !important;" :  '' ;
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;

    $data = theme_setting('homepage.top-steps');
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
                    <img src="{{ theme_setting_image($section->id,'slides_1_img') != '' ? theme_setting_image($section->id,'slides_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/step1.svg'))) }}" class="step-image img-responsive" />
                </div>
            @if (isset($data['services_count']) && $data['services_count'] > 1)
                <div class="{{$col_width}} col-md-6 text-center">
                    <img src="{{ theme_setting_image($section->id,'slides_2_img') != '' ? theme_setting_image($section->id,'slides_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/step2.svg'))) }}" class="step-image img-responsive" />
                </div>
            @endif
            @if (isset($data['services_count']) && $data['services_count'] > 2)
                <div class="{{$col_width}} col-md-6 text-center">
                    <img src="{{ theme_setting_image($section->id,'slides_3_img') != '' ? theme_setting_image($section->id,'slides_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/step3.svg'))) }}"  class="step-image img-responsive" />
                </div>
            @endif
            </div>

            <div class="row">
                <div class="{{$col_width}} col-md-6 text-center">
                    <div class="step-header" style="{{ $titleColor }}" >
                    <div> {{$data['title_1_whyus'][app()->getLocale()] ?? ''}} </div>
                    </div>
                </div>
            @if (isset($data['services_count']) && $data['services_count'] > 1)
                <div class="{{$col_width}} col-md-6 text-center">
                    <div class="step-header" style="{{ $titleColor }}">
                    <div> {{$data['title_2_whyus'][app()->getLocale()] ?? ''}}  </div>
                    </div>
                </div>
            @endif
            @if (isset($data['services_count']) && $data['services_count'] > 2)
                <div class="{{$col_width}} col-md-6 text-center">
                    <div class="step-header" style="{{ $titleColor }}">
                    <div> {{$data['title_3_whyus'][app()->getLocale()] ?? ''}}  </div>
                    </div>
                </div>
            @endif
            </div>

            <div class="row">
                <div class="{{$col_width}} col-md-6 text-center" >
                    <div style="{{ $textColor }}" class="step-description light"> {{$data['description_1_whyus'][app()->getLocale()] ?? ''}} </div>
                </div>
                @if (isset($data['services_count']) && $data['services_count'] > 1)
                    <div class="{{$col_width}} col-md-6 text-center middle-column" >
                        <div style="{{ $textColor }}" class="step-description light">{{$data['description_2_whyus'][app()->getLocale()] ?? ''}} </div>
                    </div>
                @endif
                @if (isset($data['services_count']) && $data['services_count'] > 2)
                <div class="{{$col_width}} col-md-6 text-center" >
                    <div style="{{ $textColor }}" class="step-description light"> {{$data['description_3_whyus'][app()->getLocale()] ?? ''}} </div>
                </div>
                @endif
            </div>

        </div>

        <div class="row top-steps-row mobile-only">

            <div class="{{$col_width}} col-md-6 text-center">
                <div class="step-header" style="{{ $titleColor }}" >
                    <div> {{$data['title_1_whyus'][app()->getLocale()] ?? ''}}</div>
                </div>

                <div class="step-description light">
                    <div class="row mobile-only">
                    <div class="col-xs-6">
                        <img  src="{{ theme_setting_image($section->id,'slides_1_img') != '' ? theme_setting_image($section->id,'slides_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/step1.svg'))) }}"  width="190px" style="margin-left: -30px" class="mobile-only" />
                    </div>
                    <div class="col-xs-6" style="{{ $textColor }}" >  {{$data['description_1_whyus'][app()->getLocale()] ?? ''}} </div>
                    </div>
                </div>
            </div>

            <div class="{{$col_width}} col-md-6 text-center middle-column">
                <div class="step-header" style="{{ $titleColor }}">
                    <div>  {{$data['title_2_whyus'][app()->getLocale()] ?? ''}}  </div>
                </div>
                <div class="step-description light">
                    <div class="row mobile-only">
                    <div class="col-xs-6">
                        <img src="{{ theme_setting_image($section->id,'slides_2_img') != '' ? theme_setting_image($section->id,'slides_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/step2.svg'))) }}"  width="190px" style="margin-left: -30px" class="mobile-only" />
                    </div>
                    <div class="col-xs-6" style="{{ $textColor }}" > {{$data['description_2_whyus'][app()->getLocale()] ?? ''}} </div>
                    </div>
                </div>
            </div>

            <div class="{{$col_width}} col-md-6 text-center">
                <div class="step-header" style="{{ $titleColor }}">
                    <div> {{$data['title_3_whyus'][app()->getLocale()] ?? ''}}   </div>
                </div>
                <div class="step-description light">
                    <div class="row mobile-only">
                    <div class="col-xs-6">
                        <img  src="{{ theme_setting_image($section->id,'slides_3_img') != '' ? theme_setting_image($section->id,'slides_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/step3.svg'))) }}"  width="190px" style="margin-left: -37px" class="mobile-only" />
                    </div>
                    <div class="col-xs-6" style="{{ $textColor }}"> {{$data['description_3_whyus'][app()->getLocale()] ?? ''}} </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endif


<style>
    .business{
      background-color: {{array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;" : '';}}
    }
  </style>
