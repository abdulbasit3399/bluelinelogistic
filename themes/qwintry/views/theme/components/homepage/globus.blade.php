@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';
$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$Button_attachment = array_key_exists('Button_attachment_description_color', $data) && $data['Button_attachment_description_color'] ? "color: {$data['Button_attachment_description_color']} !important;" : '';
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp
<!-- banner -->
@if (array_key_exists('display', $data) && $data['display'])
    <section id="globus" class="section " style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : '' }}">

        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="intro">
                <h2 style="{{ $titleColor }}" > {{ $data['section_title'][app()->getLocale()] ?? '' }} </h2>
                <p class="text-lg" style="{{ $textColor }}" > {{ $data['section_description'][app()->getLocale()] ?? '' }} </p>

                <p class="text-lg"> {{ $data['section_description1'][app()->getLocale()] ?? '' }} </p>

                @php
                    $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
                @endphp


                <a href="{{ $data['section_url'][$button_type] ?? '' }}" class="link w-icon text-lg" style="{{ $buttonColor }} {{ $buttonBgColor }}" >{{ $data['section_button'][app()->getLocale()] ?? '' }}</a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="wrapper">
                <img src="{{ theme_setting_image($section->id, 'section_1_banner') != '' ? theme_setting_image($section->id, 'section_1_banner') : get_general_setting('website_logo', asset('themes/qwintry/assets/images/globus.png')) }}" alt="globus" />
              </div>
            </div>
          </div>
        </div>

    </section>
@endif
<style>
    .typer {
        color: {{ array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;' }}
    }

</style>
