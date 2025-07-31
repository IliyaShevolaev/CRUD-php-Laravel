<?php

declare(strict_types=1);

namespace App\Repositories\User\Department;

use App\DTO\User\UserDTO;
use ClassTransformer\Hydrator;
use App\Models\User\Department;
use App\DTO\User\Department\DepartmentDTO;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\User\Department\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function all(): array
    {
        $departments = Department::all();
        $departmentsDto = [];

        foreach($departments as $department) {
            $departmentsDto[] = Hydrator::init()->create(DepartmentDTO::class, $department->toArray());
        }

        return $departmentsDto;
    }

    public function collection(): Collection
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

    public function find(int $department_id): DepartmentDTO
    {
        return Hydrator::init()->create(DepartmentDTO::class, Department::findOrFail($department_id)->toArray());
    }

    public function findRelatedUsers(int $department_id): array
    {
        $users = Department::findOrFail($department_id)->users()->get();
        $usersDto = [];

        foreach($users as $user) {
            $usersDto[] = Hydrator::init()->create(UserDTO::class, $user->toArray());
        }

        return $usersDto;
    }
}
