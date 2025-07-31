<?php

namespace App\Repositories\Interfaces\User\Position;

use App\DTO\User\Position\PositionDTO;
use App\Models\User\Position;
use Illuminate\Database\Eloquent\Collection;

interface PositionRepositoryInterface
{
    /**
     * Получить все записи об должностях
     *
     * @return Collection<int, Position>
     */
    public function all(): Collection;

    /**
     * Создать запись
     *
     * @param PositionDTO $data
     * @return void
     */
    public function create(PositionDTO $data): void;

    /**
     * Обновить должность
     *
     * @param int $position_id
     * @param PositionDTO $data
     * @return void
     */
    public function update(int $position_id, PositionDTO $data): void;

    /**
     * Удалить должность
     *
     * @param int $position_id
     * @return void
     */
    public function delete(int $position_id): void;

    /**
     * Найти должность по id
     *
     * @param int $position_id
     * @return Position
     */
    public function find(int $position_id): Position;
}
