<?php

namespace Modules\Blog\Http\DataTables;


use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Blog\Entities\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Blog\Http\Filter\TagFilter;

class TagsDataTable extends DataTable
{

    public $table_id = 'tags_table';
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
            ->rawColumns(['action', 'select', 'creator_id'])

            ->filterColumn('creator_id', function($query, $keyword) {
                $query->whereHas('creator', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%$keyword%");
                });
            })

            ->addColumn('select', function (Tag $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model]);
            })
            ->editColumn('id', function (Tag $model) {
                return $model->id;
            })
            ->editColumn('name', function (Tag $model) {
                return $model->name;
            })
            ->addColumn('posts', function (Tag $model) {
                return $model->count_posts;
            })
            // ->editColumn('slug', function (Tag $model) {
            //     return $model->slug;
            // })
            // ->editColumn('creator_id', function (Tag $model) {
            //     return $model->creator ? '<a href="' . fr_route('users.show', ['id' => $model->creator_id]) . '">' . $model->creator->name . '</a>' : null;
            // })
            // ->editColumn('description', function (Tag $model) {
            //     return Str::limit($model->description);
            // })
            // ->editColumn('created_at', function (Tag $model) {
            //     return date('d M, Y H:i', strtotime($model->created_at));
            // })
            ->addColumn('action', function (Tag $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.tags.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Tag  $model
     *
     * @return Tag
     */
    public function query(Tag $model, Request $request)
    {
        $query = $model->with('creator')->withCount('posts as count_posts')->newQuery();
        
        // class filter for tag only
        $tag_filter = new TagFilter($query, $request);

        $query = $tag_filter->filterBy($this->filters);

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
            Column::make('name')->title(__('blog::view.tags_table.name')),
            Column::make('posts')->title(__('blog::view.posts')),
            // Column::make('slug')->title(__('blog::view.tags_table.slug')),
            // Column::make('creator_id')->title(__('blog::view.tags_table.creator')),
            // Column::make('description')->title(__('blog::view.tags_table.description')),
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
        return 'Tags_'.date('YmdHis');
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
