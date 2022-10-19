@php
$hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getBanner = $hasBanner ? $data['header_logo_url'] : '';
$hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="industries">
    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.display') </label>
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
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_timeglobalshipping::view.section_bg') </label>
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
    <div class="row mb-6 text_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_timeglobalshipping::view.title_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} text_color_input"
                    name="title_color" value="{{ isset($data['title_color']) ? $data['title_color'] : '' }}">
            </div>
        </div>
    </div>
    <!--end::row title_color -->


    <!--begin::Input Image card 1 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.image') </label>
        <div class="col-md-8">

            @if (isset($model))
            <x-media-library-collection data-title="our_credentials_banner_1" data-type="image" max-items="1"
                name="our_credentials_banner_1" :model="$model" collection="section_banner"
                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @else
            <x-media-library-attachment data-title="our_credentials_banner_1" data-type="image"
                name="our_credentials_banner_1" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @endif

        </div>
    </div>
    <!--end::Input Image -->

     <!--begin::row second_title -->
     <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.title') </label>
        <div class="col-md-8">

            <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
                <input type="text" name="title_1_industries[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                    class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                    value="{{ isset($data['title_1_industries']) && isset($data['title_1_industries'][app()->getLocale()]) ? $data['title_1_industries'][app()->getLocale()] : 'Title' }}">
                @foreach (get_langauges_except_current() as $locale)
                <input type="text" name="title_1_industries[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                    class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                    value="{{ isset($data['title_1_industries']) && isset($data['title_1_industries'][$locale['code']]) ? $data['title_1_industries'][$locale['code']] : 'Title' }}">
                @endforeach
            </div>


        </div>
    </div>
    <!--end::row second_title -->

    <!--begin::Input Image card 2 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.image') </label>
        <div class="col-md-8">

            @if (isset($model))
            <x-media-library-collection data-title="our_credentials_banner_2" data-type="image" max-items="1"
                name="our_credentials_banner_2" :model="$model" collection="section_banner"
                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @else
            <x-media-library-attachment data-title="our_credentials_banner_2" data-type="image"
                name="our_credentials_banner_2" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @endif

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row second_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
        @lang('theme_timeglobalshipping::view.title') </label>
        <div class="col-md-8">

        <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
            <input type="text" name="title_2_industries[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                value="{{ isset($data['title_2_industries']) && isset($data['title_2_industries'][app()->getLocale()]) ? $data['title_2_industries'][app()->getLocale()] : 'Title' }}">
            @foreach (get_langauges_except_current() as $locale)
            <input type="text" name="title_2_industries[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                value="{{ isset($data['title_2_industries']) && isset($data['title_2_industries'][$locale['code']]) ? $data['title_2_industries'][$locale['code']] : 'Title' }}">
            @endforeach
        </div>


        </div>
    </div>
    <!--end::row second_title -->

    <!--begin::Input Image card 3 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.image') </label>
        <div class="col-md-8">

            @if (isset($model))
            <x-media-library-collection data-title="our_credentials_banner_3" data-type="image" max-items="1"
                name="our_credentials_banner_3" :model="$model" collection="section_banner"
                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @else
            <x-media-library-attachment data-title="our_credentials_banner_3" data-type="image"
                name="our_credentials_banner_3" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @endif

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row second_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
        @lang('theme_timeglobalshipping::view.title') </label>
        <div class="col-md-8">

        <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
            <input type="text" name="title_3_industries[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                value="{{ isset($data['title_3_industries']) && isset($data['title_3_industries'][app()->getLocale()]) ? $data['title_3_industries'][app()->getLocale()] : 'Title' }}">
            @foreach (get_langauges_except_current() as $locale)
            <input type="text" name="title_3_industries[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                value="{{ isset($data['title_3_industries']) && isset($data['title_3_industries'][$locale['code']]) ? $data['title_3_industries'][$locale['code']] : 'Title' }}">
            @endforeach
        </div>


        </div>
    </div>
    <!--end::row second_title -->

    <!--begin::Input Image card 4 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.image') </label>
        <div class="col-md-8">

            @if (isset($model))
            <x-media-library-collection data-title="our_credentials_banner_4" data-type="image" max-items="1"
                name="our_credentials_banner_4" :model="$model" collection="section_banner"
                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @else
            <x-media-library-attachment data-title="our_credentials_banner_4" data-type="image"
                name="our_credentials_banner_4" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @endif

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row second_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
        @lang('theme_timeglobalshipping::view.title') </label>
        <div class="col-md-8">

        <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
            <input type="text" name="title_4_industries[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                value="{{ isset($data['title_4_industries']) && isset($data['title_4_industries'][app()->getLocale()]) ? $data['title_4_industries'][app()->getLocale()] : 'Title' }}">
            @foreach (get_langauges_except_current() as $locale)
            <input type="text" name="title_4_industries[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                value="{{ isset($data['title_4_industries']) && isset($data['title_4_industries'][$locale['code']]) ? $data['title_4_industries'][$locale['code']] : 'Title' }}">
            @endforeach
        </div>


        </div>
    </div>
    <!--end::row second_title -->

    <!--begin::Input Image card 5 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.image') </label>
        <div class="col-md-8">

            @if (isset($model))
            <x-media-library-collection data-title="our_credentials_banner_5" data-type="image" max-items="1"
                name="our_credentials_banner_5" :model="$model" collection="section_banner"
                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @else
            <x-media-library-attachment data-title="our_credentials_banner_5" data-type="image"
                name="our_credentials_banner_5" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @endif

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row second_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
        @lang('theme_timeglobalshipping::view.title') </label>
        <div class="col-md-8">

        <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
            <input type="text" name="title_5_industries[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                value="{{ isset($data['title_5_industries']) && isset($data['title_5_industries'][app()->getLocale()]) ? $data['title_5_industries'][app()->getLocale()] : 'Title' }}">
            @foreach (get_langauges_except_current() as $locale)
            <input type="text" name="title_5_industries[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                value="{{ isset($data['title_5_industries']) && isset($data['title_5_industries'][$locale['code']]) ? $data['title_5_industries'][$locale['code']] : 'Title' }}">
            @endforeach
        </div>


        </div>
    </div>
    <!--end::row second_title -->


    <!--begin::Input Image card 6 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.image') </label>
        <div class="col-md-8">

            @if (isset($model))
            <x-media-library-collection data-title="our_credentials_banner_6" data-type="image" max-items="1"
                name="our_credentials_banner_6" :model="$model" collection="section_banner"
                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @else
            <x-media-library-attachment data-title="our_credentials_banner_6" data-type="image"
                name="our_credentials_banner_6" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @endif

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row second_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
        @lang('theme_timeglobalshipping::view.title') </label>
        <div class="col-md-8">

        <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
            <input type="text" name="title_6_industries[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                value="{{ isset($data['title_6_industries']) && isset($data['title_6_industries'][app()->getLocale()]) ? $data['title_6_industries'][app()->getLocale()] : 'Title' }}">
            @foreach (get_langauges_except_current() as $locale)
            <input type="text" name="title_6_industries[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                value="{{ isset($data['title_6_industries']) && isset($data['title_6_industries'][$locale['code']]) ? $data['title_6_industries'][$locale['code']] : 'Title' }}">
            @endforeach
        </div>


        </div>
    </div>
    <!--end::row second_title -->


    <!--begin::Input Image card 7 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.image') </label>
        <div class="col-md-8">

            @if (isset($model))
            <x-media-library-collection data-title="our_credentials_banner_7" data-type="image" max-items="1"
                name="our_credentials_banner_7" :model="$model" collection="section_banner"
                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @else
            <x-media-library-attachment data-title="our_credentials_banner_7" data-type="image"
                name="our_credentials_banner_7" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @endif

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row second_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
        @lang('theme_timeglobalshipping::view.title') </label>
        <div class="col-md-8">

        <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
            <input type="text" name="title_7_industries[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                value="{{ isset($data['title_7_industries']) && isset($data['title_7_industries'][app()->getLocale()]) ? $data['title_7_industries'][app()->getLocale()] : 'Title' }}">
            @foreach (get_langauges_except_current() as $locale)
            <input type="text" name="title_7_industries[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                value="{{ isset($data['title_7_industries']) && isset($data['title_7_industries'][$locale['code']]) ? $data['title_7_industries'][$locale['code']] : 'Title' }}">
            @endforeach
        </div>


        </div>
    </div>
    <!--end::row second_title -->

    <!--begin::Input Image card 8 -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">
            @lang('theme_timeglobalshipping::view.image') </label>
        <div class="col-md-8">

            @if (isset($model))
            <x-media-library-collection data-title="our_credentials_banner_8" data-type="image" max-items="1"
                name="our_credentials_banner_8" :model="$model" collection="section_banner"
                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @else
            <x-media-library-attachment data-title="our_credentials_banner_8" data-type="image"
                name="our_credentials_banner_8" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
            @endif

        </div>
    </div>
    <!--end::Input Image -->

    <!--begin::row second_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center">
        @lang('theme_timeglobalshipping::view.title') </label>
        <div class="col-md-8">

        <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
            <input type="text" name="title_8_industries[{{ app()->getLocale() }}]" title="{{ app()->getLocale() }}"
                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                value="{{ isset($data['title_8_industries']) && isset($data['title_8_industries'][app()->getLocale()]) ? $data['title_8_industries'][app()->getLocale()] : 'Title' }}">
            @foreach (get_langauges_except_current() as $locale)
            <input type="text" name="title_8_industries[{{ $locale['code'] }}]" title="{{ $locale['code'] }}"
                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                value="{{ isset($data['title_8_industries']) && isset($data['title_8_industries'][$locale['code']]) ? $data['title_8_industries'][$locale['code']] : 'Title' }}">
            @endforeach
        </div>


        </div>
    </div>
    <!--end::row second_title -->

</div>
<link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"
    integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
    integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
