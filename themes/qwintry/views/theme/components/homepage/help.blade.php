<!-- start-shipping -->
@php

$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$description_color = array_key_exists('description_color', $data) && $data['description_color'] ? "color: {$data['description_color']} !important;" : '';

$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';
$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$Button_attachment = array_key_exists('Button_attachment_description_color', $data) && $data['Button_attachment_description_color'] ? "color: {$data['Button_attachment_description_color']} !important;" : '';
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';

@endphp
<!-- open-calculator -->
@if (array_key_exists('display', $data) && $data['display'])
    <section id="open-calculator"   style="padding-top:70px ;margin-bottom: -79px; {{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : '' }}">


        <div class="intro text-center text-black">
            <h2 class="" style="{{ $titleColor }}"> {{ $data['section_title1'][app()->getLocale()] ?? '' }}</h2>
            <p class="text-lg" style="{{ $description_color }}"> {{ $data['section_title2'][app()->getLocale()] ?? '' }} </p>
        </div>

    </section>
@endif




