<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

/**
 * Базовый контроллер пользователей
 *
 * Содержит внедрение зависимости с UserService дочерних контроллеров
 */
class BaseUserController extends Controller
{
    /**
     * Сервис пользователей
     *
     * @var UserService $service
     */
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
