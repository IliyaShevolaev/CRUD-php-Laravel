<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Service
{
    public function RegisterStore($data)
    {
        $user = User::create([
            'name' => $data['userName'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        Auth::login($user);
    }

    public function LoginStore(LoginRequest $loginRequest, $data)
    {
        $userExists = User::where('email', $data['email'])->exists();

        if ($userExists) {
            $remember = isset($data['remember']);
            unset($data['remember']);


            if (Auth::attempt($data, $remember)) {
                $loginRequest->session()->regenerate();

                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.');
                } else {
                    return redirect()->route('post.index');
                }
            }
        }

        return redirect()->route('login')->withInput()->withErrors(['failed' => __('auth.failed')]);
    }
}
