<?php

declare(strict_types=1);

namespace App\Services\User\Position;

use App\Models\User\Position;

/**
 * Сервис для работы с должностями пользователей
 */
class PositionService
{


    /**
     * Создать отдел
     *
     * @param array<string, string> $data
     * @return void
     */
    public function create(array $data): void
    {
        Position::create($data);
    }

    /**
     * Обновить отдел
     *
     * @param Position $position
     * @param array<string, string> $data
     * @return void
     */
    public function update(Position $position, array $data): void
    {
        $position->update($data);
    }

    /**
     *  Удалить должость
     *
     * @param Position $position
     * @return array{
     *     message: string,
     *     code: int,
     * }
     */
    public function delete(Position $position): array
    {
        $result = [];

        if (!$position->users()->exists()) {
            $position->delete();

            $result['message'] = 'success';
            $result['code'] = 200;
        } else {
            $result['message'] = 'delete not allowed';
            $result['code'] = 409;
        }

        return $result;
    }
}
