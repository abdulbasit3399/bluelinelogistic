@php

    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';


    $cardTitleColor  = array_key_exists('card_title_color', $data) && $data['card_title_color'] ? "color: {$data['card_title_color']} !important;" :  '' ;
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
@endphp

<!-- why-us section -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="why-us" class="section bg-light" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    <div class="container">
        <ul class="list">
          <li>
            <div>
              <img width="70" src="{{ theme_setting_image($section->id,'section_banner_1_whyus') != '' ? theme_setting_image($section->id,'section_banner_1_whyus') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/Conversations.png'))) }}"  alt="demo" />
              <h5 style="{{$titleColor}}" > {{$data['title_1_whyus'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="content">
              <p style="{{$textColor}}"> {{$data['description_1_whyus'][app()->getLocale()] ?? ''}} </p>
            </div>
          </li>
          <li>
            <div>
              <img width="70" src="{{ theme_setting_image($section->id,'section_banner_2_whyus') != '' ? theme_setting_image($section->id,'section_banner_2_whyus') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/Compromise.png'))) }}"  alt="demo" />
              <h5 style="{{$titleColor}}" > {{$data['title_2_whyus'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="content">
              <p style="{{$textColor}}"> {{$data['description_2_whyus'][app()->getLocale()] ?? ''}} </p>
            </div>
          </li>
          <li>
            <div>
              <img width="70" src="{{ theme_setting_image($section->id,'section_banner_3_whyus') != '' ? theme_setting_image($section->id,'section_banner_3_whyus') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/Collabration.png'))) }}"  alt="demo" />
              <h5 style="{{$titleColor}}" > {{$data['title_3_whyus'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="content">
              <p style="{{$textColor}}"> {{$data['description_3_whyus'][app()->getLocale()] ?? ''}} </p>
            </div>
          </li>
          <li>
            <div>
              <img width="70" src="{{ theme_setting_image($section->id,'section_banner_4_whyus') != '' ? theme_setting_image($section->id,'section_banner_4_whyus') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/Exqulifi-03.png'))) }}"  alt="demo" />
              <h5 style="{{$titleColor}}" > {{$data['title_4_whyus'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="content">
              <p style="{{$textColor}}"> {{$data['description_4_whyus'][app()->getLocale()] ?? ''}} </p>
            </div>
          </li>
        </ul>
      </div>
</section>
@endif


<style>
    .business{
      background-color: {{array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;" : '';}}
    }
  </style>
