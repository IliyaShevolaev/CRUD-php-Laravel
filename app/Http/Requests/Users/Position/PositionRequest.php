<?php
declare(strict_types=1);

namespace App\Http\Requests\Users\Position;

use Illuminate\Validation\Rule;
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
        $positionId = $this->route('position')->id ?? null;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                isset($positionId) ?
                    'unique:positions,name,' . $positionId . ',deleted_at,NULL' :
                    'unique:positions,name,deleted_at,NULL'
            ]
        ];
    }
}
