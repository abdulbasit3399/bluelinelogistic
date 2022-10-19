<?php

namespace Modules\Pages\Http\DataTables;


use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Pages\Entities\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Pages\Http\Filter\PageFilter;

class PagesDataTable extends DataTable
{

    public $table_id = 'pages_table';
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
            ->rawColumns(['action', 'select', 'creator_id', 'view_page', 'published'])

            ->filterColumn('creator_id', function($query, $keyword) {
                $query->whereHas('creator', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%$keyword%");
                });
            })

            ->addColumn('select', function (Page $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model]);
            })
            ->editColumn('id', function (Page $model) {
                return $model->id;
            })
            ->editColumn('title', function (Page $model) {
                return $model->title;
            })
            ->editColumn('view_page', function (Page $model) {
                return '<a href="' . fr_route('page-page', ['slug' => $model->slug]) . '" target="_blank">' . __('pages::view.view_page') . '</a>';
            })
            ->editColumn('published', function (Page $model) {
                return '<span class="badge fs-9 badge-' . ($model->published ? 'success' : 'warning') . '">' . ($model->published ? __('view.published') : __('view.draft')) . '</span>';
            })
            ->editColumn('creator_id', function (Page $model) {
                return $model->creator ? '<a href="' . fr_route('users.show', ['id' => $model->creator_id]) . '">' . $model->creator->name . '</a>' : null;
            })
            // ->editColumn('created_at', function (Page $model) {
            //     return date('d M, Y H:i', strtotime($model->created_at));
            // })
            ->addColumn('action', function (Page $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('pages::'.$adminTheme.'.pages.pages.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Page  $model
     *
     * @return Page
     */
    public function query(Page $model, Request $request)
    {
        $query = $model->with('creator')->newQuery();
        
        // class filter for page only
        $page_filter = new PageFilter($query, $request);

        $query = $page_filter->filterBy($this->filters);

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
            Column::make('title')->title(__('pages::view.pages_table.title')),
            Column::computed('view_page')->title(__('pages::view.view_page'))->addClass('not-export'),
            Column::make('published')->title(__('view.publishing')),
            // Column::make('slug')->title(__('pages::view.pages_table.slug')),
            Column::make('creator_id')->title(__('pages::view.pages_table.creator')),
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
        return 'Pages_'.date('YmdHis');
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
