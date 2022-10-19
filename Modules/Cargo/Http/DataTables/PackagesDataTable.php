<?php

namespace Modules\Cargo\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Modules\Cargo\Entities\Package;
use Illuminate\Http\Request;
use Modules\Cargo\Http\Filter\PackageFilter;

class PackagesDataTable extends DataTable
{

    public $table_id = 'packages';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['name'];
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

            ->addColumn('select', function (Package $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model, 'ifHide' => $model->id == 0]);
            })
            ->editColumn('name', function (Package $model) {
                return json_decode($model->name, true)[app()->getLocale()];
            })
            ->editColumn('created_at', function (Package $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            // ->editColumn('avatar', function (Package $model) {
            //     return '
            //     <div class="symbol symbol-circle symbol-40px overflow-hidden me-3">
            //         <a href="' . fr_route('users.show', ['id' => $model->id]) . '">
            //             <div class="symbol-label">
            //                 <img src="' . $model->avatarImage . '" class="w-100">
            //             </div>
            //         </a>
            //     </div>';
            // })
            ->addColumn('action', function (Package $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.packages.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Package  $model
     *
     * @return Package
     */
    public function query(Package $model, Request $request)
    {
        $query = $model->newQuery();
        
        // class filter for user only
        $package_filter = new PackageFilter($query, $request);

        $query = $package_filter->filterBy($this->filters);

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
            Column::make('name')->title(__('cargo::view.table.name')),
            Column::make('cost')->title(__('cargo::view.table.cost')),
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
