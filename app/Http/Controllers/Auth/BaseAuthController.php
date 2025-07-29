<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\Service;
use Illuminate\Http\Request;

/**
 * Базовый контроллер авторизации
 *
 * Содержит внедрение зависимости с Service авторизации дочерних контроллеров
 */
class BaseAuthController extends Controller
{
    /**
     * Сервис авторизации
     * 
     * @var App\Services\Auth\Service $service
     */
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
