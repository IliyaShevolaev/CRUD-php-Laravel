<?php

declare(strict_types=1);

namespace App\Services\User\Department;

use App\Models\User\Department;

/**
 * Сервис для работы с отделами пользователей
 */
class DepartmentService
{

    /**
     * Создать отдел
     *
     * @param array<string, string> $data
     * @return void
     */
    public function create(array $data): void
    {
        Department::create($data);
    }

    /**
     * Обновить отдел
     *
     * @param Department $department
     * @param array<string, string> $data
     * @return void
     */
    public function update(Department $department, array $data): void
    {
        $department->update($data);
    }

    /**
     *  Удалить отдел
     *
     * @param Department $department
     * @return array{
     *     message: string,
     *     code: int,
     * }
     */
    public function delete(Department $department): array
    {
        $result = [];

        if (!$department->users()->exists()) {
            $department->delete();

            $result['message'] = 'success';
            $result['code'] = 200;
        } else {
            $result['message'] = 'delete not allowed';
            $result['code'] = 409;
        }

        return $result;
    }
}
