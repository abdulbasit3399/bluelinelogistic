@extends('cargo::adminLte.layouts.master')



@section('pageTitle')
    {{ __('cargo::view.edit_staffs') }} - {{ $model->name }}
@endsection


@section('content')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Content-->
        <div>
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form"
                action="{{ fr_route('staffs.update', ['staff' => $model->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Card body-->
                <div class="card-body border-top p-9">




                    <!--begin::Col Avatar -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-md-4 col-form-label fw-bold fs-6">{{ __('users::view.table.avatar') }}</label>
                        <!--end::Label-->
                        <div class="col-md-8">
                            <!--begin::Image input-->
                            @php
                                if (isset($model)) {
                                    $user = App\Models\User::where('id', $model->user_id)->first();
                                }
                            @endphp

                            @if (isset($model))
                                <x-media-library-collection max-items="1" name="image" :model="$user" collection="avatar"
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
                        <label
                            class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('users::view.table.full_name') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-8 fv-row">
                            <div class="input-group mb-4">
                                <input type="text" name="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="{{ __('users::view.table.full_name') }}"
                                    value="{{ old('name', isset($model) ? auth()->user()->name : '') }}" />

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
                        <label
                            class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('users::view.table.email') }}</label>
                        <!--end::Label-->
                        <!--begin::Input group-->
                        <div class="col-lg-8 fv-row">
                            <div class="input-group mb-4">
                                <input type="text" name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="{{ __('users::view.table.email') }}"
                                    value="{{ old('email', isset($model) ? auth()->user()->email : '') }}" />
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

                    <!--begin::Input group --  Password -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label
                            class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('users::view.table.password') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-8 fv-row">
                            <div class="input-group mb-4">
                                <input type="password" name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="{{ __('users::view.table.password') }}"
                                    value="{{ old('password') }}" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group -- Phone -->
                    <div class="row mb-6">

                        <!--begin::Label-->
                        <label
                            class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.phone') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-6 fv-row">
                            <div class="input-group mb-4">
                                <input type="text" name="responsible_mobile"
                                    class="form-control form-control-lg @error('responsible_mobile') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.phone') }}"
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

                    <!--begin::Input group --  National Id -->
                    <div class="row mb-6">

                        <!--begin::Label-->
                        <label
                            class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.national_id') }}</label>
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-8 fv-row">

                            <div class="input-group mb-4">
                                <input type="text" name="national_id"
                                    class="form-control form-control-lg @error('national_id') is-invalid @enderror"
                                    placeholder="{{ __('cargo::view.table.national_id') }}"
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

                    <!--begin::Input group -- Branch -->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        {{-- <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.branch') }}</label> --}}
                        <!--end::Label-->

                        <!--begin::Input group-->
                        <div class="col-lg-8 fv-row fv-row">
                            <div class="mb-4">
                                <input type="hidden" type="text" name="branch_id" class="form-control form-control-lg"
                                    value="{{ old('branch_id', isset($model) ? $model->branch_id : '') }}" />
                                {{-- <option></option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" 
                                            {{ old('branch_id') == $branch->id ? 'selected' : '' }}
                                        >{{ $branch->name }}</option>
                                    @endforeach --}}
                                </select>
                                @error('branch_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->

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
