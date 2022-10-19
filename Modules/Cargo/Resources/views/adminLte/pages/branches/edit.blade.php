@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.edit_branches') }} - {{$model->name}}
@endsection


@section('content')
    
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('cargo::view.edit_branch') }}</h3>
            </div>
            <!--end::Card title-->

        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div>
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form" action="{{ fr_route('branches.update', ['branch' => $model->id]) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    @include('cargo::adminLte.pages.branches.form', ['typeForm' => 'edit'])
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

@endsection