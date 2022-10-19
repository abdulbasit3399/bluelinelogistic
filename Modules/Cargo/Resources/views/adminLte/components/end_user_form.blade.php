@php
$branches = Modules\Cargo\Entities\Branch::where('is_archived',0)->get();
@endphp
<!--begin::Input group -- Phone -->
<div class="row mb-6">

    <!--begin::Label-->
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.phone') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
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
