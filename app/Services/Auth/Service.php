<?php

declare(strict_types=1);

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
     * Получить массив для дальнейшего редиректа
     *
     * @param string $route
     * @param mixed $failedError
     * @return array{failed: string, route: string}
     */
    private function getLoginResultInfo(string $route, mixed $failedError = ''): array
    {
        return [
            'route' => $route,
            'failed' => is_string($failedError) ? $failedError : ''
        ];
    }

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
     * @return array{failed: string, route: string}
     */
    public function loginStore(LoginRequest $loginRequest, array $data): array
    {
        $result = [];

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
                    return $this->getLoginResultInfo('login', __('auth.unactive'));
                }

                $loginRequest->session()->regenerate();

                $result['route'] = 'users.index';
                $result['failed'] = '';
                return $this->getLoginResultInfo('users.index');
            }
        }

        return $this->getLoginResultInfo('login', __('auth.failed'));
    }
}
