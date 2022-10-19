@php
$hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getBanner = $hasBanner ? $data['header_logo_url'] : '';
$hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="business">
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

    <!--begin::row count -->
    <div class="control" style="{{ isset($data['display']) && $data['display'] ?: 'display: ;' }}">

        <!--begin::row header_bg -->
        <div class="row mb-6 header_bg">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_shipito::view.section_bg') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} header_bg_input"
                        name="header_bg" value="{{ isset($data['header_bg']) ? $data['header_bg'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row header_bg -->

        <!--begin::row text_color -->
        <div class="row mb-6 text_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_shipito::view.section_description_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} text_color_input"
                        name="text_color" value="{{ isset($data['text_color']) ? $data['text_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row text_color -->

        <!--begin::row title_color -->
        <div class="row mb-6 text_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_shipito::view.section_title_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} text_color_input"
                        name="title_color" value="{{ isset($data['title_color']) ? $data['title_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row title_color -->



        <div class="row mb-6 count">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_goshippo::view.card_counts') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="services_count" id="count1" value="1" {{ isset($data['services_count']) && $data['services_count'] == 1 ? 'checked="checked"' : '' }} >
                        <label class="custom-control-label form-check-label" for="count1">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-1.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="services_count" id="count2" value="2" {{ isset($data['services_count']) && $data['services_count'] == 2 ? 'checked="checked"' : '' }} >
                        <label class="custom-control-label form-check-label" for="count2">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-2.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="services_count" id="count3" value="3" {{ isset($data['services_count']) && $data['services_count'] == 3 ? 'checked="checked"' : '' }} >
                        <label class="custom-control-label form-check-label" for="count3">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-3.svg') }}">
                        </label>
                    </div>
                </div>
            </div>
        </div>


        <div class="cont1">
            <!--begin::row title 1 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
                    @lang('theme_shipito::view.title_1') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_subtitle1">
                        <select
                            class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{ Config::get('current_lang_image') }}"
                                selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach (get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{ $locale['icon'] }}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="title_1_whyus[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['title_1_whyus']) && isset($data['title_1_whyus'][app()->getLocale()]) ? $data['title_1_whyus'][app()->getLocale()] : 'This is the heading' }}">
                        @foreach (get_langauges_except_current() as $locale)
                            <input type="text" name="title_1_whyus[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['title_1_whyus']) && isset($data['title_1_whyus'][$locale['code']]) ? $data['title_1_whyus'][$locale['code']] : 'This is the heading' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row title 1 -->

            <!--begin::row description 1 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
                    @lang('theme_shipito::view.section_description') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                            <option value="{{ app()->getLocale() }}" data-flag="{{ Config::get('current_lang_image') }}"
                                selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach (get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{ $locale['icon'] }}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <textarea name="description_1_whyus[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['description_1_whyus']) && isset($data['description_1_whyus'][app()->getLocale()]) ? $data['description_1_whyus'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @foreach (get_langauges_except_current() as $locale)
                            <textarea name="description_1_whyus[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['description_1_whyus']) && isset($data['description_1_whyus'][$locale['code']]) ? $data['description_1_whyus'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row description 1 -->

            <!--begin::Input Image card 1  -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
                    @lang('theme_shipito::view.img_1') </label>
                <div class="col-md-8">
                    @if (isset($model))
                        <x-media-library-collection data-title="section_banner2_whyus" data-type="image" max-items="1"
                            name="section_banner2_whyus" :model="$model" collection="section_banner"
                            rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @else
                        <x-media-library-attachment data-title="section_banner2_whyus" data-type="image"
                            name="section_banner2_whyus" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @endif

                </div>
            </div>
            <!--end::Input Image 1  -->
        </div>

        <div class="cont2">
            <!--begin::row title 2 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
                    @lang('theme_shipito::view.title_2') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_subtitle1">
                        <select
                            class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{ Config::get('current_lang_image') }}"
                                selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach (get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{ $locale['icon'] }}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="title_2_whyus[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['title_2_whyus']) && isset($data['title_2_whyus'][app()->getLocale()]) ? $data['title_2_whyus'][app()->getLocale()] : 'This is the heading' }}">
                        @foreach (get_langauges_except_current() as $locale)
                            <input type="text" name="title_2_whyus[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['title_2_whyus']) && isset($data['title_2_whyus'][$locale['code']]) ? $data['title_2_whyus'][$locale['code']] : 'This is the heading' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row title 2 -->

            <!--begin::row description 2 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
                    @lang('theme_shipito::view.section_description') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                            <option value="{{ app()->getLocale() }}" data-flag="{{ Config::get('current_lang_image') }}"
                                selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach (get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{ $locale['icon'] }}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <textarea name="description_2_whyus[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['description_2_whyus']) && isset($data['description_2_whyus'][app()->getLocale()]) ? $data['description_2_whyus'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @foreach (get_langauges_except_current() as $locale)
                            <textarea name="description_2_whyus[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['description_2_whyus']) && isset($data['description_2_whyus'][$locale['code']]) ? $data['description_2_whyus'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row description 2 -->

            <!--begin::Input Image card 2  -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
                    @lang('theme_shipito::view.img_2') </label>
                <div class="col-md-8">

                    @if (isset($model))
                        <x-media-library-collection data-title="section_banner_1_whyus" data-type="image" max-items="1"
                            name="section_banner_1_whyus" :model="$model" collection="section_banner"
                            rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @else
                        <x-media-library-attachment data-title="section_banner_1_whyus" data-type="image"
                            name="section_banner_1_whyus" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @endif

                </div>
            </div>
            <!--end::Input Image 2  -->
        </div>

        <div class="cont3">
            <!--begin::row title 3 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
                    @lang('theme_shipito::view.title_3') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container" id="lang_container_section_subtitle1">
                        <select
                            class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 mw-100px">
                            <option value="{{ app()->getLocale() }}" data-flag="{{ Config::get('current_lang_image') }}"
                                selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach (get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{ $locale['icon'] }}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="title_3_whyus[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['title_3_whyus']) && isset($data['title_3_whyus'][app()->getLocale()]) ? $data['title_3_whyus'][app()->getLocale()] : 'This is the heading' }}">
                        @foreach (get_langauges_except_current() as $locale)
                            <input type="text" name="title_3_whyus[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['title_3_whyus']) && isset($data['title_3_whyus'][$locale['code']]) ? $data['title_3_whyus'][$locale['code']] : 'This is the heading' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row title 3 -->

            <!--begin::row description 3 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
                    @lang('theme_shipito::view.section_description') </label>
                <div class="col-md-8">

                    <div class="input-group lang_container text" id="lang_container_section_description">
                        <select class="change_language form-control form-control-sm badge badge-light fw-bold py-4 px-3 ">
                            <option value="{{ app()->getLocale() }}" data-flag="{{ Config::get('current_lang_image') }}"
                                selected>
                                {{ get_current_lang()['name'] }}
                            </option>
                            @foreach (get_langauges_except_current() as $locale)
                                <option value="{{ $locale['code'] }}" data-flag="{{ $locale['icon'] }}">
                                    {{ $locale['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <textarea name="description_3_whyus[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                            class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['description_3_whyus']) && isset($data['description_3_whyus'][app()->getLocale()]) ? $data['description_3_whyus'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @foreach (get_langauges_except_current() as $locale)
                            <textarea name="description_3_whyus[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['description_3_whyus']) && isset($data['description_3_whyus'][$locale['code']]) ? $data['description_3_whyus'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::row description 3 -->

            <!--begin::Input Image card 3  -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
                    @lang('theme_shipito::view.img_3') </label>
                <div class="col-md-8">

                    @if (isset($model))
                        <x-media-library-collection data-title="section_banner_3_whyus" data-type="image" max-items="1"
                            name="section_banner_3_whyus" :model="$model" collection="section_banner"
                            rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @else
                        <x-media-library-attachment data-title="section_banner_3_whyus" data-type="image"
                            name="section_banner_3_whyus" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @endif

                </div>
            </div>
            <!--end::Input Image 3  -->
        </div>

    </div>
</div>

<link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/plugins/spectrum/spectrum.min.js') }}"></script>
<script>
    $(".color_picker_input_{{ isset($id) ? $id : 'id' }}").spectrum({
        type: "component",
        showInput: true,
        showInitial: true,
        clickoutFiresChange: true,
        allowEmpty: true,
        maxSelectionSize: 8,
    });

    $("#repeater_{{ isset($id) ? $id : 'id' }}").repeater({
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

            function formatFlag(lang) {
                if (!lang.id) {
                    return lang.text;
                }
                var $img = $(lang.element).attr("data-flag");
                if ($img) {
                    var $lang = $(
                        '<span ><img sytle="display: inline-block;" src=" ' + $(lang.element).attr(
                            "data-flag") + ' " />&emsp;' + lang.text + '</span>'
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
                        '<span ><img sytle="display: inline-block;" src=" ' + $(lang.element).attr(
                            "data-flag") + ' " />&emsp;' + lang.text + '</span>'
                    );
                } else {
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


   // end select tags
    /*******************************************************************************************/
    $('.display_input ').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.control').show()
        } else {
            $('.control').hide()
        }
    });


    $('input[type=radio]').change(function() {
        if (this.value == 1){
            $(".cont1").css("display","block");
            $(".cont2").css("display","none");
            $(".cont3").css("display","none");
        }
        else if (this.value == 2){
            $(".cont1").css("display","block");
            $(".cont2").css("display","block");
            $(".cont3").css("display","none");
        }
        else if (this.value == 3){
                $(".cont1").css("display","block");
                $(".cont2").css("display","block");
                $(".cont3").css("display","block");
            }
    });
</script>
