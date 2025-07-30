<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Сервис для автризации
 */
class Service
{
    /**
     * Регистрирует нового пользователя
     *
     * @param array<string> $data
     * @return void
     */
    public function registerStore(array $data): void
    {
        /** @var User $user */
        $user = User::create([
            'name' => $data['userName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'gender' => $data['gender']
        ]);

        Auth::login($user);
    }

    /**
     * Проверяет данные пользователя, а так же его статус активности при полном соответсвии выполняет вход
     *
     * Возвращает на страницу входа с errors failed при неудачной попытке входа
     *
     * @param LoginRequest $loginRequest
     * @param array<string> $data
     * @return RedirectResponse
     */
    public function loginStore(LoginRequest $loginRequest, array $data): RedirectResponse
    {
        /** @var \Illuminate\Database\Eloquent\Builder <\App\Models\User> $query */
        $query = User::where('email', $data['email']);

        $userExists = $query->exists();
        if ($userExists) {
            $remember = isset($data['remember']);
            unset($data['remember']);

            if (Auth::attempt($data, $remember)) {
                /** @var User $user */
                $user = Auth::user();
                if ($user->status === 'unactive') {
                    return redirect()->route('login')->withInput()->withErrors(['failed' => __('auth.unactive')]);
                }

                $loginRequest->session()->regenerate();

                return redirect()->route('users.index');
            }
        }

        return redirect()->route('login')->withInput()->withErrors(['failed' => __('auth.failed')]);
    }
}
