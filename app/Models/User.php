<?php

namespace App\Models;

use App\Enums\User\Gender;
use App\Enums\User\Status;
use App\Models\User\Position;
use App\Models\User\Department;
use Database\Factories\UserFactory;
use App\Models\Scopes\ActiveUserScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Модель пользователя системы
 *
 * @property int $id
 * @property string $status статус активен/неактивен
 * @method static \Illuminate\Database\Eloquent\Builder<User> create(array<int|string, mixed> $attributes = [])
 * @method static User withoutScopeFind(int $id)
 * @method static Builder<User> where(mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @use HasFactory<UserFactory>
 */
#[ScopedBy([ActiveUserScope::class])]
class User extends Authenticatable
{
    //@phpstan-ignore-next-line
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'position_id',
        'gender',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gender' => Gender::class,
            'status' => Status::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Получить пользователя не применяя Scope
     * @param int $id
     * @return User
     */
    public static function withoutScopeFind(int $id): User
    {
        return static::query()->withoutGlobalScope(ActiveUserScope::class)->findOrFail($id);
    }

    /**
     * Получить отдел пользователя
     * @return HasOne<Department, $this>
     */
    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /**
     * Получить должность пользователя
     * @return HasOne<Position, $this>
     */
    public function position(): HasOne
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
