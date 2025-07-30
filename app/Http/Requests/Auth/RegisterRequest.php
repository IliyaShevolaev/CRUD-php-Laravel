<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users|max:255',
            'userName' => 'required|string|max:255',
            'password' => 'required|confirmed|string|min:5|max:255',
            'gender' => 'required|string',
        ];
    }

    /**
     * Задает название возвращаемых атрибутов при ошибках валидации
     *
     * @return array<string, mixed>
     */
    public function attributes(): array
    {
        return [
            'email' => 'email',
        ];
    }
}
