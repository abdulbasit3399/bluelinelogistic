@php

$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '' ;
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '' ;
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '' ;
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp


<!-- desc -->
@if(array_key_exists('display', $data) && $data['display'])
<section class="desc-section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    @php
        $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
    @endphp

    <form action="{{$data['section_url'][$button_type] ?? ''}}">
        <div class="desc-section--content">
            <h2 style="{{ $textColor }}" data-i18n="headerSecondSection">{{$data['desc_main_title'][app()->getLocale()] ?? ''}}</h2>
            <div class="desc-section--icons">
                <img src="{{ theme_setting_image($section->id,'desc_1_image') != '' ? theme_setting_image($section->id,'desc_1_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/delivery_location.svg'))) }}"  class="desc-img" alt="Delivery Truck">
                <img src="{{  asset('themes/flextock/assets/icons/between-two.svg') }}" class="desc-img" alt="Next Step">
                <img src="{{ theme_setting_image($section->id,'desc_2_image') != '' ? theme_setting_image($section->id,'desc_2_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/pick_parcel.svg'))) }}"  class="desc-img" alt="Picking up pracel">
                <img src="{{  asset('themes/flextock/assets/icons/between-three.svg') }}"  class="desc-img" alt="Next Step">
                <img src="{{ theme_setting_image($section->id,'desc_3_image') != '' ? theme_setting_image($section->id,'desc_3_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/deliver_service.svg'))) }}" class="desc-img" alt="Delivery man delivering package">
            </div>
            <ul class="desc-section--list">
                <li style="{{$titleColor}}" data-i18n="firstListSecondSection">{{$data['desc_1_description'][app()->getLocale()] ?? ''}}</li>
                <li style="{{$titleColor}}" data-i18n="secondListSecondSection">{{$data['desc_2_description'][app()->getLocale()] ?? ''}}</li>
                <li style="{{$titleColor}}" data-i18n="thirdListSecondSection">{{$data['desc_3_description'][app()->getLocale()] ?? ''}}</li>
                <li style="{{$titleColor}}" data-i18n="fourthListSecondSection">{{$data['desc_4_description'][app()->getLocale()] ?? ''}}</li>
            </ul>
            <button  data-i18n="getStarted" onclick="openGetStartedModal()" class="blue-button" style="{{$buttonColor }} {{$buttonBgColor}}" >{{$data['section_button'][app()->getLocale()] ?? ''}}</button>
        </div>
    </form>
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
