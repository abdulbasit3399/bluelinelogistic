@php
    $user_role = auth()->user()->role;
    $auth_branch = 3;
@endphp


@if (in_array('transaction_owner', $filters))
    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.table.owner_type') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2"
                data-placeholder="{{ __('cargo::view.table.owner_type') }}" data-allow-clear="true"
                name="{{ $table_id }}_transaction_owner">
                <option></option>
                <option value="1">{{ __('cargo::view.driver') }}</option>
                    <option value="2">{{ __('cargo::view.client') }}</option>
                    @if ($user_role != $auth_branch)
                        <option value="3">{{ __('cargo::view.table.branch') }}</option>
                    @endif
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
                    var transaction_ownerSelect = $(`[name="${ table_id }_transaction_owner"]`)
                    var dataTableInstance = $(`#${table_id}`).DataTable();
                    var formOptions = $(`#${table_id}_filter_options_form`);

                    transaction_ownerSelect.on('change', function(e) {
                        var value = $(this).val(),

                            transaction_ownerSelectChecked = transaction_ownerSelect.filter(':checked')
                        // get data by selected roles
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (!data.filter) {
                                data.filter = {}
                            }
                            data.filter.transaction_owner = value;
                        })
                        // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.transaction_owner = '';
                            }
                        })
                        // dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush
@endif
