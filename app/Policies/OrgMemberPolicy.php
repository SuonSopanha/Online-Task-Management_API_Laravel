<?php

namespace App\Policies;

use App\Models\OrgMember;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrgMemberPolicy
{

    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function viewAny(User $user)
    {
        return true;
    }


    public function view(User $user, OrgMember $orgMember)
    {
        return true;
    }


    public function create(User $user)
    {
        return true;
    }


    public function update(User $user, OrgMember $orgMember)
    {
        return true;
    }


}
