@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch  = 3;
@endphp

@extends('users::adminLte.layouts.master')

@section('pageTitle')
    {{ __('view.profile') }} - {{$model->name}}
@endsection

@section('content')
    
    @include('cargo::adminLte.pages.drivers.overview-profile', ['model' => $model, 'items' => $items])

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('view.profile_details') }}</h3>
            </div>
            <!--end::Card title-->

            @if(auth()->user()->can('edit-drivers') || $user_role == $admin || $user_role == $branch)
                <a href="{{ fr_route('drivers.edit', $model->id) }}" class="btn btn-primary align-self-center">{{ __('view.edit_profile') }}</a>
            @endif
        </div>
        <!--begin::Card header-->
        <div class="card-body p-9">

                <!--begin::Row  Full name -->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('users::view.table.full_name') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $model->name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row  Email -->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('users::view.table.email') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $model->email }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row  Owner Name -->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('cargo::view.table.owner_name') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $model->responsible_name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row  Owner Phone -->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('cargo::view.table.owner_phone') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $model->responsible_mobile }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row  National ID -->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('cargo::view.table.national_id') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $model->national_id }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row  Branch -->
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('cargo::view.table.branch') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $model->branch->name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
        </div>
        <!--begin::Card header-->
    </div>
    <!--end::Basic info-->

@endsection