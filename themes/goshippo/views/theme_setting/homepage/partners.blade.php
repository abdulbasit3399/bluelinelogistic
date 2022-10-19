@php
    $hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getBanner = $hasBanner ? $data['header_logo_url'] : '';
    $hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="partners">


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

    <!--begin::row section_title_color -->
    <div class="row mb-6 card_title_1_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_title_color') </label>
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
    <!--end::row section_title_color -->

    <!--begin::row section_description_color -->
    <div class="row mb-6 card_desc_1_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_description_color') </label>
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
    <!--end::row section_description_color -->

    <!--begin::row button_bg_color -->
    <div class="row mb-6 card_1_button_bg_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.button_bg_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_1_button_bg_color_input"
                    name="card_1_button_bg_color"
                    value="{{ isset($data['card_1_button_bg_color']) ? $data['card_1_button_bg_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row button_bg_color -->

    <!--begin::row section_button_text_color -->
    <div class="row mb-6 card_1_button_text_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_goshippo::view.section_button_text_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} card_1_button_text_color_input"
                    name="card_1_button_text_color"
                    value="{{ isset($data['card_1_button_text_color']) ? $data['card_1_button_text_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row section_button_text_color -->

    <!--begin::row section_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold required fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_title') </label>
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
                        value="{{ isset($data['card_title_1']) && isset($data['card_title_1'][app()->getLocale()]) ? $data['card_title_1'][app()->getLocale()] : 'This is the heading' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_title_1[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_title_1']) && isset($data['card_title_1'][$locale['code']]) ? $data['card_title_1'][$locale['code']] : 'This is the heading' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row section_title -->

    <!--begin::row section_description -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_description') </label>
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

                    <textarea name="card_description_1[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['card_description_1']) && isset($data['card_description_1'][app()->getLocale()]) ? $data['card_description_1'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="card_description_1[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['card_description_1']) && isset($data['card_description_1'][$locale['code']]) ? $data['card_description_1'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo ' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row section_description -->

    <!--begin::row section_button -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_button') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_card_1_section_button">
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
                        name="card_1_section_button[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['card_1_section_button']) && isset($data['card_1_section_button'][app()->getLocale()]) ? $data['card_1_section_button'][app()->getLocale()] : 'Button' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="card_1_section_button[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['card_1_section_button']) && isset($data['card_1_section_button'][$locale['code']]) ? $data['card_1_section_button'][$locale['code']] : 'Button' }}"
                        >
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row section_button -->

    <!--begin::row section_url -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_url') </label>
        <div class="col-md-8">

                <div class="input-group url_input_container" id="url_input_container_card_1_section_url">
                    <select class="change_url_type form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px" data-type="array" name="card_1_section_url[type]" data-title="type">
                        <option value="custom"  {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type'])) ? ($data['card_1_section_url']['type'] == 'custom' ? 'selected' : '') : 'selected' }}>@lang('theme_goshippo::view.custom')</option>
                        @if (check_module('pages'))
                            <option value="page" {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'page') ? 'selected' : '' }}>@lang('theme_goshippo::view.page')</option>
                        @endif
                        @if (check_module('blog'))
                            <option value="category" {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'category') ? 'selected' : '' }}>@lang('theme_goshippo::view.category')</option>
                            <option value="post" {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'post') ? 'selected' : '' }}>@lang('theme_goshippo::view.post')</option>
                        @endif
                    </select>
                    <input
                        type="text"
                        name="card_1_section_url[custom]"
                        data-title="custom"
                        data-type="array"
                        class="form-control section-title form-control-choose-type form-control-custom {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type'])) ? ($data['card_1_section_url']['type'] == 'custom' ? '' : 'd-none') : '' }}"
                        value="{{ isset($data['card_1_section_url']) && isset($data['card_1_section_url']['custom']) ? $data['card_1_section_url']['custom'] : '' }}"
                    >
                    @if (check_module('pages'))
                        <div class="form-control-choose-type form-control-page {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'page') ? '' : 'd-none' }}">
                            <select
                                class="form-select mw-auto"
                                name="card_1_section_url[page]"
                                data-title="page"
                                data-type="array"
                                data-placeholder="@lang('theme_goshippo::view.choose_page')"
                            >
                                @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                    @foreach ($data['categories'] as $categoryId)
                                        @php
                                            $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                        @endphp
                                        <option value="{{$category->id}}" {{ isset($data['card_1_section_url']) && isset($data['card_1_section_url']['page']) && $data['card_1_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                    @if (check_module('blog'))
                        <div class="form-control-choose-type form-control-category {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'category') ? '' : 'd-none' }}">
                            <select
                                class="form-select  mw-auto "
                                name="card_1_section_url[category]"
                                data-title="category"
                                data-type="array"
                                data-placeholder="@lang('theme_goshippo::view.choose_category')"
                            >
                                @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                    @foreach ($data['categories'] as $categoryId)
                                        @php
                                            $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                        @endphp
                                        <option value="{{$category->id}}" {{ isset($data['card_1_section_url']) && isset($data['card_1_section_url']['page']) && $data['card_1_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-control-choose-type form-control-post {{ (isset($data['card_1_section_url']) && isset($data['card_1_section_url']['type']) && $data['card_1_section_url']['type'] == 'post') ? '' : 'd-none' }}">
                            <select
                                class="form-select mw-auto "
                                name="card_1_section_url[post]"
                                data-title="post"
                                data-type="array"
                                data-placeholder="@lang('theme_goshippo::view.choose_post')"
                            >
                                @if (isset($id) && isset($data['categories']) && is_array($data['categories']))

                                    @foreach ($data['categories'] as $categoryId)
                                        @php
                                            $category = Modules\Blog\Entities\Category::find($categoryId, ['id', 'name']);
                                        @endphp
                                        <option value="{{$category->id}}" {{ isset($data['card_1_section_url']) && isset($data['card_1_section_url']['page']) && $data['card_1_section_url']['page'] == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                </div>
        </div>
    </div>
    <!--end::row section_url -->

    <!--begin::Input Image -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_goshippo::view.section_banner') </label>
        <div class="col-md-8">

            @if(isset($model))
                <x-media-library-collection data-title="section_banner" data-type="image" max-items="1" name="section_banner" :model="$model" collection="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
            @else
                <x-media-library-attachment data-title="section_banner" data-type="image" name="section_banner" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp"/>
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
