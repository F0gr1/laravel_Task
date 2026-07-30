<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        $task = $this->route('task');

        return $this->user() !== null && $task instanceof Task && $this->user()->can('update', $task);
    }

    public function rules(): array
    {
        return [
            'task' => ['required', 'string', 'max:50'],
        ];
    }
}
