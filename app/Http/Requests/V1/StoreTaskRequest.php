<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'on_tracking' => 'boolean',
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'task_category' => 'required|string|max:255',
            'work_hour_required' => 'required|integer',
            'work_hour' => 'integer',
            'status' => 'required|string|max:255',
            'priority' => 'required|string|max:255',
            'severity' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'assignee_id' => 'nullable|exists:users,id',
            'assignee_dates' => 'date',
            'complete' => 'boolean',
            'complete_date' => 'nullable|date',
        ];
    }
}
