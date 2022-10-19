@php
$hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getBanner = $hasBanner ? $data['header_logo_url'] : '';
$hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="evaluation">
    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_shipito::view.display') </label>
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

                <textarea name="description_1_evaluation[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                    class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['description_1_evaluation']) && isset($data['description_1_evaluation'][app()->getLocale()]) ? $data['description_1_evaluation'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                @foreach (get_langauges_except_current() as $locale)
                    <textarea name="description_1_evaluation[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                        class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['description_1_evaluation']) && isset($data['description_1_evaluation'][$locale['code']]) ? $data['description_1_evaluation'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::row description 1 -->

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

                <textarea name="description_2_evaluation[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                    class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['description_2_evaluation']) && isset($data['description_2_evaluation'][app()->getLocale()]) ? $data['description_2_evaluation'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                @foreach (get_langauges_except_current() as $locale)
                    <textarea name="description_2_evaluation[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                        class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['description_2_evaluation']) && isset($data['description_2_evaluation'][$locale['code']]) ? $data['description_2_evaluation'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::row description 2 -->

    <!--begin::row rating_cont  -->
    <div class="row mb-6 header_bg">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.rating_cont') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 "
                    name="rating_cont2" value="{{ isset($data['rating_cont2']) ? $data['rating_cont2'] : 4 }}">
            </div>
        </div>
    </div>
    <!--end::row rating_cont -->

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

                <textarea name="description_3_evaluation[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                    class="form-control form-control-lg form-control-multilingual form-control-{{ app()->getLocale() }}">{{ isset($data['description_3_evaluation']) && isset($data['description_3_evaluation'][app()->getLocale()]) ? $data['description_3_evaluation'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                @foreach (get_langauges_except_current() as $locale)
                    <textarea name="description_3_evaluation[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                        class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none">{{ isset($data['description_3_evaluation']) && isset($data['description_3_evaluation'][$locale['code']]) ? $data['description_3_evaluation'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::row description 3 -->


    <!--begin::row rating_cont  -->
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
    <!--end::row rating_cont -->


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
</script>
