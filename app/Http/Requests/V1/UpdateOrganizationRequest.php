<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'owner_id' => 'exists:users,id',
            'email' => 'nullable|string|email|max:255|unique:organizations,email,' . $this->route('organization')->id,
        ];
    }
}
