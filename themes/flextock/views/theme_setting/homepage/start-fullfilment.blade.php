@php
    $hasBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getBanner = $hasBanner ? $data['header_logo_url'] : '';
    $hasMobileBanner = isset($data['header_logo_url']) && $data['header_logo_url'];
    $getMobileBanner = $hasMobileBanner ? $data['header_logo_url'] : '';
@endphp


<div class="start-fullfilment">

    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center"> @lang('theme_flextock::view.display') </label>
        <div class="col-md-8">
            <div class="custom-control custom-switch form-check form-switch">
                <input
                    class="custom-control-input form-check-input"
                    name="display"
                    type="checkbox"
                    value="1"
                    id="display_hero_{{isset($id) ? $id : 'id'}}"
                    {{ isset($id) ? (isset($data['display']) && $data['display'] == 1 ? 'checked="checked"' : '') : 'checked="checked"' }}
                >
                <label class="custom-control-label form-check-label fw-bold fs-6" for="display_hero_{{isset($id) ? $id : 'id'}}"></label>
            </div>
        </div>
    </div>
    <!--end::row toggle display -->

    <!--begin::row header_bg -->
    <div class="row mb-6 header_bg">
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_flextock::view.section_bg') </label>
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
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_flextock::view.section_description_color') </label>
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
        <label class="col-md-4 fw-bold fs-6"> @lang('theme_flextock::view.title_color') </label>
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

    <!--begin::row section_title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_flextock::view.section_title') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_section_section_title">
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
                        name="start-fullfilment_title[{{app()->getLocale()}}]"
                        title="{{app()->getLocale()}}"
                        class="form-control section-title form-control-multilingual form-control-{{app()->getLocale()}}"
                        value="{{ isset($data['start-fullfilment_title']) && isset($data['start-fullfilment_title'][app()->getLocale()]) ? $data['start-fullfilment_title'][app()->getLocale()] : 'This is the heading' }}"
                    >
                    @foreach(get_langauges_except_current() as $locale)
                        <input
                            type="text"
                            name="start-fullfilment_title[{{ $locale['code'] }}]"
                            title="{{ $locale['code'] }}"
                            class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none"
                            value="{{ isset($data['start-fullfilment_title']) && isset($data['start-fullfilment_title'][$locale['code']]) ? $data['start-fullfilment_title'][$locale['code']] : 'This is the heading' }}"
                        >
                    @endforeach
                </div>


        </div>
    </div>
    <!--end::row section_title  -->

    <!--begin::row section_description -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_flextock::view.section_description') </label>
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

                    <textarea name="start-fullfilment_description[{{app()->getLocale()}}]" title="{{app()->getLocale()}}" class="form-control form-control-lg form-control-multilingual form-control-{{app()->getLocale()}}">{{ isset($data['start-fullfilment_description']) && isset($data['start-fullfilment_description'][app()->getLocale()]) ? $data['start-fullfilment_description'][app()->getLocale()] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                    @foreach(get_langauges_except_current() as $locale)
                        <textarea name="start-fullfilment_description[{{ $locale['code'] }}]" title="{{ $locale['code'] }}" class="form-control section-title form-control-multilingual form-control-{{$locale['code']}}  d-none">{{ isset($data['start-fullfilment_description']) && isset($data['start-fullfilment_description'][$locale['code']]) ? $data['start-fullfilment_description'][$locale['code']] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo .' }}</textarea>
                    @endforeach
                </div>
        </div>
    </div>
    <!--end::row section_description -->

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
      $(".color_picker_input_{{isset($id) ? $id : 'id'}}").spectrum({
      type: "component",
      showInput: true,
       showInitial: true,
      clickoutFiresChange: true,
      allowEmpty: true,
      maxSelectionSize: 8,
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
    // select category_select
    var selectCategories = $('.select_categories');
    selectCategories.select2({
        closeOnSelect: false,
        ajax: {
            url: "{{ fr_route('categories.search') }}",
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return { search: params.term };
            },
            processResults: function (data) {
                if (data && data.categories) {
                    return {
                        results: data.categories.map(function(category) {
                            return {id: category.id, text: category.name}
                        })
                    };
                }
            },
            cache: true,
        },
    });

    @if (isset($id) && isset($data['categories']) && is_array($data['categories']))
        $('.select_categories_{{$id}}').val([{{ implode(", ", $data['categories']) }}]).trigger('change');
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
            data: function (params) {
                return { search: params.term };
            },
            processResults: function (data) {
                if (data && data.tags) {
                    return {
                        results: data.tags.map(function(tag) {
                            return {id: tag.id, text: tag.name}
                        })
                    };
                }
            },
            cache: true,
        },
    });

    @if (isset($id) && isset($data['tags']) && is_array($data['tags']))
        $('.select_tags_{{$id}}').val([{{ implode(", ", $data['tags']) }}]).trigger('change');
    @endif
    // end select tags
    /*******************************************************************************************/

</script>
