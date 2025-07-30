<?php
declare(strict_types=1);

namespace App\Http\Requests\Users\Department;

use Illuminate\Validation\Rule;
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
        $departmentId = $this->route('department')->id ?? null;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                isset($departmentId) ?
                    'unique:departments,name,' . $departmentId . ',id,deleted_at,NULL' :
                    'unique:departments,name,NULL,id,deleted_at,NULL'
            ]
        ];
    }
}
