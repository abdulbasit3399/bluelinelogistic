@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $headingTitleColor  = array_key_exists('heading_title_color', $data) && $data['heading_title_color'] ? "color: {$data['heading_title_color']} !important;" :  '' ;
@endphp

<!-- good-hands -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="good-hands" class="section">
    <div class="container">
        <div class="intro">
            <h2 class="heading" style="{{$titleColor}}">{{$data['section_title'][app()->getLocale()] ?? ''}}</h2>
            <p class="sub text-muted" style="{{$textColor}}">
                {{$data['section_subtitle'][app()->getLocale()] ?? ''}}
            </p>
        </div>

        <div class="contents">
            <div class="wrapper">
                <img class="graphic" src="{{ theme_setting_image($section->id,'section_mobile_banner') != '' ? theme_setting_image($section->id,'section_mobile_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/images/good-hands-graphic.webp'))) }}" alt="good hands graphic" />
                <img class="graphic lg" src="{{ theme_setting_image($section->id,'section_mobile_banner') != '' ? theme_setting_image($section->id,'section_mobile_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/good-hands-graphic-desktop.webp'))) }}" alt="good hands graphic" />
            </div>
            <ul class="points list-unstyled mb-0">
                <li class="point">
                    <h3 class="heading" style="{{$headingTitleColor}}">{{$data['section_heading1_title'][app()->getLocale()] ?? ''}}</h3>
                    <p class="text" style="{{$textColor}}">
                        {{$data['section_description1'][app()->getLocale()] ?? ''}}
                    </p>
                </li>
                <li class="point">
                    <h3 class="heading" style="{{$headingTitleColor}}">{{$data['section_heading2_title'][app()->getLocale()] ?? ''}}</h3>
                    <p class="text" style="{{$textColor}}">
                        {{$data['section_description2'][app()->getLocale()] ?? ''}}
                    </p>
                </li>
            </ul>
        </div>
    </div>
</section>
@endif

<style>
  #good-hands::before{
    background-color: {{array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;" : '#fff;';}}
  }
</style>
