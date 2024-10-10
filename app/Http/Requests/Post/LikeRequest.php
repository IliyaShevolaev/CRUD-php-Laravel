<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'integer',
            'post_id' => 'integer',
        ];
    }
}
