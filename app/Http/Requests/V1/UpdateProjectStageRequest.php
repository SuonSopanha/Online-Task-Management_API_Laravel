<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectStageRequest extends FormRequest
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
            'project_id' => 'exists:projects,id',
            'stage_name' => 'string|max:255',
            'start_date' => 'date',
            'period' => 'integer',
            'end_date' => 'date|after_or_equal:start_date',
            'completed' => 'boolean',
            'completion_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
}
