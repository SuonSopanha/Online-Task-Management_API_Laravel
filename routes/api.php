<?php

use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


// Routes for version 1 User
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// Routes for version 1 Team
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/teams', [TeamController::class, 'index']);
    Route::post('/teams', [TeamController::class, 'store']);
    Route::get('/teams/{id}', [TeamController::class, 'show']);
    Route::put('/teams/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
});

// Routes for version 1 Task
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});

// Routes for version 1 Project
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
});


// Routes for version 1 Milestone
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/milestones', [MileStoneController::class, 'index']);
    Route::post('/milestones', [MileStoneController::class, 'store']);
    Route::get('/milestones/{id}', [MileStoneController::class, 'show']);
    Route::put('/milestones/{id}', [MileStoneController::class, 'update']);
    Route::delete('/milestones/{id}', [MileStoneController::class, 'destroy']);
});

// Routes for version 1 Project Stage
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/project-stages', [ProjectStageController::class, 'index']);
    Route::post('/project-stages', [ProjectStageController::class, 'store']);
    Route::get('/project-stages/{id}', [ProjectStageController::class, 'show']);
    Route::put('/project-stages/{id}', [ProjectStageController::class, 'update']);
    Route::delete('/project-stages/{id}', [ProjectStageController::class, 'destroy']);
});

// Routes for version 1 Project Member
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/project-members', [ProjectMemberController::class, 'index']);
    Route::post('/project-members', [ProjectMemberController::class, 'store']);
    Route::get('/project-members/{id}', [ProjectMemberController::class, 'show']);
    Route::put('/project-members/{id}', [ProjectMemberController::class, 'update']);
    Route::delete('/project-members/{id}', [ProjectMemberController::class, 'destroy']);
});


// Routes for version 1 Team Member
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/team-members', [TeamMemberController::class, 'index']);
    Route::post('/team-members', [TeamMemberController::class, 'store']);
    Route::get('/team-members/{id}', [TeamMemberController::class, 'show']);
    Route::put('/team-members/{id}', [TeamMemberController::class, 'update']);
    Route::delete('/team-members/{id}', [TeamMemberController::class, 'destroy']);
});

// Routes for version 1 Goal
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/goals', [GoalController::class, 'index']);
    Route::post('/goals', [GoalController::class, 'store']);
    Route::get('/goals/{id}', [GoalController::class, 'show']);
    Route::put('/goals/{id}', [GoalController::class, 'update']);
    Route::delete('/goals/{id}', [GoalController::class, 'destroy']);
});


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::get('/organizations/{id}', [OrganizationController::class, 'show']);
    Route::put('/organizations/{id}', [OrganizationController::class, 'update']);
    Route::delete('/organizations/{id}', [OrganizationController::class, 'destroy']);
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::get('/org-members', [OrgMemberController::class, 'index']);
    Route::post('/org-members', [OrgMemberController::class, 'store']);
    Route::get('/org-members/{id}', [OrgMemberController::class, 'show']);
    Route::put('/org-members/{id}', [OrgMemberController::class, 'update']);
    Route::delete('/org-members/{id}', [OrgMemberController::class, 'destroy']);
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1','middleware' => 'auth:sanctum'], function () {
    Route::post('/organization-metrics', [OrganizationMetricController::class, 'store'])->name('organization-metrics.store');
    Route::get('/organization-metrics/{id}', [OrganizationMetricController::class, 'show'])->name('organization-metrics.show');
    Route::put('/organization-metrics/{id}', [OrganizationMetricController::class, 'update'])->name('organization-metrics.update');
    Route::delete('/organization-metrics/{id}', [OrganizationMetricController::class, 'destroy'])->name('organization-metrics.destroy');
});


