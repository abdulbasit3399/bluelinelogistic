@if (in_array('client_id', $filters))

    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.client') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2"
                data-placeholder="{{ __('cargo::view.choose_client') }}" data-allow-clear="true"
                name="{{ $table_id }}_client_id">
                <option></option>
                @foreach (Modules\Cargo\Entities\Client::all() as $client)
                    <option  value="{{ $client->id }}">
                        {{ $client->name }}
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
                    var clientSelect = $(`[name="${ table_id }_client_id"]`)
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
                            data.filter.client_id = value;
                        })
                            // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.client_id = '';
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
