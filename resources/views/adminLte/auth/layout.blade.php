@php
    if (check_module('Localization')) {
        $current_lang = Modules\Localization\Entities\Language::where('code', LaravelLocalization::getCurrentLocale())->first();
    }
@endphp
<!DOCTYPE html>
@if(isset($current_lang) && $current_lang->dir == 'rtl')
<html lang="{{LaravelLocalization::getCurrentLocale()}}" direction="rtl" dir="rtl" style="direction: rtl;">
@else
<html lang="{{LaravelLocalization::getCurrentLocale()}}">
@endif
    <head>
        <title>{{ config('app.name') . ' | ' . ($pageTitle ?? 'Dashboard') }}</title>
        <meta name="description" content="Algoriza - Framework" />
        <meta name="keywords" content="Algoriza - Framework" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{ config('app.name') }}" />

        @php
            $model = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
        @endphp
        <link rel="shortcut icon" href="{{ $model->getFirstMediaUrl('system_logo') ? $model->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" />

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- fontawesome-free -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/fontawesome/css/all.min.css">
        <!-- icheck-bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/adminlte.css">
        @if(isset($current_lang) && $current_lang->dir == 'rtl')
            <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/rtl.css">
        @else
            <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/ltr.css">
        @endif


        @yield('styles')
    </head>
    <body class="hold-transition login-page">

		<!-- Main content -->
		@yield('content')

        <!-- jQuery -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
        <script src="{{ asset('assets/lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
        <script src="{{ asset('assets/lte') }}/js/adminlte.js"></script>

        {{-- Show message alert from session flash --}}
		@include('adminLte.helpers.message-alert')

        @yield('scripts')

    </body>
</html>
