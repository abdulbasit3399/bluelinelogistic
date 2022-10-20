<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('pageTitle') | {{ \Str::title(get_general_setting('website_title', config('app.name'))) }} </title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

        <style>
            @import url(https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,300);
        body {margin:0;background:#41465c;font-weight:300;color:#404040;font-family: "RobotoDraft", Helvetica, Arial, sans-serif;letter-spacing:.1px;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;}

            .toolbar {height:64px;background:rgb(223, 223, 223);overflow:hidden;}
            </style>
    <style>
        .dropdown-toggle::after {
            display: none;
          }
        .text-decoration-none{
          text-decoration: none!important;
        }
        /* Font Awesome Icons have variable width. Added fixed width to fix that.*/
        .icon-width { width: 2rem;}
    </style>
    <style>
        .bl{
            color: rgb(0, 110, 255); !important
        }
    </style>
    @yield('styles')

    @stack('prepend-scripts')
    </head>

<body>
{{--  <div class="container">
    <div class="row">
        <div class="col-12 text-center">
        <img src="{{ asset('assets/lte/bll.png') }}" alt="" height="80px" width="160px">
        </div>
    </div>
</div>  --}}

@yield('content')


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


<!-- jQuery -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>  --}}
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        {{--  <script src="{{ asset('assets/lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  --}}

        <script src="{{ asset('assets/lte') }}/js/adminlte.js"></script>
        <!-- Select2 -->
        <script src="{{ asset('assets/lte') }}/plugins/select2/js/select2.full.min.js"></script>
        <!--begin::Custom javascript-->
		<script src="{{ asset('assets/global/js/app.js') }}"></script>
		<script src="{{ asset('assets/custom/js/custom.js') }}"></script>
@yield('scripts')
@stack('push-scripts')
</html>
