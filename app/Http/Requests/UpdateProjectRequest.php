<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        $project = $this->route('project');

        return $this->user() !== null && $project instanceof Project && $this->user()->can('update', $project);
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
