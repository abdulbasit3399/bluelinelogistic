<!-- start-shipping -->
@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';
$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$sub_description_color = array_key_exists('sub_description_color', $data) && $data['sub_description_color'] ? "color: {$data['sub_description_color']} !important;" : '';
$sub_title_color = array_key_exists('sub_title_color', $data) && $data['sub_title_color'] ? "color: {$data['sub_title_color']} !important;" : '';
$price_color = array_key_exists('price_color', $data) && $data['price_color'] ? "color: {$data['price_color']} !important;" : '';
$after_discount_color = array_key_exists('after_discount_color', $data) && $data['after_discount_color'] ? "color: {$data['after_discount_color']} !important;" : '';
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
    $footer_setting = theme_setting('homepage.open_calculator');
    if(!$footer_setting) $footer_setting = array();
@endphp
<!-- open-calculator -->
@if (array_key_exists('display', $footer_setting) && array_key_exists('count', $footer_setting) && $footer_setting['display'])
    <section id="open-calculator" class="section"style="{{ array_key_exists('header_bg', $data) && $data['header_bg']? "background-color: {$data['header_bg']} !important;": '' }}"> <div class="container-fluid">

        <div class="intro text-center text-black">
            <h2 class="" style="{{ $titleColor }}"> {{ $data['section_title1'][app()->getLocale()] ?? '' }}</h2>
            <p class="text-lg" style="{{ $sub_description_color }}"> {{ $data['section_title2'][app()->getLocale()] ?? '' }} </p>
        </div>

            @php
                $col_width = 'col-lg-12';
                if($footer_setting['count'] ==  3) {
                    $col_width = 'col-lg-4';
                }elseif($footer_setting['count']  == 2) {
                    $col_width = 'col-lg-6';
                }
            @endphp


        <div class="row footer-cols">
                <div class="{{$col_width}} col-md-6 text-center" >
                            <header>
                                <img  style=" max-width: 140px; " src="{{  theme_setting_image($section->id,'section_banner1')  != ''?  theme_setting_image($section->id,'section_banner1') : get_general_setting('website_logo', asset('themes/qwintry/assets/images/usps-logo-full.svg')) }}" alt="demo" />
                            </header>
                            <div class="body text-black">
                                <h3 style="{{ $sub_title_color }}"> {{ $data['sub_description1'][app()->getLocale()] ?? '' }} </h3>
                                <table class="mx-auto">
                                    <tbody>
                                        <tr>
                                            <td>@lang('theme_qwintry::view.retail')</td>
                                            <td style="{{ $price_color }}">
                                                {{ $data['before_discount1'][app()->getLocale()] ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('theme_qwintry::view.discounted')</td>
                                            <td class="text-primary" style="{{ $after_discount_color }}">
                                                {{ $data['after_discount1'][app()->getLocale()] ?? '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-muted">
                                    <p> {{ $data['description1'][app()->getLocale()] ?? '' }}</p>
                                </div>
                            </div>
                </div>


                @if ($footer_setting['count'] > 1)
                    <div class="{{$col_width}} col-md-6 text-center">

                            <header>
                                <img   style=" max-width: 140px; " src="{{ theme_setting_image($section->id,'section_banner2') != ''?  theme_setting_image($section->id,'section_banner2') : get_general_setting('website_logo', asset('themes/qwintry/assets/images/usps-logo-full.svg')) }}" alt="demo" />
                            </header>
                            <div class="body text-black">
                                <h3 style="{{ $sub_title_color }}"> {{ $data['sub_description2'][app()->getLocale()] ?? '' }} </h3>
                                <table class="mx-auto">
                                    <tbody>
                                        <tr>
                                            <td>@lang('theme_qwintry::view.retail')</td>
                                            <td style="{{ $price_color }}"> {{ $data['before_discount2'][app()->getLocale()] ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('theme_qwintry::view.discounted')</td>
                                            <td class="text-primary" style="{{ $after_discount_color }}">
                                                {{ $data['after_discount2'][app()->getLocale()] ?? '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-muted">
                                    <p> {{ $data['description2'][app()->getLocale()] ?? '' }}</p>
                                </div>
                            </div>

                    </div>
                @endif


                @if ($footer_setting['count'] > 2)
                    <div class="{{$col_width}} col-md-6 text-center">

                        <header>
                            <img   style=" max-width: 140px; " src="{{ theme_setting_image($section->id,'section_banner3') != ''?  theme_setting_image($section->id,'section_banner3') : get_general_setting('website_logo', asset('themes/qwintry/assets/images/usps-logo-full.svg')) }}" alt="demo" />
                        </header>
                        <div class="body text-black">
                            <h3 style="{{ $sub_title_color }}"> {{ $data['sub_description3'][app()->getLocale()] ?? '' }} </h3>
                            <table class="mx-auto">
                                <tbody>
                                    <tr>
                                        <td>@lang('theme_qwintry::view.retail')</td>
                                        <td style="{{ $price_color }}"> {{ $data['before_discount3'][app()->getLocale()] ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('theme_qwintry::view.discounted')</td>
                                        <td class="text-primary" style="{{ $after_discount_color }}">
                                            {{ $data['after_discount3'][app()->getLocale()] ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-muted">
                                <p> {{ $data['description3'][app()->getLocale()] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endif

        </div>
    </section>
@endif
