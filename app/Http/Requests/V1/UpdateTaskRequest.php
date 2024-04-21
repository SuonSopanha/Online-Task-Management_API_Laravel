<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        return [
            'project_id' => 'nullable|exists:projects,id',
            'milestone_id' => 'nullable|exists:milestones,id',
            'stage_id' => 'nullable|exists:project_stages,id',
            'owner_id' => 'exists:users,id',
            'on_tracking' => 'boolean',
            'task_name' => 'string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'date',
            'due_date' => 'date',
            'task_category' => 'string|max:255',
            'work_hour_required' => 'integer',
            'work_hour' => 'integer',
            'status' => 'string|max:255',
            'priority' => 'string|max:255',
            'severity' => 'string|max:255',
            'tag' => 'nullable|string|max:255',
            'assignee_id' => 'nullable|exists:users,id',
            'assignee_dates' => 'date',
            'complete' => 'boolean',
            'complete_date' => 'nullable|date',
        ];
    }
}
