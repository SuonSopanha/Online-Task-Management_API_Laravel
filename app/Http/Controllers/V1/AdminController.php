<?php

namespace App\Http\Controllers\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
}
