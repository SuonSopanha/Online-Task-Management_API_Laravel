<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Goal;
use App\Models\Task;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\OrgMember;
use App\Models\Organization;
use App\Models\TaskTracking;
use App\Policies\GoalPolicy;
use App\Policies\TaskPolicy;
use App\Models\ProjectMember;
use App\Policies\ProjectPolicy;
use App\Policies\MilestonePolicy;
use App\Policies\OrgMemberPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\TaskTrackingPolicy;
use App\Policies\ProjectMemberPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Organization::class => OrganizationPolicy::class,
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
        Goal::class => GoalPolicy::class,
        Milestone::class => MilestonePolicy::class,
        OrgMember::class => OrgMemberPolicy::class,
        ProjectMember::class => ProjectMemberPolicy::class,
        TaskTracking::class => TaskTrackingPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
