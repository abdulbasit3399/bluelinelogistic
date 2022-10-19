@if (in_array('address', $filters))

    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.address') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2"  data-allow-clear="true"data-placeholder="{{ __('cargo::view.choose_address') }}"  name="{{ $table_id }}_address">
                <option></option>
                @foreach (Modules\Cargo\Entities\ClientAddress::all() as $item)
                    <option >
                        {{ $item->address }}
                    </option>
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
                    var clientSelect = $(`[name="${ table_id }_address"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);

                    clientSelect.on('change', function(e) {
                        var value = $(this).val(),

                            clientSelectChecked = clientSelect.filter(':checked')
                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }
                            data.filter.address = value;
                        })
                            // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.address = '';
                            }
                        })
                        console.log('end');
                            // dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush


@endif
