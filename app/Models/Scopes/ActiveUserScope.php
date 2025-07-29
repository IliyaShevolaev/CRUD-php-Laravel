<?php

namespace App\Models\Scopes;

use App\Enums\User\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

/**
 * Scope для получения только пользователей с активным статусом
 */
class ActiveUserScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('status', Status::Active->value);
    }
}
