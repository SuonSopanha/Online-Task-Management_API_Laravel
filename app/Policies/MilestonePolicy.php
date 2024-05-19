<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Milestone;
use Illuminate\Auth\Access\HandlesAuthorization;

class MilestonePolicy
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

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Milestone $milestone)
    {
        return true;
    }

    public function delete(User $user, Milestone $milestone)
    {
        return true;
    }
}
