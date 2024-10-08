<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EditProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends BaseAuthController
{
    public function index()
    {
        $owner = Auth::user();

        return view('auth.profile', compact('owner'));
    }

    public function edit(User $owner)
    {
        return view('auth.my-profile-edit', compact('owner'));
    }

    public function update(EditProfileRequest $editProfileRequest, User $owner)
    {
        $data = $editProfileRequest->validated();

        $owner->update($data);

        return redirect()->route('profile.index');

    }
}
