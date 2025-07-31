<?php

namespace App\Repositories\Interfaces\User\Position;

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
     * @param array<string, string> $data
     * @return void
     */
    public function create(array $data): void;

    /**
     * Обновить должность
     *
     * @param int $position_id
     * @param array<string, string> $data
     * @return void
     */
    public function update(int $position_id, array $data): void;

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
