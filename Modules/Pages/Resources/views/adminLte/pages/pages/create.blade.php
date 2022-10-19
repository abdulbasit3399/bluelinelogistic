@extends('pages::adminLte.layouts.master')

@section('pageTitle')
    {{ __('pages::view.create_new_page') }}
@endsection

@section('content')
    
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('pages::view.create_new_page') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div>
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form" action="{{ fr_route('pages.store') }}" method="post" enctype="multipart/form-data">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    @include('pages::adminLte.pages.pages.form', ['typeForm' => 'create'])
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary mx-1">@lang('view.discard')</a>
                    <input type="submit" class="btn btn-primary mx-1" value="{{ __('view.save_draft') }}">
                    <input type="submit" name="publish" class="btn btn-dark mx-1" value="@lang('view.publish')">
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

@endsection