<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $registerRequest)
    {
        $data = $registerRequest->validated();
        
        $user = User::create([
            'name' => $data['userName'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        Auth::login($user);
        
        return redirect()->route('post.index');
    }
}
