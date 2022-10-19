@php
    $user_role = auth()->user()->role;
    $admin = 1;
    $branch = 3;
    $client = 4;
@endphp

@if ( url()->current() ==  route('shipments.index') || url()->current() ==  route('shipments.report'))
    @if (in_array('status_id', $filters))
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.status') }}:</label>
            <!--end::Label-->
            <!--begin::Options-->
            <div class="d-flex flex-column flex-wrap fw-bold">
                <select class="form-control  select-branch" data-control="select2"
                    data-placeholder="{{ __('cargo::view.status') }}" data-allow-clear="true"
                    name="{{ $table_id }}_status_id">
                    <option></option>
                    @foreach (Modules\Cargo\Entities\Shipment::status_info() as $item)
                        @if (in_array($user_role, [$admin, $client, $branch]) || auth()->user()->hasAnyDirectPermission($item['permissions']))
                            <option class="nav-item" value="{{ $item['status'] }}">
                                {{ $item['text'] }}
                            </option>
                        @endif
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
                        var statusSelect = $(`[name="${ table_id }_status_id"]`)
                        var dataTableInstance = $(`#${table_id}`).DataTable();
                        var formOptions = $(`#${table_id}_filter_options_form`);


                        statusSelect.on('change', function(e) {
                            var value = $(this).val(),

                                statusSelectChecked = statusSelect.filter(':checked')
                            // get data by selected roles
                            dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                if (!data.filter) {
                                    data.filter = {}
                                }

                                data.filter.status_id = value;
                                console.log(data.filter);
                            })
                            // dataTableInstance.ajax.reload()
                        })
                        formOptions.on('reset', function(e) {
                            dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                if (data.filter) {
                                    data.filter.status_id = '';
                                }
                            })
                            // dataTableInstance.ajax.reload()
                        })
                    }, 1000);
                });
            </script>
        @endpush
    @endif
@endif
