@extends('theme.layout.layout-theme')

@section('content')


<div class="bd-content-wrap" style="transform: none;">
    <div class="cfix"></div>
    <div class="clearfix"></div>


    @yield('before-content')


    <!-- .slider-area -->
    <div class="bd-container-post entry-content-only" style="transform: none;">
        <div class="bd-row" style="transform: none;">
            @yield('page-content')
            
            {{-- begin::sidebar wedgets --}}
            @include('theme.components.widgets.widget-layout')
            {{-- end::sidebar wedgets --}}

        </div>
    </div>


    @yield('after-content')


</div>


@endsection