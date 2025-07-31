<?php

declare(strict_types=1);

namespace App\DataTables;

use App\Repositories\Interfaces\User\Department\DepartmentRepositoryInterface;
use Illuminate\Support\Str;
use App\Models\User\Department;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

/**
 * Таблиа отделов пользователей
 */
class DepartmentsDataTable extends DataTable
{

    /**
     * Репозиторий для работы с данными
     *
     * @var DepartmentRepositoryInterface
     */
    private DepartmentRepositoryInterface $repository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->repository = $departmentRepository;
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Department> $query Results from query() method.
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
     *
     * @return QueryBuilder<Department>
     */
    public function query(): QueryBuilder
    {
        return $this->repository->collection()->toQuery();
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
     *
     * @return Column[]
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name')->title(
                is_array(__('main.title')) ? '' : (string) Str::of(__('main.title'))->ucfirst()
            ),
            Column::make('created_at')->title(
                is_array(__('main.users.created')) ? '' : (string) Str::of(__('main.users.created'))->ucfirst()
            ),
            Column::make('updated_at')->title(
                is_array(__('main.users.updated')) ? '' : (string) Str::of(__('main.users.updated'))->ucfirst()
            ),
            Column::computed('actions')
                ->title(
                    is_array(__('main.users.actions_buttons')) ?
                    '' :
                    (string) Str::of(__('main.users.actions_buttons'))->ucfirst()
                )
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }
}
