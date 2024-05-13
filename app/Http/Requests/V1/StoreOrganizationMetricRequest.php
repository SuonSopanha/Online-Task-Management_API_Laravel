<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationMetricRequest extends FormRequest
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
            'organization_id' => 'required|exists:organizations,id',
            'total_users' => 'required|integer|min:0',
            'active_users' => 'required|integer|min:0',
            'projects_created' => 'required|integer|min:0',
            'projects_completed' => 'required|integer|min:0',
            'projects_in_progress' => 'required|integer|min:0',
            'average_project_completion_time' => 'required|numeric|min:0',
            'total_tasks' => 'required|integer|min:0',
            'completed_tasks' => 'required|integer|min:0',
            'tasks_in_progress' => 'required|integer|min:0',
            'tasks_overdue' => 'required|integer|min:0',
            'average_task_completion_time' => 'required|numeric|min:0',
        ];
    }
}
