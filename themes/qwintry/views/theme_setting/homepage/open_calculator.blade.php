@php
$hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getBanner = $hasBanner ? $data['header_logo_url'] : '';
$hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
$getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp
<div class="open_calculator">
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

        <div class="row mb-6 count">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_qwintry::view.count') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <div class="form-check mx-3 checkbox">
                        <input class="custom-control-input form-check-input is_def_mile_or_fees" type="radio" name="count" id="count1" value="1" {{ isset($data['count']) && $data['count'] == 1 ? 'checked="checked"' : '' }}>
                    <label class="custom-control-label form-check-label " for="count1">
                            <img style="height: 60px;"
                                src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-1.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3 checkbox">
                        <input class="custom-control-input form-check-input is_def_mile_or_fees" type="radio" name="count" id="count2" value="2" {{ isset($data['count']) && $data['count'] == 2 ? 'checked="checked"' : '' }}>
                        <label class="custom-control-label form-check-label " for="count2">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-2.svg') }}">
                        </label>
                    </div>
                    <div class="form-check mx-3 checkbox">
                        <input class="custom-control-input form-check-input is_def_mile_or_fees " type="radio" name="count" id="count3" value="3" {{ isset($data['count']) && $data['count'] == 3 ? 'checked="checked"' : '' }}>
                        <label class="custom-control-label form-check-label  " for="count3">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-3.svg') }}">
                        </label>
                    </div>
                </div>
            </div>
        </div>

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

        <!--begin::row sub_description_color -->
        <div class="row mb-6 title_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.sub_description_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} title_color_input"
                        name="sub_description_color"
                        value="{{ isset($data['sub_description_color']) ? $data['sub_description_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row sub_description_color -->

        <!--begin::row sub_title_color -->
        <div class="row mb-6 title_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.sub_title_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} title_color_input"
                        name="sub_title_color"
                        value="{{ isset($data['sub_title_color']) ? $data['sub_title_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row sub_title_color -->

        <!--begin::row price_color  -->
        <div class="row mb-6 title_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.price_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} title_color_input"
                        name="price_color" value="{{ isset($data['price_color']) ? $data['price_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row price_color -->

        <!--begin::row after_discount_color  -->
        <div class="row mb-6 title_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_qwintry::view.after_discount_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{ isset($id) ? $id : 'id' }} title_color_input"
                        name="after_discount_color"
                        value="{{ isset($data['after_discount_color']) ? $data['after_discount_color'] : '' }}">
                </div>
            </div>
        </div>
        <!--end::row after_discount_color -->



        <div class="cont1">
            <!--begin::row sub_title 1   -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.sub_title1') </label>
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
                        <input type="text" name="sub_description1[{{ app()->getLocale() }}]"
                            title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['sub_description1']) && isset($data['sub_description1'][app()->getLocale()]) ? $data['sub_description1'][app()->getLocale()] : 'This is sub heading' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="sub_description1[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['sub_description1']) && isset($data['sub_description1'][$locale['code']]) ? $data['sub_description1'][$locale['code']] : 'This is sub heading' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row sub_title1 1 -->

            <!--begin::row before_discount 1  -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.before_discount') </label>
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
                        <input type="text" name="before_discount1[{{ app()->getLocale() }}]"
                            title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['before_discount1']) && isset($data['before_discount1'][app()->getLocale()]) ? $data['before_discount1'][app()->getLocale()] : '$59.80' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="before_discount1[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['before_discount1']) && isset($data['before_discount1'][$locale['code']]) ? $data['before_discount1'][$locale['code']] : '$59.80' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row before_discount 1 -->

            <!--begin::row after_discount 1 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.after_discount0') </label>
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
                        <input type="text" name="after_discount1[{{ app()->getLocale() }}]"
                            title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['after_discount1']) && isset($data['after_discount1'][app()->getLocale()]) ? $data['after_discount1'][app()->getLocale()] : '$64.34' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="after_discount1[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['after_discount1']) && isset($data['after_discount1'][$locale['code']]) ? $data['after_discount1'][$locale['code']] : '$64.34' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row after_discount -->

            <!--begin::row description1 1   -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.description') </label>
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
                        <input type="text" name="description1[{{ app()->getLocale() }}]"
                            title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['description1']) && isset($data['description1'][app()->getLocale()]) ? $data['description1'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="description1[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['description1']) && isset($data['description1'][$locale['code']]) ? $data['description1'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row description1 1 -->

            <!--begin::Input Image 1 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_qwintry::view.section_banner')
                </label>
                <div class="col-md-8">

                    @if (isset($model))
                        <x-media-library-collection data-title="section_banner1" data-type="image" max-items="1"
                            name="section_banner1" :model="$model" collection="section_banner1"
                            rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @else
                        <x-media-library-attachment data-title="section_banner1" data-type="image"
                            name="section_banner1" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @endif
                </div>
            </div>
            <!--end::Input Image -->
        </div>


        <div class="cont2">

            <!--begin::row sub_title 2   -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.sub_title2') </label>
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
                        <input type="text" name="sub_description2[{{ app()->getLocale() }}]"
                            title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['sub_description2']) && isset($data['sub_description2'][app()->getLocale()]) ? $data['sub_description2'][app()->getLocale()] : 'This is sub heading' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="sub_description2[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['sub_description2']) && isset($data['sub_description2'][$locale['code']]) ? $data['sub_description2'][$locale['code']] : 'This is sub heading' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row sub_title 2 -->

            <!--begin::row before_discount 2 -->
            <div class="row mb-6  ">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.before_discount') </label>
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
                        <input type="text" name="before_discount2[{{ app()->getLocale() }}]"
                            title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['before_discount2']) && isset($data['before_discount2'][app()->getLocale()]) ? $data['before_discount2'][app()->getLocale()] : '$59.80' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="before_discount2[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['before_discount2']) && isset($data['before_discount2'][$locale['code']]) ? $data['before_discount2'][$locale['code']] : '$59.80' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row before_discount  2-->

            <!--begin::row after_discount  2 -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.after_discount0') </label>
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
                        <input type="text" name="after_discount2[{{ app()->getLocale() }}]"
                            title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['after_discount2']) && isset($data['after_discount2'][app()->getLocale()]) ? $data['after_discount2'][app()->getLocale()] : '$64.34' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="after_discount2[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['after_discount2']) && isset($data['after_discount2'][$locale['code']]) ? $data['after_discount2'][$locale['code']] : '$64.34' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row after_discount -->

            <!--begin::row description 2   -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.description') </label>
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
                        <input type="text" name="description2[{{ app()->getLocale() }}]"
                            title="{{ app()->getLocale() }}"
                            class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                            value="{{ isset($data['description2']) && isset($data['description2'][app()->getLocale()]) ? $data['description2'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}">
                        @foreach (Config::get('langauges_except_current') as $locale)
                            <input type="text" name="description2[{{ $locale['code'] }}]"
                                title="{{ $locale['code'] }}"
                                class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                value="{{ isset($data['description2']) && isset($data['description2'][$locale['code']]) ? $data['description2'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}">
                        @endforeach
                    </div>


                </div>
            </div>
            <!--end::row description 2 -->


            <!--begin::Input Image 2-->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_qwintry::view.section_banner')
                </label>
                <div class="col-md-8">

                    @if (isset($model))
                        <x-media-library-collection data-title="section_banner2" data-type="image" max-items="1"
                            name="section_banner2" :model="$model" collection="section_banner2"
                            rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @else
                        <x-media-library-attachment data-title="section_banner2" data-type="image"
                            name="section_banner2" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                    @endif


                </div>
            </div>
            <!--end::Input Image -->
        </div>


        <div class="cont3">

                <!--begin::row sub_title 3   -->
                <div class="row mb-6">
                    <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.sub_title3') </label>
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
                            <input type="text" name="sub_description3[{{ app()->getLocale() }}]"
                                title="{{ app()->getLocale() }}"
                                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                                value="{{ isset($data['sub_description3']) && isset($data['sub_description3'][app()->getLocale()]) ? $data['sub_description3'][app()->getLocale()] : 'This is sub heading' }}">
                            @foreach (Config::get('langauges_except_current') as $locale)
                                <input type="text" name="sub_description3[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                    value="{{ isset($data['sub_description3']) && isset($data['sub_description3'][$locale['code']]) ? $data['sub_description3'][$locale['code']] : 'This is sub heading' }}">
                            @endforeach
                        </div>


                    </div>
                </div>
                <!--end::row sub_title  3 -->

                <!--begin::row before_discount 3 -->
                <div class="row mb-6  ">
                    <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.before_discount') </label>
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
                            <input type="text" name="before_discount3[{{ app()->getLocale() }}]"
                                title="{{ app()->getLocale() }}"
                                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                                value="{{ isset($data['before_discount3']) && isset($data['before_discount3'][app()->getLocale()]) ? $data['before_discount3'][app()->getLocale()] : '$59.80' }}">
                            @foreach (Config::get('langauges_except_current') as $locale)
                                <input type="text" name="before_discount3[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                    value="{{ isset($data['before_discount3']) && isset($data['before_discount3'][$locale['code']]) ? $data['before_discount3'][$locale['code']] : '$59.80' }}">
                            @endforeach
                        </div>


                    </div>
                </div>
                <!--end::row before_discount  3 -->

                <!--begin::row after_discount  3 -->
                <div class="row mb-6">  
                    <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.after_discount0') </label>
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
                            <input type="text" name="after_discount3[{{ app()->getLocale() }}]"
                                title="{{ app()->getLocale() }}"
                                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                                value="{{ isset($data['after_discount3']) && isset($data['after_discount3'][app()->getLocale()]) ? $data['after_discount3'][app()->getLocale()] : '$64.34' }}">
                            @foreach (Config::get('langauges_except_current') as $locale)
                                <input type="text" name="after_discount3[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                    value="{{ isset($data['after_discount3']) && isset($data['after_discount3'][$locale['code']]) ? $data['after_discount3'][$locale['code']] : '$64.34' }}">
                            @endforeach
                        </div>


                    </div>
                </div>
                <!--end::row after_discount -->

                <!--begin::row description 3   -->
                <div class="row mb-6">
                    <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_qwintry::view.description') </label>
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
                            <input type="text" name="description3[{{ app()->getLocale() }}]"
                                title="{{ app()->getLocale() }}"
                                class="form-control section-title form-control-multilingual form-control-{{ app()->getLocale() }}"
                                value="{{ isset($data['description3']) && isset($data['description3'][app()->getLocale()]) ? $data['description3'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}">
                            @foreach (Config::get('langauges_except_current') as $locale)
                                <input type="text" name="description3[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{ $locale['code'] }}  d-none"
                                    value="{{ isset($data['description3']) && isset($data['description3'][$locale['code']]) ? $data['description3'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}">
                            @endforeach
                        </div>


                    </div>
                </div>
                <!--end::row description 3 -->

                <!--begin::Input Image 3-->
                <div class="row mb-6">
                    <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_qwintry::view.section_banner')
                    </label>
                    <div class="col-md-8">

                        @if (isset($model))
                            <x-media-library-collection data-title="section_banner3" data-type="image" max-items="1"
                                name="section_banner3" :model="$model" collection="section_banner3"
                                rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                        @else
                            <x-media-library-attachment data-title="section_banner3" data-type="image"
                                name="section_banner3" rules="mimes:jpg,jpeg,png,gif,bmp,svg,webp" />
                        @endif

                </div>
                <!--end::Input Image -->
        </div>

    </div>
</div>



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
    $('.display_input ').on('change', function(e) {
        if ($(this)[0].checked) {
            $('.control').show()
        } else {
            $('.control').hide()
        }
    });
    $('input[type=radio]:checked').each(function () {
            if (this.value == 1){
                $(".cont1").css("display","block");
                $(".cont3").css("display","none");
                $(".cont2").css("display","none");
            }else if (this.value == 2){
                $(".cont1").css("display","none");
                $(".cont2").css("display","block");
                $(".cont3").css("display","block");
            }else if (this.value == 3){
                $(".cont1").css("display","block");
                $(".cont2").css("display","block");
                $(".cont3").css("display","block");
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
                    $(".cont2").css("display","block");
                    $(".cont2").css("display","block");
                    $(".cont3").css("display","block");
                }
        });
</script>
