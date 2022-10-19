@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';

$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';



@endphp


@if (array_key_exists('display', $data) && $data['display'])

<div class="container container-mobile"  style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : '' }}">
    <div class="row" style="margin: 0 0 0 0">
        <div data-aos="fade-up" class="col-sm-6 col-xs-12 aos-init aos-animate" style="padding: 0 0 0 0">
            <div class="youshop">
                <table>
                    <tbody>
                        <tr>
                        {{-- <td style="vertical-align: top"><div class="numberCircle">1</div></td> --}}
                        <td class="youshop" style="{{ $textColor }}" >{{ $data['works_1_description'][app()->getLocale()] ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <img class="img-responsive" src="{{ theme_setting_image($section->id,'works_1_img') != '' ? theme_setting_image($section->id,'works_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/youshop/YouShop1.jpg'))) }}" />
        </div>
        <div data-aos="fade-up" class="col-sm-6 col-xs-12 aos-init aos-animate" style="padding: 0 0 0 0">
            {{-- <div class="step2a light">Shop Online</div> --}}
            <div class="step2b light">{{ $data['works_3_description'][app()->getLocale()] ?? '' }}</div>
                <div class="youshop">
                    <table>
                        <tbody>
                            <tr>
                            {{-- <td style="vertical-align: top"><div class="numberCircle">2</div></td> --}}
                            <td class="youshop" style="{{ $textColor }}" >{{ $data['works_2_description'][app()->getLocale()] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <img class="img-responsive" src="{{ theme_setting_image($section->id,'works_2_img') != '' ? theme_setting_image($section->id,'works_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/youshop/YouShop2.svg'))) }} " />
            </div>
        </div>
</div>

@endif

<style>
    #good-hands::before {
        background-color: {{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;" : '#fff;' }}
    }

</style>
