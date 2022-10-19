<?php

namespace Modules\Users\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use App\Models\User;
use Illuminate\Http\Request;

use Modules\Users\Http\Filter\UserFilter;

class UsersDataTable extends DataTable
{

    public $table_id = 'users_table';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['branch', 'created_at' , 'name' , 'role'];
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
            ->rawColumns(['action', 'select', 'user', 'role'])

            ->filterColumn('user', function($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
                $query->orWhere('email', 'LIKE', "%$keyword%");
            })

            ->orderColumn('user', function ($query, $order) {
                $query->orderBy('name', $order);
            })

            ->addColumn('select', function (User $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model, 'ifHide' => $model->id == 1]);
            })
            ->editColumn('id', function (User $model) {
                return $model->id;
            })
            ->editColumn('role', function (User $model) {
                return '<div class="badge bg-' . ($model->role == 1 ? 'success' : 'primary') . '">' . $model->userRole . '</div>';
            })
            ->editColumn('created_at', function (User $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            // ->editColumn('avatar', function (User $model) {
            //     return '
            //     <div class="symbol symbol-circle symbol-40px overflow-hidden me-3">
            //         <a href="' . fr_route('users.show', ['id' => $model->id]) . '">
            //             <div class="symbol-label">
            //                 <img src="' . $model->avatarImage . '" class="w-100">
            //             </div>
            //         </a>
            //     </div>';
            // })
            ->addColumn('user', function (User $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('users::'.$adminTheme.'.pages.users.columns.user', ['model' => $model]);
            })
            ->addColumn('action', function (User $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('users::'.$adminTheme.'.pages.users.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  User  $model
     *
     * @return User
     */
    public function query(User $model, Request $request)
    {
        $query = $model->getUsersOnly($model)->newQuery();

        // class filter for user only
        $user_filter = new UserFilter($query, $request);

        $query = $user_filter->filterBy($this->filters);

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
            Column::make('id')->title(__('users::view.table.id'))->width(50),
            Column::make('user')->title(__('users::view.table.user')),
            Column::make('role')->title(__('users::view.table.user_type')),
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
        return 'Users_'.date('YmdHis');
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
