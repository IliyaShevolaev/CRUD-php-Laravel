<?php

namespace App\Services\User;

use App\Models\User;
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
}
