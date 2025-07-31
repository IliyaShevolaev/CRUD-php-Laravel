<?php

declare(strict_types=1);

namespace App\Services\User;

use App\DTO\User\UserDTO;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Interfaces\User\Position\PositionRepositoryInterface;
use App\Repositories\Interfaces\User\Department\DepartmentRepositoryInterface;

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
     * @var DepartmentRepositoryInterface
     */
    private DepartmentRepositoryInterface $departmentRepository;

    /**
     * Реаозиторий для представления данных для должностей
     *
     * @var PositionRepositoryInterface
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
     * @param UserDTO $dto
     * @return void
     */
    public function create(UserDTO $dto): void
    {
        $this->repository->create($dto);
    }

    /**
     * Обновляет данные о пользователе
     *
     * @param UserDTO $editedData
     * @param int $user_id
     * @return void
     */
    public function update(UserDTO $dto, int $user_id): void
    {
        $this->repository->update($user_id, $dto);
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
