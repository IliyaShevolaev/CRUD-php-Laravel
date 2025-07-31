<?php

declare(strict_types=1);

namespace App\Http\Requests\Users\Position;

use ClassTransformer\Hydrator;
use Illuminate\Validation\Rule;
use App\DTO\User\Position\PositionDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Request для создания/редактирования должности
 */
class PositionRequest extends FormRequest
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
                Rule::unique('positions')->whereNull('deleted_at')->ignore($this->id)
            ]
        ];
    }

    /**
     * Получить DTO
     *
     * @return PositionDTO
     */
    public function getDto(): PositionDTO
    {
        return Hydrator::init()->create(PositionDTO::class, $this->validated());
    }
}
