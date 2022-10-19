@if (in_array('payment_type', $filters))
    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.shipment_type') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2"
                data-placeholder="{{ __('cargo::view.type') }}" data-allow-clear="true"
                name="{{ $table_id }}_payment_type">
                <option></option>
                <option @if (Modules\Cargo\Entities\ShipmentSetting::getVal('def_payment_type') == '1') selected @endif value="1">{{ __('cargo::view.postpaid') }}
                </option>
                <option @if (Modules\Cargo\Entities\ShipmentSetting::getVal('def_payment_type') == '2') selected @endif value="2">{{ __('cargo::view.prepaid') }}
                </option>
            </select>
            <!--end::Option-->
        </div>
        <!--end::Options-->
    </div>




    {{-- Inject Scripts --}}
    @push('js-component')
        <script>
            $(window).on('load', function() {
                setTimeout(() => {
                    var table_id = '{{ $table_id }}';
                    var branchSelect = $(`[name="${ table_id }_payment_type"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);

                    branchSelect.on('change', function(e) {
                        var value = $(this).val(),

                            branchSelectChecked = branchSelect.filter(':checked')
                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }

                            data.filter.payment_type = value;
                            console.log(data.filter);
                        })
                        // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.payment_type = '';
                            }
                        })
                        // dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush
@endif
