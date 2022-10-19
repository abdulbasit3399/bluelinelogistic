@csrf


<!--begin::Input group --  Full name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="input-group lang_container" id="lang_container_name">
            <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
                    {{ get_current_lang()['name'] }}
                </option>
                @foreach(get_langauges_except_current() as $locale)
                    <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                        {{ $locale['name'] }}
                    </option>
                @endforeach
            </select>
            <input
                type="text"
                placeholder="{{ __('cargo::view.table.name') }}"
                name="name[{{app()->getLocale()}}]"
                title="{{app()->getLocale()}}"
                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}} @error('name.' . get_current_lang()['code']) is-invalid @enderror"
                value="{{ isset($model) && isset( json_decode($model->name, true)[app()->getLocale()] ) ? json_decode($model->name, true)[app()->getLocale()] : '' }}"
            >
            @foreach(get_langauges_except_current() as $locale)
                <input
                    type="text"
                    placeholder="{{ __('cargo::view.table.name') }}"
                    name="name[{{ $locale['code'] }}]"
                    title="{{ $locale['code'] }}"
                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none @error('name.' . get_current_lang()['code']) is-invalid @enderror"
                    value="{{ isset($model) && isset(json_decode($model->name, true)[$locale['code']] ) ? json_decode($model->name, true)[$locale['code']] : '' }}"
                >
            @endforeach
            
            @error('name.' . get_current_lang()['code'])
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group --  Hours -->
<div class="row mb-6">
    <!--begin::Label-->
    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('cargo::view.table.hours') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="hours" class="form-control form-control-lg @error('hours') is-invalid @enderror" placeholder="{{ __('cargo::view.table.hours') }}" value="{{ old('hours', isset($model) ? $model->hours : '') }}" />
            @error('hours') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

