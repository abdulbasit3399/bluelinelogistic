@csrf

<!--begin::Input group --  Role name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('acl::view.table.role_name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('acl::view.table.role_name') }}" value="{{ old('name', isset($model) ? $model->name : '') }}" />
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



<!--begin::Input group --- permissions group -->

<!--begin::Label-->
<label class="col-lg-4 col-form-label required fw-bold fs-6 mb-3">{{ __('acl::view.table.permissions') }}</label>
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
                                type="checkbox" 
                                class="custom-control-input form-check-input select-all-groups" 
                                id="group_check_box_all_{{ $group->name }}"
                                {{ check_every_array($group->permissions->pluck('name')->toArray(), old('permissions') ?? (isset($role_permissions) ? $role_permissions : []) ) ? 'checked="checked"' : '' }}
                            >
                            <label class="custom-control-label" for="group_check_box_all_{{ $group->name }}">{{ __('view.select_all') }}</label>
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
                                        {{ in_array($permission->name, old('permissions') ?? (isset($role_permissions) ? $role_permissions : [])) ? 'checked="checked"' : '' }}
                                    >
                                    <label
                                        class="custom-control-label"
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



@section('styles')
    <link href="{{ asset('assets/custom/css/acl.css') }}" rel="stylesheet" />
@endsection


