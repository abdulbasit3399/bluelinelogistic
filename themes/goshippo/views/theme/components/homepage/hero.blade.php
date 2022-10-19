
@php
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : 'color: ;';
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : 'color: ;';
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : 'color: ;';
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : 'background-color: ;';
@endphp

<!-- banner -->
<section id="banner" aria-label="banner" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : 'background-color: #fff;' }}">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="intro">
          <h1 class="heading ff-header" style="{{$titleColor}}" >{{$data['section_title'][app()->getLocale()] ?? ''}}</h1>
          <p class="sub ff-header" style="{{$textColor}}">
            {{$data['section_description'][app()->getLocale()] ?? ''}}
          </p>

          @php
            $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
          @endphp
          <div class="actions d-flex align-items-center">
            <form action="{{$data['section_url'][$button_type] ?? ''}}">
              <button type="submit" class="btn btn-primary " style="  color: #7fad34; {{$buttonColor }} {{$buttonBgColor}} ">
                {{$data['section_button'][app()->getLocale()] ?? ''}}
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="wrapper">
          <img
            src="{{ theme_setting_image($section->id,'section_banner') != '' ? theme_setting_image($section->id,'section_banner') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/4.svg'))) }}"
            alt="hero"
          />
        </div>
      </div>
    </div>
  </div>
</section>
