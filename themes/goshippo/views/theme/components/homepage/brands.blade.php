@php
    $card_1_bg_color  = array_key_exists('card_1_bg_color', $data) && $data['card_1_bg_color'] ? "background-color: {$data['card_1_bg_color']} !important;" : '';
    $card_title_1_color  = array_key_exists('card_title_1_color', $data) && $data['card_title_1_color'] ? "color: {$data['card_title_1_color']} !important;" : '';
    $card_desc_1_color  = array_key_exists('card_desc_1_color', $data) && $data['card_desc_1_color'] ? "color: {$data['card_desc_1_color']} !important;" : '';
    $card_1_button_text_color = array_key_exists('card_1_button_text_color', $data) && $data['card_1_button_text_color'] ? "color: {$data['card_1_button_text_color']} !important;" : '';
    $card_1_button_bg_color = array_key_exists('card_1_button_bg_color', $data) && $data['card_1_button_bg_color'] ? "background-color: {$data['card_1_button_bg_color']} !important;" : '';

@endphp

<!-- brands  -->
<section id="brands" class="section pt-3" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : 'background-color: #fff;' }}">
    <div class="container">
        <img src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/5.svg'))) }}" alt="logo" />
    </div>
</section>
