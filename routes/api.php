<?php

use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\GoalController;
use App\Http\Controllers\V1\TaskController;
use App\Http\Controllers\V1\TeamController;
use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\ProjectController;
use App\Http\Controllers\V1\MileStoneController;
use App\Http\Controllers\V1\OrgMemberController;
use App\Http\Controllers\V1\TeamMemberController;
use App\Http\Controllers\V1\OrganizationController;
use App\Http\Controllers\V1\ProjectStageController;
use App\Http\Controllers\V1\ProjectMemberController;
use App\Http\Controllers\V1\OrganizationMetricController;
use App\Http\Controllers\V1\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/users/{user}', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    // Other routes for version 1...
});

Route::get('/login/google', [AuthController::class, 'redirectToProvider']);
Route::get('/login/google/callback', [AuthController::class, 'handleProviderCallback']);

// Routes for version 1 User
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

});


Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::get('/admin/statistics', [AdminController::class, 'getStatistics']);
    Route::get('/admin/users', [AdminController::class, 'getUsers']);
    Route::get('/admin/organizations', [AdminController::class, 'getOrganizations']);
});



// Routes for version 1 Team
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/teams', [TeamController::class, 'index']);
    Route::post('/teams', [TeamController::class, 'store']);
    Route::get('/teams/{team}', [TeamController::class, 'show']);
    Route::put('/teams/{team}', [TeamController::class, 'update']);
    Route::delete('/teams/{team}', [TeamController::class, 'destroy']);
});

// Routes for version 1 Task
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

    Route::get('/tasks-by-owner', [TaskController::class, 'getTaskByOwner']);
    Route::get('/tasks-by-assignee', [TaskController::class, 'getTaskByAssignee']);
});

// Routes for version 1 Project
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::put('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

    Route::get('/projects-by-owner', [ProjectController::class, 'getProjectByOwner']);
    Route::get('/projects-by-member', [ProjectController::class, 'getProjectByMember']);
});


// Routes for version 1 Milestone
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/milestones', [MileStoneController::class, 'index']);
    Route::post('/milestones', [MileStoneController::class, 'store']);
    Route::get('/milestones/{milestone}', [MileStoneController::class, 'show']);
    Route::put('/milestones/{milestone}', [MileStoneController::class, 'update']);
    Route::delete('/milestones/{milestone}', [MileStoneController::class, 'destroy']);
});

// Routes for version 1 Project Stage
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/project-stages', [ProjectStageController::class, 'index']);
    Route::post('/project-stages', [ProjectStageController::class, 'store']);
    Route::get('/project-stages/{project-stage}', [ProjectStageController::class, 'show']);
    Route::put('/project-stages/{project-stage}', [ProjectStageController::class, 'update']);
    Route::delete('/project-stages/{project-stage}', [ProjectStageController::class, 'destroy']);
});

// Routes for version 1 Project Member
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/project-members', [ProjectMemberController::class, 'index']);
    Route::post('/project-members', [ProjectMemberController::class, 'store']);
    Route::get('/project-members/{prject-member}', [ProjectMemberController::class, 'show']);
    Route::put('/project-members/{prject-member}', [ProjectMemberController::class, 'update']);
    Route::delete('/project-members/{prject-member}', [ProjectMemberController::class, 'destroy']);
});


// Routes for version 1 Team Member
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/team-members', [TeamMemberController::class, 'index']);
    Route::post('/team-members', [TeamMemberController::class, 'store']);
    Route::get('/team-members/{id}', [TeamMemberController::class, 'show']);
    Route::put('/team-members/{id}', [TeamMemberController::class, 'update']);
    Route::delete('/team-members/{id}', [TeamMemberController::class, 'destroy']);
});

// Routes for version 1 Goal
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/goals', [GoalController::class, 'index']);
    Route::post('/goals', [GoalController::class, 'store']);
    Route::get('/goals/{goal}', [GoalController::class, 'show']);
    Route::put('/goals/{goal}', [GoalController::class, 'update']);
    Route::delete('/goals/{goal}', [GoalController::class, 'destroy']);
});


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::get('/organizations/{organization}', [OrganizationController::class, 'show']);
    Route::put('/organizations/{organization}', [OrganizationController::class, 'update']);
    Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy']);
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/org-members', [OrgMemberController::class, 'index']);
    Route::post('/org-members', [OrgMemberController::class, 'store']);
    Route::get('/org-members/{org-member}', [OrgMemberController::class, 'show']);
    Route::put('/org-members/{org-member}', [OrgMemberController::class, 'update']);
    Route::delete('/org-members/{org-member}', [OrgMemberController::class, 'destroy']);
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/organization-metrics', [OrganizationMetricController::class, 'store'])->name('organization-metrics.store');
    Route::get('/organization-metrics/{organization-metric}', [OrganizationMetricController::class, 'show'])->name('organization-metrics.show');
    Route::put('/organization-metrics/{organization-metric}', [OrganizationMetricController::class, 'update'])->name('organization-metrics.update');
    Route::delete('/organization-metrics/{organization-metric}', [OrganizationMetricController::class, 'destroy'])->name('organization-metrics.destroy');
});
