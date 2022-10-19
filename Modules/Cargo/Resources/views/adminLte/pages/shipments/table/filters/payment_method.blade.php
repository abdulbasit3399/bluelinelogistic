@if (in_array('payment_method_id', $filters))

    @php
        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
    @endphp
    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.payment_method') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2"data-placeholder="{{ __('cargo::view.payment_method') }}" data-allow-clear="true" name="{{ $table_id }}_payment_method_id">
                <option></option>
                @foreach ($paymentSettings as $key => $gateway)
                    {
                    @if ($gateway)
                        <option value="{{ $key }}" @if (Modules\Cargo\Entities\ShipmentSetting::getVal('def_payment_method') == $key) selected @endif
                            {{ old('Shipment.payment_method_id') == $key ? 'selected' : '' }}>{{ $key }}
                        </option>
                    @endif
                @endforeach
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
                    var payment_method_Select = $(`[name="${ table_id }_payment_method_id"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);


                    payment_method_Select.on('change', function(e) {
                        var value = $(this).val(),

                            payment_method_SelectChecked = payment_method_Select.filter(':checked')
                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }

                            data.filter.payment_method_id = value;
                            console.log(data.filter);
                        })
                        // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.payment_method_id = '';
                            }
                        })
                        // dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush


@endif
