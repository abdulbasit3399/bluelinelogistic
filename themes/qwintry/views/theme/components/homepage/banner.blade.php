@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $Button_attachment  = array_key_exists('Button_attachment_description_color', $data) && $data['Button_attachment_description_color'] ? "color: {$data['Button_attachment_description_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp
<!-- banner -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="banner" class="section py-0" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
<div class="container">
        <div class="row ">
            <div class="col-lg-7" >
                <div class="intro text-black" >
                <h1 class="" style="{{$titleColor}}" >{{$data['section_title'][app()->getLocale()] ?? ''}}</h1>
                <p class="text-lg" style="{{$textColor}}"> {{$data['section_description'][app()->getLocale()] ?? ''}} </p>

                @php
                    $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
                @endphp
                <div class="d-flex flex-column align-items-center flex-md-row">
                    <form  action="{{$data['section_url'][$button_type] ?? ''}}">
                        <button type="submit" class="btn btn-primary btn-lg" style="{{$buttonColor }} {{$buttonBgColor}}">
                            {{$data['section_button'][app()->getLocale()] ?? ''}}
                        </button>
                    </form>
                    <span class="text-sm text-muted" style="{{ $Button_attachment }}" >  {{$data['section_description2'][app()->getLocale()] ?? ''}} </span>
                </div>
            </div>
            </div>

            <div class="col-lg-5">
            <div class="wrapper">
                <img style=" height: 380px;  width:  380px; "  src="{{ theme_setting_image($section->id,'section_1_banner') != '' ? theme_setting_image($section->id,'section_1_banner') : (get_general_setting('website_logo', asset('themes/qwintry/assets/images/banner.png'))) }}" alt="banner" class="banner" />
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
