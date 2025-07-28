<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends BaseAuthController
{
    public function index()
    {
        $genders = config('user.genders');

        return view('auth.register', compact('genders'));
    }

    public function store(RegisterRequest $registerRequest)
    {
        $data = $registerRequest->validated();

        $this->service->RegisterStore($data);

        return redirect()->route('users.index');
    }
}
