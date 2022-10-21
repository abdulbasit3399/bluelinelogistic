<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('pageTitle') | {{ \Str::title(get_general_setting('website_title', config('app.name'))) }} </title>
        {{--  <!-- Datatable style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/datatable.min.css">
        <!-- overlayScrollbars -->  --}}
        {{--  <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/daterangepicker/daterangepicker.css">  --}}
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/summernote/summernote-bs4.min.css">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
        <!-- BS Stepper -->
        {{--  <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/bs-stepper/css/bs-stepper.min.css">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/dropzone/min/dropzone.min.css">
        <!-- flag-icon-css -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/flag-icon-css/css/flag-icon.min.css">  --}}

        <!--begin::Custom Stylesheets-->
		<link href="{{ asset('assets/global/css/app.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/custom/css/custom.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Custom Stylesheets-->

        {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />  --}}
        {{--  <!-- Datatable style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/amr.css">  --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />

    {{--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  --}}

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
{{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>  --}}
<script>
    $(document).ready(function () {
        if ($(window).width() > 991){
        $('.navbar-light .d-menu').hover(function () {
                $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
            }, function () {
                $(this).find('.sm-menu').first().stop(true, true).delay(120).slideUp(100);
            });
            }
        });
</script>
{{--  <script>

window.onload = function() {
    var heart = document.getElementsByClassName("heart");
    var classname = document.getElementsByClassName("tabitem");
    var boxitem = document.getElementsByClassName("box");

    var clickFunction = function(e) {
        e.preventDefault();
        var a = this.getElementsByTagName("a")[0];
        var span = this.getElementsByTagName("span")[0];
        var href = a.getAttribute("href").replace("#","");
        for(var i=0;i<boxitem.length;i++){
            boxitem[i].className =  boxitem[i].className.replace(/(?:^|\s)show(?!\S)/g, '');
        }
        document.getElementById(href).className += " show";
        for(var i=0;i<classname.length;i++){
            classname[i].className =  classname[i].className.replace(/(?:^|\s)active(?!\S)/g, '');
        }
        this.className += " active";
        span.className += 'active';
        var left = a.getBoundingClientRect().left;
        var top = a.getBoundingClientRect().top;
        var consx = (e.clientX - left);
        var consy = (e.clientY - top);
        span.style.top = consy+"px";
        span.style.left = consx+"px";
        span.className = 'clicked';
        span.addEventListener('webkitAnimationEnd', function(event){
            this.className = '';
        }, false);
    };

    for(var i=0;i<classname.length;i++){
        classname[i].addEventListener('click', clickFunction, false);
    }
    for(var i=0;i<heart.length;i++){
        heart[i].addEventListener('click', function(e) {
            var classString = this.className, nameIndex = classString.indexOf("active");
            if (nameIndex == -1) {
                classString += ' ' + "active";
            }
            else {
                classString = classString.substr(0, nameIndex) + classString.substr(nameIndex+"active".length);
            }
            this.className = classString;

        }, false);
    }
}
</script>  --}}
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



        {{--  <!-- ChartJS -->
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
        <script src="{{ asset('assets/lte') }}/plugins/daterangepicker/daterangepicker.js"></script>  --}}


        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('assets/lte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="{{ asset('assets/lte') }}/plugins/summernote/summernote-bs4.min.js"></script>


        {{--  <!-- overlayScrollbars -->
        <script src="{{ asset('assets/lte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="{{ asset('assets/lte') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

        --}}
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/lte') }}/js/adminlte.js"></script>
        <!-- Select2 -->
        <script src="{{ asset('assets/lte') }}/plugins/select2/js/select2.full.min.js"></script>
        <!--begin::Custom javascript-->
		<script src="{{ asset('assets/global/js/app.js') }}"></script>
		<script src="{{ asset('assets/custom/js/custom.js') }}"></script>
@yield('scripts')
@stack('push-scripts')
</html>
