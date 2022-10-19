
@php

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

<!-- blogs section -->
@if(array_key_exists('display', $data) && $data['display'])
<section class="statistic-section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
        <div class="container">
            <div class="stat-style">
                <div class="stat-icon"><img src="{{ theme_setting_image($section->id,'statistic_1_image') != '' ? theme_setting_image($section->id,'statistic_1_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/warehouses.svg'))) }}" alt="warehouses" /></div>
                <div class="stat-header"> <h1 style="{{$textColor}}">{{$data['statistic_1_counter'][app()->getLocale()] ?? ''}}</h1> </div>
                <div class="stat-content"> <h2 data-i18n="warehouses ">{{$data['statistic_1_title'][app()->getLocale()] ?? ''}} </h2> </div>
                <div class="stat-def"> <p data-i18n="warehousesDef" > {{$data['sstatistic_1_description'][app()->getLocale()] ?? ''}}</p> </div>
            </div>
            <div class="stat-style">
                <div class="stat-icon"><img src="{{ theme_setting_image($section->id,'statistic_2_image') != '' ? theme_setting_image($section->id,'statistic_2_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/online-store.svg'))) }}" alt="online-store" /></div>
                <div class="stat-header"> <h1 style="{{$textColor}}">{{$data['statistic_2_counter'][app()->getLocale()] ?? ''}}</h1> </div>
                <div class="stat-content"> <h2 data-i18n="ecommerceBusinesses ">{{$data['statistic_2_title'][app()->getLocale()] ?? ''}}</h2> </div>
                <div class="stat-def"> <p data-i18n="ecommerceBusinessesDef"  >{{$data['sstatistic_2_description'][app()->getLocale()] ?? ''}}</p> </div>
            </div>
            <div class="stat-style">
                <div class="stat-icon"><img src="{{ theme_setting_image($section->id,'statistic_3_image') != '' ? theme_setting_image($section->id,'statistic_3_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/map.svg'))) }}" alt="map" /></div>
                <div class="stat-header"> <h1 style="{{$textColor}}">{{$data['statistic_3_counter'][app()->getLocale()] ?? ''}}</h1> </div>
                <div class="stat-content"> <h2 data-i18n="cities ">{{$data['statistic_3_title'][app()->getLocale()] ?? ''}}</h2> </div>
                <div class="stat-def"> <p data-i18n="citiesDef"  >{{$data['sstatistic_3_description'][app()->getLocale()] ?? ''}}</p> </div>
            </div>
            <div class="stat-style">
                <div class="stat-icon"><img src="{{ theme_setting_image($section->id,'statistic_4_image') != '' ? theme_setting_image($section->id,'statistic_4_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/icons/targeted-head.svg'))) }}" alt="targeted-head" /></div>
                <div class="stat-header"> <h1 style="{{$textColor}}">{{$data['statistic_4_counter'][app()->getLocale()] ?? ''}}</h1> </div>
                <div class="stat-content"> <h2 data-i18n="accuracyRate ">{{$data['statistic_4_title'][app()->getLocale()] ?? ''}}</h2> </div>
                <div class="stat-def"> <p data-i18n="accuracyRateDef" >{{$data['sstatistic_4_description'][app()->getLocale()] ?? ''}}</p> </div>
            </div>
        </div>
</section>
@endif

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>



