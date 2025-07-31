<?php

namespace App\Repositories\Interfaces\User\Department;

use App\Models\User\Department;
use App\DTO\User\Department\DepartmentDTO;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentRepositoryInterface
{
    /**
     * Получить все записи об отделах
     *
     * @return Collection<int, Department>
     */
    public function all(): Collection;

    /**
     * Создать запись
     *
     * @param DepartmentDTO $dto
     * @return void
     */
    public function create(DepartmentDTO $dto): void;

    /**
     * Обновить отдел
     *
     * @param int $department_id
     * @param DepartmentDTO $dto
     * @return void
     */
    public function update(int $department_id, DepartmentDTO $dto): void;

    /**
     * Удалить отдел
     *
     * @param int $department_id
     * @return void
     */
    public function delete(int $department_id): void;

    /**
     * Найти отдел по id
     *
     * @param int $department_id
     * @return Department
     */
    public function find(int $department_id): Department;
}
