@csrf


<!--begin::Input group -- From Country -->
<div class="row">

    <!--begin::Input group-->
    <div class="col-md-12 fv-row form-group">
        <!--begin::Label-->
        <label class="col-form-label required fw-bold fs-6">{{ __('cargo::view.from_country') }}</label>
        <!--end::Label-->
        <select
            class="form-control  @error('country_id') is-invalid @enderror"
            name="country_id"
            data-control="select2"
            data-placeholder="{{ __('cargo::view.choose_country') }}"
            data-allow-clear="true"
            id="change-country"
        >
            <option></option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}" 
                    {{ old('country_id') == $country->id ? 'selected' : '' }}
                    @if($typeForm == 'edit')
                        {{ $model->state->country_id == $country->id ? 'selected' : '' }}
                    @endif
                >{{ $country->name }}</option>
            @endforeach
        </select>
        @error('country_id') 
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group -- From Country -->
<div class="row">

    <!--begin::Input group-->
    <div class="col-md-12 fv-row form-group">
        <!--begin::Label-->
        <label class="col-form-label required fw-bold fs-6">{{ __('cargo::view.from_region') }}</label>
        <!--end::Label-->
        <select
            class="form-control  @error('state_id') is-invalid @enderror"
            name="state_id"
            data-control="select2"
            data-placeholder="{{ __('cargo::view.choose_region') }}"
            data-allow-clear="true"
        >
            <option></option>
            @if($typeForm == 'edit')
                @foreach($states as $state)
                    <option value="{{ $state->id }}" 
                        {{ old('state_id') == $state->id ? 'selected' : '' }}
                        {{ $model->state_id == $state->id ? 'selected' : '' }}
                    >{{ $state->name }}</option>
                @endforeach
            @endif
        </select>
        @error('state_id') 
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group --  Area Name -->
<div class="row mb-6">

    <!--begin::Input group-->
    <div class="col-lg-12 fv-row">
        <!--begin::Label-->
        <label class="col-form-label required fw-bold fs-6">{{ __('cargo::view.area_name') }}</label>
        <!--end::Label-->
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
                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}} @error('name.' . get_current_lang()['code']) is-invalid @enderror  d-none"
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


{{-- Inject Scripts --}}
@push('js-component')

<script>

		// get-states-ajax
		$('#change-country').change(function() {
            var id = $(this).val();
            console.log(id);
            $.get("{{route('ajax.getStates')}}?country_id=" + id, function(data) {
                console.log(data);
                $('select[name ="state_id"]').empty();
                
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];

                    $('select[name ="state_id"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                    
                }
            });
        });
        // end get-states-ajax
        /*******************************************************************************************/

</script>

@endpush

