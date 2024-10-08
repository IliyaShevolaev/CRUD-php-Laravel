<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    public function viewAdmin(User $user, User $model): bool
    {
        return $model->role == 'admin';
    }

    public function viewEditProfile(User $user, User $model) 
    {
        return $model->id == $user->id || $user->role == 'admin';
    }
}
