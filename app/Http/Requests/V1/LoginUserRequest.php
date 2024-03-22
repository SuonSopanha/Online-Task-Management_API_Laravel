<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assuming anyone can attempt to login
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'full_name' => 'nullable|string|max:255',
            'photo_url' => 'nullable|string',
            // Define validation rules for other fields as needed
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.exists' => 'The provided email does not exist.', // Custom error message for email not found
            'password.min' => 'The password must be at least :min characters.', // Custom error message for minimum password length
        ];
    }
}
