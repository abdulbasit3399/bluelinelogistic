<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <title>@yield('page-title') | {{ \Str::title(get_general_setting('website_title', config('app.name'))) }} </title>
    <meta name="description" content="@yield('page-description', get_general_setting('website_description', config('app.description')))">
    <meta name="keywords" content="@yield('page-keywords',  get_general_setting('website_keywords'))">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    @php 
        $model = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
    @endphp
    <link rel="shortcut icon" href="{{ $model->getFirstMediaUrl('system_logo') ? $model->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/favicon.ico') }}" />

    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('page-title') | {{ get_general_setting('website_title', config('app.name')) }}">
    <meta property="og:description" content="@yield('page-description', get_general_setting('website_description', config('app.description')))">
    <meta property="og:type" content="@yield('page-type', 'website')">
    <meta property="og:image" content="@yield('page-image', get_general_setting('social_media_image'))">

    {{-- begin::styles --}}
    @include('theme.layout.layout-components.styles')
    {{-- end::styles --}}

    @yield('styles')


    @stack('prepend-scripts')
</head>
<body
        class="home page-template-default page wp-embed-responsive has-lazy-load"
        itemscope="itemscope"
        itemtype="https://schema.org/WebPage"
>

{{-- begin::header --}}
@include('theme.layout.layout-components.header')
{{-- end::header --}}



@yield('before-page')


{{-- begin::content --}}
@yield('content')
{{-- end::content --}}


@yield('after-page')

{{-- begin::footer --}}
@include('theme.layout.layout-components.footer')
{{-- end::footer --}}


{{-- begin::btn go to top --}}
<div class="gotop" title="Go Top"><span class="bdaia-io bdaia-io-ion-android-arrow-up"></span></div>
{{-- end::btn go to top --}}


{{-- begin::scripts --}}
@include('theme.layout.layout-components.scripts')
{{-- end::scripts --}}


@yield('scripts')

@stack('push-scripts')

</body>
</html>