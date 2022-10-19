
@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';

$textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
$titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
$link_color  = array_key_exists('link_color', $data) && $data['link_color'] ? "color: {$data['link_color']} !important;" :  '' ;
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';

@endphp

<!-- pages -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="pages" class="section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
<div class="container">

    <div class="row contents">
        <div class="col-6">
            <div class="row text-black">
                
            <div class="col-md-4 col-lg-6">
                <img class="w-100"  src="{{ theme_setting_image($section->id,'section_pages1') != '' ? theme_setting_image($section->id,'section_pages1') : (get_general_setting('website_logo', asset('themes/qwintry/assets/images/pic-contact.jpg'))) }}" alt="contact" />
            </div>
            <div class="col-md-8 col-lg-6">
                    <h3 style="{{$titleColor}}" >{{$data['section_title'][app()->getLocale()] ?? ''}}</h3>
                    <p class="text-lg" style="{{$textColor}}" > {{$data['section_description'][app()->getLocale()] ?? ''}} </p>

                    @php
                        $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
                    @endphp


                    <a href="{{ $data['section_url'][$button_type] ?? '' }}" class="link w-icon" style="{{ $link_color }}" >{{$data['section_button'][app()->getLocale()] ?? ''}}</a>
            </div>
            </div>
        </div>

        <div class="col-6">
            <div class="row text-black">
                <div class="col-md-4 col-lg-6">
                    <img class="w-100"  src="{{ theme_setting_image($section->id,'section_pages2') != '' ? theme_setting_image($section->id,'section_pages2') : (get_general_setting('website_logo', asset('themes/qwintry/assets/images/pic-about.jpg'))) }}" alt="contact" />
                </div>
                <div class="col-md-8 col-lg-6">
                    <h3 style="{{$titleColor}}" >{{$data['section_title1'][app()->getLocale()] ?? ''}}</h3>
                    <p class="text-lg" style="{{$textColor}}" > {{$data['section_description1'][app()->getLocale()] ?? ''}} </p>
                    
                    @php
                        $button_type = isset($data['section_2_url']) ? $data['section_2_url']['type'] : '';
                    @endphp

                    <a href="{{ $data['section_2_url'][$button_type] ?? '' }}" class="link w-icon"  style="{{ $link_color }}">{{$data['section_2_button'][app()->getLocale()] ?? ''}}</a>
                </div>
            </div>
        </div>
    </div>

</div>
</section>
@endif

<style>
.typer{
color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
}
</style>
