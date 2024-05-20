<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrganizationMetric;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationMetricPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function view(User $user)
    {
        return true;
    }


    public function update(User $user)
    {
        return true;
    }


    public function delete(User $user, OrganizationMetric $organizationMetric)
    {
        return true;
    }


    public function restore(User $user, OrganizationMetric $organizationMetric)
    {
        return true;
    }
}
