<?php

declare(strict_types=1);

namespace App\Repositories\User\Department;

use App\DTO\User\Department\DepartmentDTO;
use App\Models\User\Department;
use App\Repositories\Interfaces\User\Department\DepartmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function all(): Collection
    {
        return Department::all();
    }

    public function create(DepartmentDTO $dto): void
    {
        Department::create((array) $dto);
    }

    public function update(int $department_id, DepartmentDTO $dto): void
    {
        $department = Department::findOrFail($department_id);
        $department->update((array) $dto);
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
