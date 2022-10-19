<div class="dropdown" id="{{ $table_id }}_datatable_length">
    <button class="btn btn-light-primary m-1 dropdown-toggle" type="button" id="dropdownMenuButtonDatatableLength"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <!--end::Svg Icon-->
        {{ __('view.show') }}
        <span class="mx-1 current-length"></span>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonDatatableLength">
        @foreach (config('cms.datatable_length')[0] as $num)
            @php
                $key = isset(config('cms.datatable_length')[1][$loop->index]) ? config('cms.datatable_length')[1][$loop->index] : $num;
            @endphp
            <button class="dropdown-item btn-get-length" type="button"
                data-length="{{ $num }}">{{ $key }}</button>
        @endforeach
    </div>
</div>




{{-- Inject Scripts --}}
@push('js-component')
    <script>
        setTimeout(() => {
            var table_id = '{{ $table_id }}',
                datatableLength = $(`#${ table_id }_datatable_length`),
                currentLength = datatableLength.find('.current-length'),
                btnGetLength = datatableLength.find('.btn-get-length'),
                dataTableInstance = $(`#${table_id}`).DataTable();

            dataTableInstance.one('xhr', function(e, settings, data) {
                currentLength.text(settings._iDisplayLength == -1 ? 'All' : settings._iDisplayLength)
            })

            btnGetLength.on('click', function(e) {
                var length = $(this).data('length')
                dataTableInstance.on('preXhr.dt', function(e, settings, data) {
                    settings._iDisplayLength = length
                    currentLength.text(length == -1 ? 'All' : length)
                    data.length = length
                })
                dataTableInstance.ajax.reload()
            })
        }, 1000);
    </script>
@endpush
