<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $loginRequest)
    {
        $data = $loginRequest->validated();

        // Проверяем, существует ли email в базе
        $userExists = User::where('email', $data['email'])->exists();

        if ($userExists) {
            // Пытаемся аутентифицировать пользователя
            if (Auth::attempt($data)) {
                return redirect()->route('post.index');
            }

            // Если email есть, но пароль неверный
            return redirect()->route('auth.login')->withInput()->withErrors(['wrongPassword' => ' ']);
        }

        // Если email не найден в базе данных
        return redirect()->route('auth.login')->withInput()->withErrors(['incorrectEmail' => ' ']);
    }
}

