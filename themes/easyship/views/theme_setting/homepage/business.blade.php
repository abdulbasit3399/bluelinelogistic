@php
    $hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getBanner = $hasBanner ? $data['header_logo_url'] : '';
    $hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="business">

    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_easyship::view.display') </label>
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
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_easyship::view.section_bg') </label>
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

    <!--begin::row title_color -->
    <div class="row mb-6 title_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_easyship::view.section_title_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} title_color_input"
                    name="title_color"
                    value="{{ isset($data['title_color']) ? $data['title_color'] :  ''  }}"
                >
            </div>
        </div>
    </div>
    <!--end::row title_color -->

    <!--begin::row text_color -->
    <div class="row mb-6 text_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_easyship::view.section_text_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} text_color_input"
                    name="text_color"
                    value="{{ isset($data['text_color']) ? $data['text_color'] :   ''   }}"
                >
            </div>
        </div>
    </div>
    <!--end::row text_color -->

    <!--begin::row card_bg_color -->
    <div class="row mb-6 card_bg_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_easyship::view.card_bg_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_bg_color_input"
                    name="card_bg_color"
                    value="{{ isset($data['card_bg_color']) ? $data['card_bg_color'] :   ''   }}"
                >
            </div>
        </div>
    </div>
    <!--end::row card_bg_color -->

    <!--begin::row card_title_color -->
    <div class="row mb-6 title_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_easyship::view.section_card_title_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_title_color_input"
                    name="card_title_color"
                    value="{{ isset($data['card_title_color']) ? $data['card_title_color'] :   ''   }}"
                >
            </div>
        </div>
    </div>
    <!--end::row card_title_color -->

    <!--begin::row section title -->
    <div class="row mb-6">
        <label class="col-md-4 required fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.section_title') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_section_title">
                    <select class="form-control change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
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
                        name="section_title[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['section_title']) && isset($data['section_title'][app()->getLocale()]) ? $data['section_title'][app()->getLocale()] : '' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="section_title[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['section_title']) && isset($data['section_title'][$locale['code']]) ? $data['section_title'][$locale['code']] : '' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row section title -->

    <!--begin::row section subtitle -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.section_subtitle') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_section_subtitle">
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
                        name="section_subtitle[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['section_subtitle']) && isset($data['section_subtitle'][app()->getLocale()]) ? $data['section_subtitle'][app()->getLocale()] : '' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="section_subtitle[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['section_subtitle']) && isset($data['section_subtitle'][$locale['code']]) ? $data['section_subtitle'][$locale['code']] : '' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row section subtitle -->

    <!--begin::row card_title_1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.card_title_1') </label>
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
                        value="{{ isset($data['card_title_1']) && isset($data['card_title_1'][app()->getLocale()]) ? $data['card_title_1'][app()->getLocale()] : '' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_1[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_1']) && isset($data['card_title_1'][$locale['code']]) ? $data['card_title_1'][$locale['code']] : '' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row card_title_1 -->

    <!--begin::row card_description_1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.card_description_1') </label>
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
                    
                    <textarea name="card_description_1[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_1']) && isset($data['card_description_1'][app()->getLocale()]) ? $data['card_description_1'][app()->getLocale()] : '' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_1[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_1']) && isset($data['card_description_1'][$locale['code']]) ? $data['card_description_1'][$locale['code']] : '' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row card_description_1 -->

    <!--begin::Input Image card 1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_easyship::view.section_banner_1') </label>
        <div class="col-md-8">

            @if(isset($model))
                <x-media-library-collection data-title="section_banner_1" data-type="image" max-items="1" name="section_banner_1" :model="$model" collection="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="section_banner_1" data-type="image" name="section_banner_1" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif            

        </div>
    </div>
    <!--end::Input Image -->
    
    <!--begin::Input Image card 1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_easyship::view.section_mobile_banner_1') </label>
        <div class="col-md-8">


            @if(isset($model))
                <x-media-library-collection data-title="section_mobile_banner_1" data-type="image" max-items="1" name="section_mobile_banner_1" :model="$model" collection="section_mobile_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="section_mobile_banner_1" data-type="image" name="section_mobile_banner_1" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif
            

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row card_title_2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.card_title_2') </label>
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
                        value="{{ isset($data['card_title_2']) && isset($data['card_title_2'][app()->getLocale()]) ? $data['card_title_2'][app()->getLocale()] : '' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_2[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_2']) && isset($data['card_title_2'][$locale['code']]) ? $data['card_title_2'][$locale['code']] : '' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row card_title_2 -->

    <!--begin::row card_description_2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.card_description_2') </label>
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
                    
                    <textarea name="card_description_2[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_2']) && isset($data['card_description_2'][app()->getLocale()]) ? $data['card_description_2'][app()->getLocale()] : '' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_2[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_2']) && isset($data['card_description_2'][$locale['code']]) ? $data['card_description_2'][$locale['code']] : '' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row card_description_2 -->

    <!--begin::Input Image card 2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_easyship::view.section_banner_2') </label>
        <div class="col-md-8">

            @if(isset($model))
                <x-media-library-collection data-title="section_banner_2" data-type="image" max-items="1" name="section_banner_2" :model="$model" collection="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="section_banner_2" data-type="image" name="section_banner_2" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif
            

        </div>
    </div>
    <!--end::Input Image -->
    
    <!--begin::Input Image card 2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_easyship::view.section_mobile_banner_2') </label>
        <div class="col-md-8">


            @if(isset($model))
                <x-media-library-collection data-title="section_mobile_banner_2" data-type="image" max-items="1" name="section_mobile_banner_2" :model="$model" collection="section_mobile_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="section_mobile_banner_2" data-type="image" name="section_mobile_banner_2" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif
            

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row card_title_3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.card_title_3') </label>
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
                        value="{{ isset($data['card_title_3']) && isset($data['card_title_3'][app()->getLocale()]) ? $data['card_title_3'][app()->getLocale()] : '' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_3[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_3']) && isset($data['card_title_3'][$locale['code']]) ? $data['card_title_3'][$locale['code']] : '' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row card_title_3 -->

    <!--begin::row card_description_3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.card_description_3') </label>
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
                    
                    <textarea name="card_description_3[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_3']) && isset($data['card_description_3'][app()->getLocale()]) ? $data['card_description_3'][app()->getLocale()] : '' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_3[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_3']) && isset($data['card_description_3'][$locale['code']]) ? $data['card_description_3'][$locale['code']] : '' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row card_description_3 -->

    <!--begin::Input Image card 3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_easyship::view.section_banner_3') </label>
        <div class="col-md-8">

            @if(isset($model))
                <x-media-library-collection data-title="section_banner_3" data-type="image" max-items="1" name="section_banner_3" :model="$model" collection="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="section_banner_3" data-type="image" name="section_banner_3" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif
            

        </div>
    </div>
    <!--end::Input Image -->
    
    <!--begin::Input Image card 3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_easyship::view.section_mobile_banner_3') </label>
        <div class="col-md-8">


            @if(isset($model))
                <x-media-library-collection data-title="section_mobile_banner_3" data-type="image" max-items="1" name="section_mobile_banner_3" :model="$model" collection="section_mobile_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="section_mobile_banner_3" data-type="image" name="section_mobile_banner_3" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @endif
            

        </div>
    </div>
    <!--end::Input Image -->

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
