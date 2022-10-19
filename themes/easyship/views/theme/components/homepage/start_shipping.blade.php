<!-- start-shipping -->
@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

@if(array_key_exists('display', $data) && $data['display'])
<section id="start-shipping" class="section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    <div class="wrapper">
        <img class="graphic" src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/images/start-shipping-graphic.webp'))) }}" alt="Start Shipping in Minutes" />
    </div>

    <div class="container">
        <div class="section-content">
        <div class="intro">
            <h2 class="heading" style="{{$titleColor}}">{{$data['section_title'][app()->getLocale()] ?? ''}}</h2>
            <p class="sub" style="{{$textColor}}">{{$data['section_subtitle'][app()->getLocale()] ?? ''}}</p>
        </div>

        <div class="contents">
            @php
                $button_type = $data['section_url']['type'];
            @endphp
            <form action="{{$data['section_url'][$button_type] ?? ''}}">
                <button type="submit" class="btn btn-primary" style="{{$buttonColor }} {{$buttonBgColor}}">
                    {{$data['section_button'][app()->getLocale()] ?? ''}}
                </button>
            </form>
            <p class="text" style="{{$textColor}}">
                {{$data['section_description'][app()->getLocale()] ?? ''}}
            </p>
        </div>
        </div>
    </div>
</section>
@endif
