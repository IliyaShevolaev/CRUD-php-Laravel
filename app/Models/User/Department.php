<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Модель отдела пользвателя
 *
 * @property int $id Id
 * @property string $name Название
 * @method static \Illuminate\Database\Eloquent\Builder<Department> create(array<string, mixed> $attributes = [])
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User>|null $users Пользоватили из отдела
 */
class Department extends Model
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
     * Получить пользователей из этого отдела
     *
     * @return HasMany<User, $this>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
}
