<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'project' => ['required', 'string', 'max:50'],
            'PIC' => ['required', 'string', 'max:50', 'exists:users,name'],
            'progress' => ['required', 'integer', 'between:0,100'],
            'memo' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }
}
