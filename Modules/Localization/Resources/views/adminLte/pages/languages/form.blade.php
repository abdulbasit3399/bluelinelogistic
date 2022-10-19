@csrf

@php
    $classColLable = $typeForm == 'create' ? 'col-lg-4' : 'col-lg-4';
    $classColInput = $typeForm == 'create' ? 'col-lg-8' : 'col-lg-8';
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
@endphp


<!--begin::Input group -- name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label required fw-bold fs-6">@lang('localization::view.languages_table.name')</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="name"
                class="form-control form-control-sm @error('name') is-invalid @enderror"
                placeholder="@lang('localization::view.languages_table.name')"
                value="{{ old('name', isset($model) ? $model->name : '') }}"
            />
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



<!--begin::Input group -- code -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label required fw-bold fs-6">@lang('localization::view.languages_table.code')</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="code"
                class="form-control form-control-sm @error('code') is-invalid @enderror"
                placeholder="@lang('localization::view.languages_table.code')"
                value="{{ old('code', isset($model) ? $model->code : '') }}"
            />
            @error('code') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->



<!--begin::Input group -- parent category -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label fw-bold fs-6">@lang('localization::view.languages_table.dir')</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">

        <div class="mb-4">
            <select
                class="form-control  @error('dir') is-invalid @enderror"
                name="dir"
                data-control="select2"
                data-allow-clear="true"
                data-placeholder="@lang('localization::view.languages_table.dir')"
            >
                <option value="ltr" {{ old('dir', isset($model) ? $model->dir : '') == 'ltr' ? 'selected' : '' }}>
                    @lang('localization::view.languages_table.ltr')
                </option>
                <option value="rtl" {{ old('dir', isset($model) ? $model->dir : '') == 'rtl' ? 'selected' : '' }}>
                    @lang('localization::view.languages_table.rtl')
                </option>
            </select>
            @error('dir') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group -- script -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label fw-bold fs-6">@lang('localization::view.languages_table.script')</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="script"
                class="form-control form-control-sm"
                placeholder="@lang('localization::view.languages_table.script')"
                value="{{ old('script', isset($model) ? $model->script : '') }}"
            />
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group -- native -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label fw-bold fs-6">@lang('localization::view.languages_table.native')</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="native"
                class="form-control form-control-sm"
                placeholder="@lang('localization::view.languages_table.native')"
                value="{{ old('native', isset($model) ? $model->native : '') }}"
            />
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group -- regional -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label fw-bold fs-6">@lang('localization::view.languages_table.regional')</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="regional"
                class="form-control form-control-sm"
                placeholder="@lang('localization::view.languages_table.regional')"
                value="{{ old('regional', isset($model) ? $model->regional : '') }}"
            />
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->



<!--begin::Col Image -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-md-4 col-form-label fw-bold fs-6">{{ __('localization::view.languages_table.falg') }}</label>
    <!--end::Label-->
    <div class="col-md-8">
        

        @if(isset($model))
            <x-media-library-collection max-items="1" name="image" :model="$model" collection="icon" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
        @else
            <x-media-library-attachment name="image" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
        @endif

    </div>
</div>
<!--end::Col-->
