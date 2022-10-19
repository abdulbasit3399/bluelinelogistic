<x-base-layout>

    <x-slot name="pageTitle">
        @lang('view.notifications_settings')
    </x-slot>

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">

        <div class="wrapper-settings">
                <!--begin::Content-->
                <div class="main-setting">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                        @csrf
                        @include('adminLte.pages.fields', ['fields' => $fields])
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>
                            <button type="submit" class="btn btn-success" id="kt_account_profile_details_submit">@lang('view.update')</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
                
        </div>
    </div>
    <!--end::Basic info-->


    @section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
    @endsection

    @section('scripts')
    
    <script src="{{ asset('assets/plugins/spectrum/spectrum.min.js') }}"></script>
    <script>

        $('.color_picker_input').spectrum({
            type: "component",
            showInput: true,
             showInitial: true,
            clickoutFiresChange: true,
            allowEmpty: true,
            maxSelectionSize: 8,
        });

    </script>
    @endsection

</x-base-layout>