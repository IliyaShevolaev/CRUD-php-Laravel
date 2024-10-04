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

        $userExists = User::where('email', $data['email'])->exists();

        if ($userExists) {
            $remember = isset($data['remember']);
            unset($data['remember']);


            if (Auth::attempt($data, $remember)) {
                $loginRequest->session()->regenerate();
                return redirect()->route('post.index');
            }

            return redirect()->route('login')->withInput()->withErrors(['wrongPassword' => ' ']);
        }

        return redirect()->route('login')->withInput()->withErrors(['incorrectEmail' => ' ']);
    }

    public function destroy(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

