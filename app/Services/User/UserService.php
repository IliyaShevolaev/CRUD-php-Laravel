<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\View\View;

class UserService
{
    public function create(array $newData) : void
    {
        $templatePassword = '12345678';
        $newData['password'] = $templatePassword;

        User::create($newData);
    }

    public function update(array $editedData, User $user) : void
    {
        $user->update($editedData);
    }

    public function delete(User $user) : void
    {
        $user->delete();
    }

    public function indexViewInCreateMode(): View
    {
        $users = User::all();
        $inCreateMode = true;
        $roles = ['admin', 'user'];

        return view('admin.users.index', compact('users', 'inCreateMode', 'roles'));
    }

    public function indexViewInEditMode(User $user): View
    {
        $users = User::all();
        $editUserId = $user->id;
        $roles = ['admin', 'user'];

        return view('admin.users.index', compact('users', 'editUserId', 'roles'));
    }
}
