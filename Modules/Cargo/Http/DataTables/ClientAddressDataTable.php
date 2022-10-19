<?php

namespace Modules\Cargo\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Area;
use Modules\Cargo\Entities\ClientAddress;
use Illuminate\Http\Request;
use Modules\Cargo\Http\Filter\ClientAddressFilter;

class ClientAddressDataTable extends DataTable
{

    public $table_id = 'client_addresses';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['address', 'created_at' , 'country_id' ,'area_id', 'state_id'];
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
            ->rawColumns(['action', 'select','name' , 'country_id'])

            ->filterColumn('address', function($query, $keyword) {
                $query->where('address', 'LIKE', "%$keyword%");
            })
            ->orderColumn('country_id', function ($query, $order) {
                $query->orderBy('country_id', $order);
            })

            ->addColumn('select', function (ClientAddress $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model, 'ifHide' => $model->id == 0]);
            })
            ->editColumn('country_id', function (ClientAddress $model) {
                return $model->country->name;
            })
            ->editColumn('area_id', function (ClientAddress $model) {
                return json_decode($model->area->name, true)[app()->getLocale()];
            })
            ->editColumn('state_id', function (ClientAddress $model) {
                return $model->state->name;
            })
            ->editColumn('created_at', function (ClientAddress $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('action', function (ClientAddress $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.clients.columns.actions_address', ['model' => $model, 'table_id' => $this->table_id]);
            });


    }

    /**
     * Get query source of dataTable.
     *
     * @param  ClientAddress  $model
     *
     * @return ClientAddress
     */
    public function query(ClientAddress $model, Request $request)
    {
        $query = $model->getClientAddresses($model,$request)->newQuery();

        // class filter for user only
        $client_filter = new ClientAddressFilter($query, $request);

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
            Column::make('address')->title(__('cargo::view.address')),
            Column::make('country_id')->title(__('cargo::view.country')),
            Column::make('state_id')->title(__('cargo::view.region')),
            Column::make('area_id')->title(__('cargo::view.area')),
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
        return 'client_addresses_'.date('YmdHis');
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