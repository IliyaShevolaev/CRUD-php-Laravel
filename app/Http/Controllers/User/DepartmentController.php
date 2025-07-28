<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\User\DepartmentResource;
use App\Models\User\Department;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTables\DepartmentsDataTable;
use App\Http\Requests\Users\Department\DepartmentRequest;

class DepartmentController extends Controller
{
    public function index(DepartmentsDataTable $departmentsDataTable)
    {
        return $departmentsDataTable->render('departments.index');
    }

    public function create()
    {
        return response()->json(view('departments.form')
            ->with(['route' => route('departments.store')])
            ->render());
    }

    public function store(DepartmentRequest $departmentRequest): JsonResponse
    {
        $data = $departmentRequest->validated();

        Department::create($data);

        return response()->json(['message' => 'success']);
    }

    public function edit(Department $department)
    {
        return response()->json(view('departments.form')
            ->with([
                'route' => route('departments.update', $department),
                'element' => $department
            ])->render());
    }

    public function update(DepartmentRequest $departmentRequest, Department $department): JsonResponse
    {
        $data = $departmentRequest->validated();

        $department->update($data);

        return response()->json(['message' => 'success']);
    }

    public function destroy(Department $department): JsonResponse
    {
        if ($department->users()->get()->isEmpty()) {
            $department->delete();
            return response()->json(['message' => 'success']);
        }

        return response()->json(['message' => 'delete not allowed'], 409);
    }
}
