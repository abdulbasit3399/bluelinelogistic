@if (in_array('role', $filters))

    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('users::view.table.role') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            @foreach (config('cms.user_roles') as $value => $titleRole)
                <!--begin::Option-->
                <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5" for="{{ $titleRole . $value }}">
                    <input class="form-check-input" name="{{ $table_id }}_role[]" type="checkbox" value="{{ $value }}" id="{{ $titleRole . $value }}" >
                    <span class="form-check-label text-gray-600 " style="margin-left: 2.55rem;" >{{ $titleRole }}</span>
                </label>
                <!--end::Option-->
            @endforeach
        </div>
        <!--end::Options-->
    </div>

    {{-- Inject Scripts --}}
    @push('js-component')
        <script>
            $(window).on('load', function() {
                setTimeout(() => {
                    var table_id = '{{ $table_id }}';
                    var roleCheckbox = $(`[name="${ table_id }_role[]"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);

                    roleCheckbox.on('change', function (e) {

                        var value = $(this).val(),
                            roles = [],
                            roleCheckboxChecked = roleCheckbox.filter(':checked')

                        // get multi roles
                        roleCheckboxChecked.each(function (i) {
                            roles.push($(this).val())
                        })
                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function (e, settings, data) {

                            console.log(data);
                            if (!data.filter) {
                                data.filter = {}
                            }
                            data.filter.role = roles


                        })
                        // dataTableInstance.ajax.reload()
                    })

                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                            if (data.filter) {
                                data.filter.role = ''
                            }
                        })
                        dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush


@endif







