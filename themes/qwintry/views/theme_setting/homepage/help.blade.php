@php
$hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getBanner = $hasBanner ? $data['header_logo_url'] : '';
$hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="help">


    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_qwintry::view.display') </label>
        <div class="col-md-8">
            <div class="custom-control custom-switch form-check form-switch">
                <input class="custom-control-input form-check-input" name="display" type="checkbox" value="1" id="display_hero_{{isset($id) ? $id : 'id'}}" {{ isset($id) ? (isset($data['display']) && $data['display'] == 1 ? 'checked="checked"' : '') : 'checked="checked"' }} >
                <label class="custom-control-label form-check-label fw-bold fs-6" for="display_hero_{{isset($id) ? $id : 'id'}}"></label>
            </div>
        </div>
    </div>
    <!--end::row toggle display -->



        <!--begin::row header_bg  -->
        <div class="row mb-6 header_bg">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.section_bg') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} header_bg_input"
                        name="header_bg" value="{{ isset($data['header_bg']) ? $data['header_bg'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row header_bg -->
        <!--begin::row title_color   -->
        <div class="row mb-6 title_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.section_title_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} title_color_input"
                        name="title_color" value="{{ isset($data['title_color']) ? $data['title_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row title_color -->

        <!--begin::row description_color -->
        <div class="row mb-6 title_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.section_description_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} title_color_input"
                        name="description_color"
                        value="{{ isset($data['description_color']) ? $data['description_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row description_color -->

        <!--begin::row main_title -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.main_title') </label>
            <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_section_title">
                    <select
                        class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                        <option value="{{ app()->getLocale() }}"
                            data-flag="{{ Config::get('current_lang_image') }}" selected>
                            {{ Config::get('current_lang')['name'] }}
                        </option>
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <option value="{{ $locale['code'] }}" data-flag="{{ $locale['icon'] }}">
                                {{ $locale['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="section_title1[{{ app()->getLocale() }}]"
                        title="{{ app()->getLocale() }}"
                        class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                        value="{{ isset($data['section_title1']) && isset($data['section_title1'][app()->getLocale()]) ? $data['section_title1'][app()->getLocale()] : 'This is the heading' }}">
                    @foreach (Config::get('langauges_except_current') as $locale)
                        <input type="text" name="section_title1[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                            value="{{ isset($data['section_title1']) && isset($data['section_title1'][$locale['code']]) ? $data['section_title1'][$locale['code']] : 'This is the heading' }}">
                    @endforeach
                </div>


            </div>
        </div>
        <!--end::row main_title -->

        <!--begin::row main_description -->
        <div class="row mb-6">
            <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.main_description') </label>
            <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_section_title">
                    <select
                        class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                        <option value="{{ app()->getLocale() }}"
                            data-flag="{{ Config::get('current_lang_image') }}" selected>
                            {{ Config::get('current_lang')['name'] }}
                        </option>
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <option value="{{ $locale['code'] }}" data-flag="{{ $locale['icon'] }}">
                                {{ $locale['name'] }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="section_title2[{{ app()->getLocale() }}]"
                        title="{{ app()->getLocale() }}"
                        class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                        value="{{ isset($data['section_title2']) && isset($data['section_title2'][app()->getLocale()]) ? $data['section_title2'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}">
                    @foreach (Config::get('langauges_except_current') as $locale)
                        <input type="text" name="section_title2[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                            value="{{ isset($data['section_title2']) && isset($data['section_title2'][$locale['code']]) ? $data['section_title2'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}">
                    @endforeach
                </div>
            </div>
        </div>
        <!--end::row main_description -->







</div>

<link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
<script src="{{ asset('assets/plugins/spectrum/spectrum.min.js') }}"></script>
<script>
    /*!*******************************************************!*\
      !*** Select fields ***!
      \*******************************************************/
    $("select.form-select").select2();
    $(".change_language").select2({
        templateResult: formatFlag,
        templateSelection: formatState,
        minimumResultsForSearch: -1,
        width: '100%'
    });
    /*!*******************************************************!*\
      !*** Color picker fields ***!
      \*******************************************************/
    $(".color_picker_input_{{ isset($id) ? $id : 'id' }}").spectrum({
        type: "component",
        showInput: true,
        showInitial: true,
        clickoutFiresChange: true,
        allowEmpty: true,
        maxSelectionSize: 8,
    });
    function formatFlag(lang) {
        if (!lang.id) {
            return lang.text;
        }
        var $img = $(lang.element).attr("data-flag");
        if ($img) {
            var $lang = $(
                '<span ><img sytle="display: inline-block;" src=" ' + $(lang.element).attr("data-flag") +
                ' " />&emsp;' + lang.text + '</span>'
            );
        } else {
            var $lang = $(
                '<span >' + lang.text + '</span>'
            );
        }
        return $lang;
    }
    function formatState(lang) {
        if (!lang.id) {
            return lang.text;
        }
        var $img = $(lang.element).attr("data-flag");
        if ($img) {
            var $lang = $(
                '<span ><img sytle="display: inline-block;" src=" ' + $(lang.element).attr("data-flag") +
                ' " />&emsp;' + lang.text + '</span>'
            );
        } else {
            var $lang = $(
                '<span >' + lang.text + '</span>'
            );
        }
        return $lang;
    };
    // select category_select
    var selectCategories = $('.select_categories');
    selectCategories.select2({
        closeOnSelect: false,
        ajax: {
            url: "{{ fr_route('categories.search') }}",
            dataType: 'json',
            delay: 500,
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(data) {
                if (data && data.categories) {
                    return {
                        results: data.categories.map(function(category) {
                            return {
                                id: category.id,
                                text: category.name
                            }
                        })
                    };
                }
            },
            cache: true,
        },
    });
    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))
        $('.select_categories_{{ $id }}').val([{{ implode(', ', $data['categories']) }}]).trigger(
            'change');
    @endif
    // end select category_select
    /*******************************************************************************************/
    // select tags
    var selectTags = $('.select_tags');
    selectTags.select2({
        closeOnSelect: false,
        ajax: {
            url: "{{ fr_route('tags.search') }}",
            dataType: 'json',
            delay: 500,
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(data) {
                if (data && data.tags) {
                    return {
                        results: data.tags.map(function(tag) {
                            return {
                                id: tag.id,
                                text: tag.name
                            }
                        })
                    };
                }
            },
            cache: true,
        },
    });
    @if (isset($id) && isset($data['tags']) && is_array($data['tags']))
        $('.select_tags_{{ $id }}').val([{{ implode(', ', $data['tags']) }}]).trigger('change');
    @endif
    // end select tags
    /*******************************************************************************************/
</script>
