
@php
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
@endphp

<!-- features section -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="features" class="" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    <div class="container-fluid ">
      <div class="row feature">
        @if(isset($data['image_place']) && $data['image_place'] == 'start')
          <div class="col-md-6 px-0">
            <div class="feature-img">
              <img  src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/2.svg'))) }}" alt="Demo" />
            </div>
          </div>
          <div class="col-md-12 col-lg-5 offset-lg-1">
            <div class="feature-content">
              <h2 class="section-title" style="{{$titleColor}}">
                {{$data['section_title'][app()->getLocale()] ?? ''}}
              </h2>
              <ul class="feature-list">
                <li style="list-style: none ; {{$textColor}}"> {{$data['section_description'][app()->getLocale()] ?? ''}} </li>
              </ul>
            </div>
          </div>
        @else
          <div class="col-md-12 col-lg-5 offset-lg-1">
            <div class="feature-content">
              <h2 class="section-title" style="{{$titleColor}}">
                {{$data['section_title'][app()->getLocale()] ?? ''}}
              </h2>
              <ul class="feature-list">
                <li style="list-style: none ; {{$textColor}}"> {{$data['section_description'][app()->getLocale()] ?? ''}} </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 px-0">
            <div class="feature-img">
              <img  src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/2.svg'))) }}" alt="Demo" />
            </div>
          </div>
        @endif
      </div>
    </div>
</section>
@endif

