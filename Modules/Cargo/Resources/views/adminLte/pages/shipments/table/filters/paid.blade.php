@if (in_array('paid', $filters))
    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.paid') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
                <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5" >
                    <input class="form-check-input" name="{{ $table_id }}_paid" type="checkbox" value="0"  >
                    <span class="form-check-label text-gray-600 " style="margin-left: 2.55rem;" > {{ __('cargo::view.paid') }} </span>
                </label>
                <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5" >
                    <input class="form-check-input" name="{{ $table_id }}_paid" type="checkbox" value="1"  >
                    <span class="form-check-label text-gray-600 " style="margin-left: 2.55rem;" > {{ __('cargo::view.UNPaid') }} </span>
                </label>
            {{-- </select> --}}
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
                    var paidSelect = $(`[name="${ table_id }_paid"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);


                    paidSelect.on('change', function(e) {
                        var value = $(this).val(),

                            paidSelectChecked = paidSelect.filter(':checked')

                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }
                            console.log(data.filter.paid);
                            data.filter.paid = value;

                        })
                        // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.paid = '';
                            }
                        })
                        // dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush
@endif
