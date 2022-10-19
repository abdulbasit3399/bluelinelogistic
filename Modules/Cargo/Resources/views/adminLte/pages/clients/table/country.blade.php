@php
$user_role = auth()->user()->role;
$admin = 1;
$countries = Modules\Cargo\Entities\Country::where('covered', 1)->get();
@endphp




    <div class="mb-10">
        <!--begin::Options-->
        <div class="row">
            @if (in_array('country_id', $filters))
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-form-label fw-bold fs-6 ">{{ __('cargo::view.country') }}</label>
                        <select  name="{{ $table_id }}_country_id" class="change-country-client-address form-control select-country ">
                            <option value=""></option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @push('js-component')
                    <script>
                        $(window).on('load', function() {

                            setTimeout(() => {
                                var table_id = '{{ $table_id }}';
                                var clientSelect = $(`[name="${ table_id }_country_id"]`)
                                var dataTableInstance = $(`#${table_id}`).DataTable();
                                var formOptions = $(`#${table_id}_filter_options_form`);
                                console.log('clientSelect');
                                clientSelect.on('change', function(e) {
                                    var value = $(this).val(),

                                    clientSelectChecked = clientSelect.filter(':checked')
                                    // get data by selected roles
                                    dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                        console.log(data.filter);
                                        if (!data.filter) {
                                            data.filter.country_id = {}
                                        }
                                        data.filter.country_id = value;
                                    })
                                        // dataTableInstance.ajax.reload()
                                })
                                formOptions.on('reset', function(e) {
                                    dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                        if (data.filter) {
                                            data.filter.country_id = '';
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

            @if (in_array('state_id', $filters))
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label fw-bold fs-6 ">{{ __('cargo::view.region') }}</label>
                        <select name="{{ $table_id }}_state_id"
                            class="change-state-client-address form-control select-state @error('address.*.state_id') is-invalid @enderror">
                            <option value=""></option>

                        </select>
                    </div>
                </div>
                @push('js-component')
                <script>
                    $(window).on('load', function() {
                        setTimeout(() => {
                            var table_id = '{{ $table_id }}';
                            var clientSelect = $(`[name="${ table_id }_state_id"]`)
                            var dataTableInstance = $(`#${table_id}`).DataTable();
                            var formOptions = $(`#${table_id}_filter_options_form`);

                            clientSelect.on('change', function(e) {
                                var value = $(this).val(),

                                    console.log(value);

                                    clientSelectChecked = clientSelect.filter(':checked')
                                // get data by selected roles
                                dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                    if (!data.filter) {
                                        data.filter.state_id = {}
                                    }
                                    data.filter.state_id = value;
                                })
                                    // dataTableInstance.ajax.reload()
                            })
                            formOptions.on('reset', function(e) {
                                dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                    if (data.filter) {
                                        data.filter.state_id = '';
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


            @if (in_array('area_id', $filters))
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label fw-bold fs-6 ">{{ __('cargo::view.area') }}</label>
                            <select name="{{ $table_id }}_area_id" style="display: block !important;"
                                class="change-area-client-address form-control select-area @error('address.*.area_id') is-invalid @enderror">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    @push('js-component')
                    <script>
                        $(window).on('load', function() {
                            setTimeout(() => {
                                var table_id = '{{ $table_id }}';
                                var clientSelect = $(`[name="${ table_id }_area_id"]`)
                                var dataTableInstance = $(`#${table_id}`).DataTable();
                                var formOptions = $(`#${table_id}_filter_options_form`);

                                clientSelect.on('change', function(e) {
                                    var value = $(this).val(),

                                        console.log(value);

                                        clientSelectChecked = clientSelect.filter(':checked')
                                    // get data by selected roles
                                    dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                        if (!data.filter) {
                                            data.filter.area_id = {}
                                        }
                                        data.filter.area_id = value;
                                    })
                                        // dataTableInstance.ajax.reload()
                                })
                                formOptions.on('reset', function(e) {
                                    dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                        if (data.filter) {
                                            data.filter.area_id = '';
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

            {{-- </div> --}}

        </div>
        <!--end::Options-->
    </div>








@push('js-component')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"> </script>
    <script>

        function changeCountry() {
            $('.change-country-client-address').change(function() {
                var id = $(this).parent().find(".change-country-client-address").val();
                var row = $(this).closest(".row");
                var state_input = row.find(".change-state-client-address");
                var state_name = state_input.attr("name");

                $.get("{{ route('ajax.getStates') }}?country_id=" + id, function(data) {
                    $('select[name ="' + state_name + '"]').empty();
                    $('select[name ="' + state_name + '"]').append('<option value=""></option>');
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="' + state_name + '"]').append('<option value="' + element['id'] +
                            '">' + element['name'] + '</option>');
                    }
                });
            });
        }
        changeCountry();

        function changeState() {
            $('.change-state-client-address').change(function() {

                var id = $(this).parent().find(".change-state-client-address").val();
                var row = $(this).closest(".row");
                var area_input = row.find(".change-area-client-address");
                var area_name = area_input.attr("name");
                console.log(area_name);
                $.get("{{ route('ajax.getAreas') }}?state_id=" + id, function(data) {
                    $('select[name ="' + area_name + '"]').empty();
                    $('select[name ="' + area_name + '"]').append('<option value=""></option>');
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="' + area_name + '"]').append('<option value="' + element['id'] +
                            '">' + JSON.parse(element['name'], true)[`{{ app()->getLocale() }}`] +
                            '</option>');
                    }
                });
            });
        }
        changeState();

        function selectPlaceholder() {
            $('.select-country').select2({
                placeholder: "{{ __('cargo::view.choose_country') }}",
                width: '100%'
            })
            @if (auth()->user()->can('add-covered-countries') || $user_role == $admin)
                .on('select2:open', () => {
                $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%"
                        href="{{ route('countries.index') }}?redirect=shipments.create"
                        class="btn btn-primary">{{ __('cargo::view.manage') }} {{ __('cargo::view.covered_countries') }}</a>
                </li>`);
                });
            @endif

            $('.select-state').select2({
                placeholder: "{{ __('cargo::view.choose_region') }}",
                width: '100%'
            })
            @if (auth()->user()->can('add-covered-regions') || $user_role == $admin)
                .on('select2:open', () => {
                $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%"
                        href="{{ route('countries.index') }}?redirect=shipments.create"
                        class="btn btn-primary">{{ __('cargo::view.manage') }} {{ __('cargo::view.covered_regions') }}</a>
                </li>`);
                });
            @endif

            $('.select-area').select2({
                placeholder: "{{ __('cargo::view.choose_area') }}",
                width: '100%'
            })
            @if (auth()->user()->can('manage-areas') || $user_role == $admin)
                .on('select2:open', () => {
                $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%"
                        href="{{ route('areas.index') }}?redirect=shipments.create"
                        class="btn btn-primary">{{ __('cargo::view.manage') }} {{ __('cargo::view.areas') }}</a>
                </li>`);
                });
            @endif
        }
        selectPlaceholder();


    </script>
@endpush
