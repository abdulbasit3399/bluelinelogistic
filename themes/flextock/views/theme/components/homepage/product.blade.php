@php

$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '' ;
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '' ;
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '' ;
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp





    <!-- product -->
@if(array_key_exists('display', $data) && $data['display'])
<section class="product-section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
        <div class="product-section--container">
            @php
                $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
            @endphp

            <div class="product-section--content">
                <h2 data-i18n="productHeader" style="{{$titleColor}}" >{{$data['product_main_title'][app()->getLocale()] ?? ''}}</h2>
                <ul class="production-section--features">
                    <li>
                        <img src="{{ theme_setting_image($section->id,'product_1_image') != '' ? theme_setting_image($section->id,'product_1_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/monitor.svg'))) }}" alt="Monitor inventory">
                        <p style="{{ $textColor }}"> <span class="golden-color" data-i18n="productmonitor">  </span> {{$data['product_1_description'][app()->getLocale()] ?? ''}} </p>
                    </li>
                    <li>
                        <img src="{{ theme_setting_image($section->id,'product_2_image') != '' ? theme_setting_image($section->id,'product_2_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/verify.svg'))) }}" alt="Verify fullfillment & fees">
                        <p style="{{ $textColor }}"> <span class="golden-color" data-i18n="productView">  </span>{{$data['product_2_description'][app()->getLocale()] ?? ''}} </p>
                    </li>
                    <li>
                        <img src="{{ theme_setting_image($section->id,'product_3_image') != '' ? theme_setting_image($section->id,'product_3_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/validate.svg'))) }}" alt="Validate shipment address">
                        <p style="{{ $textColor }}"> <span class="golden-color" data-i18n="productValidate">  </span> {{$data['product_3_description'][app()->getLocale()] ?? ''}}  </p>
                    </li>
                    <li>
                        <img src="{{ theme_setting_image($section->id,'product_4_image') != '' ? theme_setting_image($section->id,'product_4_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/predict.svg'))) }}" alt="Predict deplection and re-orders">
                        <p style="{{ $textColor }}"> <span class="golden-color" data-i18n="productPredict">  </span> {{$data['product_4_description'][app()->getLocale()] ?? ''}}   </p>
                    </li>
                </ul>
                <a href="{{$data['section_url'][$button_type] ?? ''}}" data-i18n="getStarted" onclick="openGetStartedModal()" class="blue-button" style="{{$buttonColor }} {{$buttonBgColor}}"  >{{$data['section_button'][app()->getLocale()] ?? ''}}</a>
            </div>
            <div class="product-section--img">
                <img src="{{ theme_setting_image($section->id,'product_main_image') != '' ? theme_setting_image($section->id,'product_main_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/dashboard.png'))) }}" alt="A picture of dashboard">
            </div>
        </div>



































</section>
@endif

<style>
.typer {
    color: {
            {
            array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;": '#222;';
        }
    }
}
</style>
