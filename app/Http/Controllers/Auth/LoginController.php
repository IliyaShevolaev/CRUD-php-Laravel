<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

/**
 * Контроллер входа в систему
 *
 * @uses \App\Services\Auth\Service
 */
class LoginController extends BaseAuthController
{
    /**
     * Возвращает страницу входа в систему
     *
     * @return View
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Выполняет вход в систему и редирект на главную страницу при успешном входе
     *
     * @param LoginRequest $loginRequest
     * @return RedirectResponse
     */
    public function store(LoginRequest $loginRequest): RedirectResponse
    {
        $data = $loginRequest->validated();

        return $this->service->LoginStore($loginRequest, $data);
    }

    /**
     * Выполняет выход из системы и редирект на страницу входа
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

