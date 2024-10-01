<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

use function PHPUnit\Framework\returnSelf;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string',
            'content' => 'string',
            'price' => 'integer',
            'category_id' => ''
        ];
    }
}
