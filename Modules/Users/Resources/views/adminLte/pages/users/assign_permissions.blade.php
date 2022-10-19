@extends('users::adminLte.layouts.master')

@section('pageTitle')
    {{ __('view.edit_profile') }} - {{$model->name}}
@endsection

@section('content')


    @include('users::adminLte.pages.users.overview-profile', ['model' => $model])

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('view.manage_access') }}</h3>
            </div>
            <!--end::Card title-->

            {{-- <a href="{{ fr_route('users.show', ['id' => $model->id]) }}" class="btn btn-primary align-self-center">Show Profile</a> --}}

        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div>
            <!--begin::Form-->
            <form id="kt_account_profile_details_form" class="form" action="{{ fr_route('users.manage-access', ['id' => $model->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <!--begin::Card body-->
                <div class="card-body border-top p-9">

                    <!-- ========================================= Roles ========================================= -->

                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6 mb-3">{{ __('acl::view.roles') }}</label>
                    <!--end::Label-->

                    @error('roles') 
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <!--begin::Input group --- roles -->
                    @if($roles)
                        <div class="row mb-6">
                            <div class="col-xl-4 col-md-6 mb-6">
                                <div class="card shadow card-permissions">
                                    <div class="card-header">
                                        <div class="group-name">
                                            {{ __('acl::view.roles') }}
                                        </div>
                                        <div class="select-all">
                                            <div class="custom-control custom-switch form-check form-switch">
                                                <input
                                                    class="custom-control-input form-check-input select-all-groups"
                                                    type="checkbox"
                                                    id="group_check_box_all_roles"

                                                    {{ check_every_array($roles, old('roles') ?? (isset($user_roles) ? $user_roles : []) ) ? 'checked="checked"' : '' }}
                                                    >
                                                <label class="custom-control-label form-check-label" for="group_check_box_all_roles">{{ __('view.select_all') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="view-permissions">
                                            @foreach($roles as $role)
                                                <div class="permission-checkbox mb-3">
                                                    <div class="custom-control custom-switch form-check form-switch">
                                                        <input
                                                            class="custom-control-input form-check-input select-single-permission"
                                                            name="roles[]"
                                                            type="checkbox"
                                                            id="check_box_role{{ $role }}"
                                                            value="{{ $role }}"
                                                            {{ in_array($role, old('roles') ?? (isset($user_roles) ? $user_roles : [])) ? 'checked="checked"' : '' }}
                                                        >
                                                        <label
                                                            class="custom-control-label form-check-label"
                                                            for="check_box_role{{ $role }}"
                                                        >
                                                            {{ str_replace('-', ' ', $role) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif(count($roles) == 0)
                        <div class="row">
                            <div class="text-center alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                                {{ __('acl::view.access_control_level') }},
                                <a class="alert-link" href="{{ route('roles.create') }}">{{ __('cargo::view.configure_now') }}</a>
                            </div>
                        </div>
                    @endif
                    <!--end::Input group --- roles -->


                    <!-- ========================================= Permissions ========================================= -->

                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6 mb-3">{{ __('acl::view.table.permissions') }}</label>
                    <!--end::Label-->

                    @error('permissions') 
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror


                    <!--begin::Input group --- permissions group -->
                    <div class="row mb-6">
                        @foreach($permissions_by_group as $group)
                            <div class="col-xl-4 col-md-6 mb-6">
                                <div class="card shadow card-permissions" data-group-name="{{ $group->name }}">
                                    <div class="card-header">
                                        <div class="group-name">
                                            {{ $group->name }}
                                        </div>
                                        <div class="select-all">
                                            <div class="custom-control custom-switch form-check form-switch">
                                                <input
                                                    class="custom-control-input form-check-input select-all-groups"
                                                    type="checkbox"
                                                    id="group_check_box_all_{{ $group->name }}"

                                                    {{ check_every_array($group->permissions->pluck('name')->toArray(), old('permissions') ?? (isset($user_permissions) ? $user_permissions : []) ) ? 'checked="checked"' : '' }}
                                                    >
                                                <label class="custom-control-label form-check-label" for="group_check_box_all_{{ $group->name }}">{{ __('view.select_all') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="view-permissions">
                                            @foreach($group->permissions as $permission)
                                                <div class="permission-checkbox mb-3">
                                                    <div class="custom-control custom-switch form-check form-switch">
                                                        <input
                                                            class="custom-control-input form-check-input select-single-permission"
                                                            name="permissions[]"
                                                            type="checkbox"
                                                            id="check_box_permission{{ $permission->name }}"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->name, old('permissions') ?? (isset($user_permissions) ? $user_permissions : [])) ? 'checked="checked"' : '' }}
                                                        >
                                                        <label
                                                            class="custom-control-label form-check-label"
                                                            for="check_box_permission{{ $permission->name }}"
                                                        >
                                                            {{ str_replace('-', ' ', $permission->name) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--end::Input group --- permissions group -->



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

@section('styles')
    <link href="{{ asset('assets/custom/css/acl.css') }}" rel="stylesheet" />
@endsection