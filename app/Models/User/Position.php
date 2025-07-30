<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Модель должности пользвателя
 *
 * @property int $id Id
 * @property string $name Название
 * @method static \Illuminate\Database\Eloquent\Builder<Position> create(array<string, mixed> $attributes = [])
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User>|null $users Пользоватили с должностью
 */
class Position extends Model
{
    /**
     * Автозаполняемые атрибуты
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Получить пользователей с этой должностью
     *
     * @return HasMany<User, $this>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'position_id', 'id');
    }
}
