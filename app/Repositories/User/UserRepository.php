<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\DTO\User\UserDTO;
use ClassTransformer\Hydrator;
use App\Models\Scopes\ActiveUserScope;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function all(): Collection
    {
        return User::all();
    }

    public function allWithUnactive(): Collection
    {
        return User::withoutGlobalScope(ActiveUserScope::class)->get();
    }

    public function create(UserDTO $dto): User
    {
        return User::create((array) $dto);
    }

    public function update(int $user_id, UserDTO $dto): void
    {
        $user = User::withoutScopeFind($user_id);
        $user->update((array) $dto);
    }

    public function delete(int $user_id): void
    {
        $user = User::withoutScopeFind($user_id);
        $user->delete();
    }

    public function find(int $user_id): User
    {
        return User::findOrFail($user_id);
    }

    public function withoutScopeFind(int $user_id): UserDTO
    {
        //dd(User::withoutScopeFind($user_id)->toArray());
        return Hydrator::init()->create(UserDTO::class, User::withoutScopeFind($user_id)->toArray());
    }
}
