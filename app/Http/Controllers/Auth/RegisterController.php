<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\Service;

class RegisterController extends BaseAuthController
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $registerRequest)
    {
        $data = $registerRequest->validated();
        
        $this->service->RegisterStore($data);
        
        return redirect()->route('post.index');
    }
}
