<x-base-layout>

    <x-slot name="pageTitle">
        {{ __('acl::view.edit_role') }} - {{$model->name}}
    </x-slot>

    
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('acl::view.edit_role') }}</h3>
            </div>
            <!--end::Card title-->

        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div id="kt_account_profile_details" class="collapse show">
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form" action="{{ route('roles.update', ['id' => $model->id]) }}" method="post">
                @method('PUT')
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    @include('acl::adminLte.pages.roles.form', ['typeForm' => 'edit'])
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
    <!--end::Basic info-->


</x-base-layout>