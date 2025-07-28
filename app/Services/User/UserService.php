<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\User\Position;
use App\Models\User\Department;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function create(array $newData) : void
    {
        User::create($newData);
    }

    public function update(array $editedData, User $user): void
    {
        if (array_key_exists('password', $editedData) && $editedData['password'] === null) {
            unset($editedData['password']);
        }

        $user->update($editedData);
    }

    public function delete(User $user) : void
    {
        if (Auth::id() !== $user->id) {
            $user->delete();
        }
    }

    public function prepareViewData(User $user = null): array
    {
        $departments = Department::all();
        $positions = Position::all();

        return compact('user', 'departments', 'positions');
    }
}
