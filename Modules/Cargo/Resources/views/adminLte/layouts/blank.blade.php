@extends('theme.layout.layout-theme')

@section('content')


<div class="bd-content-wrap" style="transform: none; min-height:100%">
    <div class="cfix"></div>
    <div class="clearfix"></div>


    @yield('before-content')


    <!-- .slider-area -->
    <div class="bd-container-post entry-content-only" style="transform: none;">
        <div class="bd-row" style="transform: none;">
            @yield('page-content')
        </div>
    </div>


    @yield('after-content')


</div>


@endsection
