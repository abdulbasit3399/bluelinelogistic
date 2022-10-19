<div class="demos-setting">

    
    
    <!--begin::colors -->
    <div class="setting-box">
        <h4 class="setting-box-label fw-bold fs-3">@lang('theme_easyship::view.choose_demo') </h4>
        
        <div class="row mb-6">
            <div class="col-md-12">
                <div class="input-group radio-images">
                    <div class="form-check mx-3">
                        <label class="px-2 py-1 text-center">
                            <input
                                class=""
                                type="radio"
                                name="active_demo"
                                value="main"
                                {{ isset($data['active_demo']) && $data['active_demo'] == 'main' ? 'checked="checked"' : '' }}
                            >
                            <div class="form-check-label bg-white border p3">
                                <img  class="mb-1" style="height: 160px;width: 160px;" src="{{ asset('assets/custom/images/settings/demos/demo-main.jpg') }}"><br>
                                @lang('theme_easyship::view.main_demo')
                            </div>
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <label class="px-2 py-1 text-center">
                            <input
                                class=""
                                type="radio"
                                name="active_demo"
                                value="easyship"
                                {{ isset($data['active_demo']) && $data['active_demo'] == 'easyship' ? 'checked="checked"' : '' }}
                            >
                            <div class="form-check-label bg-white border p3">
                                <img  class="mb-1" style="height: 160px;width: 160px;" src="{{ asset('assets/custom/images/settings/demos/easyship.png') }}"><br>
                                @lang('theme_easyship::view.easyship_demo')
                            </div>
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <label class="px-2 py-1 text-center">
                            <input
                                class=""
                                type="radio"
                                name="active_demo"
                                value="flextock"
                                {{ isset($data['active_demo']) && $data['active_demo'] == 'flextock' ? 'checked="checked"' : '' }}
                            >
                            <div class="form-check-label bg-white border p3">
                                <img  class="mb-1" style="height: 160px;width: 160px;" src="{{ asset('assets/custom/images/settings/demos/flextock.png') }}"><br>
                                @lang('theme_easyship::view.flextock_demo')
                            </div>
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <label class="px-2 py-1 text-center">
                            <input
                                class=""
                                type="radio"
                                name="active_demo"
                                value="goshippo"
                                {{ isset($data['active_demo']) && $data['active_demo'] == 'goshippo' ? 'checked="checked"' : '' }}
                            >
                            <div class="form-check-label bg-white border p3">
                                <img  class="mb-1" style="height: 160px;width: 160px;" src="{{ asset('assets/custom/images/settings/demos/goshippo.png') }}"><br>
                                @lang('theme_easyship::view.goshippo_demo')
                            </div>
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <label class="px-2 py-1 text-center">
                            <input
                                class=""
                                type="radio"
                                name="active_demo"
                                value="qwintry"
                                {{ isset($data['active_demo']) && $data['active_demo'] == 'qwintry' ? 'checked="checked"' : '' }}
                            >
                            <div class="form-check-label bg-white border p3">
                                <img  class="mb-1" style="height: 160px;width: 160px;" src="{{ asset('assets/custom/images/settings/demos/qwintry.png') }}"><br>
                                @lang('theme_easyship::view.qwintry_demo')
                            </div>
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <label class="px-2 py-1 text-center">
                            <input
                                class=""
                                type="radio"
                                name="active_demo"
                                value="shipito"
                                {{ isset($data['active_demo']) && $data['active_demo'] == 'shipito' ? 'checked="checked"' : '' }}
                            >
                            <div class="form-check-label bg-white border p3">
                                <img  class="mb-1" style="height: 160px;width: 160px;" src="{{ asset('assets/custom/images/settings/demos/shipito.png') }}"><br>
                                @lang('theme_easyship::view.shipito_demo')
                            </div>
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <label class="px-2 py-1 text-center">
                            <input
                                class=""
                                type="radio"
                                name="active_demo"
                                value="timeglobalshipping"
                                {{ isset($data['active_demo']) && $data['active_demo'] == 'timeglobalshipping' ? 'checked="checked"' : '' }}
                            >
                            <div class="form-check-label bg-white border p3">
                                <img  class="mb-1" style="height: 160px;width: 160px;" src="{{ asset('assets/custom/images/settings/demos/timeglobalshipping.png') }}"><br>
                                @lang('theme_easyship::view.timeglobalshipping_demo')
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--end::colors -->

</div>