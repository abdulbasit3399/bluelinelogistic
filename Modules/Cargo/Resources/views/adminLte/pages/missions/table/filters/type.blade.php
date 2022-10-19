@php
$user_role = auth()->user()->role;
$admin = 1;
$branch = 3;
$client = 4;
@endphp


@if (in_array('type', $filters))
    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.type') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2" data-placeholder="{{ __('cargo::view.type') }}" data-allow-clear="true" name="{{ $table_id }}_type">
                <option></option>
                <option value="1">{{ __('cargo::view.PICKUP_TYPE') }} </option>
                <option value="2">{{ __('cargo::view.DELIVERY_TYPE') }} </option>
                <option value="3">{{ __('cargo::view.RETURN_TYPE') }} </option>
                <option value="4">{{ __('cargo::view.SUPPLY_TYPE') }} </option>
                <option value="5">{{ __('cargo::view.TRANSFER_TYPE') }} </option>
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
                    var typSelect = $(`[name="${ table_id }_type"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);


                    typSelect.on('change', function(e) {
                        var value = $(this).val(),

                            typSelectChecked = typSelect.filter(':checked')
                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }

                            data.filter.type = value;
                            console.log(data.filter);
                        })
                        // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.type = '';
                            }
                        })
                        // dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush
@endif
