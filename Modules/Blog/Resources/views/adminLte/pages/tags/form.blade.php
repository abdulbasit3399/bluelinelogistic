@csrf

@php
    $classColLable = $typeForm == 'create' ? 'col-lg-4' : 'col-lg-4';
    $classColInput = $typeForm == 'create' ? 'col-lg-8' : 'col-lg-8';
@endphp


<!--begin::Input group -- name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label required fw-bold fs-6">{{ __('blog::view.tags_table.name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <input type="text" name="name" data-slug-content="tags" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="{{ __('blog::view.tags_table.name') }}" value="{{ old('name', isset($model) ? $model->name : '') }}" />
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



<!--begin::Input group -- slug -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label required fw-bold fs-6">{{ __('blog::view.tags_table.slug') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="slug"
                data-slug-inject="tags"
                class="form-control form-control-sm @error('slug') is-invalid @enderror {{ $typeForm == 'edit' ? 'edited' : '' }}"
                placeholder="{{ __('blog::view.tags_table.slug') }}"
                value="{{ old('slug', isset($model) ? $model->slug : '') }}"
            >
            @error('slug') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->


<!--begin::Input group -- description -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label fw-bold fs-6">{{ __('blog::view.tags_table.description') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <!-- begin current lang -->
        <div class="mb-4">
            <textarea
                type="text"
                name="description"
                class="form-control form-control-sm @error('description') is-invalid @enderror"
                placeholder="{{ __('blog::view.tags_table.description') }}">{{ old('description', isset($model) ? $model->description : '') }}</textarea>

            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <!-- end current lang -->
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->




