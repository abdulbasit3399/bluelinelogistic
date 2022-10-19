@csrf

@php
    $hasAvatar = isset($model) && $model->avatar;
    $getAvatar = $hasAvatar ? $model->avatarImage : '';
@endphp

<!--begin::Col Avatar -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-md-4 col-form-label fw-bold fs-6">{{ __('users::view.table.avatar') }}</label>
    <!--end::Label-->
    <div class="col-md-8">
        <!--begin::Image input-->
        <div class="image-input image-input-outline {{ $hasAvatar ? '' : 'image-input-empty' }}" data-kt-image-input="true" style="background-image: url( {{ asset('assets/lte/media/avatars/blank.png') }} )">
            <!--begin::Preview existing avatar-->

            @if ($hasAvatar)
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $getAvatar }})"></div>
            @else
                <div class="image-input-wrapper"></div>                        
            @endif

            <!--end::Preview existing avatar-->
            <!--begin::Label-->
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('view.change_avatar') }}">
                <i class="bi bi-pencil-fill fs-7"></i>
                <!--begin::Inputs-->
                <input type="file" name="avatar" accept="image/*" />
                <input type="hidden" name="avatar_remove" />
                <!--end::Inputs-->
            </label>
            <!--end::Label-->
            <!--begin::Cancel-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{ __('view.cancel_avatar') }}">
                <i class="bi bi-x fs-2"></i>
            </span>
            <!--end::Cancel-->
            <!--begin::Remove-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{ __('view.remove_avatar') }}">
                <i class="bi bi-x fs-2"></i>
            </span>
            <!--end::Remove-->
        </div>
        <!--end::Image input-->
        <!--begin::Hint-->
        <div class="form-text">{{ __('view.hint_image_ext') }}</div>
        <!--end::Hint-->

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
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('users::view.table.full_name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('users::view.table.full_name') }}" value="{{ old('name', isset($model) ? $model->name : '') }}" />
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
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('users::view.table.email') }}</label>
    <!--end::Label-->
    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('users::view.table.email') }}" value="{{ old('email', isset($model) ? $model->email : '') }}" />
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
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('users::view.table.password') }}</label>
    <!--end::Label-->

        <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="input-group mb-4">
            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('users::view.table.password') }}" value="{{ old('password') }}" />
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
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.phone') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="responsible_mobile" class="form-control form-control-lg @error('responsible_mobile') is-invalid @enderror" placeholder="{{ __('cargo::view.table.phone') }}" value="{{ old('responsible_mobile', isset($model) ? $model->responsible_mobile : '') }}" />
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
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.national_id') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">

        <div class="input-group mb-4">
            <input type="text" name="national_id" class="form-control form-control-lg @error('national_id') is-invalid @enderror" placeholder="{{ __('cargo::view.table.national_id') }}" value="{{ old('national_id', isset($model) ? $model->national_id : '') }}" />
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
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.branch') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row fv-row">
        <div class="mb-4">
            <select
                class="form-control  @error('branch_id') is-invalid @enderror"
                name="branch_id"
                data-control="select2"
                data-placeholder="{{ __('cargo::view.table.choose_branch') }}"
                data-allow-clear="true"
                id="change-country"
            >
                <option></option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}"
                        {{ old('branch_id') == $branch->id ? 'selected' : '' }}
                        @if($typeForm == 'edit')
                            {{ $model->branch_id == $branch->id ? 'selected' : '' }}
                        @endif
                    >{{ $branch->name }}</option>
                @endforeach
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
