<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle') | {{ \Str::title(get_general_setting('website_title', config('app.name'))) }} </title>


    <!-- Datatable style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/datatable.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/summernote/summernote-bs4.min.css">
        <!-- Bootstrap4 Duallistbox -->
        {{--  <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">  --}}
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
{{--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />  --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        @import url(https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,300);
    body {margin:0;background:#41465c;font-weight:300;color:#404040;font-family: "RobotoDraft", Helvetica, Arial, sans-serif;letter-spacing:.1px;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;}

        .toolbar {height:64px;background:rgb(223, 223, 223);overflow:hidden;}


        .tabs {padding-top:14px}
        .tabs ul {list-style:none;margin:0;width:100%;overflow:hidden;padding:0;margin-left:16px;}
        .tabs ul li {float:left;width:100px}
        .tabs a {position:relative;color:rgb(3, 3, 3);text-decoration:none;display:block;width:100px;height:50px;text-align:center;line-height:52px;font-weight:700;font-size:14px;color:rgba(255,255,255,0.6);overflow:hidden;}
        .tabs .active a {color:rgb(7, 7, 7);}
        .tabs .active a:after {height:2px;width:100%;display:block;content:" ";bottom:0px;left:0px;position:absolute;background:#050505;
        -webkit-animation: border-expand 0.2s cubic-bezier(0.4, 0.0, 0.4, 1) 0s alternate forwards;-moz-animation: border-expand 0.2s cubic-bezier(0.4, 0.0, 0.4, 1) 0s alternate forwards;transition:all 1s cubic-bezier(0.4, 0.0, 1, 1);}
        .tabs a span {position:absolute;margin-left:-40px;margin-top:-24px;width:80px;background:rgb(10, 10, 10);height:100%;display:block;border-radius:50%;opacity:0;}
        .tabs a span.clicked {-webkit-animation: expand 0.6s cubic-bezier(0.4, 0.0, 0.4, 1) 0s normal;-moz-animation: expand 0.6s cubic-bezier(0.4, 0.0, 0.4, 1) 0s normal;border-bottom:2px solid #0c0c0c;}
        .content {box-shadow:inset 0px 5px 6px -3px rgba(0, 0, 0, 0.4);height:500px;padding-top:50px;position:relative;top:0px;overflow:hidden;}
        .item {background:white;width:440px;padding-bottom:30px;margin:0 auto 2em;}
        .itemhead {padding:30px;overflow:hidden;position:relative;}
        .itemhead img {border-radius:100%;float:left}
        .itemhead h2 {font-weight:400;float:left;margin-left:20px;}
        .itemhead .heart {cursor:pointer;position:absolute;right:4px;top:4px;padding:7px;border-radius:2px}
        .item p:first-of-type {margin-top:0}
        .item p {padding:0px 30px;font-size:19px;line-height:26px;margin:0;margin-top:1em;}
        .item a {text-decoration:none;color:#00bcd4;font-weight:500;font-size:0.8em;}

        .heart:hover {box-shadow:0 1px 0 0 rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(0, 0, 0, 0.1)}
        .heart #favorite {fill:#0a0a0a}
        .heart.active #favorite {fill:#DA4336;}

        .box {display:none;overflow:auto;position:relative;overflow-x:hidden;}
        .box.show {display:block;}

    @-webkit-keyframes expand {
        0% {
            background:rgb(100, 100, 100);
            opacity:1;
            border-radius:100%;
            transform: scale(0);
            -webkit-transform: scale(0);
            -moz-transform:scale(0);
        }
        50% {
            background:rgba(92, 92, 92, 0.8);
            border-radius:50%;
        }
        100% {
            background:rgba(255,255,141,0);
            transform: scale(3);
            border-radius: 0;
            -webkit-transform: scale(3);
            -moz-transform:scale(3);
            opacity:1;
        }
    }
    @-moz-keyframes expand {
        0% {
            background:rgba(255,255,141,1);
            opacity:1;
            border-radius:100%;
            transform: scale(0);
            -moz-transform:scale(0);
        }
        50% {
            background:rgba(255,255,141,0.8);
            border-radius:50%;
        }
        100% {
            background:rgba(255,255,141,0);
            transform: scale(3);
            border-radius: 0;
            -moz-transform:scale(3);
            opacity:1;
        }
    }
    @-webkit-keyframes border-expand {
        0% {
            opacity:0;
            width:0;
        }
        100% {
            opacity:1;
            width:100%;
        }
    }
    @-moz-keyframes border-expand {
        0% {
            opacity:0;
            width:0;
        }
        100% {
            opacity:1;
            width:100%;
        }
    }
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
