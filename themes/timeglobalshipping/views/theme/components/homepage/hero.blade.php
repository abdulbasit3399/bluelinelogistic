
@php

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
@endphp

<!-- banner/hero -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="banner" class="" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
  <div class="banner-img " style="background: url({{ theme_setting_image($section->id,'image') != '' ? theme_setting_image($section->id,'image') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/home-page-banner.jpg'))) }}) ; height: 500px; z-index: -1; background-size: cover; background-position: right; "></div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="banner-content">
            <h1 class="section-title" style="{{$titleColor}}" >{{$data['section_title'][app()->getLocale()] ?? ''}}</h1>
            <p class="section-subtitle" style="{{$textColor}}" >{{$data['section_description'][app()->getLocale()] ?? ''}} </p>
          </div>
        </div>
    </div>
  </div>
</section>
@endif

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>
