<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'photo_url' => ['nullable', 'url'],
            'additional_info' => ['nullable', 'array'], // Validate as array
        ])->validateWithBag('updateProfileInformation');

        // Convert additional_info array to JSON string
        $additionalInfo = isset($input['additional_info']) ? json_encode($input['additional_info']) : $user->additional_info;

        $userData = [
            'full_name' => $input['name'] ?? $user->name,
            'email' => $input['email'] ?? $user->email,
            'photo_url' => $input['photo_url'] ?? $user->photo_url,
            'additional_info' => $additionalInfo,
        ];

        if (isset($input['email']) && $input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $userData);
        } else {
            $user->forceFill($userData)->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, mixed>  $userData
     */
    protected function updateVerifiedUser(User $user, array $userData): void
    {
        $user->forceFill($userData + ['email_verified_at' => null])->save();
        $user->sendEmailVerificationNotification();
    }
}
