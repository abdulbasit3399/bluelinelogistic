@if (in_array('name', $filters))

    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.branch') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2"
                data-placeholder="{{ __('cargo::view.choose_branch') }}" data-allow-clear="true"
                name="{{ $table_id }}_name">
                <option></option>
                @foreach (Modules\Cargo\Entities\Branch::where('is_archived', 0)->get() as $branch)
                    <option>
                        {{ $branch->name}}
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
                    var branchSelect = $(`[name="${ table_id }_name"]`)
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

                            data.filter.name = value;
                            console.log(data.filter);
                        })
                        // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.name = '';
                            }
                        })
                        // dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush


@endif
