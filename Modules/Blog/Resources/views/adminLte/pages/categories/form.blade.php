@csrf

@php
    $current_lang = app()->getLocale();
    $classColLable = $typeForm == 'create' ? 'col-lg-12' : 'col-lg-4';
    $classColInput = $typeForm == 'create' ? 'col-lg-12' : 'col-lg-8';
@endphp

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<!--begin::Input group -- name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label required fw-bold fs-6">{{ __('blog::view.categories_table.name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">

        <div class="input-group mb-5 lang_container">
            <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                <option value="{{ get_current_lang()['code'] }}" data-flag="{{get_current_lang()['icon']}}" selected>
                    {{ get_current_lang()['name'] }}
                </option>
                @foreach(get_langauges_except_current() as $locale)
                    <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                        {{ $locale['name'] }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="name[{{ $current_lang }}]" data-slug-content="categories" placeholder="{{ __('blog::view.categories_table.name') }}" value="{{ old('name.' . $current_lang, isset($model) ? $model->name : '') }}" class="form-control  form-control-multilingual form-control-{{app()->getLocale()}}  @error('name.' . $current_lang) is-invalid @enderror" >
            @error('name.' . $current_lang)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
                @foreach(get_langauges_except_current() as $locale)
                <input
                    type="text"
                    class="form-control  form-control-multilingual form-control-{{$locale['code']}} @error('name.' . $locale['code']) is-invalid @enderror d-none"
                    name="name[{{ $locale['code'] }}]"
                    placeholder="{{ __('blog::view.categories_table.name') }}"
                    value="{{ old('name.' . $locale['code'], isset($model) ? $model->getTranslation('name', $locale['code']) : '') }}"
                >
                @error('name.' . $locale['code'])
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endforeach
        </div>


    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->



<!--begin::Input group -- slug -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label required fw-bold fs-6">{{ __('blog::view.categories_table.slug') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <input
                type="text"
                name="slug"
                data-slug-inject="categories"
                class="form-control form-control-sm @error('slug') is-invalid @enderror {{ $typeForm == 'edit' ? 'edited' : '' }}"
                placeholder="{{ __('blog::view.categories_table.slug') }}"
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
    <label class="{{ $classColLable }} col-form-label fw-bold fs-6">{{ __('blog::view.categories_table.description') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">


        <div class="mb-5 lang_container text">
            <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                <option value="{{ get_current_lang()['code'] }}" data-flag="{{get_current_lang()['icon']}}" selected>
                    {{ get_current_lang()['name'] }}
                </option>
                @foreach(get_langauges_except_current() as $locale)
                    <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                        {{ $locale['name'] }}
                    </option>
                @endforeach
            </select>

            <textarea
                name="description[{{ get_current_lang()['code'] }}]"
                class="form-control  form-control-multilingual form-control-{{get_current_lang()['code']}} @error('description.' . get_current_lang()['code']) is-invalid @enderror"
            >{{ old('description.' . $current_lang, isset($model) ? $model->description : '') }}</textarea>
            @error('description.' . $current_lang)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            @foreach(get_langauges_except_current() as $locale)
                <textarea
                    name="description[{{ $locale['code'] }}]"
                    class="form-control form-control-multilingual form-control-{{$locale['code']}} d-none  @error('description.' . $locale['code']) is-invalid @enderror"
                >{{ old('description.' . $locale['code'], isset($model) ? $model->getTranslation('description', $locale['code']) : '') }}</textarea>
                @error('description.' . $locale['code'])
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endforeach

        </div>


    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->


<!--begin::Input group -- parent category -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="{{ $classColLable }} col-form-label fw-bold fs-6">{{ __('blog::view.categories_table.parent_category') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="{{ $classColInput }} fv-row">
        <div class="mb-4">
            <select
                class="form-control @error('parent_id') is-invalid @enderror"
                name="parent_id"
                data-control="select2"
                data-placeholder="{{ __('blog::view.categories_table.choose_category') }}"
                data-allow-clear="true"
            >
                <option></option>
                @foreach($category_list as $category)
                    <option value="{{ $category->id }}" {{ old('parent_id', (isset($model) ? $model->parent_id : null)) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->



<!--begin::Col Image -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-md-4 col-form-label fw-bold fs-6">{{ __('blog::view.categories_table.image') }}</label>
    <!--end::Label-->
    <div class="col-md-8">
        @if(isset($model))
            <x-media-library-collection max-items="1" name="image" :model="$model" collection="featured_image" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
        @else
            <x-media-library-attachment name="image" collection="featured_image" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
        @endif
    </div>
</div>
<!--end::Col-->


<!--begin::Input group -- activation -->
@if ($typeForm == 'edit')
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="{{ $classColLable }} col-form-label fw-bold fs-6">{{ __('view.activation') }}</label>
        <!--end::Label-->

        <!--begin::Input group-->
        <div class="{{ $classColInput }} fv-row">
            <div class="mb-4">
                <div class="custom-control custom-switch icheck-success d-inline">
                    <input  name="active" class="custom-control-input" type="checkbox" id="category_activation" value="1" {{ old('active', isset($model) ? $model->active : true) == 1 ? 'checked="checked"' : '' }} >
                    <label class="custom-control-label" for="category_activation">
                        {{ __('view.active') }}
                    </label>
                </div>
            </div>
        </div>
        <!--end::Input group-->
    </div>
@endif
<!--end::Input group-->
