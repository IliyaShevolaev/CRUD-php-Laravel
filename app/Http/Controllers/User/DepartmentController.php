<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Models\User\Department;
use App\Services\User\Department\DepartmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\DataTables\DepartmentsDataTable;
use App\Http\Requests\Users\Department\DepartmentRequest;

/**
 * Контрллер отделов пользователей
 */
class DepartmentController extends Controller
{
    /**
     * Сервис для контроллера
     *
     * @var DepartmentService
     */
    private DepartmentService $service;

    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }

    /**
     * Отображает все отделы через таблицу DepartmentsDataTable
     * @return JsonResponse|View
     *
     * @param DepartmentsDataTable $departmentsDataTable
     */
    public function index(DepartmentsDataTable $departmentsDataTable): JsonResponse|View
    {
        return $departmentsDataTable->render('departments.index');
    }

    /**
     * Возвращает форму создания нового отдела
     *
     * @return JsonResponse
     */
    public function create()
    {
        return response()->json(view('departments.form')
            ->with(['route' => route('departments.store')])
            ->render());
    }

    /**
     * Сохраняет новый отдел
     *
     * @param DepartmentRequest $departmentRequest
     * @return JsonResponse 200 - {'message' => 'success'}
     */
    public function store(DepartmentRequest $departmentRequest): JsonResponse
    {
        $data = $departmentRequest->validated();

        Department::create($data);

        return response()->json(['message' => 'success']);
    }

    /**
     * Возвращает форму редактирования передаваемого отдела
     *
     * @param \App\Models\User\Department $department
     * @return JsonResponse
     */
    public function edit(Department $department)
    {
        return response()->json(view('departments.form')
            ->with([
                'route' => route('departments.update', $department),
                'element' => $department
            ])->render());
    }

    /**
     * Обновляет отдел
     *
     * @param DepartmentRequest $departmentRequest
     * @param Department $department
     * @return JsonResponse 200 - {'message' => 'success'}
     */
    public function update(DepartmentRequest $departmentRequest, Department $department): JsonResponse
    {
        $data = $departmentRequest->validated();

        $department->update($data);

        return response()->json(['message' => 'success']);
    }

    /**
     * Удаляет отдел при отсутствии связей
     *
     * @param Department $department
     * @return JsonResponse 200 - {'message' => 'success'} | 409 - {'message' => 'delete not allowed'}
     */
    public function destroy(Department $department): JsonResponse
    {
        $deleteResult = $this->service->delete($department);

        return response()->json(['message' => $deleteResult['message']], $deleteResult['code']);
    }
}
