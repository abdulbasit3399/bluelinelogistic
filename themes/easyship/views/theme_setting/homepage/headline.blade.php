<div class="headline">

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
                    id="display_headline_{{isset($id) ? $id : 'id'}}"
                    {{ isset($id) ? (isset($data['display']) && $data['display'] == 1 ? 'checked="checked"' : '') : 'checked="checked"' }}
                >
                <label class="custom-control-label form-check-label fw-bold fs-6" for="display_headline_{{isset($id) ? $id : 'id'}}"></label>
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
                    value="{{ isset($data['header_bg']) ? $data['header_bg'] :  ''  }}"
                >
            </div>
        </div>
    </div>
    <!--end::row header_bg -->

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

    <!--begin::row section title -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 d-inline-flex align-items-center"> @lang('theme_easyship::view.section_title') </label>
        <div class="col-md-8">

                <div class="input-group lang_container" id="lang_container_section_title">
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

</div>

<link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/css/setting.css') }}">
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