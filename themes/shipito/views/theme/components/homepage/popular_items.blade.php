@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';

$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$headingTitleColor = array_key_exists('heading_title_color', $data) && $data['heading_title_color'] ? "color: {$data['heading_title_color']} !important;" : '';
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp


@if (array_key_exists('display', $data) && $data['display'])

    <div class="container not-mobile aos-init aos-animate" data-aos="fade-up" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : '' }}">
        <div class="carousel slide" id="carousel-popular">
        <div class="carousel-inner">
            <div class="item active">
            <div class="row row-eq-height popular-items not-mobile">
                <div class="col-sm-4 col-xs-4 popular-item">
                    <img class="popular-item-img img-responsive" src="{{ theme_setting_image($section->id,'popular_1_img') != '' ? theme_setting_image($section->id,'popular_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/PopularItem1.png'))) }}" />
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                    <img class="popular-item-img img-responsive" src="{{ theme_setting_image($section->id,'popular_2_img') != '' ? theme_setting_image($section->id,'popular_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/PopularItem2.png'))) }}" />
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                    <img class="popular-item-img img-responsive"  src="{{ theme_setting_image($section->id,'popular_3_img') != '' ? theme_setting_image($section->id,'popular_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/PopularItem3.png'))) }}"  />
                </div>
            </div>
            <div class="row row-eq-height popular-items not-mobile">
                <div class="col-sm-4 col-xs-4 popular-item">
                    <div class="popular-item-caption" style="{{ $titleColor }}" >{{$data['title_1_popular'][app()->getLocale()] ?? ''}}</div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                    <div class="popular-item-caption" style="{{ $titleColor }}">{{$data['title_2_popular'][app()->getLocale()] ?? ''}}</div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                     <div class="popular-item-caption" style="{{ $titleColor }}" >{{$data['title_3_popular'][app()->getLocale()] ?? ''}}</div>
                </div>
            </div>
            <div class="row row-eq-height popular-items not-mobile">
                <div class="col-sm-4 col-xs-4 popular-item">
                    <div class="popular-item-caption-small" style="{{ $textColor }}">
                        {{$data['description_1_popular'][app()->getLocale()] ?? ''}}
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item" style="{{ $textColor }}" >
                    <div class="popular-item-caption-small">
                        {{$data['description_2_popular'][app()->getLocale()] ?? ''}}
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item" style="{{ $textColor }}">
                    <div class="popular-item-caption-small">
                        {{$data['description_3_popular'][app()->getLocale()] ?? ''}}
                    </div>
                </div>
            </div>
            </div>
            <div class="item">
            <div class="row row-eq-height popular-items not-mobile">
                <div class="col-sm-4 col-xs-4 popular-item">
                    <img class="popular-item-img img-responsive" src="{{ theme_setting_image($section->id,'popular_1_img') != '' ? theme_setting_image($section->id,'popular_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/PopularItem1.png'))) }}" />
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                    <img class="popular-item-img img-responsive" src="{{ theme_setting_image($section->id,'popular_2_img') != '' ? theme_setting_image($section->id,'popular_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/PopularItem2.png'))) }}" />
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                    <img class="popular-item-img img-responsive"  src="{{ theme_setting_image($section->id,'popular_3_img') != '' ? theme_setting_image($section->id,'popular_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/PopularItem3.png'))) }}"  />
                </div>
            </div>
            <div class="row row-eq-height popular-items not-mobile">
                <div class="col-sm-4 col-xs-4 popular-item">
                    <div class="popular-item-caption" style="{{ $titleColor }}" > {{$data['title_1_popular'][app()->getLocale()] ?? ''}} </div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                    <div class="popular-item-caption" style="{{ $titleColor }}" >{{$data['title_2_popular'][app()->getLocale()] ?? ''}}</b></div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                    <div class="popular-item-caption" style="{{ $titleColor }}" >{{$data['title_3_popular'][app()->getLocale()] ?? ''}}</div>
                </div>
            </div>
            <div class="row row-eq-height popular-items not-mobile">
                <div class="col-sm-4 col-xs-4 popular-item">
                <div class="popular-item-caption " style="{{ $textColor }}" >{{$data['description_1_popular'][app()->getLocale()] ?? ''}} </div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                <div class="popular-item-caption" style="{{ $textColor }}"> {{$data['description_2_popular'][app()->getLocale()] ?? ''}} </div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                <div class="popular-item-caption" style="{{ $textColor }}" > {{$data['description_3_popular'][app()->getLocale()] ?? ''}} </div>
                </div>
            </div>
            <div class="row row-eq-height popular-items not-mobile">
                <div class="col-sm-4 col-xs-4 popular-item">
                <div class="popular-item-caption-small"> {{$data['sub_description_1_popular'][app()->getLocale()] ?? ''}} </div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                <div class="popular-item-caption-small"> {{$data['sub_description_2_popular'][app()->getLocale()] ?? ''}} </div>
                </div>
                <div class="col-sm-4 col-xs-4 popular-item">
                <div class="popular-item-caption-small"> {{$data['sub_description_3_popular'][app()->getLocale()] ?? ''}} </div>
                </div>
            </div>
            </div>
        </div>
        <a class="left carousel-control popular-nav-prev" href="#carousel-popular" data-slide="prev" >
                <img style="width: 40px; vertical-align: middle" src="{{ asset('themes/shipito/assets/imgs/home/PopularArrowLeft.svg') }}" />
            </a>
        <a class="right carousel-control popular-nav-next" href="#carousel-popular" data-slide="next" >
                <img style="width: 40px; vertical-align: middle" src="{{ asset('themes/shipito/assets/imgs/home/PopularArrowRight.svg') }}" />
            </a>
        </div>
</div>


@endif

<style>
    #good-hands::before {
        background-color: {{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;" : '#fff;' }}
    }

</style>
