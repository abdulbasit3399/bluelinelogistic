<?php

namespace Modules\Acl\Http\DataTables;

use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RolesDataTable extends DataTable
{

    public $table_id = 'roles_table';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['role', 'created_at' , 'name'];
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
            ->rawColumns(['action', 'select'])
            ->addColumn('select', function (Role $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model]);
            })
            ->editColumn('id', function (Role $model) {
                return $model->id;
            })
            ->editColumn('name', function (Role $model) {
                return Str::limit($model->name);
            })
            ->editColumn('created_at', function (Role $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('action', function (Role $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view('acl::'.$adminTheme.'.pages.roles.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Role  $model
     *
     * @return Role
     */
    public function query(Role $model, Request $request)
    {
        $query = $model->newQuery();
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $lang = config('cms.langauges')[app()->getLocale()];
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
            Column::make('id')->title(__('acl::view.table.id'))->width(50),
            Column::make('name')->title(__('acl::view.table.name')),
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
        return 'Roles_'.date('YmdHis');
    }

}