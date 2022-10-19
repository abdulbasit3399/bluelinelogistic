@if (in_array('name', $filters))

<div class="mb-10">
    <!--begin::Label-->
    <label class="form-label fs-5 fw-bold mb-3">{{ __('users::view.table.full_name') }}:</label>
    <!--end::Label-->
    <!--begin::Options-->
    <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2" data-placeholder="{{ __('users::view.table.name') }}" data-allow-clear="true" name="{{ $table_id }}_name" >
                <option></option>
                @foreach(App\Models\User::all() as $name)
                    <option  >
                        {{$name->name}}
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
                    var roleCheckbox = $(`[name="${ table_id }_name"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);

                    roleCheckbox.on('change', function (e) {

                        var value = $(this).val(),

                            roleCheckboxChecked = roleCheckbox.filter(':checked')


                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }
                            data.filter.name = value ;
                        })
                        dataTableInstance.ajax.reload()
                    })

                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                            console.log(data.filter.name);
                            if (data.filter) {
                                data.filter.name = '' ;
                            }
                        })
                        console.log('end');
                        dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush


@endif







