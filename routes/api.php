<?php

use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\GoalController;
use App\Http\Controllers\V1\TaskController;
use App\Http\Controllers\V1\TeamController;
use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\ProjectController;
use App\Http\Controllers\V1\TeamMemberController;
use App\Http\Controllers\V1\ProjectStageController;
use App\Http\Controllers\V1\ProjectMemberController;

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
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// Routes for version 1 Team
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/teams', [TeamController::class, 'index']);
    Route::post('/teams', [TeamController::class, 'store']);
    Route::get('/teams/{id}', [TeamController::class, 'show']);
    Route::put('/teams/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
});

// Routes for version 1 Task
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});

// Routes for version 1 Project
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
});


// Routes for version 1 Milestone
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/milestones', [Milestone::class, 'index']);
    Route::post('/milestones', [Milestone::class, 'store']);
    Route::get('/milestones/{id}', [Milestone::class, 'show']);
    Route::put('/milestones/{id}', [Milestone::class, 'update']);
    Route::delete('/milestones/{id}', [Milestone::class, 'destroy']);
});

// Routes for version 1 Project Stage
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/project-stages', [ProjectStageController::class, 'index']);
    Route::post('/project-stages', [ProjectStageController::class, 'store']);
    Route::get('/project-stages/{id}', [ProjectStageController::class, 'show']);
    Route::put('/project-stages/{id}', [ProjectStageController::class, 'update']);
    Route::delete('/project-stages/{id}', [ProjectStageController::class, 'destroy']);
});

// Routes for version 1 Project Member
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/project-members', [ProjectMemberController::class, 'index']);
    Route::post('/project-members', [ProjectMemberController::class, 'store']);
    Route::get('/project-members/{id}', [ProjectMemberController::class, 'show']);
    Route::put('/project-members/{id}', [ProjectMemberController::class, 'update']);
    Route::delete('/project-members/{id}', [ProjectMemberController::class, 'destroy']);
});


// Routes for version 1 Team Member
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/team-members', [TeamMemberController::class, 'index']);
    Route::post('/team-members', [TeamMemberController::class, 'store']);
    Route::get('/team-members/{id}', [TeamMemberController::class, 'show']);
    Route::put('/team-members/{id}', [TeamMemberController::class, 'update']);
    Route::delete('/team-members/{id}', [TeamMemberController::class, 'destroy']);
});

// Routes for version 1 Goal
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    Route::get('/goals', [GoalController::class, 'index']);
    Route::post('/goals', [GoalController::class, 'store']);
    Route::get('/goals/{id}', [GoalController::class, 'show']);
    Route::put('/goals/{id}', [GoalController::class, 'update']);
    Route::delete('/goals/{id}', [GoalController::class, 'destroy']);
});




