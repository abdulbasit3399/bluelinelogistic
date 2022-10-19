@extends('theme.layout.layout-theme')


@section('page-title')
    @lang('view.home')
@endsection


@section('content')

@php
    $homepage_containers = theme_setting_containers('homepage');
    // dd($homepage_containers);
@endphp


<div class="bd-content-wrap">
    <div class="cfix"></div>

    <div class="bd-container entry-content-only">
        <div class="vc_row wpb_row vc_row-fluid">
            @forelse ($homepage_containers as $container)
                <div
                    class="{{ $container->container_width_class }} {{ array_key_exists('container_sticky', $container->data) && $container->data['container_sticky'] ? 'theia_stickys is-fixeds' : '' }}"
                    style="{{ isset($container->data['container_width']) && $container->data['container_width'] == 'full_width' ? 'clear: both;' : '' }}"
                >
                    <div class="bd-container">
                        @foreach ($container['sections'] as $section)
                            @if ($section['section'])
                                @php
                                    $section_blade_path = 'theme.components.homepage.' . $section['section'];
                                @endphp
                                @if (view()->exists($section_blade_path) && array_key_exists('display', $section->data) && $section->data['display'] == true)
                                    <div class="full-width {{ $section['section'] }}">
                                        @include($section_blade_path, ['section' => $section, 'data' => $section->data])
                                    </div>
                                @endif
                            @else
                                <div class="full-width">
                                    {!! $section->widget_view !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @empty
            
            <div class="container" style="padding-top: 150px;">
                <div class="alert alert-success" role="alert">
                    <h5> 
                        @lang('theme_easyship::view.if_home_empty')          
                        <a href="{{ fr_route('theme-setting.edit', ['place' => 'import_demo']) }}"
                                style="border-bottom: 1px solid;"
                                target="_blank">@lang('theme_easyship::view.here')</a>
                    </h5>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>


@endsection