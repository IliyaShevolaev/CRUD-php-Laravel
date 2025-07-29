<?php

namespace App\DataTables;

use App\Models\Scopes\ActiveUserScope;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

/**
 * Таблица пользователей
 */
class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('department_id', function ($user) {
                return $user->department->name ?? trans('main.users.without_department');
            })
            ->editColumn('position_id', function ($user) {
                return $user->position->name ?? trans('main.users.without_position');
            })
            ->editColumn('gender', function ($user) {
                return trans('main.users.genders.' . $user->gender->value);
            })
            ->editColumn('status', function ($user) {
                return trans('main.users.statuses.' . $user->status->value);
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d.m.Y H:i');
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('d.m.Y H:i');
            })
            ->addColumn('actions', function ($user) {
                return view('users.actions', compact('user'))->render();
            })
            ->rawColumns(['department_name', 'position_name', 'actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->withoutGlobalScope(ActiveUserScope::class);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $this->builder()->language(['url' => 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/ru.json']);

        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name')->title(str(trans('main.users.name'))->ucfirst()),
            Column::make('email')->title(str(trans('main.users.email'))->ucfirst()),
            Column::make('department_id')->title(str(trans('main.users.department'))->ucfirst()),
            Column::make('position_id')->title(str(trans('main.users.position'))->ucfirst()),
            Column::make('gender')->title(str(trans('main.users.gender'))->ucfirst()),
            Column::make('status')->title(str(trans('main.users.status'))->ucfirst()),
            Column::make('created_at')->title(str(trans('main.users.created'))->ucfirst()),
            Column::make('updated_at')->title(str(trans('main.users.updated'))->ucfirst()),
            Column::computed('actions')->title(str(trans('main.users.actions_buttons'))->ucfirst())->printable(false)->width(120)->addClass('text-center'),
        ];
    }
}
