<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Enums\User\Gender;
use App\Enums\User\Status;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Request для создания пользователя
 */
class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|max:255|confirmed',
            'department_id' => 'nullable|int|exists:departments,id',
            'position_id' => 'nullable|int|exists:positions,id',
            'gender' => ['required', new Enum(Gender::class)],
            'status' => ['required', new Enum(Status::class)]
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
            'name' => trans('main.users.name'),
        ];
    }
}
