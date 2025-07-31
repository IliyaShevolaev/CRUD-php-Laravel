<?php

namespace App\Repositories\User\Department;

use App\Models\User\Department;
use App\Repositories\Interfaces\User\Department\DepartmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function all(): Collection
    {
        return Department::all();
    }

    public function create(array $data): void
    {
        Department::create($data);
    }

    public function update(int $department_id, array $data): void
    {
        $department = Department::findOrFail($department_id);
        $department->update($data);
    }

    public function delete(int $department_id): void
    {
        $department = Department::findOrFail($department_id);
        $department->delete();
    }

    public function find(int $department_id): Department
    {
        return Department::findOrFail($department_id);
    }
}
