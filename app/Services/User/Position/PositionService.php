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

        if ($position->users()->get()->isEmpty()) {
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
