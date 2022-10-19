@php
    $header_setting = theme_setting('header.header');
    if(!$header_setting) $header_setting = array();
    $repoPosts = new Modules\Blog\Repositories\PostRepository();
    $new_articles_count = array_key_exists('new_articles_count', $header_setting) && $header_setting['new_articles_count'] ? intval($header_setting['new_articles_count']) : 21;
    $latest_posts = $repoPosts->getPosts('latest', $new_articles_count);
@endphp

<ul class="nav-list close-web-menu list-unstyled mb-0">
    @if (array_key_exists('display_home_icon', $header_setting) && $header_setting['display_home_icon'])
        <li class="nav-item">
            <a class="nav-link" href="{{ fr_route('home') }}" style="{{ array_key_exists('header_text_color', $header_setting) && $header_setting['header_text_color'] ? "color: {$header_setting['header_text_color']};" :  ''  }}">@lang('theme_easyship::view.home') </a>
        </li>
    @endif
    {!! get_menu_header() !!}
</ul>


<style type="text/css" media="all">

  @media (max-width: 1000px)
  {
    .close-web-menu{
        display: none !important;
    }
  }
</style>


