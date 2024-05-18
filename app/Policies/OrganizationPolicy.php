<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;

    public function view(User $user, Organization $organization){
        return $organization->members()->where('user_id', $user->id)->exists() || $user->id === $organization->owner_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the organization.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Organization  $organization
     * @return mixed
     */
    public function update(User $user, Organization $organization)
    {
        return $user->id === $organization->owner_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the organization.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Organization  $organization
     * @return mixed
     */
    public function delete(User $user, Organization $organization)
    {
        return $user->id === $organization->owner_id || $user->role === 'admin';
    }
}
