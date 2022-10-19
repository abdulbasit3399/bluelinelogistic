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

<!-- why-us section -->
@if(array_key_exists('display', $data) && $data['display'])
<footer class="top-footer" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}"> 
    <div class="container">
        <div class="row">
        <div class="col-md-3 col-xs-6 text-center advantage">
            <span class="advantage-image"><img src="{{ theme_setting_image($section->id,'features_1_img') != '' ? theme_setting_image($section->id,'features_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/navigation/pricing.svg'))) }}"  /></span>
            <span class="advantage-service" style="{{ $titleColor }}"> {{$data['title_1_features'][app()->getLocale()] ?? ''}}</span>
            <span class="advantage-description" style="{{ $textColor }}"  >{{$data['description_1_features'][app()->getLocale()] ?? ''}}</span >
        </div>
        <div class="col-md-3 col-xs-6 text-center advantage">
            <span class="advantage-image"><img src="{{ theme_setting_image($section->id,'features_2_img') != '' ? theme_setting_image($section->id,'features_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/navigation/delivery.svg'))) }}" /></span>
            <span class="advantage-service" style="{{ $titleColor }}"> {{$data['title_2_features'][app()->getLocale()] ?? ''}}</span>
            <span class="advantage-description"style="{{ $textColor }}" >{{$data['description_2_features'][app()->getLocale()] ?? ''}}</span
            >
        </div>
        <div class="col-md-3 col-xs-6 text-center advantage">
            <span class="advantage-image"><img src="{{ theme_setting_image($section->id,'features_3_img') != '' ? theme_setting_image($section->id,'features_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/navigation/payment.svg'))) }}" /></span>
            <span class="advantage-service" style="{{ $titleColor }}" > {{$data['title_3_features'][app()->getLocale()] ?? ''}}</span>
            <span class="advantage-description" style="{{ $textColor }}" >{{$data['description_3_features'][app()->getLocale()] ?? ''}}</span>
        </div>
        <div class="col-md-3 col-xs-6 text-center advantage">
            <span class="advantage-image"><img src="{{ theme_setting_image($section->id,'features_4_img') != '' ? theme_setting_image($section->id,'features_4_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/navigation/safety.svg'))) }}" /></span>
            <span class="advantage-service" style="{{ $titleColor }}" > {{$data['title_4_features'][app()->getLocale()] ?? ''}}</span>
            <span class="advantage-description" style="{{ $textColor }}">{{$data['description_4_features'][app()->getLocale()] ?? ''}}</span >
        </div>
        </div>
    </div>
</footer>
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