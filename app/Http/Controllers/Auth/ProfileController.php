<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends BaseAuthController
{
    public function index()
    {
        $owner = Auth::user();

        return view('auth.profile', compact('owner'));
    }

    public function edit($userId)
    {
        $owner = User::find($userId);

        return view('auth.my-profile-edit', compact('owner'));
    }

    public function update()
    {

    }
}
