<?php

namespace Modules\Blog\Http\DataTables;


use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Blog\Entities\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Blog\Http\Filter\CommentFilter;

class CommentsDataTable extends DataTable
{

    public $table_id = 'comments_table';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['created_at', 'approval'];
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $datatables =
            datatables()
            ->eloquent($query)
            ->rawColumns(['action', 'select', 'creator_id', 'approved', 'commentable'])

            ->filterColumn('creator_id', function($query, $keyword) {
                $query->whereHas('creator', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%$keyword%");
                });
            })

            ->addColumn('select', function (Comment $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model]);
            })
            ->editColumn('id', function (Comment $model) {
                return $model->id;
            })
            ->editColumn('content', function (Comment $model) {
                return Str::limit($model->content);
            })
            ->addColumn('commentable', function (Comment $model) {
                return $model->commentable ? '<a target="_blank" href="' . fr_route('posts.edit', ['id' => $model->commentable->id]) . '">' . $model->commentable->title . '</a>' : null;
            })
            ->editColumn('approved', function (Comment $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.comments.columns.approval', ['model' => $model]);
            })
            // ->editColumn('approved_action', function (Comment $model) {
            //     $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.comments.columns.approval_action', ['model' => $model]);
            // })
            // ->editColumn('creator_id', function (Comment $model) {
            //     return $model->creator ? '<a href="' . fr_route('users.show', ['id' => $model->creator_id]) . '">' . $model->creator->name . '</a>' : null;
            // })
            ->editColumn('created_at', function (Comment $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('action', function (Comment $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.comments.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });

        if (auth()->user()->can('approval-comments')) {
            $datatables->editColumn('approved_action', function (Comment $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.comments.columns.approval_action', ['model' => $model]);
            });
        }

        return $datatables;
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Comment  $model
     *
     * @return Comment
     */
    public function query(Comment $model, Request $request)
    {
        $query = $model->with('creator', 'commentable')->newQuery();
        
        // class filter for comment only
        $comment_filter = new CommentFilter($query, $request);

        $query = $comment_filter->filterBy($this->filters);

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

        $columns = [
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
            Column::make('content')->title(__('blog::view.comments_table.content')),
            Column::make('commentable')->title(__('blog::view.posts_table.post')),
            // Column::make('approved_action')->title(__('view.approval')),
            Column::make('approved')->title(__('view.approval_status')),
            // Column::make('creator_id')->title(__('blog::view.comments_table.creator')),
            Column::make('created_at')->title(__('view.created_at')),
            Column::computed('action')
                ->title(__('view.action'))
                ->addClass('text-center not-export')
                ->responsivePriority(-1)
        ];
        if (auth()->user()->can('approval-comments')) {
            $approved_action = Column::computed('approved_action')
            ->addClass('text-center not-export')
            ->responsivePriority(-1)
            ->title(__('view.approval'));
            array_splice($columns, 4, 0, $approved_action);
        }

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Comments_'.date('YmdHis');
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
