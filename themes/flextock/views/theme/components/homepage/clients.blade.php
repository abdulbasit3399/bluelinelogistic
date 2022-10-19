@php
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

<!-- clients -->
@if(array_key_exists('display', $data) && $data['display'])
<section class="clients-section"   style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
        <h2 data-i18n="headerFifthSection">{{$data['clients_main_title'][app()->getLocale()] ?? ''}}</h2>
        <div class="clients-section--circle"></div>
        <div class="clients-section--content">
        @php
            $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
        @endphp

            <div class="clients-type--container">
                <div class="client">
                    <picture>
                        <source srcset="{{ asset('themes/flextock/assets/webp/skycraper.webp') }}" type="image/webp">
                        </source>
                        <img src="{{ theme_setting_image($section->id,'clients_1_image') != '' ? theme_setting_image($section->id,'clients_1_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/skycraper.png'))) }}"  class="clients-section--image" alt="Image of a company HQ">

                    </picture>
                    <h3 data-i18n="b2bs" style="{{ $titleColor }}" >{{$data['clients_1_title'][app()->getLocale()] ?? ''}}</h3>
                    <p data-i18n="b2bsDescribtion" style="{{ $textColor }}" >{{$data['clients_1_description'][app()->getLocale()] ?? ''}} </p>
                </div>
                <div class="client">
                    <picture>
                        <source srcset="{{ asset('themes/flextock/assets/webp/delivery.webp') }}" type="image/webp">
                        </source>
                        <img src="{{ theme_setting_image($section->id,'clients_2_image') != '' ? theme_setting_image($section->id,'clients_2_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/imgs/delivery.png'))) }}"   class="clients-section--image" alt="Handing order to the client">

                    </picture>
                    <h3 data-i18n="b2cs" style="{{ $titleColor }}" >{{$data['clients_2_title'][app()->getLocale()] ?? ''}}</h3>
                    <p data-i18n="b2csDescribtion" style="{{ $textColor }}" >{{$data['clients_2_description'][app()->getLocale()] ?? ''}}</p>
                </div>
            </div>
            <div class="clients-section--action">
                <form action="{{$data['section_url'][$button_type] ?? ''}}" method="get">
                    <button data-i18n="getStarted" onclick="openGetStartedModal()" class="white-button"  style="{{$buttonColor }} {{$buttonBgColor}}" >{{$data['clients_1_button'][app()->getLocale()] ?? ''}} </button>
                </form>
                @php
                    $button_type = isset($data['section_2_url']) ? $data['section_2_url']['type'] : '';
                @endphp
                <a href="{{$data['section_2_url'][$button_type] ?? ''}}" data-i18n="header.about" class="outline-button"  >{{$data['clients_2_button'][app()->getLocale()] ?? ''}} </a>
            </div>

        </div>
</section>
@endif

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>



