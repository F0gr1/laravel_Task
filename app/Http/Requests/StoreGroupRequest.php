<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'group' => ['required', 'string', 'max:255'],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['integer', 'distinct', 'exists:users,id'],
        ];
    }
}
