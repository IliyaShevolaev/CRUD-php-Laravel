<?php

declare(strict_types=1);

namespace App\Http\Requests\Users\Department;

use ClassTransformer\Hydrator;
use Illuminate\Validation\Rule;
use App\DTO\User\Department\DepartmentDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Request для создания/редактирования отдела
 */
class DepartmentRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments')->whereNull('deleted_at')->ignore($this->id)
            ]
        ];
    }

    /**
     * Получить DTO
     *
     * @return DepartmentDTO
     */
    public function getDto(): DepartmentDTO
    {
        return Hydrator::init()->create(DepartmentDTO::class, $this->validated());
    }
}
