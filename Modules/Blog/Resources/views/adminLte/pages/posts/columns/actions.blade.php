
<!-- begin: Btn Edit Row -->
@can('edit-posts')
    <a
        href="{{ fr_route('posts.edit', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.edit') }}"
    >
        <i class="fas fa-edit fa-fw"></i>
    </a>
@endcan
<!-- end: Btn Edit Row -->




<!-- begin: Btn Delete Row -->
{{-- 
    data-callback = reload-page, reload-table, delete-row
--}}

@can('delete-posts')
    <button
        type="button"
        data-action="{{ fr_route('posts.destroy', $model->id) }}"
        data-callback="reload-table"
        data-table-id="{{ isset($table_id) ? $table_id : '' }}"
        data-model-name="{{ __('blog::view.posts_table.post') }}"
        data-time-alert="2000"
        class="delete-row btn btn-sm btn-secondary btn-action-table btn-custom"
        data-toggle="tooltip"
        title="{{ __('view.delete') }}"
    >
        <i class="fas fa-trash fa-fw"></i>
    </button>
@endcan
<!-- end: Btn Delete Row -->
