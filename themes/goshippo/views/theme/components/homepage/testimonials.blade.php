@php
$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : 'color: #222;';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : 'color: #222;';
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : 'color: #222;';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : 'background-color: #222;';
@endphp
<!-- testimonials -->
<section id="testimonials" class="section"
    style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : 'background-color: #fff;' }}">




    <section id="testimonials" class="section">
        <div class="container">


            <div class="contents">
                <div class="app-carousel">

                    {{-- 1 --}}
                    <div class="card text-center bg-light">
                        <header class="header">
                            <div class="logo">
                                <img src="{{ theme_setting_image($section->id, 'section_1_logo') != '' ? theme_setting_image($section->id, 'section_1_logo') : get_general_setting('website_logo', asset('assets/lte/cargo-logo-small-h38.svg')) }}" alt="logo" />
                            </div>
                            <div class="avatar">
                                <img src="{{ theme_setting_image($section->id, 'section_1_avatar') != '' ? theme_setting_image($section->id, 'section_1_avatar') : get_general_setting('website_logo', asset('themes/goshippo/assets/images/greenbelly-meals.jpg')) }}" alt="avatar" />
                            </div>
                        </header>

                        <div class="body">
                            <h4 class="title" style="{{ $titleColor }}"> {{ $data['section_1_title'][app()->getLocale()] ?? '' }}</h4>
                            <div class="title"> {{ $data['section_1_sub_title'][app()->getLocale()] ?? '' }} </div>
                            <q class="text quote" style="{{ $textColor }}"> {{ $data['section_1_description'][app()->getLocale()] ?? '' }} </q>
                        </div>

                        <footer class="footer">
                            @php
                                $button_type = isset($data['section_1_url']) ? $data['section_1_url']['type'] : '';
                            @endphp
                            <a href="{{ $data['section_1_url'][$button_type] ?? '' }}" style="{{ $buttonColor }}" class="link">{{ $data['section_1_button'][app()->getLocale()] ?? '' }}</a>
                        </footer>
                    </div>

                    {{-- 2 --}}
                    <div class="card text-center bg-light">
                        <header class="header">
                            <div class="logo">
                                <img src="{{ theme_setting_image($section->id, 'section_2_logo') != '' ? theme_setting_image($section->id, 'section_2_logo') : get_general_setting('website_logo', asset('assets/lte/cargo-logo-small-h38.svg')) }}"
                                    alt="logo" />
                            </div>
                            <div class="avatar">
                                <img src="{{ theme_setting_image($section->id, 'section_2_avatar') != '' ? theme_setting_image($section->id, 'section_2_avatar') : get_general_setting('website_logo', asset('themes/goshippo/assets/images/greenbelly-meals.jpg')) }}"
                                    alt="avatar" />
                            </div>
                        </header>

                        <div class="body">
                            <h4 class="title" style="{{ $titleColor }}"> {{ $data['section_2_title'][app()->getLocale()] ?? '' }}</h4>
                            <div class="title"> {{ $data['section_2_sub_title'][app()->getLocale()] ?? '' }} </div>
                            <q class="text quote" style="{{ $textColor }}"> {{ $data['section_2_description'][app()->getLocale()] ?? '' }} </q>
                        </div>

                        <footer class="footer">
                            @php
                                $button_type = isset($data['section_2_url']) ? $data['section_2_url']['type'] : '';
                            @endphp
                            <a href="{{ $data['section_2_url'][$button_type] ?? '' }}" style="{{ $buttonColor }}"
                                class="link">{{ $data['section_2_button'][app()->getLocale()] ?? '' }}</a>
                        </footer>
                    </div>

                    {{-- 3 --}}
                    <div class="card text-center bg-light">
                        <header class="header">
                            <div class="logo">
                                <img src="{{ theme_setting_image($section->id, 'section_3_logo') != '' ? theme_setting_image($section->id, 'section_3_logo') : get_general_setting('website_logo', asset('assets/lte/cargo-logo-small-h38.svg')) }}" alt="logo" />
                            </div>
                            <div class="avatar">
                                <img src="{{ theme_setting_image($section->id, 'section_3_avatar') != '' ? theme_setting_image($section->id, 'section_3_avatar') : get_general_setting('website_logo', asset('themes/goshippo/assets/images/greenbelly-meals.jpg')) }}" alt="avatar" />
                            </div>
                        </header>

                        <div class="body">
                            <h4 class="title" style="{{ $titleColor }}"> {{ $data['section_3_title'][app()->getLocale()] ?? '' }}</h4>
                            <div class="title"> {{ $data['section_3_sub_title'][app()->getLocale()] ?? '' }} </div>
                            <q class="text quote" style="{{ $textColor }}">
                                {{ $data['section_3_description'][app()->getLocale()] ?? '' }}
                            </q>
                        </div>

                        <footer class="footer">
                            @php
                                $button_type = isset($data['section_3_url']) ? $data['section_3_url']['type'] : '';
                            @endphp
                            <a href="{{ $data['section_3_url'][$button_type] ?? '' }}" style="{{ $buttonColor }}"
                                class="link">{{ $data['section_3_button'][app()->getLocale()] ?? '' }}</a>
                        </footer>
                    </div>

                    {{-- 4 --}}
                    <div class="card text-center bg-light">
                        <header class="header">
                            <div class="logo">
                                <img src="{{ theme_setting_image($section->id, 'section_4_logo') != '' ? theme_setting_image($section->id, 'section_4_logo') : get_general_setting('website_logo', asset('assets/lte/cargo-logo-small-h38.svg')) }}"
                                    alt="logo" />
                            </div>
                            <div class="avatar">
                                <img src="{{ theme_setting_image($section->id, 'section_4_avatar') != '' ? theme_setting_image($section->id, 'section_4_avatar') : get_general_setting('website_logo', asset('themes/goshippo/assets/images/greenbelly-meals.jpg')) }}"
                                    alt="avatar" />
                            </div>
                        </header>

                        <div class="body">
                            <h4 class="title" style="{{ $titleColor }}"> {{ $data['section_4_title'][app()->getLocale()] ?? '' }}</h4>
                            <div class="title"> {{ $data['section_4_sub_title'][app()->getLocale()] ?? '' }} </div>
                            <q class="text quote" style="{{ $textColor }}">
                                {{ $data['section_4_description'][app()->getLocale()] ?? '' }}
                            </q>
                        </div>

                        <footer class="footer">
                            @php
                                $button_type = $data['section_4_url']['type'];
                            @endphp
                            <a href="{{ $data['section_4_url'][$button_type] ?? '' }}" style="{{ $buttonColor }}"
                                class="link">{{ $data['section_3_button'][app()->getLocale()] ?? '' }}</a>
                        </footer>
                    </div>

                    {{-- 5 --}}
                    <div class="card text-center bg-light">
                        <header class="header">
                            <div class="logo">
                                <img src="{{ theme_setting_image($section->id, 'section_5_logo') != '' ? theme_setting_image($section->id, 'section_5_logo') : get_general_setting('website_logo', asset('assets/lte/cargo-logo-small-h38.svg')) }}"
                                    alt="logo" />
                            </div>
                            <div class="avatar">
                                <img src="{{ theme_setting_image($section->id, 'section_5_avatar') != '' ? theme_setting_image($section->id, 'section_5_avatar') : get_general_setting('website_logo', asset('themes/goshippo/assets/images/greenbelly-meals.jpg')) }}"
                                    alt="avatar" />
                            </div>
                        </header>

                        <div class="body">
                            <h4 class="title" style="{{ $titleColor }}"> {{ $data['section_5_title'][app()->getLocale()] ?? '' }}</h4>
                            <div class="title"> {{ $data['section_5_sub_title'][app()->getLocale()] ?? '' }} </div>
                            <q class="text quote" style="{{ $textColor }}"> {{ $data['section_5_description'][app()->getLocale()] ?? '' }} </q>
                        </div>

                        <footer class="footer">
                            @php
                                $button_type = $data['section_5_url']['type'];
                            @endphp
                            <a href="{{ $data['section_5_url'][$button_type] ?? '' }}" style="{{ $buttonColor }}" class="link">{{ $data['section_5_button'][app()->getLocale()] ?? '' }}</a>
                        </footer>
                    </div>




                </div>
            </div>
        </div>
    </section>

</section>
<style>
    #testimonials .contents .row {
        margin-bottom: 0px !important;
    }

    #testimonials .container {
        padding: 0 0 0px !important;
    }

</style>
