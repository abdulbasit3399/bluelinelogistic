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
        <title>{{ \Str::title(get_general_setting('company_name', config('app.name'))) . ' | ' . ($pageTitle ?? 'Dashboard') }}</title>
        <meta name="description" content="{{ \Str::title(get_general_setting('company_name', config('app.name'))) }}" />
        <meta name="keywords" content="{{ \Str::title(get_general_setting('company_name', config('app.name'))) }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{ \Str::title(get_general_setting('company_name', config('app.name'))) }}" />

        @php
            $model = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
        @endphp
        <link rel="shortcut icon" href="{{ $model->getFirstMediaUrl('system_logo') ? $model->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" />
        {{--  <link rel="shortcut icon" href="{{ asset('assets/lte/media/logos/bll.png') }}" />  --}}

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('assets/lte/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->

        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/select2/css/select2.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/adminlte.css">
        @if(isset($current_lang) && $current_lang->dir == 'rtl')
            <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/rtl.css">
        @else
            <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/ltr.css">
        @endif

        <!-- Datatable style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/datatable.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/summernote/summernote-bs4.min.css">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
        <!-- BS Stepper -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/bs-stepper/css/bs-stepper.min.css">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/dropzone/min/dropzone.min.css">
        <!-- flag-icon-css -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/flag-icon-css/css/flag-icon.min.css">

        <!--begin::Custom Stylesheets-->
		<link href="{{ asset('assets/global/css/app.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/custom/css/custom.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Custom Stylesheets-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Datatable style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/amr.css">

        <script>
			var hostUrl = "assets/";
			window._csrf_token = '{!! csrf_token() !!}'
		</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('assets/lte/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/lte/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->

        <livewire:styles />
        <livewire:scripts />
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        @yield('styles')
        <!-- signature pad -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed @if(isset($current_lang) && $current_lang->dir == 'rtl') rtl @endif">

        <div class="wrapper">

            <!-- Preloader -->
            @php
                $model = App\Models\Settings::where('group', 'general')->where('name','loading_logo')->first();
                $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
            @endphp
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ $model->getFirstMediaUrl('loading_logo') ? $model->getFirstMediaUrl('loading_logo') : ( $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/bll.png') ) }}" alt="Logo" height="60" width="60">
                {{--  <img class="animation__shake" src="{{ asset('assets/lte/media/logos/bll.png') }}" alt="Logo" height="60" width="60">  --}}

            </div>

            <!-- Navbar -->
            @include('adminLte.components.header')
            <!-- /.navbar -->

            <!--begin::Aside-->
            @include('adminLte.components.aside')
            <!--end::Aside-->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @include('adminLte.components.page-title')

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                    @yield('before-page')

                    {{ $slot }}

                    @yield('after-page')
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!--begin::Footer-->
            @include('adminLte.components.footer')
            <!--end::Footer-->

        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="{{ asset('assets/lte') }}/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="{{ asset('assets/lte') }}/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="{{ asset('assets/lte') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{ asset('assets/lte') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('assets/lte') }}/plugins/moment/moment.min.js"></script>
        <script src="{{ asset('assets/lte') }}/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('assets/lte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="{{ asset('assets/lte') }}/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('assets/lte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="{{ asset('assets/lte') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/lte') }}/js/adminlte.js"></script>
        <!-- Select2 -->
        <script src="{{ asset('assets/lte') }}/plugins/select2/js/select2.full.min.js"></script>
        <!--begin::Custom javascript-->
		<script src="{{ asset('assets/global/js/app.js') }}"></script>
		<script src="{{ asset('assets/custom/js/custom.js') }}"></script>
		<!--end::Custom javascript-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(function () {
            bsCustomFileInput.init();
            });
        </script>

		{{-- Show message alert from session flash --}}
		@include('adminLte.helpers.message-alert')
		<!--end::Javascript-->

        @yield('scripts')

		@stack('js-component')
    </body>
</html>
