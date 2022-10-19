<?php

namespace Modules\Currency\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Modules\Currency\Entities\Currency;
use Illuminate\Http\Request;
use Modules\Currency\Http\Filter\CurrencyFilter;

class CurrenciesDataTable extends DataTable
{

    public $table_id = 'currencies';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['state_id'];
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
            ->rawColumns(['action', 'select','name'])
            ->filterColumn('name', function($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })

            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('name', $order);
            })

            ->addColumn('select', function (Currency $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model, 'ifHide' => $model->id == 0]);
            })
            ->editColumn('id', function (Currency $model) {
                return '#'.$model->id;
            })
            ->addColumn('status', function (Currency $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('currency::'.$adminTheme.'.pages.currencies.columns.checkbox', ['model' => $model, 'status' => $model->status, 'ifHide' => $model->id == 0]);
            })
            ->editColumn('created_at', function (Currency $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('action', function (Currency $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('currency::'.$adminTheme.'.pages.currencies.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Currency  $model
     *
     * @return Currency
     */
    public function query(Currency $model, Request $request)
    {
        $query = $model->newQuery();
        
        // class filter for user only
        $Currency_filter = new CurrencyFilter($query, $request);

        $query = $Currency_filter->filterBy($this->filters);

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
            Column::make('id')->title(__('cargo::view.table.id'))->width(50),
            Column::make('name')->title(__('currency::view.currency_name')),
            Column::make('symbol')->title(__('currency::view.currency_symbol')),
            Column::make('code')->title(__('currency::view.currency_code')),
            Column::make('exchange_rate')->title(__('currency::view.exchange_rate')),
            Column::make('status')->title(__('cargo::view.status')),
            Column::make('created_at')->title(__('view.created_at')),
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
        return 'packages_'.date('YmdHis');
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
