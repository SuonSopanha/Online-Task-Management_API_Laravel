<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{

    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Goal $goal)
    {
        return true;
    }


    public function create(User $user)
    {
        return true;
    }


    public function delete(User $user, Goal $goal)
    {
        return true;
    }


    public function update(User $user, Goal $goal)
    {
        return true;
    }


}
