@php 
    $current_theme = strtolower(Qirolab\Theme\Theme::active());
@endphp

<x-base-layout>

<x-slot name="pageTitle">
    @lang('setting::view.themes')
</x-slot>

<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header">

        <!--begin::Card body-->
        <div class="card-body">
            <div class="demos-setting">
        
                <!--begin::colors -->
                <div class="setting-box">
                    <h4 class="setting-box-label fw-bold fs-3">{{__('view.choose_theme')}} </h4>

                    <form id="kt_account_profile_details_form" class="form" action="{{ fr_route('active-theme.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-6">
                            <div class="input-group ">
                                <div class="col-md-4">
                                    <div class="form-check mx-4">
                                        <label class="px-2 py-1 text-center">
                                            <input
                                                class=""
                                                type="radio"
                                                name="active_theme"
                                                value="easyship"
                                                {{ isset($active_theme) && $active_theme == 'easyship' ? 'checked="checked"' : '' }}
                                            >
                                            <div class="form-check-label bg-white border p3">
                                                <img  class="mb-1" style="height: 250px;width: 250px;" src="{{ asset('assets/custom/images/settings/demos/easyship.jpg') }}"><br>
                                                {{__('view.easyship_theme')}}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check mx-4">
                                        <label class="px-2 py-1 text-center">
                                            <input
                                                class=""
                                                type="radio"
                                                name="active_theme"
                                                value="flextock"
                                                {{ isset($active_theme) && $active_theme == 'flextock' ? 'checked="checked"' : '' }}
                                            >
                                            <div class="form-check-label bg-white border p3">
                                                <img  class="mb-1" style="height: 250px;width: 250px;" src="{{ asset('assets/custom/images/settings/demos/flextock.png') }}"><br>
                                                {{__('view.flextock_theme')}}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check mx-4">
                                        <label class="px-2 py-1 text-center">
                                            <input
                                                class=""
                                                type="radio"
                                                name="active_theme"
                                                value="goshippo"
                                                {{ isset($active_theme) && $active_theme == 'goshippo' ? 'checked="checked"' : '' }}
                                            >
                                            <div class="form-check-label bg-white border p3">
                                                <img  class="mb-1" style="height: 250px;width: 250px;" src="{{ asset('assets/custom/images/settings/demos/goshippo.png') }}"><br>
                                                {{__('view.goshippo_theme')}}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check mx-4">
                                        <label class="px-2 py-1 text-center">
                                            <input
                                                class=""
                                                type="radio"
                                                name="active_theme"
                                                value="qwintry"
                                                {{ isset($active_theme) && $active_theme == 'qwintry' ? 'checked="checked"' : '' }}
                                            >
                                            <div class="form-check-label bg-white border p3">
                                                <img  class="mb-1" style="height: 250px;width: 250px;" src="{{ asset('assets/custom/images/settings/demos/qwintry.png') }}"><br>
                                                {{__('view.qwintry_theme')}}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check mx-4">
                                        <label class="px-2 py-1 text-center">
                                            <input
                                                class=""
                                                type="radio"
                                                name="active_theme"
                                                value="shipito"
                                                {{ isset($active_theme) && $active_theme == 'shipito' ? 'checked="checked"' : '' }}
                                            >
                                            <div class="form-check-label bg-white border p3">
                                                <img  class="mb-1" style="height: 250px;width: 250px;" src="{{ asset('assets/custom/images/settings/demos/shipito.png') }}"><br>
                                                {{__('view.shipito_theme')}}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check mx-4">
                                        <label class="px-2 py-1 text-center">
                                            <input
                                                class=""
                                                type="radio"
                                                name="active_theme"
                                                value="timeglobalshipping"
                                                {{ isset($active_theme) && $active_theme == 'timeglobalshipping' ? 'checked="checked"' : '' }}
                                            >
                                            <div class="form-check-label bg-white border p3">
                                                <img  class="mb-1" style="height: 250px;width: 250px;" src="{{ asset('assets/custom/images/settings/demos/timeglobalshipping.png') }}"><br>
                                                {{__('view.timeglobalshipping_theme')}}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-success" id="kt_account_profile_details_submit">{{__('view.active_now')}}</button>
                        </div>
                    </form>

                </div>
                <!--end::colors -->

            </div>
        </div>
        <!--begin::Card body-->

    </div>
    <!--begin::Card header-->


</div>
<!--end::Card-->

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/plugins/spectrum/spectrum.min.js') }}"></script>
@endsection

</x-base-layout>
