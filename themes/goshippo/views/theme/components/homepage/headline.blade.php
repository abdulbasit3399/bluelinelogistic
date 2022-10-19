<!-- services -->
<section id="services" class="section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : 'background-color: #fff;' }}">
    <div class="container" style="margin-top: 6rem;">
        <div class="intro">
            <h2 class="heading" style="{{ array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : 'color: #fff;' }}" >{{$data['section_title'][app()->getLocale()] ?? ''}}</h2>
            <p class="sub" style="{{ array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : 'color: #fff;' }}">{{$data['section_description'][app()->getLocale()] ?? ''}}</p>

        </div>
    </div>
</section>

<style>
    .container{
        padding: 0px !important;
    }
</style>
