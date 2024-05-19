<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectStagePolicy
{
    /**
     * Create a new policy instance.
     */


    use HandlesAuthorization;

    public function view(User $user){

        return true;
    }

    public function create(User $user){
        return true;
    }

    public function update(User $user){
        return true;
    }

    public function delete(User $user){
        return true;
    }

}
