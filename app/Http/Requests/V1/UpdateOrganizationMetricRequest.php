<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationMetricRequest extends FormRequest
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
            'total_users' => 'sometimes|required|integer|min:0',
            'active_users' => 'sometimes|required|integer|min:0',
            'projects_created' => 'sometimes|required|integer|min:0',
            'projects_completed' => 'sometimes|required|integer|min:0',
            'projects_in_progress' => 'sometimes|required|integer|min:0',
            'average_project_completion_time' => 'sometimes|required|numeric|min:0',
            'total_tasks' => 'sometimes|required|integer|min:0',
            'completed_tasks' => 'sometimes|required|integer|min:0',
            'tasks_in_progress' => 'sometimes|required|integer|min:0',
            'tasks_overdue' => 'sometimes|required|integer|min:0',
            'average_task_completion_time' => 'sometimes|required|numeric|min:0',
        ];
    }
}
