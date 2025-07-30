<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер регистрации пользователей
 *
 * @uses \App\Services\Auth\Service
 */
class RegisterController extends BaseAuthController
{
    /**
     * Отображает страницу регистрации
     *
     * @return View
     */
    public function index(): View
    {
        return view('auth.register');
    }

    /**
     * Создает запись о зарегистрированном пользователе и редиректит на главную страницу пользователей
     *
     * @param RegisterRequest $registerRequest
     * @return RedirectResponse
     */
    public function store(RegisterRequest $registerRequest): RedirectResponse
    {
        $data = $registerRequest->validated();

        $this->service->registerStore($data);

        return redirect()->route('users.index');
    }
}
