
@if(array_key_exists('display', $data) && $data['display'])
<!-- supercharge -->
<section id="supercharge" class="section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    <div class="container">
        <div class="intro mt-4">
            <h2 class="heading" style="{{ array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '' }}">{{$data['section_title'][app()->getLocale()] ?? ''}}</h2>
        </div>
    </div>
</section>
@endif