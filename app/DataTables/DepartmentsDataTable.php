<?php

namespace App\DataTables;

use App\Models\User\Department;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DepartmentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('created_at', function ($department) {
            return $department->created_at->format('d.m.Y H:i');
        })
        ->editColumn('updated_at', function ($department) {
            return $department->updated_at->format('d.m.Y H:i');
        })
        ->addColumn('actions', function ($department) {
            return view('departments.actions', compact('department'))->render();
        })
        ->rawColumns(['actions'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Department $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $this->builder()->language(['url' => 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/ru.json']);

        return $this->builder()
                    ->setTableId('departments-table')
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
            Column::make('name')->title(str(trans('main.title'))->ucfirst()),
            Column::make('created_at')->title(str(trans('main.users.created'))->ucfirst()),
            Column::make('updated_at')->title(str(trans('main.users.updated'))->ucfirst()),
            Column::computed('actions')->title(str(trans('main.users.actions_buttons'))->ucfirst())->printable(false)->width(120)->addClass('text-center'),
        ];
    }
}
