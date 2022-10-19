<x-base-layout>

    <x-slot name="pageTitle">
        @lang('widget::view.widgets')
    </x-slot>

     <!--begin:: Card-->
     <div class="card">

        <!--begin::Card body-->
        <div class="card-body">
            {{-- begin:: sidebar_list --}}
            <div id="sidebar_list">
                @php
                    $sidebar_ids = [];
                @endphp
                @foreach ($sidebar_list as $sidebar)
                    @php
                        $sidebar_ids[] = $sidebar['id'];
                    @endphp
                    <div 
                        class="sidebar {{ $loop->index == 0 ? 'open-sidebar opened' : '' }}"
                        data-sidebar-id="{{ $sidebar['id'] }}"
                        data-sidebar-theme="{{ $sidebar['theme'] }}"
                    >
                        <div class="sidebar-content shadow">
                            <div class="sidebar-header shadow">
                                <h6 class="sidebar-title">
                                    {{ ucfirst($sidebar['name']) }}
                                </h6>
                                <div class="sidebar-control">
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm mx-5 add_new_widget_btn"
                                    >
                                        @lang('widget::view.add_widget')
                                        <i class="fas fa-plus fa-fw mx-1"></i>
                                    </button>

                                    <div class="sidebar-icon {{ $loop->index == 0 ? 'flip-icon' : '' }}">
                                        <i class="fas fa-chevron-down fa-fw"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-body">
                                <div class="widget_list" id="widget_list_id_{{ $sidebar['id'] }}">
                                    @php
                                        $widget_forms = isset($sidebar_widgets[$sidebar['id']]) ? $sidebar_widgets[$sidebar['id']] : [];
                                    @endphp
                                    @foreach ($widget_forms as $widget_form)
                                        <div
                                            class="widget-component shadow"
                                            data-id="{{ $widget_form->id }}"
                                            data-widget="{{ $widget_form->widget }}"
                                        >
                                            <div class="widget-component-header">
                                                <div class="widget-component-title">
                                                    <h4 class="title">{{ $widget_form->title }}</h4>
                                                </div>
                                                <div class="widget-component-control">
                                                    <div class="widget-component-control-view">
                                                        <div class="btns-moving">
                                                            <div class="btn btn-secondary btn-moving mx-1" data-move="top">
                                                                @lang('widget::view.to_top')
                                                            </div>
                                                            <div class="btn btn-secondary btn-moving mx-1" data-move="bottom">
                                                                @lang('widget::view.to_bottom')
                                                            </div>
                                                            
                                                            <div class="btn-moving mx-1" data-move="up" title="@lang('widget::view.move_up')">
                                                                <i class="fas fa-arrow-up fa-fw"></i>
                                                            </div>
                                                            <div class="btn-moving mx-1" data-move="down" title="@lang('widget::view.move_down')">
                                                                <i class="fas fa-arrow-down fa-fw"></i>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown ms-2">
                                                            <div class="btn-menu" role="button" data-bs-toggle="dropdown">
                                                                <i class="fas fa-ellipsis-v fa-fw"></i>
                                                            </div>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item duplicate-widget" href="javascript:void()">
                                                                        <i class="fas fa-copy fa-fw"></i>
                                                                        @lang('widget::view.duplicate')
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item remove-widget" href="javascript:void()">
                                                                        <i class="fas fa-trash fa-fw"></i>
                                                                        @lang('widget::view.remove_widget')
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="widget-component-toggle p-2 ms-2">
                                                            <i class="fas fa-chevron-down fa-fw widget-component-toggle-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-component-wrapper-forms">
                                                <div class="widget-component-form">
                                                    {!! $widget_form->widget_class->form($widget_form->data, $widget_form->id)->render() !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="add_new_widget mt-10">
                                    <button
                                        type="button"
                                        class="btn btn-primary add_new_widget_btn"
                                    >
                                        @lang('widget::view.add_widget')
                                        <i class="fas fa-plus fa-fw mx-1"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- end:: sidebar_list --}}


            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>
                <a id="update_widgets" href="#" class="btn btn-sm btn-success" >@lang('view.update') <span class="loading-in-btn d-none fas fa-circle-notch fa-spin"></span></a>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end:: Card-->
    
    <!--begin:: widget_class_list-->
    <div id="widget_class_list_widgets" style="overflow: scroll;">
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




    @section('toolbar-btn')
        <!--begin::Button-->
        <a
            id="update_widgets"
            href="{{ fr_route('widgets.update') }}"
            class="btn btn-sm btn-success"
        >
            @lang('widget::view.update_widgets')
            <span class="loading-in-btn d-none fas fa-circle-notch fa-spin"></span>
        </a>
        <!--end::Button-->
    @endsection



    @section('styles')
        <link href="{{ asset('assets/modules/css/widget.css') }}" rel="stylesheet" />
    @endsection

    @section('scripts')
        <script>
            window.widget_translations = JSON.parse('{!! $widget_view_trans !!}');
        </script>
        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}"></script>
        <script src="{{ asset('assets/modules/js/widget.js') }}"></script>

        <script>
            // trigger sortable
            $('{{ "#widget_list_id_" . implode(", #widget_list_id_", $sidebar_ids) }}').sortable({
                connectWith: ".widget_list",
                placeholder: "widget-sortable-placeholder",
                opacity: 0.8
            }).disableSelection();
            </script>
    @endsection
</x-base-layout>
