
@php

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
@endphp

<!-- about-us section -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="about-us" class="section-lg" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
        <div class="container">
            <h2   class="section-title">{{$data['first_title'][app()->getLocale()] ?? ''}}<span style="{{$titleColor}}" class="text-primary">{{$data['second_title'][app()->getLocale()] ?? ''}}</span></h2>
            <p style="{{$textColor}}" class="section-subtitle">
                {{$data['first_description'][app()->getLocale()] ?? ''}}
            </p>
        </div>
</section>
@endif

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>
