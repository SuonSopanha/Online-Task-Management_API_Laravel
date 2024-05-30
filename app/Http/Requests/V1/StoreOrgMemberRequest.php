<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrgMemberRequest extends FormRequest
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
            'org_id' => 'required|exists:organizations,id',
            'role' => 'required|string|max:255',
            'is_admin' => 'nullable|boolean',
            'assigned_tasks' => 'nullable|integer|min:0',
            'completed_tasks' => 'nullable|integer|min:0',
            'overdue_tasks' => 'nullable|integer|min:0',
            'worked_hour' => 'nullable|integer|min:0',
        ];
    }
}
