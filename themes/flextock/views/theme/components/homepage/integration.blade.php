@php

$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '' ;
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '' ;
@endphp





    <!-- integration -->
@if(array_key_exists('display', $data) && $data['display'])
<section class="integration-section container" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
        <div class="integration-section--text">
            <h2 data-i18n="integrationHeader" style="{{$titleColor}}">{{$data['integration_main_title'][app()->getLocale()] ?? ''}}</h2>
            <p data-i18n="integrationDef" style="{{$textColor}}" >{{$data['integration_main_description'][app()->getLocale()] ?? ''}} </p>
        </div>
        <div class="integration-section--icons">
            <div class="half-circle">
                <div class="icon-container">
                    <picture>
                        <source srcset="{{asset('themes/flextock/assets/webp/facebook.webp')}}" type="image/webp">
                        <img src="{{ theme_setting_image($section->id,'integration_1_image') != '' ? theme_setting_image($section->id,'integration_1_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/facebook.png'))) }}" alt="Facebook">
                    </picture>
                </div>
                <div class="icon-container">
                    <picture>
                        <source srcset="{{asset('themes/flextock/assets/webp/shopify.webp')}}" type="image/webp">
                        <img src="{{ theme_setting_image($section->id,'integration_2_image') != '' ? theme_setting_image($section->id,'integration_2_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/shopify.png'))) }}" alt="Shopify">
                    </picture>
                </div>
                <div class="icon-container">
                    <picture>
                        <source srcset="{{asset('themes/flextock/assets/webp/woo.webp')}}" type="image/webp">
                        <img src="{{ theme_setting_image($section->id,'integration_3_image') != '' ? theme_setting_image($section->id,'integration_3_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/woo.png'))) }}" alt="Woo">
                    </picture>
                </div>
                <div class="icon-container">
                    <picture>
                        <source srcset="{{asset('themes/flextock/assets/webp/odoo.webp')}}" type="image/webp">
                        <img src="{{ theme_setting_image($section->id,'integration_4_image') != '' ? theme_setting_image($section->id,'integration_4_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/odoo.png'))) }}" alt="Odoo">
                    </picture>
                </div>
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
