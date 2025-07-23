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
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'price' => 'required|integer',
            'category_id' => 'required|'
        ];
    }
}
