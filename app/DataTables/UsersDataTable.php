<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $editButton = function ($user) {
            return
                '<a class="btn btn-sm btn-warning" href="' . route('admin.users.edit', $user->id) . '">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>';
        };

        $deleteButton = function ($user) {
            return
                '<form action="' . route('admin.users.destroy', $user->id) . '" method="POST"">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger delete-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                </form>';
        };

        return (new EloquentDataTable($query))
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d.m.Y H:i');
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('d.m.Y H:i');
            })
            ->addColumn('edit', $editButton)
            ->addColumn('delete', $deleteButton)
            ->rawColumns(['edit', 'delete'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $createButton = [
            'text' => '<i class="fas fa-plus mr-1"></i> Создать',
            'className' => 'btn btn-success',
            'action' => 'function(e, dt, node, config) {
                window.location.href = "' . route('admin.users.create') . '";
            }'
        ];

        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => [$createButton],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name')->title('Имя'),
            Column::make('email')->title('Почта'),
            Column::make('role')->title('Роль'),
            Column::make('created_at')->title('Создан'),
            Column::make('updated_at')->title('Обновлен'),
            Column::computed('edit')
                ->title('Изменить')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center'),
            Column::computed('delete')
                ->title('Удалить')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
