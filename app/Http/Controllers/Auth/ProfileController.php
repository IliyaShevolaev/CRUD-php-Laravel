<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends BaseAuthController
{
    public function index()
    {
        $owner = Auth::user();

        return view('auth.profile', compact('owner'));
    }

    public function edit()
    {

    }
}
