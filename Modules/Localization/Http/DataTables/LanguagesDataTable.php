<?php

namespace Modules\Localization\Http\DataTables;


use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Modules\Localization\Entities\Language;
use Illuminate\Http\Request;
use Modules\Localization\Http\Filter\LanguageFilter;

class LanguagesDataTable extends DataTable
{

    public $table_id = 'languages_table';
    public $btn_exports = [
        // 'excel',
        // 'print',
        // 'pdf'
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

            ->addColumn('select', function (Language $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model]);
            })
            ->editColumn('id', function (Language $model) {
                return $model->id;
            })
            ->editColumn('name', function (Language $model) {
                return $model->name;
            })
            ->editColumn('code', function (Language $model) {
                return $model->code;
            })
            ->editColumn('is_default', function (Language $model) {
                return '<span class="badge fs-9 badge-' . ($model->is_default ? 'success' : 'danger') . '">' . ($model->active ? __('view.activated') : __('view.deactivated')) . '</span>';
            })
            ->editColumn('is_default', function (Language $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('localization::'.$adminTheme.'.pages.languages.columns.switch_default', ['model' => $model]);
            })
            // ->editColumn('creator_id', function (Language $model) {
            //     return $model->creator ? '<a href="' . fr_route('users.show', ['id' => $model->creator_id]) . '">' . $model->creator->name . '</a>' : null;
            // })
            // ->editColumn('created_at', function (Language $model) {
            //     return date('d M, Y H:i', strtotime($model->created_at));
            // })
            ->addColumn('action', function (Language $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('localization::'.$adminTheme.'.pages.languages.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Language  $model
     *
     * @return Language
     */
    public function query(Language $model, Request $request)
    {
        $query = $model->with('creator')->newQuery();
        
        // class filter for language only
        $language_filter = new LanguageFilter($query, $request);

        $query = $language_filter->filterBy($this->filters);

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
            Column::make('name')->title(__('localization::view.languages_table.name')),
            Column::make('code')->title(__('localization::view.languages_table.code')),
            Column::make('is_default')->title(__('localization::view.languages_table.is_default')),
            // Column::make('creator_id')->title(__('localization::view.languages_table.creator')),
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
        return 'Languages_'.date('YmdHis');
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
