<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Модель должности пользвателя
 *
 * @property int $id Id
 * @property string $name Название
 * @property-read \Illuminate\Database\Eloquent\Collection<User>|null $users Пользоватили с должностью
 */
class Position extends Model
{
    use HasFactory;

    /**
     * Автозаполняемые атрибуты
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Получить пользователей с этой должностью
     *
     * @return HasMany<User, User\Position>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'position_id', 'id');
    }
}
