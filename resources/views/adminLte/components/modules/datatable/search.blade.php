<div class="d-flex align-items-center position-relative my-1">
    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
    <span class="svg-icon svg-icon-1 position-absolute ms-6">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
        </svg>
    </span>
    <!--end::Svg Icon-->
    <input name="{ table_id }_filter" type="search" id="{{ $table_id }}_input_search" class="form-control form-control-solid w-250px ps-15" placeholder="{{ __('view.search') }}" />
</div>




{{-- Inject Scripts --}}
@push('js-component')
    <script>
        setTimeout(() => {
            var table_id = '{{ $table_id }}';
            // remove default search input from table
            var usersTableFilter = $(`#${ table_id }_filter`)
            usersTableFilter.remove()
            // add my custom search in table
            var tableInputSearch = $(`#${ table_id }_input_search`)
            var dataTableInstance = $(`#${table_id}`).DataTable();
            var timer;


            tableInputSearch.on('input', function (e) {
                var value = $(this).val()

                // debounce search function
                clearTimeout(timer)
                timer = setTimeout(() => {
                    dataTableInstance.on('preXhr.dt', function (e, settings, data) {
                        console.log(data.search.value);
                        data.search.value = value
                    })
                    dataTableInstance.ajax.reload()
                }, 500);
            })
        }, 1000);
    </script>
@endpush
