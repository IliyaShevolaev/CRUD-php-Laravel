<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users|max:255',
            'userName' => 'required|string|max:255',
            'password' => 'required|confirmed|string|min:5|max:255',
        ];
    }
}
