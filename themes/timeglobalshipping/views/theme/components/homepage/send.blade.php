
@php

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

  <!-- send section -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="send" class="section-lg" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 send-cards">
          <div class="send-card">
             <h3 style="{{$titleColor}}" class="send-title"> {{$data['first_title'][app()->getLocale()] ?? ''}}  </h3>
            <p style="{{$textColor}}">{{$data['first_description'][app()->getLocale()] ?? ''}}</p>
          </div>
           <div class="send-card">
            <h3  style="{{$titleColor}}" class="send-title"> {{$data['second_title'][app()->getLocale()] ?? ''}}  </h3>
            <p style="{{$textColor}}"> {{$data['second_description'][app()->getLocale()] ?? ''}} </p>
          </div>
          <div class="send-card">
            <h3 style="{{$titleColor}}" class="send-title"> {{$data['Third_title'][app()->getLocale()] ?? ''}}   </h3>
            <p style="{{$textColor}}"> {{$data['Third_description'][app()->getLocale()] ?? ''}}</p>
          </div>
          <div class="send-card">
            <h3 style="{{$titleColor}}" class="send-title"> {{$data['Fourth_title'][app()->getLocale()] ?? ''}}  </h3>
            <p style="{{$textColor}}">{{$data['Fourth_description'][app()->getLocale()] ?? ''}} </p>
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
