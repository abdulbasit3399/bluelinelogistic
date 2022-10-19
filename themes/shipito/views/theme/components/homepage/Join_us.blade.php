@php

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
@endphp

<!-- supercharge -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="supercharge" class="section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    <div class="container">

        <div class="contents">
            <div class="row">
                @if($data['image_place'] == 'start')
                    <div class="col-lg-6">
                        <div class="wrapper">
                            <img src="{{ theme_setting_image($section->id,'section_mobile_banner') != '' ? theme_setting_image($section->id,'section_mobile_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/2.svg'))) }}" alt="demo" class="graphic d-lg-none" />
                            <img src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/2.svg'))) }}" alt="demo" class="graphic d-none d-lg-block" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info">
                            <h3 class="heading" style="{{$titleColor}}">{{$data['section_title'][app()->getLocale()] ?? ''}}</h3>
                            <p class="sub" style="{{$textColor}}">
                                {{$data['section_description'][app()->getLocale()] ?? ''}}
                            </p>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6">
                        <div class="info">
                            <h3 class="heading" style="{{$titleColor}}">{{$data['section_title'][app()->getLocale()] ?? ''}}</h3>
                            <p class="sub" style="{{$textColor}}">
                                {{$data['section_description'][app()->getLocale()] ?? ''}}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wrapper">
                            <img src="{{ theme_setting_image($section->id,'section_mobile_banner') != '' ? theme_setting_image($section->id,'section_mobile_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/4.svg'))) }}" alt="demo" class="graphic d-lg-none" />
                            <img src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/4.svg'))) }}" alt="demo" class="graphic d-none d-lg-block" />
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
