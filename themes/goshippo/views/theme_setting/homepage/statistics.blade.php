@php
    $hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getBanner = $hasBanner ? $data['header_logo_url'] : '';
    $hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="statistics">

    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.display') </label>
        <div class="col-md-8">
            <div class="custom-control custom-switch form-check form-switch">
                <input
                    class="custom-control-input form-check-input"
                    name="display"
                    type="checkbox"
                    value="1"
                    id="display_business_{{isset($id) ? $id : 'id'}}"
                    {{ isset($id) ? (isset($data['display']) && $data['display'] == 1 ? 'checked="checked"' : '') : 'checked="checked"' }}
                >
                <label class="custom-control-label form-check-label fw-bold fs-6" for="display_business_{{isset($id) ? $id : 'id'}}"></label>
            </div>
        </div>
    </div>
    <!--end::row toggle display -->

    <!--begin::row header_bg -->
    <div class="row mb-6 header_bg">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_bg') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} header_bg_input"
                    name="header_bg"
                    value="{{ isset($data['header_bg']) ? $data['header_bg'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row header_bg -->

    <!--begin::row card_1_bg_color -->
    <div class="row mb-6 card_1_bg_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_1_bg_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_bg_color_input"
                    name="card_1_bg_color"
                    value="{{ isset($data['card_1_bg_color']) ? $data['card_1_bg_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row card_1_bg_color -->

    <!--begin::row card_title_1_color -->
    <div class="row mb-6 card_title_1_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_title_1_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_title_1_color_input"
                    name="card_title_1_color"
                    value="{{ isset($data['card_title_1_color']) ? $data['card_title_1_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row card_title_1_color -->

    <!--begin::row card_desc_1_color -->
    <div class="row mb-6 card_desc_1_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.card_desc_1_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_desc_1_color_input"
                    name="card_desc_1_color"
                    value="{{ isset($data['card_desc_1_color']) ? $data['card_desc_1_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row card_desc_1_color -->

    <!--begin::row button_bg_color -->
    <div class="row mb-6 card_1_bg_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.button_bg_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_bg_color_input"
                    name="button_bg_color"
                    value="{{ isset($data['button_bg_color']) ? $data['button_bg_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row button_bg_color -->

    <!--begin::row button_text_color -->
     <div class="row mb-6 card_desc_1_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_button_text_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_desc_1_color_input"
                    name="button_text_color"
                    value="{{ isset($data['button_text_color']) ? $data['button_text_color'] : '#f3f6f4' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row button_text_color -->

    <!--begin::row card_title_1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_1') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_card_title_1">
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
                        name="card_title_1[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['card_title_1']) && isset($data['card_title_1'][app()->getLocale()]) ? $data['card_title_1'][app()->getLocale()] : '100 Million+' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_1[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_1']) && isset($data['card_title_1'][$locale['code']]) ? $data['card_title_1'][$locale['code']] : '100 Million+' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row card_title_1 -->

    <!--begin::row card_description_1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_1') </label>
        <div class="col-md-8">

                <div class="input-group lang_container text" id="lang_container_card_description_1">
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

                    <textarea name="card_description_1[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_1']) && isset($data['card_description_1'][app()->getLocale()]) ? $data['card_description_1'][app()->getLocale()] : 'Shipments Annually' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_1[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_1']) && isset($data['card_description_1'][$locale['code']]) ? $data['card_description_1'][$locale['code']] : 'Shipments Annually' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row card_description_1 -->

    <!--begin::row card_title_2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_2') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_card_title_2">
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
                        name="card_title_2[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['card_title_2']) && isset($data['card_title_2'][app()->getLocale()]) ? $data['card_title_2'][app()->getLocale()] : '100K+' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_2[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_2']) && isset($data['card_title_2'][$locale['code']]) ? $data['card_title_2'][$locale['code']] : '100K+' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row card_title_2 -->

    <!--begin::row card_description_2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_2') </label>
        <div class="col-md-8">

                <div class="input-group lang_container text" id="lang_container_card_description_2">
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

                    <textarea name="card_description_2[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_2']) && isset($data['card_description_2'][app()->getLocale()]) ? $data['card_description_2'][app()->getLocale()] : 'Brands that trust Shippo' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_2[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_2']) && isset($data['card_description_2'][$locale['code']]) ? $data['card_description_2'][$locale['code']] : 'Brands that trust Shippo' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row card_description_2 -->

    <!--begin::row card_title_3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_3') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_card_title_3">
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
                        name="card_title_3[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['card_title_3']) && isset($data['card_title_3'][app()->getLocale()]) ? $data['card_title_3'][app()->getLocale()] : '90%' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_3[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_3']) && isset($data['card_title_3'][$locale['code']]) ? $data['card_title_3'][$locale['code']] : '90%' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row card_title_3 -->

    <!--begin::row card_description_3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_3') </label>
        <div class="col-md-8">

                <div class="input-group lang_container text" id="lang_container_card_description_3">
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

                    <textarea name="card_description_3[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_3']) && isset($data['card_description_3'][app()->getLocale()]) ? $data['card_description_3'][app()->getLocale()] : 'Potential savings on shipping labels' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_3[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_3']) && isset($data['card_description_3'][$locale['code']]) ? $data['card_description_3'][$locale['code']] : 'Potential savings on shipping labels' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row card_description_3 -->

    <!--begin::row card_title_4 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_4') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_card_title_4">
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
                        name="card_title_4[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['card_title_4']) && isset($data['card_title_4'][app()->getLocale()]) ? $data['card_title_4'][app()->getLocale()] : '$5.2B' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_4[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_4']) && isset($data['card_title_4'][$locale['code']]) ? $data['card_title_4'][$locale['code']] : '$5.2B' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row card_title_4 -->

    <!--begin::row card_description_4 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_4') </label>
        <div class="col-md-8">

                <div class="input-group lang_container text" id="lang_container_card_description_4">
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

                    <textarea name="card_description_4[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_4']) && isset($data['card_description_4'][app()->getLocale()]) ? $data['card_description_4'][app()->getLocale()] : 'Annual gross merchandise volume' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_4[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_4']) && isset($data['card_description_4'][$locale['code']]) ? $data['card_description_4'][$locale['code']] : 'Annual gross merchandise volume' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row card_description_4 -->

    <!--begin::row card_title_5 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_title_5') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_card_title_5">
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
                        name="card_title_5[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['card_title_5']) && isset($data['card_title_5'][app()->getLocale()]) ? $data['card_title_5'][app()->getLocale()] : '77%' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_5[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_5']) && isset($data['card_title_5'][$locale['code']]) ? $data['card_title_5'][$locale['code']] : '77%' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row card_title_5 -->

    <!--begin::row card_description_5 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.card_description_5') </label>
        <div class="col-md-8">

                <div class="input-group lang_container text" id="lang_container_card_description_5">
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

                    <textarea name="card_description_5[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_5']) && isset($data['card_description_5'][app()->getLocale()]) ? $data['card_description_5'][app()->getLocale()] : 'Avg YOY growth for Shippo brands' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_5[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_5']) && isset($data['card_description_5'][$locale['code']]) ? $data['card_description_5'][$locale['code']] : 'Avg YOY growth for Shippo brands' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row card_description_5 -->

    <!--begin::row section button -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_button') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_section_button">
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
                        name="section_button[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['section_button']) && isset($data['section_button'][app()->getLocale()]) ? $data['section_button'][app()->getLocale()] : 'Button' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="section_button[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['section_button']) && isset($data['section_button'][$locale['code']]) ? $data['section_button'][$locale['code']] : 'Button' }}"
                        >
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row section button -->

    <!--begin::row section URL Field -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_url') </label>
        <div class="col-md-8">

                <div class="input-group url_input_container" id="url_input_container_section_url">
                    <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="section_url[type]" data-title="type">
                        <option value="custom"  {{ (isset($data['section_url']) && isset($data['section_url']['type'])) ? ($data['section_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                        @if (check_module('pages'))
                            <option value="page" {{ (isset($data['section_url']) && isset($data['section_url']['type']) && $data['section_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                        @endif
                        @if (check_module('blog'))
                            <option value="category" {{ (isset($data['section_url']) && isset($data['section_url']['type']) && $data['section_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                            <option value="post" {{ (isset($data['section_url']) && isset($data['section_url']['type']) && $data['section_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                        @endif
                    </select>
                    <input
                        type="text"
                        name="section_url[custom]"
                        data-title="custom"
                        data-type="array"
                        class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['section_url']) && isset($data['section_url']['type'])) ? ($data['section_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                        value="{{ isset($data['section_url']) && isset($data['section_url']['custom']) ? $data['section_url']['custom'] : '' }}"
                    >
                    @if (check_module('pages'))
                        <div class="form-control-choose-type form-control-page {{ (isset($data['section_url']) && isset($data['section_url']['type']) && $data['section_url']['type'] == 'page') ? '' : 'd-none' }}">
                            <select
                                class="form-select mw-auto"
                                name="section_url[page]"
                                data-title="page"
                                data-type="array"
                                data-placeholder="@lang('theme_goshippo::view.choose_page')"
                            >
                                @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                    @foreach ($data['categories'] as $categoryId)
                                        @php
                                            $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                        @endphp
                                        <option value="{{$category->id}}" {{ isset($data['section_url']) && isset($data['section_url']['page']) && $data['section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                    @if (check_module('blog'))
                        <div class="form-control-choose-type form-control-category {{ (isset($data['section_url']) && isset($data['section_url']['type']) && $data['section_url']['type'] == 'category') ? '' : 'd-none' }}">
                            <select
                                class="form-select  mw-auto "
                                name="section_url[category]"
                                data-title="category"
                                data-type="array"
                                data-placeholder="@lang('theme_goshippo::view.choose_category')"
                            >
                                @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                    @foreach ($data['categories'] as $categoryId)
                                        @php
                                            $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                        @endphp
                                        <option value="{{$category->id}}" {{ isset($data['section_url']) && isset($data['section_url']['page']) && $data['section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-control-choose-type form-control-post {{ (isset($data['section_url']) && isset($data['section_url']['type']) && $data['section_url']['type'] == 'post') ? '' : 'd-none' }}">
                            <select
                                class="form-select mw-auto "
                                name="section_url[post]"
                                data-title="post"
                                data-type="array"
                                data-placeholder="@lang('theme_goshippo::view.choose_post')"
                            >
                                @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                    @foreach ($data['categories'] as $categoryId)
                                        @php
                                            $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                        @endphp
                                        <option value="{{$category->id}}" {{ isset($data['section_url']) && isset($data['section_url']['page']) && $data['section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                </div>
        </div>
    </div>
    <!--end::row section button -->

</div>

<link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/plugins/spectrum/spectrum.min.js') }}"></script>
<script>
    $(".color_picker_input_{{isset($id) ? $id : 'id'}}").spectrum({
      type: "component",
      showInput: true,
       showInitial: true,
      clickoutFiresChange: true,
      allowEmpty: true,
      maxSelectionSize: 8,
    });

    $("#repeater_{{isset($id) ? $id : 'id'}}").repeater({
        initEmpty: false,

        show: function() {
            $(this).slideDown();

            $("select.form-select").select2();
            $(".change_language").select2({
                templateResult: formatFlag,
                templateSelection: formatState,
                minimumResultsForSearch: -1,
                width: '100%'
            });

            function formatFlag (lang) {
                if (!lang.id) { return lang.text; }
                var $img    = $(lang.element).attr("data-flag");
                if($img) {
                    var $lang = $(
                        '<span ><img sytle="display: inline-block;" src=" '+ $(lang.element).attr("data-flag") +' " />&emsp;' + lang.text + '</span>'
                    );
                }else{
                    var $lang = $(
                        '<span >' + lang.text + '</span>'
                    );
                }
                return $lang;
            }
            function formatState (lang) {
                if (!lang.id) {
                return lang.text;
                }
                var $img    = $(lang.element).attr("data-flag");
                if($img) {
                    var $lang = $(
                        '<span ><img sytle="display: inline-block;" src=" '+ $(lang.element).attr("data-flag") +' " />&emsp;' + lang.text + '</span>'
                    );
                }else{
                    var $lang = $(
                        '<span >' + lang.text + '</span>'
                    );
                }
                return $lang;
            };
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        },

        isFirstItemUndeletable: true
    });

    $("select.form-select").select2();
    $(".change_language").select2({
        templateResult: formatFlag,
        templateSelection: formatState,
        minimumResultsForSearch: -1,
        width: '100%'
    });

    function formatFlag (lang) {
        if (!lang.id) { return lang.text; }
        var $img    = $(lang.element).attr("data-flag");
        if($img) {
            var $lang = $(
                '<span ><img sytle="display: inline-block;" src=" '+ $(lang.element).attr("data-flag") +' " />&emsp;' + lang.text + '</span>'
            );
        }else{
            var $lang = $(
                '<span >' + lang.text + '</span>'
            );
        }
        return $lang;
    }
    function formatState (lang) {
        if (!lang.id) {
        return lang.text;
        }
        var $img    = $(lang.element).attr("data-flag");
        if($img) {
            var $lang = $(
                '<span ><img sytle="display: inline-block;" src=" '+ $(lang.element).attr("data-flag") +' " />&emsp;' + lang.text + '</span>'
            );
        }else{
            var $lang = $(
                '<span >' + lang.text + '</span>'
            );
        }
        return $lang;
    };
</script>
