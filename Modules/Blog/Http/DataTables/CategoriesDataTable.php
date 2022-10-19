<?php

namespace Modules\Blog\Http\DataTables;


use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Blog\Entities\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Blog\Http\Filter\CategoryFilter;

class CategoriesDataTable extends DataTable
{

    public $table_id = 'categories_table';
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
            ->rawColumns(['action', 'select', 'active', 'creator_id'])

            ->filterColumn('creator_id', function($query, $keyword) {
                $query->whereHas('creator', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%$keyword%");
                });
            })

            ->addColumn('select', function (Category $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model]);
            })
            ->editColumn('id', function (Category $model) {
                return $model->id;
            })
            ->editColumn('name', function (Category $model) {
                return $model->name;
            })
            ->addColumn('posts', function (Category $model) {
                return $model->count_posts;
            })
            ->editColumn('active', function (Category $model) {
                return '<span class="badge fs-9 badge-' . ($model->active ? 'success' : 'danger') . '">' . ($model->active ? __('view.activated') : __('view.deactivated')) . '</span>';
            })
            // ->editColumn('parent_id', function (Category $model) {
            //     return $model->categoryParent ? '<a href="' . fr_route('categories.edit', ['id' => $model->parent_id]) . '">' . $model->categoryParent->name . '</a>' : null;
            // })
            // ->editColumn('slug', function (Category $model) {
            //     return $model->slug;
            // })
            // ->editColumn('creator_id', function (Category $model) {
            //     return $model->creator ? '<a href="' . fr_route('users.show', ['id' => $model->creator_id]) . '">' . $model->creator->name . '</a>' : null;
            // })
            // ->editColumn('description', function (Category $model) {
            //     return Str::limit($model->description);
            // })
            // ->editColumn('created_at', function (Category $model) {
            //     return date('d M, Y H:i:s', strtotime($model->created_at));
            // })
            ->addColumn('action', function (Category $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.categories.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Category  $model
     *
     * @return Category
     */
    public function query(Category $model, Request $request)
    {
        $query = $model->with('categoryParent')->withCount('posts as count_posts')->newQuery();
        
        // class filter for tag only
        $tag_filter = new CategoryFilter($query, $request);

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
            Column::make('name')->title(__('blog::view.categories_table.name')),
            Column::make('posts')->title(__('blog::view.posts')),
            Column::make('active')->title(__('view.activation')),
            // Column::make('parent_id')->title(__('blog::view.categories_table.parent_category')),
            // Column::make('slug')->title(__('blog::view.categories_table.slug')),
            // Column::make('creator_id')->title(__('blog::view.categories_table.creator')),
            // Column::make('description')->title(__('blog::view.categories_table.description')),
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
        return 'Categorys_'.date('YmdHis');
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
