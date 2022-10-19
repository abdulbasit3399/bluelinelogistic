
@php

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

    <!-- intro -->
@if(array_key_exists('display', $data) && $data['display'])
<section class="intro-section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    <div class="container">
        <div class="intro-section--introduction">
            <h1> 
                <span class="orange-text" >{{$data['section_title'][app()->getLocale()] ?? ''}}</span> 
            </h1> 
            <p  style="{{$textColor}}" >{{$data['section_description'][app()->getLocale()] ?? ''}} </p>
            <iframe width="100%" height="289"
                src="{{ isset($data['video_url']) ? $data['video_url'] : 'https://www.youtube.com/embed/tgbNymZ7vqY' }}?autoplay=1&mute=1&controls=1">
            </iframe>
        </div>
    </div>
</section>
@endif
