
<button
    type="button"
    id="{{ $table_id }}_btn_reload"
    class="btn btn-light-primary m-1"
    data-toggle="tooltip" title="{{ __('view.reload') }}"
>
    <i class="fas fa-sync-alt fs-3"></i>
</button>



{{-- Inject Scripts --}}
@push('js-component')
    <script>
        setTimeout(() => {
            var table_id = '{{ $table_id }}';
            var btnReload = $(`#${ table_id }_btn_reload`)
            var dataTableInstance = $(`#${table_id}`).DataTable();
            btnReload.on('click', function (e) { 
                dataTableInstance.ajax.reload()
            })
        }, 2000);
    </script>
@endpush