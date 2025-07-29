<?php

namespace App\Models;

use App\Enums\User\Gender;
use App\Enums\User\Status;
use App\Models\User\Position;
use App\Models\User\Department;
use App\Models\Scopes\ActiveUserScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[ScopedBy([ActiveUserScope::class])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * Приведение атрибутов в указаным типам
     * @var array
     */
    protected $casts = [
        'gender' => Gender::class,
        'status' => Status::class
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
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
        return static::withoutGlobalScope(ActiveUserScope::class)->findOrFail($id);
    }

    /**
     * Получить отдел пользователя
     * @return HasOne<Department, User>
     */
    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /**
     * Получить должность пользователя
     * @return HasOne<Position, User>
     */
    public function position(): HasOne
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
