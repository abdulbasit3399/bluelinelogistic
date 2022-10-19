@php

$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

<!-- start-fullfilment -->
@if (array_key_exists('display', $data) && $data['display'])
    <section class="start-fullfilment"
        style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : '' }}">

        <div class="start-fullfilment--content">
            <div class="start-fullfilment--header">
                <h1 data-i18n="startFullfillment" style="{{ $titleColor }}">
                    {{ $data['start-fullfilment_title'][app()->getLocale()] ?? '' }}</h1>
                <p data-i18n="startFullfillmentDef" style="{{ $textColor }}">
                    {{ $data['start-fullfilment_description'][app()->getLocale()] ?? '' }} </p>
                <div class="shap-style"></div>
             </div>
        </div>
    </section>
@endif

<style>
    .typer {
        color: {{ array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;' }}
    }

</style>
