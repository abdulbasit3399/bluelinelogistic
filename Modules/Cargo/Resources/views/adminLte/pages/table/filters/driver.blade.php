@php
$user_role = auth()->user()->role;
$admin  = 1;
$auth_staff  = 0;
$auth_branch = 3;
$auth_client = 4;

$userBranch = Modules\Cargo\Entities\Branch::where('user_id',auth()->user()->id)->first();
$userStaff  = Modules\Cargo\Entities\Staff::where('user_id',auth()->user()->id)->first();
$userClient = Modules\Cargo\Entities\Driver::where('user_id',auth()->user()->id)->first();

$driver = Modules\Cargo\Entities\Driver::where('is_archived', 0)->get();

if($user_role == $auth_branch){
    $driver  = Modules\Cargo\Entities\Driver::where('branch_id', $userBranch->id )->get();
}elseif(auth()->user()->can('manage-drivers') && $user_role == $auth_staff){

    $driver  = Modules\Cargo\Entities\Driver::where('branch_id', $userStaff->branch_id )->get();
}

@endphp


@if(auth()->user()->can('manage-drivers') || $user_role == $admin  || $user_role == $auth_branch)
    @if (in_array('captain_id', $filters))

        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.captain') }}:</label>
            <!--end::Label-->
            <!--begin::Options-->
            <div class="d-flex flex-column flex-wrap fw-bold">
                <select class="form-control  select-branch" data-control="select2"
                    data-placeholder="{{ __('cargo::view.choose_captain') }}" data-allow-clear="true"
                    name="{{ $table_id }}_driver_id">
                    <option></option>
                    @foreach ($driver as $driver)
                        <option  value="{{ $driver->id }}">
                            {{ $driver->name }}
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
                        var driverSelect = $(`[name="${ table_id }_driver_id"]`)
                        var dataTableInstance = $(`#${table_id}`).DataTable();
                        var formOptions = $(`#${table_id}_filter_options_form`);

                        driverSelect.on('change', function(e) {
                            var value = $(this).val(),

                                driverSelectChecked = driverSelect.filter(':checked')
                            // get data by selected roles
                            dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                if (!data.filter) {
                                    data.filter = {}
                                }
                                data.filter.captain_id = value;
                            })
                                // dataTableInstance.ajax.reload()
                        })
                        formOptions.on('reset', function(e) {
                            dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                                if (data.filter) {
                                    data.filter.captain_id = '';
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
@endif
