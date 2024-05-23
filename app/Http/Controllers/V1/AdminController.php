<?php

namespace App\Http\Controllers\V1;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrganizationAdminCollection;

class AdminController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('is_admin');
    }

    public function getStatistics()
    {
        // Get total number of users
        $userCount = User::count();

        // Get total number of tasks
        $taskCount = Task::count();

        // Get total number of projects
        $projectCount = Project::count();

        // Get total number of organizations
        $organizationCount = Organization::count();

        // Get number of active users (users who have valid personal access tokens)
        $activeUserCount = DB::table('personal_access_tokens')
            ->distinct('tokenable_id')
            ->count('tokenable_id');

        // Get number of new users in the past week
        $oneWeekAgo = Carbon::now()->subWeek();
        $newUserCount = User::where('created_at', '>=', $oneWeekAgo)->count();

        $data = [
            'userCount' => $userCount,
            'taskCount' => $taskCount,
            'projectCount' => $projectCount,
            'organizationCount' => $organizationCount,
            'activeUserCount' => $activeUserCount,
            'newUserCount' => $newUserCount,
        ];

        return $this->success($data);
    }

    public function getUsers()
    {
        $users = User::all();
        return $this->success($users);

    }

    public function getOrganizations()
    {
        $organizations = Organization::with(['owner'])->get();
        return $this->success(new OrganizationAdminCollection($organizations));
    }

}
