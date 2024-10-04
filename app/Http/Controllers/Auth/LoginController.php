<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;

class LoginController extends BaseAuthController
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $loginRequest)
    {
        $data = $loginRequest->validated();

        return $this->service->LoginStore($loginRequest, $data);
    }

    public function destroy(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

