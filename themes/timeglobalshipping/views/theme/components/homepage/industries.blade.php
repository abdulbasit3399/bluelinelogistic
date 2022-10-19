@php

$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';


$cardTitleColor = array_key_exists('card_title_color', $data) && $data['card_title_color'] ? "color:
{$data['card_title_color']} !important;" : '' ;
$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :
'' ;
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']}
!important;" : '' ;
@endphp

<!-- our-credentials section -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="our-credentials" class="section-lg py-0" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">




    <!-- industries section -->
    <section id="industries" class="section-lg">
        <div class="container">
  
          <div class="owl-carousel owl-theme">
            <div class="item">
              <img height="80" width="80" src="{{ theme_setting_image($section->id,'industries_1_img') != '' ? theme_setting_image($section->id,'industries_1_img') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/construction-site.png'))) }}" alt="industry" />
              <h5 style="{{ $titleColor }}" >{{$data['title_1_industries'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="item">
              <img height="80" width="80" src="{{ theme_setting_image($section->id,'industries_2_img') != '' ? theme_setting_image($section->id,'industries_2_img') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/food.png'))) }}" alt="industry" />
              <h5 style="{{ $titleColor }}" >{{$data['title_2_industries'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="item">
              <img height="80" width="80" src="{{ theme_setting_image($section->id,'industries_3_img') != '' ? theme_setting_image($section->id,'industries_3_img') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/fmcg.png'))) }}" alt="industry" />
              <h5 style="{{ $titleColor }}" >{{$data['title_3_industries'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="item">
              <img height="80" width="80" src="{{ theme_setting_image($section->id,'industries_4_img') != '' ? theme_setting_image($section->id,'industries_4_img') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/retail.png'))) }}" alt="industry" />
              <h5 style="{{ $titleColor }}" >{{$data['title_4_industries'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="item">
              <img height="80" width="80" src="{{ theme_setting_image($section->id,'industries_5_img') != '' ? theme_setting_image($section->id,'industries_5_img') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/eletronics.png'))) }}" alt="industry" />
              <h5 style="{{ $titleColor }}" >{{$data['title_5_industries'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="item">
              <img height="80" width="80" src="{{ theme_setting_image($section->id,'industries_6_img') != '' ? theme_setting_image($section->id,'industries_6_img') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/healthcare.png'))) }}" alt="industry" />
              <h5 style="{{ $titleColor }}" >{{$data['title_6_industries'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="item">
              <img height="80" width="80" src="{{ theme_setting_image($section->id,'industries_7_img') != '' ? theme_setting_image($section->id,'industries_7_img') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/automotive.png'))) }}" alt="industry" />
              <h5 style="{{ $titleColor }}" >{{$data['title_7_industries'][app()->getLocale()] ?? ''}}</h5>
            </div>
            <div class="item">
              <img height="80" width="80" src="{{ theme_setting_image($section->id,'industries_8_img') != '' ? theme_setting_image($section->id,'industries_8_img') : (get_general_setting('website_logo', asset('themes/timeglobalshipping/assets/images/oil-industires.png'))) }}" alt="industry" />
              <h5 style="{{ $titleColor }}" >{{$data['title_8_industries'][app()->getLocale()] ?? ''}}</h5>
            </div>
          </div>
        </div>
      </section>
@endif


<style>
.business {
    background-color: {
            {
            array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;": '';
        }
    }
}
</style>