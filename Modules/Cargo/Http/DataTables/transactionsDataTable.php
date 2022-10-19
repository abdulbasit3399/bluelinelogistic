<?php

namespace Modules\Cargo\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Modules\Cargo\Entities\Transaction;
use Modules\Cargo\Entities\Mission;
use Illuminate\Http\Request;
use Modules\Cargo\Http\Filter\TransactionFilter;
use App\Models\User;

class transactionsDataTable extends DataTable
{

    public $table_id = 'transactions';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = [ 'created_at', 'captain_id' , 'client_id' , 'branch_id' , 'transaction_owner' ];
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


            ->editColumn('transaction_owner', function (Transaction $model) {
                $transaction_owner[Transaction::CAPTAIN]['text'] = __('cargo::view.driver');
                $transaction_owner[Transaction::CLIENT]['text'] = __('cargo::view.client');
                $transaction_owner[Transaction::BRANCH]['text'] = __('cargo::view.table.branch');
                return $transaction_owner[$model->transaction_owner]['text']  ?? "";
            })
            ->editColumn('captain_id', function (Transaction $model) {
                $transaction_owner[Transaction::CAPTAIN]['key'] = "captain";
                $transaction_owner[Transaction::CLIENT]['key'] = "client";
                $transaction_owner[Transaction::BRANCH]['key'] = "branch";
                return $model->{$transaction_owner[$model->transaction_owner]['key']}->name ?? "";
            })
            ->editColumn('type', function (Transaction $model) {
                $transaction_type[Transaction::MESSION_TYPE] = "mission";
                $transaction_type[Transaction::SHIPMENT_TYPE] = "shipment";
                $transaction_type[Transaction::MANUAL_TYPE] = "manual";

                if($transaction_type[$model->type] == 'mission' && $model->mission_id){
                    return __('cargo::view.mission').' ('. $model->mission->code .')' ?? "" ;
                }elseif($transaction_type[$model->type] == 'shipment' && $model->shipment_id){
                    return __('cargo::view.shipment').' ('. $model->shipment->code .')' ?? "";
                }elseif($transaction_type[$model->type] == 'manual'){
                    return  __('cargo::view.manual');
                }
            })
            ->editColumn('value', function (Transaction $model) {
                return format_price($model->value) ?? "";
            })
            ->editColumn('description', function (Transaction $model) {
                return $model->description ?? "";
            })
            ->editColumn('created_at', function (Transaction $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->editColumn('created_by', function (Transaction $model) {
                $created_by = User::where('id', $model->created_by )->first();

                if($created_by){
                    return $created_by->name;
                }else{

                $transaction_type[Transaction::MESSION_TYPE] = "mission";
                $transaction_type[Transaction::SHIPMENT_TYPE] = "shipment";
                $transaction_type[Transaction::MANUAL_TYPE] = "manual";

                if($transaction_type[$model->type] == 'mission' && $model->mission_id){
                    return __('cargo::view.mission').' ('. $model->mission->code.')' ?? "";
                }elseif($transaction_type[$model->type] == 'shipment' && $model->shipment_id){
                    return __('cargo::view.shipment').' ('. $model->shipment->code.')' ?? "";
                }
                }

            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Transaction  $model
     *
     * @return Transaction
     */
    public function query(Transaction $model, Request $request)
    {
        $query = $model->getTransactions($model,$request)->newQuery();

        // class filter for user only
        $client_filter = new TransactionFilter($query, $request);

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
            Column::make('id')->title(__('cargo::view.table.#'))->width(50),
            Column::make('transaction_owner')->title(__('cargo::view.table.owner_type')),
            Column::make('captain_id')->title(__('cargo::view.table.owner_name')),
            Column::make('type')->title(__('cargo::view.type')),
            Column::make('value')->title(__('cargo::view.value')),
            Column::make('created_at')->title(__('cargo::view.date')),
            Column::make('created_by')->title(__('cargo::view.created_by')),
            Column::make('description')->title(__('cargo::view.description')),

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