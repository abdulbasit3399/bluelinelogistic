@if (in_array('approval', $filters))

    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('view.approval') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            @foreach (config('blog.comments_approval_types') as $value => $typeText)
                
                <!--begin::Option-->
                <label class="custom-control custom-switch form-check form-check-sm form-check-custom form-check-solid mb-3 me-5" for="{{ $typeText . $value }}">
                    <input
                        class="custom-control-input form-check-input"
                        name="{{ $table_id }}_approval[]"
                        type="checkbox"
                        value="{{ $value }}"
                        id="{{ $typeText . $value }}"
                    >
                    <span class="custom-control-label text-gray-600">{{ __('view.' . $typeText) }}</span>
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
                    var approvalCheckbox = $(`[name="${ table_id }_approval[]"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);
                    
                    approvalCheckbox.on('change', function (e) {
                        var value = $(this).val(),
                            approvals = [],
                            approvalCheckboxChecked = approvalCheckbox.filter(':checked')
    
                        // get multi approvals
                        approvalCheckboxChecked.each(function (i) {
                            approvals.push($(this).val())
                        })
                        // get data by selected approvals
                        dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }
                            data.filter.approval = approvals
                        })
                        // dataTableInstance.ajax.reload()
                    })
    
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                            if (data.filter) {
                                data.filter.approval = ''
                            }
                        })
                        dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush


@endif