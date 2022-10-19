<!-- start-shipping -->
@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    // $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

<!-- help section -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="help" class="section-lg bg-secondary" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">

    @php
        $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
    @endphp

        <div class="container">
          <h2 class="section-title" style="{{$textColor}}" >
            {{$data['section_description'][app()->getLocale()] ?? ''}}
            <a href="{{$data['section_url'][$button_type] ?? ''}}" style="{{$buttonColor }} {{$buttonBgColor}}" class="btn btn-primary rounded-pill">{{$data['section_button'][app()->getLocale()] ?? ''}}</a>
          </h2>
        </div>

</section>
@endif
