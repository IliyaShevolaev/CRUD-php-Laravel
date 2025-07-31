<?php

declare(strict_types=1);

namespace App\Services\User\Position;

use App\Models\User\Position;
use App\Repositories\Interfaces\User\Position\PositionRepositoryInterface;

/**
 * Сервис для работы с должностями пользователей
 */
class PositionService
{

    /**
     * Реаозиторий для представления данных для должностей
     *
     * @var PositionRepositoryInterface
     */
    private PositionRepositoryInterface $repository;

    public function __construct(PositionRepositoryInterface $positiionRepository)
    {
        $this->repository = $positiionRepository;
    }

    /**
     * Создать должность
     *
     * @param array<string, string> $data
     * @return void
     */
    public function create(array $data): void
    {
        $this->repository->create($data);
    }

    /**
     * Обновить должность
     *
     * @param int $position_id
     * @param array<string, string> $data
     * @return void
     */
    public function update(int $position_id, array $data): void
    {
        $this->repository->update($position_id, $data);
    }

    /**
     *  Удалить должость
     *
     * @param int $position_id
     * @return array{
     *     message: string,
     *     code: int,
     * }
     */
    public function delete(int $position_id): array
    {
        $result = [];

        if (!$this->repository->find($position_id)->users()->exists()) {
            $this->repository->delete($position_id);

            $result['message'] = 'success';
            $result['code'] = 200;
        } else {
            $result['message'] = 'delete not allowed';
            $result['code'] = 409;
        }

        return $result;
    }
}
