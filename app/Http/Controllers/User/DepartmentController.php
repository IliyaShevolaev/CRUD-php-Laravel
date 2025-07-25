<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User\Department;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTables\DepartmentsDataTable;
use App\Http\Resources\User\DepartmentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\Users\Department\DepartmentRequest;

class DepartmentController extends Controller
{
    // public function index(): JsonResource
    // {
    //     $departments = Department::all();

    //     return DepartmentResource::collection($departments);
    // }

    public function index(DepartmentsDataTable $departmentsDataTable)
    {
        return $departmentsDataTable->render('departments.index');
    }

    public function store(DepartmentRequest $departmentRequest): JsonResponse
    {
        $data = $departmentRequest->validated();

        Department::create($data);

        return response()->json(['message' => 'success']);
    }

    public function update(DepartmentRequest $departmentRequest, Department $department): JsonResponse
    {
        $data = $departmentRequest->validated();

        $department->update($data);

        return response()->json(['message' => 'success']);
    }

    public function destroy(Department $department): JsonResponse
    {
        $department->delete();

        return response()->json(['message' => 'success']);
    }
}
