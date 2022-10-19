<?php

namespace Modules\Cargo\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Modules\Cargo\Entities\Mission;
use Illuminate\Http\Request;
use Modules\Cargo\Http\Filter\MissionFilter;
use Modules\Cargo\Http\Helpers\TransactionHelper;

class MissionsDataTable extends DataTable
{

    public $table_id = 'missions';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['created_at' , 'status_id' , 'type' ,'captain_id' ];
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

            ->filterColumn('code', function($query, $keyword) {
                $query->where('code', 'LIKE', "%$keyword%");
            })
            ->orderColumn('code', function ($query, $order) {
                $query->orderBy('code', $order);
            })

            ->addColumn('select', function (Mission $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model, 'ifHide' => $model->id == 0]);
            })
            ->editColumn('status_id', function (Mission $model) {
                return $model->getStatus();
            })
            ->editColumn('captain_id', function (Mission $model) {
                if($model->captain_id){
                    return $model->captain->name;
                }else{
                    return __('cargo::view.no_driver');
                }
            })
            ->editColumn('type', function (Mission $model) {
                return $model->type;
            })
            ->editColumn('amount', function (Mission $model) {
                $helper = new TransactionHelper();
                $shipment_cost = $helper->calcMissionShipmentsAmount($model->getRawOriginal('type'),$model->id);

                if($model->status_id == Mission::DONE_STATUS && $model->getRawOriginal('type') == Mission::DELIVERY_TYPE){
                    return format_price($model->amount);
                }else{
                    return format_price($shipment_cost);
                }
            })
            ->editColumn('due_date', function (Mission $model) {
                if($model->due_date){
                    return date('d M, Y H:i', strtotime($model->due_date));
                }else{
                    return '-';
                }
            })
            ->editColumn('created_at', function (Mission $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('action', function (Mission $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.missions.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Mission  $model
     *
     * @return Mission
     */
    public function query(Mission $model, Request $request)
    {
        $query = $model->getMissions($model,$request)->newQuery();

        // class filter for user only
        $client_filter = new MissionFilter($query, $request);

        $query = $client_filter->filterBy($this->filters);

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
            Column::make('id')->title(__('cargo::view.table.#'))->width(50),
            Column::make('code')->title(__('cargo::view.table.code')),
            Column::make('status_id')->title(__('cargo::view.status')),
            Column::make('captain_id')->title(__('cargo::view.driver')),
            Column::make('type')->title(__('cargo::view.table.type')),
            Column::make('amount')->title(__('cargo::view.amount')),
            Column::make('due_date')->title(__('cargo::view.due_date')),
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
        return 'clients_'.date('YmdHis');
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