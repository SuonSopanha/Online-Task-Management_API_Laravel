<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'project_name' => 'string|max:255',
            'owner_id' => 'exists:users,id',
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date',
            'team_id' => 'nullable|string|max:255',
            'project_status' => 'string|max:255',
            'project_priority' => 'string|max:255',
        ];
    }
}
