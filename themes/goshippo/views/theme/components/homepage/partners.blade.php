@php
    $card_title_1_color  = array_key_exists('card_title_1_color', $data) && $data['card_title_1_color'] ? "color: {$data['card_title_1_color']} !important;" : '';
    $card_desc_1_color  = array_key_exists('card_desc_1_color', $data) && $data['card_desc_1_color'] ? "color: {$data['card_desc_1_color']} !important;" : '';
    $card_1_button_text_color = array_key_exists('card_1_button_text_color', $data) && $data['card_1_button_text_color'] ? "color: {$data['card_1_button_text_color']} !important;" : '';
    $card_1_button_bg_color = array_key_exists('card_1_button_bg_color', $data) && $data['card_1_button_bg_color'] ? "background-color: {$data['card_1_button_bg_color']} !important;" : '';

@endphp

<!-- partners -->
<section id="partners" class="section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : 'background-color: #fff;' }}">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="groups">
                    <img src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/2.svg'))) }}" alt="partner" />                
                </div>
            </div>
        <div class="col-md-5">
            <div class="intro">
            <h2 class="heading" style="{{$card_title_1_color}}" >{{$data['card_title_1'][app()->getLocale()] ?? ''}}</h2>
            <p class="sub" style="{{$card_desc_1_color}}" > {{$data['card_description_1'][app()->getLocale()] ?? ''}}  </p>
            @php
                $button_type = isset($data['card_1_section_url']) ? $data['card_1_section_url']['type'] : '';
            @endphp
            <a href="{{$data['card_1_section_url'][$button_type] ?? ''}}"  class="link" style="{{$card_1_button_text_color }} {{$card_1_button_bg_color}}" >{{$data['card_1_section_button'][app()->getLocale()] ?? ''}}</a>
            </div>
        </div>
        </div>
    </div>

</section>
