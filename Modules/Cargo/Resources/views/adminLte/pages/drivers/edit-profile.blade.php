@extends('cargo::adminLte.layouts.master')
@php
$hasAvatar = isset($model) && $model->img;
$getAvatar = $hasAvatar ? $model->img : '';
@endphp

@section('pageTitle')
    {{ __('cargo::view.edit_profile') }} - {{ $model->name }}
@endsection


@section('content')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('cargo::view.edit_profile') }} - {{ $model->name }}</h3>
            </div>
            <!--end::Card title-->

        </div>
        <!--begin::Content-->
        <div>
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form"
                action="{{ fr_route('drivers.update', ['driver' => $model->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!--begin::Card body-->
                <div class="card-body border-top p-9">



                    <!--begin::Col Avatar -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.avatar') }}</label>
                        <!--end::Label-->
                        <div class="col-md-12">
                            <!--begin::Image input-->
                            @if (isset($model))
                                <x-media-library-collection max-items="1" name="image" :model="$model" collection="avatar"
                                    rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                            @else
                                <x-media-library-attachment name="image" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                            @endif
                            <!--end::Image input-->

                            @error('avatar')
                                <div class="is-invalid"></div>
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <!--end::Col-->


                    <!--begin::Input group --  Full name -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.full_name') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-12 fv-row">
                            <div class="input-group mb-4">
                                <input type="text" name="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.full_name') }}"
                                    value="{{ old('name', isset($model) ? $model->name : '') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group --  Email -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.email') }}</label>
                        <!--end::Label-->
                        <!--begin::Input group-->
                        <div class="col-lg-12 fv-row">
                            <div class="input-group mb-4">
                                <input type="text" name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.email') }}"
                                    value="{{ old('email', isset($model) ? $model->email : '') }}" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->


                    <div class="row mb-6">

                        <!--begin::Input group --  Password -->
                        <!--begin::Input group-->
                        <div class="col-lg-6 fv-row">
                            <!--begin::Label-->
                            <label class="col-form-label fw-bold fs-6 ">{{ __('cargo::view.table.password') }}</label>
                            <!--end::Label-->
                            <div class="input-group mb-4">
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg has-feedback @error('password') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.password') }}"
                                    value="{{ old('password', isset($model) ? $model->password : '') }}" />
                                <i id="check" class="far fa-eye" id="togglePassword"
                                    style="cursor: pointer;position: absolute;right: 0;padding: 3%;font-size: 16px;"></i>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group --  National Id -->
                        <!--begin::Input group-->
                        <div class="col-lg-6 fv-row">
                            <!--begin::Label-->
                            <label
                                class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_national_id') }}</label>
                            <!--end::Label-->
                            <div class="input-group mb-4">
                                <input type="text" name="national_id"
                                    class="form-control form-control-lg @error('national_id') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.owner_national_id') }}"
                                    value="{{ old('national_id', isset($model) ? $model->national_id : '') }}" />
                                @error('national_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->


                    <div class="row mb-6">

                        <!--begin::Input group --  Owner Name -->
                        <!--begin::Input group-->
                        <div class="col-lg-6 fv-row">
                            <!--begin::Label-->
                            {{-- <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_name') }}</label> --}}
                            <!--end::Label-->
                            <div class="input-group mb-4">
                                <input type="hidden" type="text" name="responsible_name"
                                    class="form-control form-control-lg @error('responsible_name') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.owner_name') }}"
                                    value="{{ old('responsible_name', isset($model) ? $model->responsible_name : '') }}" />
                                @error('responsible_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group --  Owner Phone -->
                        <!--begin::Input group-->
                        <div class="col-lg-6 fv-row">
                            <!--begin::Label-->
                            {{-- <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.owner_phone') }}</label> --}}
                            <!--end::Label-->
                            <div class="input-group mb-4">
                                <input type="hidden" type="text" name="responsible_mobile"
                                    class="form-control form-control-lg @error('responsible_mobile') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.owner_phone') }}"
                                    value="{{ old('responsible_mobile', isset($model) ? $model->responsible_mobile : '') }}" />
                                @error('responsible_mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group -- Branch -->
                    <div class="row mb-6">
                        <div class="col-md-12">
                            <!--begin::Input group-->
                            <div class="form-group">
                                <!--begin::Label-->
                                {{-- <label class="col-form-label fw-bold fs-6 required">{{ __('cargo::view.table.branch') }}</label> --}}
                                <!--end::Label-->
                                <input type="hidden" type="text" name="branch_id"
                                    class="form-control form-control-lg @error('branch_id') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.full_name') }}"
                                    value="{{ old('branch->id', isset($model) ? $model->branch->id : '') }}" />
                                @error('branch_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
























































                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ url()->previous() }}"
                        class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>
                    <button type="submit" class="btn btn-success"
                        id="kt_account_profile_details_submit">@lang('view.update')</button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->
@endsection
