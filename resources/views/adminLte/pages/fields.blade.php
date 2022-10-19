@foreach($fields as $field_key => $field)
    <!--begin::Input group --  Field -->
    <div class="row mb-6">
        @if($field['type'] == 'separator')
            <div class="separator my-10"></div>
        @elseif($field['type'] === 'headline')
            <div class="card-title mt-5">
                <h3 class="fw-bolder">{{ __($field['label'])  }}</h3>
            </div>
        @else
            <!--begin::Label-->
            @if($field['type'] == 'radio')
                <label class="col-lg-4">{{ __($field['label'])  }}</label>
            @else
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __($field['label'])  }}</label>
            @endif
            <!--end::Label-->

            <!--begin::Input group-->
            <div class="col-lg-8 fv-row">
                <div class="wrapper-inputs">
                    @if ($field['type'] == 'string')
                        @if (isset($field['translatable']) && $field['translatable'])
                            <div class="input-group mb-5 lang_container" id="lang_container_{{ $field_key }}">
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
                                    name="fields[{{ $field_key }}][{{app()->getLocale()}}]"
                                    class="form-control  form-control-multilingual form-control-{{app()->getLocale()}} @error('fields.' . $field_key. app()->getLocale()) is-invalid @enderror"
                                    value="{{ old('fields.' . $field_key .'.'. app()->getLocale(), (isset($field['value'][app()->getLocale()]) ? $field['value'][app()->getLocale()] : '') ) }}"
                                >
                                @error('fields.' . $field_key.'.'.app()->getLocale()) 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @foreach(get_langauges_except_current() as $locale)
                                    <input
                                        type="text"
                                        name="fields[{{ $field_key }}][{{ $locale['code'] }}]"
                                        class="form-control form-control form-control-multilingual form-control-{{$locale['code']}} @error('fields.' . $field_key. $locale['code']) is-invalid @enderror d-none"
                                        value="{{ old('fields.' . $field_key .'.'. $locale['code'], (isset($field['value'][$locale['code']]) || is_array($field['value']) ? (isset($field['value'][$locale['code']]) ? $field['value'][$locale['code']] : '') : $field['value']) ) }}"
                                    >
                                    @error('fields.' . $field_key .'.'. $locale['code']) 
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endforeach
                            </div>
                        @else
                            <div class="input-group mb-5">
                                <input
                                    type="text"
                                    name="fields[{{ $field_key }}]"
                                    class="form-control form-control-lg @error('fields.' . $field_key) is-invalid @enderror"
                                    value="{{ old('fields.' . $field_key, (isset($field['value']) ? $field['value'] : $field['value']) ) }}"
                                >
                                @error('fields.' . $field_key) 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        
                    @elseif($field['type'] == 'password')
                        <div class="input-group mb-5">
                            <input
                                type="password"
                                name="fields[{{ $field_key }}]"
                                class="form-control form-control-lg @error('fields.' . $field_key) is-invalid @enderror"
                                value="{{ old('fields.' . $field_key, (isset($field['value']) ? $field['value'] : $field['value']) ) }}"
                            >
                            @error('fields.' . $field_key) 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @elseif($field['type'] == 'number')
                        <div class="input-group mb-5">
                            <input
                                type="number"
                                name="fields[{{ $field_key }}]"
                                class="form-control form-control-lg @error('fields.' . $field_key) is-invalid @enderror"
                                value="{{ old('fields.' . $field_key, (isset($field['value']) ? $field['value'] : $field['value']) ) }}"
                            >
                            @error('fields.' . $field_key) 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @elseif($field['type'] == 'text')

                        @if (isset($field['translatable']) && $field['translatable'])
                            <div class="mb-5 lang_container text" id="lang_container_{{ $field_key }}">
                                <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                                    <option value="{{ app()->getLocale() }}" data-flag="{{Config::get('current_lang_image')}}" selected>
                                        {{ get_current_lang()['name'] }}
                                    </option>
                                    @foreach(get_langauges_except_current() as $locale)
                                        <option value="{{ $locale['code'] }}" data-flag="{{$locale['icon']}}">
                                            {{ $locale['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                        

                                @php
                                    $field_value = $field['value'];
                                    if(isset($field['value'][app()->getLocale()])){
                                        $field_value = $field['value'][app()->getLocale()];
                                    }
                                @endphp
                                <textarea
                                    name="fields[{{ $field_key }}][{{app()->getLocale()}}]"
                                    class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}} @error('fields.' . $field_key.'.'.app()->getLocale()) is-invalid @enderror"
                                >{{ old('fields.' . $field_key .'.'. app()->getLocale(), (isset($field['value'][app()->getLocale()]) || is_array($field['value']) ? $field['value'][app()->getLocale()] : $field['value']) ) }}</textarea>
                                @error('fields.' . $field_key.'.'.app()->getLocale()) 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                
                                @foreach(get_langauges_except_current() as $locale)
                                    @php
                                        $field_value = $field['value'];
                                        if(isset($field['value'][app()->getLocale()])){
                                            $field_value = $field['value'][$locale['code']];
                                        }
                                    @endphp

                                    <textarea
                                        name="fields[{{ $field_key }}][{{$locale['code']}}]"
                                        class="form-control form-control-multilingual form-control-{{$locale['code']}} d-none form-control-lg @error('fields.' . $field_key.'.'.$locale['code']) is-invalid @enderror"
                                    >{{ old('fields.' . $field_key .'.'. $locale['code'], (isset($field['value'][$locale['code']]) || is_array($field['value']) ? (isset($field['value'][$locale['code']]) ? $field['value'][$locale['code']] : '') : $field['value']) ) }}</textarea>
                                    @error('fields.' . $field_key .'.'. $locale['code']) 
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endforeach

                            </div>
                        @else
                            <div class="input-group mb-5">
                                <textarea
                                    name="fields[{{ $field_key }}]"
                                    class="form-control form-control-lg @error('fields.' . $field_key) is-invalid @enderror"
                                >{{ old('fields.' . $field_key, $field_value ) }}</textarea>
                                @error('fields.' . $field_key) 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                    @elseif($field['type'] == 'bool')

                        <div class="custom-control custom-switch form-check form-switch pt-3">
                            <input
                                class="custom-control-input form-check-input"
                                type="checkbox"
                                name="fields[{{ $field_key }}]"
                                id="fields[{{ $field_key }}]"
                                value="1"
                                {{ old('fields') ? (old('fields.' . $field_key) == true ? 'checked="checked"' : '') : ($field['value'] == true ? 'checked="checked"' : '') }}
                            >
                            @error('fields.' . $field_key) 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label
                                class="custom-control-label"
                                for="fields[{{ $field_key }}]"
                            >
                            </label>
                        </div>
                        
                    @elseif($field['type'] == 'array_enable_select')
                        <div class="row mb-6">
                            @foreach($field['array'] as $key => $item)
                                @if($item['type'] == 'select')
                                    <div class="col-sm-4 custom-control custom-switch form-check form-switch pt-3">
                                        <input
                                            class="custom-control-input form-check-input array_boolen_ckeck"
                                            type="checkbox"
                                            id="array_boolen_{{ $key }}"
                                            name="fields[{{ $key }}]"
                                            value="1"
                                            {{ old('fields') ? (old('fields.' . $key) == true ? 'checked="checked"' : '') : ($item['value'] != false ? 'checked="checked"' : '') }}
                                        >
                                        @error('fields.' . $key) 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="array_boolen_{{ $key }}" class="custom-control-label col-sm-12 @if(isset($item['if'])) condition_fields @endif  if_{{$item['if'] ?? ''}} if_{{$item['if'] ?? ''}}_{{$item['if_value'] ?? ''}} array_boolen_{{ $key }}_label fw-bold fs-6">{{ __($item['label'])  }}</label>
                                    </div>
                               
                                    <div class="col-sm-8 mb-5 @if(isset($item['if'])) condition_fields @endif  if_{{$item['if'] ?? ''}} if_{{$item['if'] ?? ''}}_{{$item['if_value'] ?? ''}}">
                                        <select id="fields[{{ $key }}]" @if($item['multiple']) multiple="multiple"  name="fields[{{ $field_key }}][{{ $key }}][]" @else  name="fields[{{ $field_key }}][{{ $key }}]" @endif  class="form-control array_boolen_{{ $key }} @if(isset($item['conditionier'])) conditionier @endif"
                                            data-control="select2"
                                        >
                                            @foreach($item['options'] as $value => $label)
                                                <option value="{{ $value }}" 
                                                {{ old('fields') ? (old('fields.' . $field_key .'.'.$key) == $value ? 'selected="selected"' : '') : (is_array($item['value']) ? (in_array($value, $item['value']) ? 'selected="selected"' : '')  : ($item['value'] == $value ? 'selected="selected"' : '')) }}
                                                >
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('fields.' . $field_key .'.'.$key) 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @else
                                    <div class="col-sm-4 custom-control custom-switch form-check form-switch pt-3">
                                        <input
                                            class="custom-control-input form-check-input array_boolen_ckeck"
                                            type="checkbox"
                                            id="array_boolen_{{ $key }}"
                                            name="fields[{{ $field_key }}][{{ $key }}][]"
                                            value="1"
                                            {{ old('fields') ? (old('fields.' . $key) == true ? 'checked="checked"' : '') : ($item['value'] != false ? 'checked="checked"' : '') }}
                                        >
                                        @error('fields.' . $key) 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="array_boolen_{{ $key }}" class="custom-control-label col-sm-12 @if(isset($item['if'])) condition_fields @endif  if_{{$item['if'] ?? ''}} if_{{$item['if'] ?? ''}}_{{$item['if_value'] ?? ''}} array_boolen_{{ $key }}_label fw-bold fs-6">{{ __($item['label'])  }}</label>
                                    </div>
                                    <div class="col-sm-8 mb-5"></div>
                                @endif
                            @endforeach
                        </div>
                    @elseif($field['type'] == 'array_boolen')
                        <div class="row mb-6">
                            <div class="col-sm-1 custom-control custom-switch form-check form-switch pt-3">
                                <input
                                    class="custom-control-input form-check-input array_boolen_ckeck"
                                    type="checkbox"
                                    id="array_boolen_{{ $field_key }}"
                                    name="fields[{{ $field_key }}]"
                                    value="1"
                                    {{ old('fields') ? (old('fields.' . $key) == true ? 'checked="checked"' : '') : ($field['value'] != false ? 'checked="checked"' : '') }}
                                >
                                <label class="custom-control-label" for="array_boolen_{{ $field_key }}"></label>
                                @error('fields.' . $field_key) 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @foreach($field['array'] as $key => $item)
                                @if($loop->first != true)
                                    <div class="col-sm-1  @if(isset($item['if'])) condition_fields @endif  if_{{$item['if'] ?? ''}} if_{{$item['if'] ?? ''}}_{{$item['if_value'] ?? ''}} form-check form-switch pt-3"></div>
                                @endif
                                <label class="col-sm-3 @if(isset($item['if'])) condition_fields @endif  if_{{$item['if'] ?? ''}} if_{{$item['if'] ?? ''}}_{{$item['if_value'] ?? ''}} col-form-label array_boolen_{{ $field_key }}_label fw-bold fs-6">{{ __($item['label'])  }}</label>
                                <div class="col-sm-8 mb-5 @if(isset($item['if'])) condition_fields @endif  if_{{$item['if'] ?? ''}} if_{{$item['if'] ?? ''}}_{{$item['if_value'] ?? ''}}">
                                    @if($item['type'] == 'string')
                                        @if (isset($item['translatable']) && $item['translatable'])
                                            <div class="input-group lang_container" id="lang_container_{{ $key }}">
                                                <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px array_boolen_{{ $field_key }}">
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
                                                    id="fields[{{ $key }}]"
                                                    name="fields[{{ $field_key }}][{{ $key }}][{{app()->getLocale()}}]"
                                                    class="array_boolen_{{ $field_key }} form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}} @error('fields.' . $field_key.$key. app()->getLocale()) is-invalid @enderror"
                                                    value="{{ old('fields.' . $field_key .'.'.$key .'.'. app()->getLocale(), (isset($item['value'][app()->getLocale()]) ? $item['value'][app()->getLocale()] : $item['value']) ) }}"
                                                >
                                                @error('fields.' . $field_key.'.'.$key.'.'.app()->getLocale()) 
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                @foreach(get_langauges_except_current() as $locale)
                                                    <input
                                                        type="text"
                                                        id="fields[{{ $key }}]"
                                                        name="fields[{{ $field_key }}][{{ $key }}][{{ $locale['code'] }}]"
                                                        class="array_boolen_{{ $field_key }} form-control form-control-lg form-control-multilingual form-control-{{$locale['code']}} @error('fields.' . $field_key.$key. $locale['code']) is-invalid @enderror d-none"
                                                        value="{{ old('fields.' . $field_key .'.'.$key .'.'. $locale['code'], (isset($item['value'][$locale['code']]) || is_array($item['value']) ? (isset($item['value'][$locale['code']]) ? $item['value'][$locale['code']] : '' ) : $item['value']) ) }}"
                                                    >
                                                    @error('fields.' .$field_key.'.'. $key .'.'. $locale['code']) 
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="input-group">
                                                <input
                                                    id="fields[{{ $key }}]"
                                                    type="text"
                                                    name="fields[{{ $field_key }}][{{ $key }}]"
                                                    class="array_boolen_{{ $field_key }} form-control form-control-lg @error('fields.' .$field_key .'.'. $key) is-invalid @enderror"
                                                    value="{{ old('fields.' . $field_key .'.' . $key, (isset($item['value']) ? $item['value'] : $item['value']) ) }}"
                                                >
                                                @error('fields.' .$field_key.'.'. $key) 
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        @endif
                                    @elseif ($item['type'] == 'password')
                                        <div class="input-group">
                                            <input
                                                id="fields[{{ $key }}]"
                                                type="password"
                                                name="fields[{{ $field_key }}][{{ $key }}]"
                                                class="array_boolen_{{ $field_key }} form-control form-control-lg @error('fields.' . $field_key .'.'. $key) is-invalid @enderror"
                                                value="{{ old('fields.' . $field_key .'.'. $key, (isset($item['value']) ? $item['value'] : $item['value']) ) }}"
                                            >
                                            @error('fields.' . $field_key.'.'.$key) 
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        @error('fields.' . $field_key .'.'. $key) 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @elseif($item['type'] == 'number')
                                        <div class="input-group">
                                            <input
                                                type="number"
                                                id="fields[{{ $key }}]"
                                                name="fields[{{ $field_key }}][{{ $key }}]"
                                                class="array_boolen_{{ $field_key }} form-control form-control-lg @error('fields.' . $field_key .'.'.$key) is-invalid @enderror"
                                                value="{{ old('fields.' . $field_key .'.'.$key, (isset($item['value']) ? $item['value'] : $item['value']) ) }}"
                                            >
                                            @error('fields.' . $field_key .'.'.$key) 
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    
                                        @error('fields.' . $field_key .'.'.$key) 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @elseif($item['type'] == 'select')
                                        <select id="fields[{{ $key }}]" name="fields[{{ $field_key }}][{{ $key }}]" class="form-control array_boolen_{{ $field_key }} @if(isset($item['conditionier'])) conditionier @endif">
                                            @foreach($item['options'] as $value => $label)
                                                <option value="{{ $value }}" 
                                                {{ old('fields') ? (old('fields.' . $field_key .'.'.$key) == $value ? 'selected="selected"' : '') : ($item['value'] == $value ? 'selected="selected"' : '') }}
                                                >
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('fields.' . $field_key .'.'.$key) 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @elseif($item['type'] == 'bool')

                                        <div class="custom-control custom-switch form-check form-switch pt-3">
                                            <input
                                                class="custom-control-input array_boolen_{{ $field_key }} @error('fields.' . $field_key .'.'.$key) is-invalid @enderror"
                                                type="checkbox"
                                                id="fields[{{ $key }}]"
                                                name="fields[{{ $field_key }}][{{ $key }}]"
                                                value="1"
                                                {{ old('fields') ? (old('fields.' . $field_key) == true ? 'checked="checked"' : '') : ($item['value'] == true ? 'checked="checked"' : '') }}
                                            >
                                            <label
                                                class="custom-control-label"
                                                for="fields[{{ $key }}]"
                                            >
                                            </label>
                                            @error('fields.' . $field_key) 
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    @elseif($item['type'] == 'note')
                                        {{isset($item['value']) ? $item['value'] : ''}} 
                                        @if(isset($item['help_link']) && $item['help_link'] != ' ')
                                            , <a href="{{$item['help_link']}}" target="_blank">@lang('view.this_help_you')</a>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @elseif($field['type'] == 'color')

                        <input
                            name="fields[{{ $field_key }}]"
                            class="form-control form-control-color w-100 color_picker_input @error('fields.' . $field_key) is-invalid @enderror"
                            id="{{ $field_key }}"
                            value="{{ old('fields.' . $field_key, $field['value'] ) }}"
                        >
                        @error('fields.' . $field_key)
                            <div class="is-invalid"></div>
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    @elseif($field['type'] == 'image')
                        @php
                            $model = App\Models\Settings::where('group', $type)->where('name',$field_key)->first();
                        @endphp
                        <div>
                            @if(isset($model))
                                <x-media-library-collection max-items="1" name="fields[{{ $field_key }}]" :model="$model" collection="{{ $field_key }}" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                            @else
                                <x-media-library-attachment name="fields[{{ $field_key }}]" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
                            @endif
                        </div>


                    @elseif($field['type'] == 'select')
                        <div class="input-group mb-5">
                            <select name="fields[{{ $field_key }}]" class="form-control" 
                                data-control="select2"
                                data-placeholder="{{ __('cargo::view.choose') }}"
                                data-allow-clear="true"
                            >
                                @foreach($field['options'] as $value => $label)
                                    <option value="{{ $value }}" 
                                    {{ old('fields') ? (old('fields.' . $field_key) == $value ? 'selected="selected"' : '') : ($field['value'] == $value ? 'selected="selected"' : '') }}
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            @error('fields.' . $field_key) 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @elseif($field['type'] == 'multi-select')
                    @elseif($field['type'] == 'array')

                        @php
                            $value_array = old('fields.' . $field_key, is_array($field['value']) ? $field['value'] : [] );
                        @endphp
                        <div class="wrapper-array-value" data-key="{{ $field_key }}" data-placeholder="{{__('setting::view.item')}}">
                            @foreach($value_array as $value)
                            
                                <div class="array-item d-flex mb-4">
                                    <div class="input w-100">
                                        <input
                                            type="text"
                                            name="fields[{{ $field_key }}][]"
                                            class="form-control form-control-lg @error('fields.' . $field_key . '.' . $loop->index) is-invalid @enderror"
                                            placeholder="{{ __('setting::view.item') . ' ' . ($loop->index + 1) }}"
                                            value="{{ $value }}"
                                        >
                                        @error('fields.' . $field_key . '.' . $loop->index)
                                            <div class="is-invalid"></div>
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-active-light-danger btn-sm ms-2 btn-remove-item mh-45px">
                                        <i class="fas fa-times fs-3"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <div class="add-new-item-array mb-4">
                            <button type="button" class="btn btn-success btn-sm btn-add-item" data-key="{{ $field_key }}">
                                {{ __('setting::view.add_new_item') }}
                                <i class="fas fa-plus fa-fw ms-2"></i>
                            </button>
                        </div>
                    @elseif($field['type'] == 'radio')
                        <div class="input-group mb-5">
                            <div class="radio-inline">
                                <label class="radio radio-success" style="margin-right: 15px;">
                                    <input value="{{ old('fields.' . $field_key, (isset($field['value_radio_1']) ? $field['value_radio_1'] : $field['value_radio_1']) ) }}"  {{$field['checked_radio_1']}} type="radio" name="fields[{{ $field_key }}]"/>
                                    <span></span>
                                    {{ __($field['label_radio_1'])  }}
                                </label>
                                <label class="radio radio-success">
                                    <input value="{{ old('fields.' . $field_key, (isset($field['value_radio_2']) ? $field['value_radio_2'] : $field['value_radio_2']) ) }}"  {{$field['checked_radio_2']}} type="radio"  name="fields[{{ $field_key }}]"/>
                                    <span></span>
                                    {{ __($field['label_radio_2'])  }}
                                </label>
                                @if (isset($field['active_radio_3']) && $field['active_radio_3'])
                                    <label class="radio radio-success" style="margin-left: 15px;">
                                        <input value="{{ old('fields.' . $field_key, (isset($field['value_radio_3']) ? $field['value_radio_3'] : $field['value_radio_3']) ) }}"  {{$field['checked_radio_3']}} type="radio"  name="fields[{{ $field_key }}]"/>
                                        <span></span>
                                        {{ __($field['label_radio_3'])  }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    @elseif($field['type'] == 'hidden')
                        <div class="input-group mb-5">
                            <input
                                type="hidden"
                                name="fields[{{ $field_key }}]"
                                class="form-control form-control-lg @error('fields.' . $field_key) is-invalid @enderror"
                                value="{{ old('fields.' . $field_key, (isset($field['value']) ? $field['value'] : $field['value']) ) }}"
                            >
                            @error('fields.' . $field_key) 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>
            <!--end::Input group-->
        @endif
    </div>
    <!--end::Input group-->
@endforeach



@section('scripts')
    @if (isset($fields_script))
        {!! $fields_script !!}
    @endif
@endsection