<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    
    public function view(User $user, User $model): bool
    {
        return $model->role == 'admin';
    }

}
