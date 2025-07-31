<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Repositories\Interfaces\User\Department\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\User\Position\PositionRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Сервис для работы с пользователями
 */
class UserService
{
    /**
     * Реаозиторий для представления данных для пользователей
     *
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * Реаозиторий для представления данных для отделов
     *
     * @var UserRepositoryInterface
     */
    private DepartmentRepositoryInterface $departmentRepository;

    /**
     * Реаозиторий для представления данных для должностей
     *
     * @var UserRepositoryInterface
     */
    private PositionRepositoryInterface $positionRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        DepartmentRepositoryInterface $departmentRepository,
        PositionRepositoryInterface $positionRepository
    ) {
        $this->repository = $userRepository;
        $this->departmentRepository = $departmentRepository;
        $this->positionRepository = $positionRepository;
    }

    /**
     * Создает нового пользователя
     *
     * @param array<string, mixed> $newData
     * @return void
     */
    public function create(array $newData): void
    {
        $this->repository->create($newData);
    }

    /**
     * Обновляет данные о пользователе
     *
     * @param array<mixed> $editedData
     * @param int $user_id
     * @return void
     */
    public function update(array $editedData, int $user_id): void
    {
        if (array_key_exists('password', $editedData) && $editedData['password'] === null) {
            unset($editedData['password']);
        }

        $this->repository->update($user_id, $editedData);
    }

    /**
     * Удаляет данные о пользователе
     *
     * @param int $user_id
     * @return void
     */
    public function delete(int $user_id): void
    {
        if (Auth::id() !== $user_id) {
            $this->repository->delete($user_id);
        }
    }

    /**
     * Подготавливает данные перед отображением формы создания/редактирования пользователя
     *
     * @param int|null $user_id
     * @return array<mixed>
     */
    public function prepareViewData(int $user_id = null): array
    {
        $user = isset($user_id) ? $this->repository->withoutScopeFind($user_id) : null;

        $departments = $this->departmentRepository->all();
        $positions = $this->positionRepository->all();

        return compact('user', 'departments', 'positions');
    }
}
