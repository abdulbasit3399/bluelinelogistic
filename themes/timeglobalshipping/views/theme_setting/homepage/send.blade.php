<div class="send">

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
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_timeglobalshipping::view.section_bg') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} header_bg_input"
                        name="header_bg"
                        value="{{ isset($data['header_bg']) ? $data['header_bg'] :  ''  }}"
                    >
                </div>
            </div>
        </div>
        <!--end::row header_bg -->

        <!--begin::row text_color -->
        <div class="row mb-6 text_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_timeglobalshipping::view.section_description_color') </label>
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

        <!--begin::row title_color -->
        <div class="row mb-6 text_color">
            <label class="col-md-4 fw-bold fs-6"> @lang('theme_timeglobalshipping::view.title_color') </label>
            <div class="col-md-8">
                <div class="input-group">
                    <input
                        class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} text_color_input"
                        name="title_color"
                        value="{{ isset($data['title_color']) ? $data['title_color'] :   ''   }}"
                    >
                </div>
            </div>
        </div>
        <!--end::row title_color -->


        <div class="row mb-6 count">
            <label class="col-md-4 fw-bold fs-6 required"> @lang('theme_goshippo::view.count') </label>
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
                    <div class="form-check mx-3">
                        <input class="custom-control-input form-check-input" type="radio" name="services_count" id="count4" value="4" {{ isset($data['services_count']) && $data['services_count'] == 4 ? 'checked="checked"' : '' }} >
                        <label class="custom-control-label form-check-label" for="count4">
                            <img style="height: 60px;" src="{{ asset('assets/custom/images/settings/layouts/footer_layout/column-4.svg') }}">
                        </label>
                    </div>
                </div>
            </div>
        </div>



        <div class="cont1">
            <!--begin::row first_title -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_timeglobalshipping::view.title') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_section_subtitle1">
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
                                name="first_title[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"value="{{ isset($data['first_title']) && isset($data['first_title'][app()->getLocale()]) ? $data['first_title'][app()->getLocale()] : 'This is the heading' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="first_title[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['first_title']) && isset($data['first_title'][$locale['code']]) ? $data['first_title'][$locale['code']] : 'This is the heading' }}"
                                >
                            @endforeach
                        </div>


                </div>
            </div>
            <!--end::row first_title -->
            
            <!--begin::row first_description -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_timeglobalshipping::view.section_description') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container text" id="lang_container_section_description">
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

                            <textarea name="first_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['first_description']) && isset($data['first_description'][app()->getLocale()]) ? $data['first_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @foreach(get_langauges_except_current() as $locale)
                                <textarea name="first_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['first_description']) && isset($data['first_description'][$locale['code']]) ? $data['first_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row first_description -->
        </div>

        <div class="cont2">

            <!--begin::row second_title -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_timeglobalshipping::view.title') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_section_subtitle2">
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
                                name="second_title[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['second_title']) && isset($data['second_title'][app()->getLocale()]) ? $data['second_title'][app()->getLocale()] : 'This is the heading' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="second_title[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['second_title']) && isset($data['second_title'][$locale['code']]) ? $data['second_title'][$locale['code']] : 'This is the heading' }}"
                                >
                            @endforeach
                        </div>


                </div>
            </div>
            <!--end::row second_title -->

            <!--begin::row second_description -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_timeglobalshipping::view.section_description') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container text" id="lang_container_section_description">
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

                            <textarea name="second_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['second_description']) && isset($data['second_description'][app()->getLocale()]) ? $data['second_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @foreach(get_langauges_except_current() as $locale)
                                <textarea name="second_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['second_description']) && isset($data['second_description'][$locale['code']]) ? $data['second_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row second_description -->

        </div>

        <div class="cont3">
            <!--begin::row Third_title -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_timeglobalshipping::view.title') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_section_subtitle3">
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
                                name="Third_title[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['Third_title']) && isset($data['Third_title'][app()->getLocale()]) ? $data['Third_title'][app()->getLocale()] : 'This is the heading' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="Third_title[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['Third_title']) && isset($data['Third_title'][$locale['code']]) ? $data['Third_title'][$locale['code']] : 'This is the heading' }}"
                                >
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row Third_title -->

            <!--begin::row Third_description -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_timeglobalshipping::view.section_description') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container text" id="lang_container_section_description">
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

                            <textarea name="Third_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['Third_description']) && isset($data['Third_description'][app()->getLocale()]) ? $data['Third_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @foreach(get_langauges_except_current() as $locale)
                                <textarea name="Third_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['Third_description']) && isset($data['Third_description'][$locale['code']]) ? $data['Third_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row Third_description -->
        </div>

        <div class="cont4">
            <!--begin::row Fourth_title -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_timeglobalshipping::view.title') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container" id="lang_container_section_subtitle3">
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
                                name="Fourth_title[{{app()->getLocale()}}]"
                                title="{{app()->getLocale()}}"
                                class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                                value="{{ isset($data['Fourth_title']) && isset($data['Fourth_title'][app()->getLocale()]) ? $data['Fourth_title'][app()->getLocale()] : 'This is the heading' }}"
                            >
                            @foreach(get_langauges_except_current() as $locale)
                                <input
                                    type="text"
                                    name="Fourth_title[{{ $locale['code'] }}]"
                                    title="{{ $locale['code'] }}"
                                    class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                                    value="{{ isset($data['Fourth_title']) && isset($data['Fourth_title'][$locale['code']]) ? $data['Fourth_title'][$locale['code']] : 'This is the heading' }}"
                                >
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row Fourth_title -->

            <!--begin::row Fourth_description -->
            <div class="row mb-6">
                <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_timeglobalshipping::view.section_description') </label>
                <div class="col-md-8">

                        <div class="input-group lang_container text" id="lang_container_section_description">
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

                            <textarea name="Fourth_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['Fourth_description']) && isset($data['Fourth_description'][app()->getLocale()]) ? $data['Fourth_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @foreach(get_langauges_except_current() as $locale)
                                <textarea name="Fourth_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['Fourth_description']) && isset($data['Fourth_description'][$locale['code']]) ? $data['Fourth_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                            @endforeach
                        </div>
                </div>
            </div>
            <!--end::row Fourth_description -->
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


        $('input[type=radio]').change(function() {
            if (this.value == 1){
                $(".cont1").css("display","block");
                $(".cont2").css("display","none");
                $(".cont3").css("display","none");
                $(".cont4").css("display","none");
            }
            else if (this.value == 2){
                $(".cont1").css("display","block");
                $(".cont2").css("display","block");
                $(".cont3").css("display","none");
                $(".cont4").css("display","none");
            }
            else if (this.value == 3){
                    $(".cont1").css("display","block");
                    $(".cont2").css("display","block");
                    $(".cont3").css("display","block");
                    $(".cont4").css("display","none");
                }
            else if (this.value == 4){
                    $(".cont1").css("display","block");
                    $(".cont2").css("display","block");
                    $(".cont3").css("display","block");
                    $(".cont4").css("display","block");
                }
        });
</script>
