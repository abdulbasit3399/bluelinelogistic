
@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

<!-- banner -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="banner" class="section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
  <div class="container">
    <div class="intro">
      <h1 class="heading">
        <span style="{{$titleColor}}" class="title">{{$data['section_title'][app()->getLocale()] ?? ''}}</span>
        <br />
        <span
          class="typer"
          id="main"
          data-words="{{$data['section_subtitle1'][app()->getLocale()] ?? ''}},{{$data['section_subtitle2'][app()->getLocale()] ?? ''}},{{$data['section_subtitle3'][app()->getLocale()] ?? ''}}"
          data-delay="10"
          data-colors="#276095"
          data-deleteDelay="2000"
        ></span>
        <!-- <span class="cursor" data-owner="main"></span> -->
      </h1>
      <p class="sub" style="{{$textColor}}">
        {{$data['section_description'][app()->getLocale()] ?? ''}}
      </p>

      @php
          $button_type = $data['section_url']['type'];
      @endphp
      <form action="{{$data['section_url'][$button_type] ?? ''}}">
        <button type="submit" class="btn btn-primary" style="{{$buttonColor }} {{$buttonBgColor}}">
          {{$data['section_button'][app()->getLocale()] ?? ''}}
        </button>
      </form>
    </div>
    <div class="wrapper">
      <img style="max-width: 360px;max-height: 320px;" src="{{ theme_setting_image($section->id,'section_mobile_banner') != '' ? theme_setting_image($section->id,'section_mobile_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/images/banner-pricing-static.webp'))) }}" alt="banner" class="graphic d-lg-none" />
      <img
        style="max-width: 830px;max-height: 596px;"
        src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/sm.svg'))) }}"
        alt="banner"
        class="graphic d-none d-lg-block"
      />
    </div>
  </div>
</section>
@endif

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>

