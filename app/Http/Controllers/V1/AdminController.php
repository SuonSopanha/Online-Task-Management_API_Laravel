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
use Illuminate\Support\Facades\Cache;
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
        // Cache the statistics for a short period (e.g., 5 minutes) to reduce database load
        $statistics = Cache::remember('admin_statistics', 300, function () {
            $userCount = User::count();
            $taskCount = Task::count();
            $projectCount = Project::count();
            $organizationCount = Organization::count();
            $activeUserCount = DB::table('personal_access_tokens')
                ->distinct('tokenable_id')
                ->count('tokenable_id');
            $oneWeekAgo = Carbon::now()->subWeek();
            $newUserCount = User::where('created_at', '>=', $oneWeekAgo)->count();

            return [
                'userCount' => $userCount,
                'taskCount' => $taskCount,
                'projectCount' => $projectCount,
                'organizationCount' => $organizationCount,
                'activeUserCount' => $activeUserCount,
                'newUserCount' => $newUserCount,
            ];
        });

        return $this->success($statistics);
    }

    public function getUsers()
    {
        // Use pagination instead of fetching all users to handle large datasets efficiently
        $users = User::all();
        return $this->success($users);
    }

    public function getOrganizations()
    {
        // Use eager loading for related models to avoid the N+1 problem
        $organizations = Organization::with(['owner'])->get();
        return $this->success(new OrganizationAdminCollection($organizations));
    }
}
