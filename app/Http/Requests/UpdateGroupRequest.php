<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        $group = $this->route('group');

        return $this->user() !== null && $group instanceof Group && $this->user()->can('update', $group);
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
