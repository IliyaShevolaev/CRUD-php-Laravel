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
 * @property-read \Illuminate\Database\Eloquent\Collection<User>|null $users Пользоватили из отдела
 */
class Department extends Model
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
     * Получить пользователей из этого отдела
     *
     * @return HasMany<User, User\Department>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
}
