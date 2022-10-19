<!-- start-shipping -->
@php
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

<!-- contact-us section -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="contact-us" class="bg-secondary mb-5 " style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">

        @php
            $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
        @endphp

            <div class="container">
              <div class="row">
                <div class="col-12">
                  <h2 class="section-title text-white" style="{{$textColor}}">{{$data['section_description'][app()->getLocale()] ?? ''}}</h2>
                </div>
                <div class="col-12">
                  <p class="">
                   <q style="{{$textColor}}" > Call:</q>
                    <a class="phone" >{{$data['phone'][app()->getLocale()] ?? ''}}</a>
                    <span class="text-uppercase">or</span>
                    <a href="{{$data['section_url'][$button_type] ?? ''}}" class="btn btn-primary rounded-pill"style="{{$buttonColor }} {{$buttonBgColor}}" >{{$data['section_button'][app()->getLocale()] ?? ''}}</a>
                  </p>
                </div>
              </div>
            </div>

</section>
@endif
