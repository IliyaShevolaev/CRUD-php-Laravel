<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use App\Models\User\Position;
use App\Models\User\Department;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

/**
 * Сервис для работы с пользователями
 */
class UserService
{
    /**
     * Создает нового пользователя
     *
     * @param array<string, mixed> $newData
     * @return void
     */
    public function create(array $newData): void
    {
        User::create($newData);
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
        $user = User::withoutScopeFind($user_id);

        if (array_key_exists('password', $editedData) && $editedData['password'] === null) {
            unset($editedData['password']);
        }

        $user->update($editedData);
    }

    /**
     * Удаляет данные о пользователе
     *
     * @param User $user
     * @return void
     */
    public function delete(User $user): void
    {
        if (Auth::id() !== $user->id) {
            $user->delete();
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
        $user = isset($user_id) ? User::withoutScopeFind($user_id) : null;

        $departments = Department::all();
        $positions = Position::all();

        return compact('user', 'departments', 'positions');
    }
}
