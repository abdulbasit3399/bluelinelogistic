@php
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $mintitleColor  = array_key_exists('min_title_color', $data) && $data['min_title_color'] ? "color: {$data['min_title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

    <!-- e2e -->
@if(array_key_exists('display', $data) && $data['display'])
<section class="e2e-section"   style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">

        @php
            $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
        @endphp


        <h2 data-i18n="e2eHeader" style="{{ $mintitleColor }}" >{{$data['e2e_main_title'][app()->getLocale()] ?? ''}}</h2>
        <div class="e2e-container">
            <div class="e2e-card">
                <picture>
                    <source srcset="{{asset('themes/flextock/assets/webp/first-mile.webp')}}" type="image/webp">
                    <img src="{{ theme_setting_image($section->id,'e2e_1_image') != '' ? theme_setting_image($section->id,'e2e_1_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/first-mile.png'))) }}" alt="Loaded Truck">
                </picture>
                <h3 style="{{ $titleColor }}"  data-i18n="e2efirstHeader">{{$data['e2e_1_title'][app()->getLocale()] ?? ''}}</h3>
                <p style="{{ $textColor }}" data-i18n="e2efirstdef">{{$data['e2e_1_description'][app()->getLocale()] ?? ''}} </p>
            </div>
            <div class="e2e-card">
                <picture>
                    <source srcset="{{asset('themes/flextock/assets/webp/last-mile.webp')}}" type="image/webp">
                    <img src="{{ theme_setting_image($section->id,'e2e_2_image') != '' ? theme_setting_image($section->id,'e2e_2_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/last-mile.png'))) }}" alt="Loaded Truck">
                </picture>
                <h3 style="{{ $titleColor }}"  data-i18n="e2eSecondHeader">{{$data['e2e_2_title'][app()->getLocale()] ?? ''}}</h3>
                <p style="{{ $textColor }}" data-i18n="e2eSecondDef">{{$data['e2e_2_description'][app()->getLocale()] ?? ''}} </p>
            </div>
            <div class="e2e-card">
                <picture>
                    <source srcset="{{asset('themes/flextock/assets/webp/global-shipping.webp')}}" type="image/webp">
                    <img src="{{ theme_setting_image($section->id,'e2e_3_image') != '' ? theme_setting_image($section->id,'e2e_3_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/cash-collection.png'))) }}" alt="Loaded Truck">
                </picture>
                <h3 style="{{ $titleColor }}"  data-i18n="e2ethreeHeader">{{$data['e2e_3_title'][app()->getLocale()] ?? ''}}</h3>
                <p style="{{ $textColor }}" data-i18n="e2ethreeDef">{{$data['e2e_3_description'][app()->getLocale()] ?? ''}} </p>
            </div>
            <div class="e2e-card">
                <picture>
                    <source srcset="{{asset('themes/flextock/assets/webp/global-shipping.webp')}}" type="image/webp">
                    <img src="{{ theme_setting_image($section->id,'e2e_4_image') != '' ? theme_setting_image($section->id,'e2e_4_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/global-shipping.png'))) }}" alt="Loaded Truck">
                </picture>
                <h3 style="{{ $titleColor }}"  data-i18n="e2eFourHeader">{{$data['e2e_4_title'][app()->getLocale()] ?? ''}}</h3>
                <p style="{{ $textColor }}" data-i18n="e2eFourDef">{{$data['e2e_4_description'][app()->getLocale()] ?? ''}} </p>
            </div>
        </div>
        <form action="{{$data['section_url'][$button_type] ?? ''}}" method="get">
            <button data-i18n="getStarted" onclick="openGetStartedModal()" class="blue-button"   style="{{$buttonColor }} {{$buttonBgColor}}"  >  {{$data['section_button'][app()->getLocale()] ?? ''}}  </button>
        </form>

</section>
@endif

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>



