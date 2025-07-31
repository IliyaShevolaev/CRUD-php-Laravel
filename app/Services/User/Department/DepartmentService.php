<?php

declare(strict_types=1);

namespace App\Services\User\Department;

use App\Models\User\Department;
use App\Repositories\Interfaces\User\Department\DepartmentRepositoryInterface;

/**
 * Сервис для работы с отделами пользователей
 */
class DepartmentService
{
    /**
     * Реаозиторий для представления данных для отделов
     *
     * @var DepartmentRepositoryInterface
     */
    private DepartmentRepositoryInterface $repository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->repository = $departmentRepository;
    }

    /**
     * Создать отдел
     *
     * @param array<string, string> $data
     * @return void
     */
    public function create(array $data): void
    {
        $this->repository->create($data);
    }

    /**
     * Обновить отдел
     *
     * @param int $department_id
     * @param array<string, string> $data
     * @return void
     */
    public function update(int $department_id, array $data): void
    {
        $this->repository->update($department_id, $data);
    }

    /**
     *  Удалить отдел
     *
     * @param int $department_id
     * @return array{
     *     message: string,
     *     code: int,
     * }
     */
    public function delete(int $department_id): array
    {
        $result = [];

        if (!$this->repository->find($department_id)->users()->exists()) {
            $this->repository->delete($department_id);

            $result['message'] = 'success';
            $result['code'] = 200;
        } else {
            $result['message'] = 'delete not allowed';
            $result['code'] = 409;
        }

        return $result;
    }
}
