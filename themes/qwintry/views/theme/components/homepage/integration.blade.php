@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';
$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$buttonColor1 = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '';
$buttonColor = array_key_exists('button_text_color1', $data) && $data['button_text_color1'] ? "color: {$data['button_text_color1']} !important;" : '';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
$buttonBgColor1 = array_key_exists('button_bg_color1', $data) && $data['button_bg_color1'] ? "background-color: {$data['button_bg_color1']} !important;" : '';
@endphp
<!-- integration -->
@if (array_key_exists('display', $data) && $data['display'])
    <section id="integration" class="section py-0 mt-5 mb-5 p-3"
        style=" {{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : '' }}">
        <div class="container-fluid">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-6">
                    <div class="intro">
                        <h2 style="{{ $titleColor }}">{{ $data['section_title'][app()->getLocale()] ?? '' }}</h2>
                        <p class="text-lg" style="{{ $textColor }}">
                            {{ $data['section_description'][app()->getLocale()] ?? '' }} </p>
                        <div class="actions d-flex flex-column flex-md-row align-items-start">

                            <img width="55" height="55"
                                src="{{ theme_setting_image($section->id, 'section_integration1') != '' ? theme_setting_image($section->id, 'section_integration1') : get_general_setting('website_logo', asset('themes/qwintry/assets/images/icon-code.svg')) }}"
                                alt="icon code" />
                            <div class="d-flex flex-column">
                                @php
                                    $button_type = isset($data['link1']) ? $data['link1']['type'] : '';
                                @endphp

                                <div class="d-flex flex-column align-items-center flex-md-row">
                                    <form class="mb-3">
                                        <a href="{{ $data['link1'][$button_type] ?? '' }}"
                                            class="btn  btn-lg fa-10x p-0"
                                            style="{{ $buttonColor }} {{ $buttonBgColor }}">
                                            {{ $data['section_button'][app()->getLocale()] ?? '' }}
                                            <i class="fa-solid fa-greater-than ml-3 fa-sm"></i>
                                        </a>
                                    </form>
                                </div>

                                @php
                                    $button_type = isset($data['link2']) ? $data['link2']['type'] : '';
                                @endphp

                                <form action="{{ $data['link2'][$button_type] ?? '' }}">
                                    <button type="submit" class="btn  button"
                                        style="{{ $buttonColor1 }} {{ $buttonBgColor1 }}">
                                        {{ $data['section_button1'][app()->getLocale()] ?? '' }} </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper">
                        <img style=" height: 516px; width: 395px;  "
                            src="{{ theme_setting_image($section->id, 'section_integration2') != '' ? theme_setting_image($section->id, 'section_integration2') : get_general_setting('website_logo', asset('themes/qwintry/assets/images/mobile.png')) }}"
                            alt="mobile" />
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
