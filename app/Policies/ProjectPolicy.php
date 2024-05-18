<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    public function destroy(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }





}
