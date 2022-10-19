
@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';

    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
@endphp




@if(array_key_exists('display', $data) && $data['display'])




    <div class="container container-mobile aos-init aos-animate" data-aos="fade-up" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}"  >
        <div class="row" style="margin: 0 0 0 0; padding-bottom: 10px; background-color: #f4f4f4">
            <div class="col-sm-2 col-xs-4">
                <img class="img-responsive" src="{{ theme_setting_image($section->id,'work_1_img') != '' ? theme_setting_image($section->id,'work_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/reasons/SaveShipping.svg'))) }}" />
                <div class="reason"  style="{{ $titleColor }}" >{{$data['description_1_work'][app()->getLocale()] ?? ''}}</div>
            </div>
            <div class="col-sm-2 col-xs-4">
                <img class="img-responsive" src="{{ theme_setting_image($section->id,'work_2_img') != '' ? theme_setting_image($section->id,'work_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/reasons/Consolidation.svg'))) }}" />
                <div class="reason" style="{{ $titleColor }}"> {{$data['description_2_work'][app()->getLocale()] ?? ''}}</div>
            </div>
            <div class="col-sm-2 col-xs-4">
                <img class="img-responsive" src="{{ theme_setting_image($section->id,'work_3_img') != '' ? theme_setting_image($section->id,'work_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/reasons/Photos.svg'))) }}" />
                <div class="reason" style="{{ $titleColor }}"> {{$data['description_3_work'][app()->getLocale()] ?? ''}}</div>
            </div>
            <div class="col-sm-2 col-xs-4 row-2">
                <img class="img-responsive" src="{{ theme_setting_image($section->id,'work_4_img') != '' ? theme_setting_image($section->id,'work_4_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/reasons/90days.svg'))) }}" />
                <div class="reason" style="{{ $titleColor }}" > {{$data['description_4_work'][app()->getLocale()] ?? ''}} </div>
            </div>
            <div class="col-sm-2 col-xs-4">
                <img class="img-responsive" src="{{ theme_setting_image($section->id,'work_5_img') != '' ? theme_setting_image($section->id,'work_5_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/reasons/TaxFree.svg'))) }}" />
                <div class="reason" style="{{ $titleColor }}"> {{$data['description_5_work'][app()->getLocale()] ?? ''}} </div>
            </div>
            <div class="col-sm-2 col-xs-4">
                <img class="img-responsive" src="{{ theme_setting_image($section->id,'work_7_img') != '' ? theme_setting_image($section->id,'work_7_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/reasons/CustSupport.svg'))) }}" />
                <div class="reason" style="{{ $titleColor }}" > {{$data['description_6_work'][app()->getLocale()] ?? ''}} </div>
            </div>
        </div>
    </div>


@endif

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>
