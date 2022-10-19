@php 
    $current_theme = strtolower(Qirolab\Theme\Theme::active());
@endphp

<x-base-layout>

<x-slot name="pageTitle">
    {{ $theme_setting_forms['name'] }} - @lang('setting::view.theme_setting')
</x-slot>

<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">@lang('setting::view.theme_setting')</h3>
        </div>
        <!--end::Card title-->

    </div>
    <!--begin::Card header-->

    <!--begin::Navs-->
    <div class="d-flex overflow-auto h-55px px-15">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
            @foreach($tabs as $tabPlace => $tabName)
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a
                        href="{{ fr_route('theme-setting.edit', ['place' => $tabPlace]) }}"
                        class="nav-link text-active-primary me-6 {{ $tabPlace == $place ? 'active' : '' }}"
                    >
                        {{ $tabName }}
                    </a>
                </li>
                <!--end::Nav item-->
            @endforeach
        </ul>
    </div>
    <!--begin::Navs-->

    <!--begin::Card body-->
    <div class="card-body">
        @if ($is_sortable)


            <div class="d-flex justify-content-end p-2 mb-4 hide-when-not-containers {{ $containers->count() ? '' : 'd-none' }}">
                <div>
                    <button
                        type="button"
                        class="btn btn-secondary add_new_container_btn"
                    >
                        @lang('setting::view.add_container')
                        <i class="fas fa-plus fa-fw mx-1"></i>
                    </button>
                </div>
            </div>

            <div id="containers" class="hide-when-not-containers {{ $containers->count() ? '' : 'd-none' }}">
                @foreach($containers as $container)
                    <div
                        class="section-component shadow container_section"
                        data-id="{{ $container->id }}"
                        >
                        <div class="section-component-header">
                            <div class="section-component-title">
                                <h4 class="title">@lang('setting::view.container') {{ $loop->index + 1 }}</h4>
                            </div>
                            <div class="section-component-control">
                                <div class="section-component-control-view">
                                    <div class="btns-moving">
                                        <div class="btn btn-secondary btn-moving mx-1" data-move="top">
                                            @lang('setting::view.to_top')
                                        </div>
                                        <div class="btn btn-secondary btn-moving mx-1" data-move="bottom">
                                            @lang('setting::view.to_bottom')
                                        </div>

                                        <div class="btn-moving mx-1" data-move="up" title="@lang('setting::view.move_up')">
                                            <i class="fas fa-arrow-up fa-fw"></i>
                                        </div>
                                        <div class="btn-moving mx-1" data-move="down" title="@lang('setting::view.move_down')">
                                            <i class="fas fa-arrow-down fa-fw"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown ms-2">
                                        <div class="btn-menu" role="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v fa-fw"></i>
                                        </div>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item duplicate-section" href="javascript:void()">
                                                    <i class="fas fa-copy fa-fw"></i>
                                                    @lang('setting::view.duplicate')
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item remove-section" href="javascript:void()">
                                                    <i class="fas fa-trash fa-fw"></i>
                                                    @lang('setting::view.remove_container')
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="section-component-toggle p-2 ms-2">
                                        <i class="fas fa-chevron-down fa-fw section-component-toggle-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-component-wrapper-forms wrapper-sections">
                            <div class="section-component-form">
                                <h3 class="container-section-title">
                                    @lang('setting::view.container_setting')
                                </h3>

                                <div class="container-inner wrapper-container-setting">
                                    <form class="container_form">
                                        <!--begin::row display_container -->
                                        <div class="row mb-6 display_container">
                                            <label class="col-md-4 fw-bold fs-6 required"> @lang('setting::view.display_container') </label>
                                            <div class="col-md-8">
                                                <div class="custom-control custom-switch form-check form-switch">
                                                    <input
                                                        class="custom-control-input form-check-input display_container_input"
                                                        name="display_container"
                                                        type="checkbox"
                                                        value="1"
                                                        id="display_container_{{isset($container->id) ? $container->id : 'id'}}"
                                                        {{ isset($container->data['display_container']) && $container->data['display_container'] == 1 ? 'checked="checked"' : '' }}
                                                    >
                                                    <label class="custom-control-label form-check-label fw-bold fs-6" for="display_container_{{isset($container->id) ? $container->id : 'id'}}"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::row display_container -->

                                        <!--begin::row container_sticky -->
                                        <div class="row mb-6 container_sticky">
                                            <label class="col-md-4 fw-bold fs-6 required"> @lang('setting::view.container_sticky') </label>
                                            <div class="col-md-8">
                                                <div class="custom-control custom-switch form-check form-switch">
                                                    <input
                                                        class="custom-control-input form-check-input container_sticky_input"
                                                        name="container_sticky"
                                                        type="checkbox"
                                                        value="1"
                                                        id="display_container_sticky_{{isset($container->id) ? $container->id : 'id'}}"
                                                        {{ isset($container->data['container_sticky']) && $container->data['container_sticky'] == 1 ? 'checked="checked"' : '' }}
                                                    >
                                                    <label class="custom-control-label form-check-label fw-bold fs-6" for="display_container_sticky_{{isset($container->id) ? $container->id : 'id'}}"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::row container_sticky -->

                                        <!--begin::row container_width -->
                                        <div class="row mb-6">
                                            <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('setting::view.container_width') </label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    @foreach(config("theme_{$current_theme}.container_width") as $key => $name)
                                                        <div class="form-check mx-3">
                                                            <input
                                                                class="form-check-input container_width"
                                                                type="radio"
                                                                name="container_width"
                                                                value="{{ $key }}"
                                                                id="{{ $key }}_{{ $container->id }}"
                                                                {{ isset($container->data['container_width']) && $container->data['container_width'] == $key ? 'checked="checked"' : '' }}
                                                            >
                                                            <label for="{{ $key }}_{{ $container->id }}" class="form-check-label bg-white px-2 py-1 text-center">
                                                                <img  class="mb-1" style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/container_width/' . $key . '.svg') }}"><br>
                                                                {{ $name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::row container_width -->
                                    </form>
                                </div>

                                <h3 class="container-section-title">
                                    @lang('setting::view.container_sections')
                                </h3>

                                <div class="container-inner wrapper-container-sections">
                                    <div class="d-flex justify-content-end mb-4">
                                        <div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-primary add_new_section_btn mx-2"
                                            >
                                                @lang('setting::view.add_section')
                                                <i class="fas fa-plus fa-fw mx-1"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-info add_new_widget_btn mx-2"
                                            >
                                                @lang('setting::view.add_widget')
                                                <i class="fas fa-plus fa-fw mx-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @php
                                        $sections_of_container = $theme_setting_data->filter(function ($setting_data) use ($container) {
                                            return $setting_data->container_id == $container->id;
                                        });
                                    @endphp
                                    <div class="wrapper_section_list" data-place="{{ $place }}" id="place_{{ $place }}">
                                        @foreach ($sections_of_container as $section)
                                            <div
                                                class="section-component shadow theme-setting-section {{ $section->widget_id ? 'widget_section' : '' }}"
                                                data-id="{{ $section->id }}"
                                                data-container-id="{{ $container->id }}"
                                                @if ($section->widget_id)
                                                    data-widget="{{ $section->widget_namespace }}"
                                                    data-widget-id="{{ $section->widget_id }}"
                                                @else
                                                    data-section="{{ $section->section }}"
                                                @endif
                                            >
                                                <div class="section-component-header">
                                                    <div class="section-component-title">
                                                        <h4 class="title">{{ \Str::title($section->name) }}</h4>
                                                        @if ($section->widget_id)
                                                            <span class="badge badge-info">@lang('setting::view.widget')</span>
                                                        @endif
                                                    </div>
                                                    <div class="section-component-control">
                                                        <div class="section-component-control-view">
                                                            <div class="btns-moving">
                                                                <div class="btn btn-secondary btn-moving mx-1" data-move="top">
                                                                    @lang('setting::view.to_top')
                                                                </div>
                                                                <div class="btn btn-secondary btn-moving mx-1" data-move="bottom">
                                                                    @lang('setting::view.to_bottom')
                                                                </div>

                                                                <div class="btn-moving mx-1" data-move="up" title="@lang('setting::view.move_up')">
                                                                    <i class="fas fa-arrow-up fa-fw"></i>
                                                                </div>
                                                                <div class="btn-moving mx-1" data-move="down" title="@lang('setting::view.move_down')">
                                                                    <i class="fas fa-arrow-down fa-fw"></i>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown ms-2">
                                                                <div class="btn-menu" role="button" data-bs-toggle="dropdown">
                                                                    <i class="fas fa-ellipsis-v fa-fw"></i>
                                                                </div>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item duplicate-section" href="javascript:void()">
                                                                            <i class="fas fa-copy fa-fw"></i>
                                                                            @lang('setting::view.duplicate')
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item remove-section" href="javascript:void()">
                                                                            <i class="fas fa-trash fa-fw"></i>
                                                                            @lang('setting::view.remove_section')
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div class="section-component-toggle p-2 ms-2">
                                                                <i class="fas fa-chevron-down fa-fw section-component-toggle-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="section-component-wrapper-forms">
                                                    <form class="section-component-form">
                                                        {!! $section->form !!}
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="no-sections shadow mx-6" style="{{ $sections_of_container->count() ? 'display: none;' : '' }}">
                                        @lang('setting::view.no_sections')
                                    </div>

                                    <div class="mt-4">
                                        <div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-primary add_new_section_btn mx-2"
                                            >
                                                @lang('setting::view.add_section')
                                                <i class="fas fa-plus fa-fw mx-1"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-info add_new_widget_btn mx-2"
                                            >
                                                @lang('setting::view.add_widget')
                                                <i class="fas fa-plus fa-fw mx-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="hide-when-not-containers {{ $containers->count() ? '' : 'd-none' }}">
                <button
                    type="button"
                    class="btn btn-secondary add_new_container_btn"
                >
                    @lang('setting::view.add_container')
                    <i class="fas fa-plus fa-fw mx-1"></i>
                </button>
            </div>

            <div class="empty-containers shadow my-6 {{ $containers->count() ? 'd-none' : '' }}">

                <div class="add add_new_container_btn">
                    @lang('setting::view.add_container')
                    <i class="fas fa-plus fa-fw mx-1"></i>
                </div>

            </div>

        @else

            @foreach ($theme_setting_data as $section)
                <div
                    class="section-component theme-setting-section"
                    data-section="{{ $section['section'] }}"
                    {{ isset($section['id']) ? "data-id={$section['id']}" : '' }}
                >
                    <form class="section-component-form">
                        {!! $section['form'] !!}
                    </form>
                </div>
            @endforeach

        @endif

    </div>
    <!--begin::Card body-->

    <!--begin::Actions-->
    <div class="card-footer d-flex justify-content-end py-6 px-9">
        <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>
        <a
            class="btn btn-success update_theme_setting"
            href="{{ fr_route('theme-setting.update', ['place' => $place]) }}"
        >
            @lang('view.update')
            <span class="loading-in-btn d-none fas fa-circle-notch fa-spin"></span>
        </a>
    </div>
    <!--end::Actions-->

    <div class="container_clone d-none">
        <div
            class="section-component shadow container_section"
            >
            <div class="section-component-header">
                <div class="section-component-title">
                    <h4 class="title"></h4>
                </div>
                <div class="section-component-control">
                    <div class="section-component-control-view">
                        <div class="btns-moving">
                            <div class="btn btn-secondary btn-moving mx-1" data-move="top">
                                @lang('setting::view.to_top')
                            </div>
                            <div class="btn btn-secondary btn-moving mx-1" data-move="bottom">
                                @lang('setting::view.to_bottom')
                            </div>

                            <div class="btn-moving mx-1" data-move="up" title="@lang('setting::view.move_up')">
                                <i class="fas fa-arrow-up fa-fw"></i>
                            </div>
                            <div class="btn-moving mx-1" data-move="down" title="@lang('setting::view.move_down')">
                                <i class="fas fa-arrow-down fa-fw"></i>
                            </div>
                        </div>
                        <div class="dropdown ms-2">
                            <div class="btn-menu" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item duplicate-section" href="javascript:void()">
                                        <i class="fas fa-copy fa-fw"></i>
                                        @lang('setting::view.duplicate')
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item remove-section" href="javascript:void()">
                                        <i class="fas fa-trash fa-fw"></i>
                                        @lang('setting::view.remove_container')
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="section-component-toggle p-2 ms-2">
                            <i class="fas fa-chevron-down fa-fw section-component-toggle-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-component-wrapper-forms wrapper-sections">
                <div class="section-component-form">
                    <h3 class="container-section-title">
                        @lang('setting::view.container_setting')
                    </h3>

                    <div class="container-inner wrapper-container-setting">
                        <form class="container_form">
                            <!--begin::row display_container -->
                            <div class="row mb-6 display_container">
                                <label class="col-md-4 fw-bold fs-6 required"> @lang('setting::view.display_container') </label>
                                <div class="col-md-8">
                                    <div class="custom-control custom-switch form-check form-switch">
                                        <input
                                            class="custom-control-input form-check-input display_container_input"
                                            name="display_container"
                                            type="checkbox"
                                            value="1"
                                            checked="checked"
                                            id="display_container_{{isset($id) ? $id : 'id'}}"
                                        >
                                        <label class="custom-control-label form-check-label fw-bold fs-6" for="display_container_{{isset($id) ? $id : 'id'}}"></label>
                                    </div>
                                </div>
                            </div>
                            <!--end::row display_container -->

                            <!--begin::row container_sticky -->
                            <div class="row mb-6 container_sticky">
                                <label class="col-md-4 fw-bold fs-6 required"> @lang('setting::view.container_sticky') </label>
                                <div class="col-md-8">
                                    <div class="custom-control custom-switch form-check form-switch">
                                        <input
                                            class="custom-control-input form-check-input container_sticky_input"
                                            name="container_sticky"
                                            type="checkbox"
                                            value="1"
                                            id="display_container_sticky_{{isset($id) ? $id : 'id'}}"
                                        >
                                        <label class="custom-control-label form-check-label fw-bold fs-6" for="display_container_sticky_{{isset($id) ? $id : 'id'}}"></label>
                                    </div>
                                </div>
                            </div>
                            <!--end::row container_sticky -->

                            <!--begin::row container_width -->
                            <div class="row mb-6">
                                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('setting::view.container_width') </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        @foreach(config("theme_{$current_theme}.container_width") as $key => $name)
                                            <div class="form-check mx-3">
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="container_width"
                                                    value="{{ $key }}"
                                                    id="{{$name}}"
                                                >
                                                <label for="{{$name}}" class="form-check-label bg-white px-2 py-1 text-center">
                                                    <img  class="mb-1" style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/container_width/' . $key . '.svg') }}"><br>
                                                    {{ $name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--end::row container_width -->
                        </form>
                    </div>

                    <h3 class="container-section-title">
                        @lang('setting::view.container_sections')
                    </h3>

                    <div class="container-inner wrapper-container-sections">
                        <div class="d-flex justify-content-end mb-4">
                            <div>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-primary add_new_section_btn mx-2"
                                >
                                    @lang('setting::view.add_section')
                                    <i class="fas fa-plus fa-fw mx-1"></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-info add_new_widget_btn mx-2"
                                >
                                    @lang('setting::view.add_widget')
                                    <i class="fas fa-plus fa-fw mx-1"></i>
                                </button>
                            </div>
                        </div>
                        <div class="wrapper_section_list" data-place="{{ $place }}" id="place_{{ $place }}">
                        </div>
                        <div class="no-sections shadow mx-6">
                            @lang('setting::view.no_sections')
                        </div>

                        <div class="mt-4">
                            <div>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-primary add_new_section_btn mx-2"
                                >
                                    @lang('setting::view.add_section')
                                    <i class="fas fa-plus fa-fw mx-1"></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-info add_new_widget_btn mx-2"
                                >
                                    @lang('setting::view.add_widget')
                                    <i class="fas fa-plus fa-fw mx-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!--end::Card-->

<!--begin:: section_class_list-->
@if ($is_sortable)

    <div id="section_class_list" data-place="{{ $place }}">
        <div class="sections-view">
            <div class="sections-content">
                <div class="sections-search">
                    <input type="search" class="form-control sections-search-input" placeholder="@lang('view.search')">
                </div>
                <div class="section-list">
                    @foreach ($theme_setting_forms['sections'] as $file_name => $section)
                        <div
                            class="section-box shadow"
                            title="{{ \Str::title($section['name']) }}"
                            data-title="{{ \Str::title($section['name']) }}"
                            data-title-search="{{ strtolower($section['name']) }}"
                            data-name="{{ $section['section'] }}"
                            data-form="{{ $section['form'] }}"
                        >
                            @if ($section['image'])
                                <div class="section-image">
                                    <img class="image" src="{{ $section['image'] }}">
                                </div>
                            @endif
                            <div class="section-title {{ $section['image'] ? 'has-image' : 'no-image' }}">
                                {{ \Str::title($section['name']) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!--begin:: widget_class_list-->
    <div id="widget_class_list" style="overflow: scroll;">
        <div class="widgets-view">
            <div class="widgets-content">
                <div class="widgets-search">
                    <input type="search" class="form-control widgets-search-input" placeholder="@lang('view.search')">
                </div>
                <div class="widget-groups">
                    @foreach ($widget_list as $group => $widgets)
                        <h6 class="group-title">{{ ucfirst($group) }}</h6>

                        <div class="widget-list">
                            @foreach ($widgets as $widget)
                                <div
                                    class="widget-box shadow"
                                    data-title="{{ $widget->title }}"
                                    data-title-search="{{ strtolower($widget->title) }}"
                                    data-namespace="{{ $widget->namespace }}"
                                    data-form="{{ $widget->form()->render() }}"
                                >
                                    <div class="widget-icon">
                                        <i class="{{ $widget->icon }}"></i>
                                    </div>
                                    <div class="widget-title">
                                        {{ ucfirst($widget->title) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--end:: widget_class_list-->

@endif
<!--end:: section_class_list-->

@section('toolbar-btn')
    <!--begin::Button-->
    <a
        href="{{ fr_route('theme-setting.update', ['place' => $place]) }}"
        class="btn btn-sm btn-success update_theme_setting"
    >
        @lang('view.update')
        <span class="loading-in-btn d-none fas fa-circle-notch fa-spin"></span>
    </a>
    <!--end::Button-->
@endsection

@section('styles')
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            display: none !important;
        }
        .select2-container--bootstrap5{display: none !important;}

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked + label {
            border: solid 2px #009ef7  !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
@endsection

@section('scripts')
    <script>
        window.setting_translations = JSON.parse('{!! $setting_view_trans !!}');
        window.place = "{{ $place }}";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/plugins/spectrum/spectrum.min.js') }}"></script>



    <script>


         // trigger sortable
         $('.wrapper_section_list').sortable({
            connectWith: ".wrapper_section_list",
            placeholder: "section-sortable-placeholder",
            opacity: 0.7
        }).disableSelection();

         // trigger sortable
         $('#containers').sortable({
            connectWith: "#containers",
            placeholder: "section-sortable-placeholder",
            opacity: 0.7,
            update: function( event, ui ) {
                window.resetContainerNames()
            }
        }).disableSelection();

        $('.color_picker_input').spectrum({
            type: "component",
            showInput: true,
            showInitial: true,
            allowEmpty: true,
            maxSelectionSize: 8,
        });

    </script>
@endsection

</x-base-layout>
