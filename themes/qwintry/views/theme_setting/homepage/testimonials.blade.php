@php
$hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getBanner = $hasBanner ? $data['header_logo_url'] : '';
$hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp

<div class="testimonials">

    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_qwintry::view.display') </label>
        <div class="col-md-8">
            <div class="custom-control custom-switch form-check form-switch">
                <input class="custom-control-input form-check-input" name="display" type="checkbox" value="1"
                    id="display_hero_{{ isset($id) ? $id : 'id' }}"
                    {{ isset($id) ? (isset($data['display']) && $data['display'] == 1 ? 'checked="checked"' : '') : 'checked="checked"' }}>
                <label class="custom-control-label form-check-label fw-bold fs-6"
                    for="display_hero_{{ isset($id) ? $id : 'id' }}"></label>
            </div>
        </div>
    </div>
    <!--end::row toggle display -->

    <!--begin::row widgets_count -->
    <div class="control" style="{{ isset($data['display']) && $data['display'] ?: 'display: ;' }}">
        <div class="row mb-6 widgets_count">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_easyship::view.widgets_count') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="testimonials_count"
                            id="widgets_count1" value="1"
                            {{ isset($data['testimonials_count']) && $data['testimonials_count'] == 1 ? 'checked="checked"' : '' }}>
                        <label class="custom-control-label form-check-label" for="widgets_count1">
                            <img style="height: 60px;"
                                src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-1.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="testimonials_count"
                            id="widgets_count2" value="2"
                            {{ isset($data['testimonials_count']) && $data['testimonials_count'] == 2 ? 'checked="checked"' : '' }}>
                        <label class="custom-control-label form-check-label" for="widgets_count2">
                            <img style="height: 60px;"
                                src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-2.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="testimonials_count"
                            id="widgets_count3" value="3"
                            {{ isset($data['testimonials_count']) && $data['testimonials_count'] == 3 ? 'checked="checked"' : '' }}>
                        <label class="custom-control-label form-check-label" for="widgets_count3">
                            <img style="height: 60px;"
                                src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-3.svg') }}">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::row header_bg -->
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

        <!--begin::row title_color -->
        <div class="row mb-6 title_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.title_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} title_color_input"
                        name="title_color" value="{{ isset($data['title_color']) ? $data['title_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row title_color -->

        <!--begin::row pathColor -->
        <div class="row mb-6 title_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.pathColor') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} title_color_input"
                        name="pathColor" value="{{ isset($data['pathColor']) ? $data['pathColor'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row pathColor -->


        <div class="cont1">
            <!--begin::row section_description1 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.section_description1') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select
                            class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
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

                        <textarea name="section_description1[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['section_description1']) && isset($data['section_description1'][app()->getLocale()]) ? $data['section_description1'][app()->getLocale()] : 'We have an amazing experience with Qwintry Global. Best shipping prices for international shipping. The system is easy to use. I can only thank you for the excellent service provided. Highly recommended!' }}</textarea>
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <textarea name="section_description1[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['section_description1']) && isset($data['section_description1'][$locale['code']]) ? $data['section_description1'][$locale['code']] : 'We have an amazing experience with Qwintry Global. Best shipping prices for international shipping. The system is easy to use. I can only thank you for the excellent service provided. Highly recommended!' }}</textarea>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row section_description1 -->

            <!--begin::row path1  -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.path1') </label>
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
                        <input type="text" name="path1[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['path1']) && isset($data['path1'][app()->getLocale()]) ? $data['path1'][app()->getLocale()] : 'Dmitriy, Samara, Russia / 17 Jan 2022' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="path1[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['path1']) && isset($data['path1'][$locale['code']]) ? $data['path1'][$locale['code']] : 'Dmitriy, Samara, Russia / 17 Jan 2022' }}">
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row path1 -->

            <!--begin::row rating_cont  -->
            <div class="row mb-6 header_bg">
                <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.rating_cont') </label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input
                            class="form-control form-control-color w-100 "
                            name="rating_cont1" value="{{ isset($data['rating_cont1']) ? $data['rating_cont1'] : 5 }}">
                    </div>
                </div>
            </div>
            <!--end::row rating_cont -->

        </div>

        <div class="cont2">
            <!--begin::row section_description2 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.section_description2') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select
                            class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
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

                        <textarea name="section_description2[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['section_description2']) && isset($data['section_description2'][app()->getLocale()]) ? $data['section_description2'][app()->getLocale()] : 'We have an amazing experience with Qwintry Global. Best shipping prices for international shipping. The system is easy to use. I can only thank you for the excellent service provided. Highly recommended!' }}</textarea>
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <textarea name="section_description2[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['section_description2']) && isset($data['section_description2'][$locale['code']]) ? $data['section_description2'][$locale['code']] : 'We have an amazing experience with Qwintry Global. Best shipping prices for international shipping. The system is easy to use. I can only thank you for the excellent service provided. Highly recommended!' }}</textarea>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row section_description2 -->

            <!--begin::row path2  -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.path2') </label>
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
                        <input type="text" name="path2[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['path2']) && isset($data['path2'][app()->getLocale()]) ? $data['path2'][app()->getLocale()] : 'Robert, Kissimmee, FL / 22 Dec 2021' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="path2[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['path2']) && isset($data['path2'][$locale['code']]) ? $data['path2'][$locale['code']] : 'Robert, Kissimmee, FL / 22 Dec 2021' }}">
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row path2 -->

            <!--begin::row rating_cont 2  -->
            <div class="row mb-6 header_bg">
                <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.rating_cont') </label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input
                            class="form-control form-control-color w-100 "
                            name="rating_cont2" value="{{ isset($data['rating_cont2']) ? $data['rating_cont2'] : 3 }}">
                    </div>
                </div>
            </div>
            <!--end::row rating_cont 2-->

        
        </div>

        <div class="cont3">

            <!--begin::row section_description3 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.section_description3') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select
                            class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
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

                        <textarea name="section_description3[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['section_description3']) && isset($data['section_description3'][app()->getLocale()]) ? $data['section_description3'][app()->getLocale()] : 'We have an amazing experience with Qwintry Global. Best shipping prices for international shipping. The system is easy to use. I can only thank you for the excellent service provided. Highly recommended!' }}</textarea>
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <textarea name="section_description3[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['section_description3']) && isset($data['section_description3'][$locale['code']]) ? $data['section_description3'][$locale['code']] : 'We have an amazing experience with Qwintry Global. Best shipping prices for international shipping. The system is easy to use. I can only thank you for the excellent service provided. Highly recommended!' }}</textarea>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row section_description3 -->

            <!--begin::row path3 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.path3') </label>
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
                        <input type="text" name="path3[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['path3']) && isset($data['path3'][app()->getLocale()]) ? $data['path3'][app()->getLocale()] : 'Robert, Kissimmee, FL / 22 Dec 2021' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="path3[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['path3']) && isset($data['path3'][$locale['code']]) ? $data['path3'][$locale['code']] : 'Robert, Kissimmee, FL / 22 Dec 2021' }}">
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row path3 -->

            <!--begin::row rating_cont 3  -->
            <div class="row mb-6 header_bg">
                <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.rating_cont') </label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input
                            class="form-control form-control-color w-100 "
                            name="rating_cont3" value="{{ isset($data['rating_cont3']) ? $data['rating_cont3'] : 3 }}">
                    </div>
                </div>
            </div>
            <!--end::row rating_cont 3-->

        </div>

    </div>
    <!--end::row widgets_count -->

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
