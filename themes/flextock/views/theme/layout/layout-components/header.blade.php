@php
    $header_setting = theme_setting('header.header');
    if(!$header_setting) $header_setting = array();
@endphp

<div class="bdaia-header-default">
<header id="main-header" class="active {{ array_key_exists('header_style', $header_setting) && $header_setting['header_style'] == 'dark_style' ? "dark_style" :  'light_style'  }}">

    <nav id="navigation" class="navbar dropdown-light" aria-label="primary" >
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div  class="logo site--logo">
                    <a href="{{ fr_route('home') }}" rel="home" title="{{ config('app.name') }}">
                        <img src="{{ theme_setting_image('header','header_logo') != '' ? theme_setting_image('header','header_logo') : asset('assets/lte/cargo-logo-small-h38.svg') }}" alt="{{ config('app.name') }}" />
                    </a>
                </div>

                {{-- begin::nav --}}
                @include('theme.layout.layout-components.header.nav')
                {{-- end::nav --}}
            </div>

            <div class="mobile-items">
                <button id="nav-open" class="btn btn-sm px-3 bars d-lg-none stop-propagation" aria-label="navbar toggle" style="{{ array_key_exists('header_text_color', $header_setting) && $header_setting['header_text_color'] ? "color: {$header_setting['header_text_color']};" :  ''  }}">
                    <i data-feather="menu"></i>
                </button>
                <!-- dropdowns -->

                    <ul class="nav-components bd-components">
                        @if (array_key_exists('display_sign_in', $header_setting) && $header_setting['display_sign_in'])
                        <li class="components-item">
                            <a href="{{ fr_route('admin.dashboard') }}">
                                <span class="bdaia-ns-btn mr-3" style="display: inline-block; height: 50px; line-height: 50px">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="27" viewBox="0 0 24 24" style="width:auto" ><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/></svg>
                                </span>
                            </a>
                        </li>
                        @endif

                        @if (array_key_exists('display_tracking_search', $header_setting) && $header_setting['display_tracking_search'])
                        <!-- Start:: Header Search -->
                        <li class="bd-search-bar components-item">
                            <span class="bdaia-ns-btn mr-3" style="display: inline-block; height: 50px; line-height: 50px">
                                <svg style="width:auto" height="22" viewBox="0 0 959.36 820.05" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m959.24 34.19c0-20.57-13.59-34.19-34.13-34.19h-889.94c-21.95 0-35.17 13.23-35.17 35.18q0 114.24 0 228.48 0 202.48 0 405c0 21.21 13.47 34.59 34.72 34.6q91.5 0 183 .1c4.33 0 5.71-1 5.64-5.52q-.41-25.74 0-51.49c.08-4.92-1-6.48-6.26-6.45-49 .22-98 .14-147 .11-7.7 0-6.86 1-6.86-7q0-185.73-.11-371.47c0-4.89 1-6.44 6.21-6.41 38.66.25 77.32 0 116 .25 4.91 0 6.08-1.45 6-6.17q-.4-25.74 0-51.49c.08-4.69-1.35-5.81-5.89-5.79-38.83.17-77.66 0-116.49.19-4.48 0-5.87-1-5.85-5.73.2-38.83.11-77.66.11-116.49 0-6.62 0-6.63 6.77-6.63h260.51q279.74 0 559.47-.1c4.66 0 6.18.94 6.15 5.94q-.33 58.74 0 117.49c0 4.45-1.21 5.54-5.58 5.52-39.16-.17-78.33 0-117.49-.18-3.87 0-5.18 1-5.13 5q.33 26.24 0 52.49c-.06 4.46 1 6 5.74 5.94 20.83-.27 41.66-.12 62.5-.12 18.33 0 36.66.12 55-.09 4.06 0 5.41 1.3 4.89 5.11a27.23 27.23 0 0 0 0 3.5q0 200.73-.11 401.47c0 4.76 1.15 6.21 6 6.12 17.16-.3 34.33-.25 51.49 0 4.4.06 6-.87 5.94-5.69q-.2-315.75-.13-631.48z"/><path fill="currentColor" d="m707.52 631.15c-2.35-2.34-3.68-3.9-1-7.35 50-65.7 69.2-139.55 56.86-221.16-8.92-59-34.49-110.2-75.82-153.2-56.56-58.78-126.14-87.73-203.69-89.44-26.34-.07-54 3.42-76.7 9.45q-87.28 23.2-146.17 91.74c-40.19 47-62.55 101.6-68 163.09a272.35 272.35 0 0 0 4.71 79.43c16.18 78 57.39 139.51 123.5 183.53 61.71 41.08 129.93 55.28 203.29 44.15 47.88-7.27 90.85-26.13 129.39-55.31 6.13-4.64 4.72-5 10.25.56q70.54 70.49 141 141.11c3.2 3.21 4.75 3 7.74-.12 11.83-12.2 24-24.12 36-36.13 4.52-4.52 4.52-4.52 0-9q-70.64-70.69-141.36-141.35zm-3.34-179.94c-1.83 121-101.88 221-224.65 221-123.4 0-226.67-102.46-224.47-228.69 2.13-121.15 102.52-221.25 224.66-220.27 123.08-1.05 226.38 101.75 224.46 227.96z"/><path fill="currentColor" d="m154.93 96q-27.45.18-54.9 0c-3 0-4.09.9-4.07 4q.17 27.69 0 55.4c0 3.14 1.18 4 4.12 3.94 9.15-.13 18.3 0 27.45 0s18.31-.11 27.45.06c3.23.06 4.36-.92 4.34-4.24q-.19-27.45 0-54.91c.01-3.47-1.22-4.32-4.39-4.25z"/><path fill="currentColor" d="m196 159.29c18.31-.1 36.61-.14 54.92 0 3.73 0 4.43-1.45 4.38-4.72-.16-9-.06-18-.06-27 0-9.15-.13-18.3.06-27.45.06-3.32-1.09-4.28-4.32-4.26q-27.47.19-54.92 0c-2.93 0-4.14.77-4.12 3.93q.18 27.71 0 55.41c-.01 3.18 1.06 4.11 4.06 4.09z"/><path fill="currentColor" d="m292.38 159.3c9-.15 18-.05 27-.05 9.16 0 18.32-.08 27.48.05 3 0 4.52-.52 4.49-4.06-.15-18.48-.11-37 0-55.44 0-2.73-.76-3.86-3.67-3.84q-28 .14-55.94 0c-2.86 0-3.74 1-3.72 3.8.08 18.48.12 37 0 55.44-.11 3.49 1.28 4.16 4.36 4.1z"/><path fill="currentColor" d="m367.25 447.61c0-30.15-.05-60.29.06-90.44 0-3.65-.59-5.32-4.87-5.26-18 .24-36 .18-54 0-3.52 0-4.54 1.09-4.53 4.57q.12 91.19 0 182.37c0 3.64 1.27 4.46 4.63 4.43 17.82-.13 35.65-.18 53.47 0 4.14 0 5.34-1.11 5.31-5.29-.15-30.09-.07-60.23-.07-90.38z"/><path fill="currentColor" d="m596.74 351.92c-3.72 0-4.82 1-4.82 4.78q.18 90.93 0 181.88c0 3.81 1.22 4.77 4.88 4.74 17.65-.17 35.31-.22 53 0 4.43.06 5.61-1.19 5.58-5.59-.19-30-.1-60-.1-89.94 0-30.15-.07-60.3.08-90.44 0-3.94-.73-5.54-5.13-5.48-17.85.28-35.67.23-53.49.05z"/><path fill="currentColor" d="m463.25 431.91c0-25-.09-50 .08-74.93 0-4-1.13-5.1-5.08-5.06q-26.72.3-53.45 0c-3.65 0-4.88.92-4.87 4.74q.18 74.93 0 149.86c0 3.75 1.12 4.82 4.83 4.78 17.65-.17 35.3-.2 52.95 0 4.3.06 5.7-1 5.66-5.51-.23-24.59-.12-49.24-.12-73.88z"/><path fill="currentColor" d="m559.25 431.59c0-24.82-.07-49.63.06-74.45 0-3.68-.64-5.3-4.88-5.24-18 .24-36 .19-54 0-3.53 0-4.53 1.07-4.53 4.55q.15 75.21 0 150.4c0 3.65 1.3 4.44 4.64 4.42 17.82-.13 35.65-.18 53.47 0 4.15.06 5.34-1.13 5.3-5.3-.15-24.74-.06-49.56-.06-74.38z"/></svg>
                            </span>
                            <div class="bdaia-ns-wrap components-sub-menu mr-3" style="opacity: 0; display: none; transform: translateY(0px);">
                                <div class="bdaia-ns-content">
                                    <div class="bdaia-ns-inner">
                                        <form class="form" action="{{route('shipments.tracking')}}" method="GET">
                                            <input type="text" class="bbd-search-field search-live" id="code" name="code" placeholder="{{ __('cargo::view.enter_your_tracking_code') }}"
                                                 autocomplete="off" />

                                            <button type="submit" class="bbd-search-btn"><span class="bdaia-io bdaia-io-ion-ios-search-strong"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- END:: Header Search -->
                        @endif

                    </ul>


                @if (array_key_exists('display_language_switcher', $header_setting) && $header_setting['display_language_switcher'])
                    @if(check_module('Localization'))
                    <div class="dropdowns">
                        <div class="position-relative">
                            <span class="" data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="{{ array_key_exists('header_text_color', $header_setting) && $header_setting['header_text_color'] ? "color: {$header_setting['header_text_color']};" :  ''  }}">

                                <svg height="22" viewBox="0 0 22 22" style="width:auto" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor" transform=""><path d="m11 22c-6.06517241 0-11-4.9348276-11-11 0-6.06517241 4.93482759-11 11-11 6.0651724 0 11 4.93482759 11 11 0 6.0651724-4.9348276 11-11 11zm0-21.24137931c-5.64717241 0-10.24137931 4.5942069-10.24137931 10.24137931 0 5.6471724 4.5942069 10.2413793 10.24137931 10.2413793 5.6471724 0 10.2413793-4.5942069 10.2413793-10.2413793 0-5.64717241-4.5942069-10.24137931-10.2413793-10.24137931z"/><path d="m11 22c-3.40317241 0-6.17289655-4.9348276-6.17289655-11 0-6.06517241 2.76972414-11 6.17289655-11 3.4031724 0 6.1728966 4.93482759 6.1728966 11 0 6.0651724-2.7697242 11-6.1728966 11zm0-21.24137931c-2.98593103 0-5.41427586 4.5942069-5.41427586 10.24137931 0 5.6471724 2.42834483 10.2413793 5.41427586 10.2413793 2.985931 0 5.4142759-4.5942069 5.4142759-10.2413793 0-5.64717241-2.4283449-10.24137931-5.4142759-10.24137931z"/><path d="m21.6206897 11.3793103h-21.24137935c-.20937932 0-.37931035-.169931-.37931035-.3793103s.16993103-.3793103.37931035-.3793103h21.24137935c.2093793 0 .3793103.169931.3793103.3793103s-.169931.3793103-.3793103.3793103z"/><path d="m20.1944828 6.06896552h-18.38896556c-.20937931 0-.37931034-.16993104-.37931034-.37931035s.16993103-.37931034.37931034-.37931034h18.38896556c.2093793 0 .3793103.16993103.3793103.37931034s-.169931.37931035-.3793103.37931035z"/><path d="m20.1944828 16.6896552h-18.38896556c-.20937931 0-.37931034-.1699311-.37931034-.3793104s.16993103-.3793103.37931034-.3793103h18.38896556c.2093793 0 .3793103.169931.3793103.3793103s-.169931.3793104-.3793103.3793104z"/><path d="m11 22c-.2093793 0-.3793103-.169931-.3793103-.3793103v-21.24137935c0-.20937932.169931-.37931035.3793103-.37931035s.3793103.16993103.3793103.37931035v21.24137935c0 .2093793-.169931.3793103-.3793103.3793103z"/></g></svg>

                                &nbsp;

                                {{LaravelLocalization::getCurrentLocaleName()}}
                            </span>
                            <div class="dropdown-menu" style="margin-top: 15px">
                                @foreach(Modules\Localization\Entities\Language::all() as $key => $language)
                                    <a @if($language->name == LaravelLocalization::getCurrentLocaleName()) class="dropdown-item active" @else class="dropdown-item" @endif  href="{{ LaravelLocalization::getLocalizedURL($language->code) }}" >{{$language->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </nav>
</header>
</div>

<!-- Mobile Menu -->
<nav aria-label="primary mobile" class="drawer d-lg-none">
    <header class="header d-lg-none d-flex justify-content-between align-items-center">
      <img src="{{ theme_setting_image('header','header_logo') != '' ? theme_setting_image('header','header_logo') : asset('assets/lte/cargo-logo-small-h38.svg') }}" alt="{{ config('app.name') }}" />
      <button id="nav-close" class="btn p-0 stop-propagation">
        <i data-feather="x"></i>
      </button>
    </header>

    <div class="body">
      <ul class="nav-list list-unstyled mb-0">
        @if (array_key_exists('display_home_icon', $header_setting) && $header_setting['display_home_icon'])
            <li class="nav-item">
                <a class="nav-link" href="{{ fr_route('home') }}" style="{{ array_key_exists('header_text_color', $header_setting) && $header_setting['header_text_color'] ? "color: {$header_setting['header_text_color']};" :  ''  }}">@lang('theme_easyship::view.home') </a>
            </li>
        @endif
        {!! get_menu_header() !!}
      </ul>
    </div>
</nav>
