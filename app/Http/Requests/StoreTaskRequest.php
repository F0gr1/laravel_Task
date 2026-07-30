<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'task' => ['required', 'string', 'max:50'],
            'group_id' => ['nullable', 'array'],
            'group_id.*' => ['integer', 'distinct', 'exists:groups,id'],
        ];
    }
}
