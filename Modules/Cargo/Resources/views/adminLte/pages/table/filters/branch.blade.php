@if (in_array('branch_id', $filters))


@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $auth_staff  = 0;
    $auth_branch = 3;


    $userBranch = Modules\Cargo\Entities\Branch::where('user_id',auth()->user()->id)->first();
    $userStaff  = Modules\Cargo\Entities\Staff::where('user_id',auth()->user()->id)->first();
    $branches = Modules\Cargo\Entities\Branch::where('is_archived', 0)->get();

    if(auth()->user()->can('manage-branches') && $user_role == $auth_staff){
        $branches = Modules\Cargo\Entities\Branch::where('id', $userStaff->branch_id )->get();
    }


@endphp


@if(auth()->user()->can('manage-branches') || $user_role == $admin )
    <div class="mb-10">
        <!--begin::Label-->
        <label class="form-label fs-5 fw-bold mb-3">{{ __('cargo::view.branch') }}:</label>
        <!--end::Label-->
        <!--begin::Options-->
        <div class="d-flex flex-column flex-wrap fw-bold">
            <select class="form-control  select-branch" data-control="select2"
                data-placeholder="{{ __('cargo::view.select_branch') }}" data-allow-clear="true"
                name="{{ $table_id }}_branch_id">
                <option></option>
                @foreach ( $branches as $branch)
                    <option value="{{ $branch->id }}">
                        {{ $branch->name }}
                    </option>
                @endforeach

            </select>
            <!--end::Option-->
        </div>
        <!--end::Options-->
    </div>
@endif

    {{-- Inject Scripts --}}
    @push('js-component')
        <script>
            $(window).on('load', function() {
                setTimeout(() => {

                    var table_id = '{{ $table_id }}';
                    var branchSelect = $(`[name="${ table_id }_branch_id"]`)
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

                            data.filter.branch_id = value;
                            console.log(data.filter);
                        })
                        // dataTableInstance.ajax.reload()
                    })
                    formOptions.on('reset', function(e) {
                        dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                            if (data.filter) {
                                data.filter.branch_id = '';
                            }
                        })
                        // dataTableInstance.ajax.reload()
                    })
                }, 1000);
            });
        </script>
    @endpush


@endif


{{-- @if(auth()->user()->can('export-table-branches') || $user_role == $admin) @endif --}}


