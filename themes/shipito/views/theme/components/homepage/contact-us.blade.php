@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';

$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$headingTitleColor = array_key_exists('heading_title_color', $data) && $data['heading_title_color'] ? "color: {$data['heading_title_color']} !important;" : '';
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '';
$header_bg = array_key_exists('header_bg', $data) && $data['header_bg'] ? "color: {$data['header_bg']} !important;" : '';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp


@if (array_key_exists('display', $data) && $data['display'])
<div class="container mobile-only"  style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}"  >

    <h1 style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}; color:red"></h1>
        @php
            $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
        @endphp

        <div class="videothumb mobile-only">
            <div class="play-btn">
                <a href="#examplevideo" onclick="return gaPopUpDisplay(this);">
                </a>
            </div>
        </div>
    </div>

    <div class="signup-banner top-signup-banner" style="margin-top: 0px !important; {{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }};">
        <div class="container">
            <div class="text-center" style="{{ $titleColor }}">
                <div>{{ $data['contact_1_title'][app()->getLocale()] ?? '' }}</div>
            </div>
            <div class="text-center us-address" style="{{ $titleColor }}">
                <div>{{ $data['contact_2_title'][app()->getLocale()] ?? '' }}</div>
            </div>
            <div class="text-center">
                <div>
                    <a href="{{ $data['section_url'][$button_type] ?? '' }}" class="btn" style="{{ $buttonColor }} {{ $buttonBgColor }}">{{ $data['section_button'][app()->getLocale()] ?? '' }}</a>
                </div>
            </div> 
        </div>
    </div>
@endif

<style>
    #good-hands::before {
        background-color: {{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;" : '#fff;' }}
    }

</style>
