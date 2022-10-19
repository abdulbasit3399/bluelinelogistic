<!--begin::Form-->
<form class="traking-widget">

    <!--begin::row toggle display -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold fs-6 required d-inline-flex align-items-center">@lang('cargo::view.display') </label>
        <div class="col-md-8">
            <div class="custom-control custom-switch form-check form-switch">
                <input
                    class="custom-control-input form-check-input"
                    name="display"
                    type="checkbox"
                    value="1"
                    id="display_business_{{isset($id) ? $id : 'id'}}"
                    {{ isset($id) ? (isset($oldData['display']) && $oldData['display'] == 1 ? 'checked="checked"' : '') : 'checked="checked"' }}
                >
                <label class="custom-control-label form-check-label fw-bold fs-6" for="display_business_{{isset($id) ? $id : 'id'}}"></label>
            </div>
        </div>
    </div>
    <!--end::row toggle display -->

    <!--begin::row header_bg -->
    <div class="row mb-6 header_bg">
        <label class="col-md-4 fw-bold fs-6"> @lang('cargo::view.widget_bg')</label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} header_bg_input"
                    name="header_bg"
                    value="{{ isset($oldData['header_bg']) ? $oldData['header_bg'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row header_bg -->

    <!--begin::row widget_color -->
    <div class="row mb-6 widget_color">
        <label class="col-md-4 fw-bold fs-6"> @lang('cargo::view.widget_color') </label>
        <div class="col-md-8">
            <div class="input-group">
                <input
                    class="form-control form-control-color w-100 color_picker_input_{{isset($id) ? $id : 'id'}} widget_color_input"
                    name="widget_color"
                    value="{{ isset($oldData['widget_color']) ? $oldData['widget_color'] : '' }}"
                >
            </div>
        </div>
    </div>
    <!--end::row widget_color -->

    <!--begin::Input group view_style -->
    <div class="row mb-6">
        <label class="col-md-4 fw-bold mb-1 fs-6 required"> @lang('cargo::view.widget_tracking.view_style') </label>
        <div class="col-md-8 mb-4">
            <select
                class="form-control view-style-select"
                name="view_style"
            >
                @foreach($viewStyles as $viewStyles)
                    <option value="{{ $viewStyles['id'] }}" {{ isset($oldData['view_style']) && $oldData['view_style'] == $viewStyles['id'] ? 'selected' : '' }}>{{ $viewStyles['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!--end::Input group view_style -->
</form>
<!--end::Form-->

<link rel="stylesheet" href="{{ asset('assets/plugins/spectrum/spectrum.min.css') }}">
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
</script>