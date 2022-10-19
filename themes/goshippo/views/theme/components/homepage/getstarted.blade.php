@php
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : 'color: #222;';
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : 'color: #222;';
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : 'color: #222;';
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : 'background-color: #222;';
@endphp
<!-- subscribe -->
<section id="subscribe" class="section bg-light pt-5 pb-5" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : 'background-color: #fff;' }}">
    <div class="container">
        <div class="intro text-center">
            <h3 class="heading" style="{{$titleColor}}">{{$data['section_title'][app()->getLocale()] ?? ''}}</h3>
            <p class="sub" style="{{$textColor}}" >{{$data['section_subtitle'][app()->getLocale()] ?? ''}}</p>

            @php
                $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
            @endphp
            <form action="{{$data['section_url'][$button_type] ?? ''}}">
                <button type="submit" class="btn btn-primary btn-lg" style="{{$buttonColor }} {{$buttonBgColor}}">
                    {{$data['section_button'][app()->getLocale()] ?? ''}}
                </button>
            </form>
        </div>
    </div>
</section> 
