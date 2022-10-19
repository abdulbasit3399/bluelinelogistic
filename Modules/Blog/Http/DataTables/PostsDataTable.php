<?php

namespace Modules\Blog\Http\DataTables;


use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Blog\Entities\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Blog\Http\Filter\PostFilter;

class PostsDataTable extends DataTable
{

    public $table_id = 'posts_table';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['created_at'];
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->rawColumns(['action', 'select', 'creator_id', 'view_post', 'published'])

            ->filterColumn('creator_id', function($query, $keyword) {
                $query->whereHas('creator', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%$keyword%");
                });
            })

            ->addColumn('select', function (Post $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model]);
            })
            ->editColumn('id', function (Post $model) {
                return $model->id;
            })
            ->editColumn('title', function (Post $model) {
                return $model->title;
            })
            ->editColumn('view_post', function (Post $model) {
                return '<a href="' . fr_route('post-page', ['slug' => $model->slug]) . '" target="_blank">' . __('blog::view.view_post_page') . '</a>';
            })
            ->editColumn('published', function (Post $model) {
                return '<span class="badge fs-9 badge-' . ($model->published ? 'success' : 'warning') . '">' . ($model->published ? __('view.published') : __('view.draft')) . '</span>';
            })
            ->addColumn('comments_count', function (Post $model) {
                return $model->comments_count;
            })
            // ->editColumn('slug', function (Post $model) {
            //     return $model->slug;
            // })
            ->editColumn('creator_id', function (Post $model) {
                return $model->creator ? '<a href="' . fr_route('users.show', ['id' => $model->creator_id]) . '">' . $model->creator->name . '</a>' : null;
            })
            // ->editColumn('created_at', function (Post $model) {
            //     return date('d M, Y H:i', strtotime($model->created_at));
            // })
            ->addColumn('action', function (Post $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.posts.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Post  $model
     *
     * @return Post
     */
    public function query(Post $model, Request $request)
    {
        $query = $model->with('creator')->withCount('comments')->newQuery();
        
        // class filter for post only
        $post_filter = new PostFilter($query, $request);

        $query = $post_filter->filterBy($this->filters);

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $lang = \LaravelLocalization::getCurrentLocale();
        return $this->builder()
            ->setTableId($this->table_id)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->orderBy(1)
            ->responsive()
            ->autoWidth(false)
            ->parameters([
                'scrollX' => true,
                'dom' => 'Bfrtip',
                'language' => ['url' => "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/$lang.json"],
                'buttons' => [
                    ...$this->buttonsExport(),
                ],
            ])
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('select')
                    ->title('
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input checkbox-all-rows" type="checkbox">
                        </div>
                    ')
                    ->responsivePriority(-1)
                    ->addClass('not-export')
                    ->width(50),
            Column::make('id')->title(__('view.table_id'))->width(50),
            Column::make('title')->title(__('blog::view.posts_table.title')),
            Column::computed('view_post')->title(__('blog::view.view_post'))->addClass('not-export'),
            Column::make('published')->title(__('view.publishing')),
            Column::make('comments_count')->title(__('blog::view.posts_table.comments_count')),
            // Column::make('slug')->title(__('blog::view.posts_table.slug')),
            Column::make('creator_id')->title(__('blog::view.posts_table.creator')),
            // Column::make('created_at')->title(__('view.created_at')),
            Column::computed('action')
                ->title(__('view.action'))
                ->addClass('text-center not-export')
                ->responsivePriority(-1)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Posts_'.date('YmdHis');
    }


    /**
     * Transformer buttons export.
     *
     * @return string
     */
    protected function buttonsExport()
    {
        $btns = [];
        foreach($this->btn_exports as $btn) {
            $btns[] = [
                'extend' => $btn,
                'exportOptions' => [
                    'columns' => 'th:not(.not-export)'
                ]
            ];
        }
        return $btns;
    }
}
