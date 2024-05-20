<?php

namespace App\Policies;

use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectMemberPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user){
        return true;
    }

    public function create(User $user){
        return true;
    }

    public function update(User $user,ProjectMember $projectMember){
        return true;
    }

    public function delete(User $user,ProjectMember $projectMember){
        return true;
    }
}
