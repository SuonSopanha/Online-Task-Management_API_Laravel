<?php

namespace App\Http\Controllers\V1;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreTaskRequest;
use App\Http\Requests\V1\UpdateTaskRequest;
use App\Http\Resources\V1\TaskCollection;
use App\Http\Resources\V1\TaskResource;
use App\Services\V1\TaskQuery;


class TaskController extends Controller
{
    use HttpResponses;

    // Get all tasks    // Get all tasks
    public function index(Request $request)
    {
        $filter = new TaskQuery();
        $query = $filter->transform($request, Task::class); // Get the filtered query

        // Get the filtered tasks
        $tasks = $query->get(); // Retrieve the filtered data without pagination
        // Return the filtered tasks
        return $this->success(new TaskCollection($tasks));
    }
    // Create a new task
    public function store(StoreTaskRequest $request)
    {
        $request->validate();

        $task = Task::create($request->all());

        return $this->success(new TaskResource($task));
    }

    // Get a task by ID
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->error(null, 'Task not found', 404);
        }

        return $this->success(new TaskResource($task));
    }

    // Update a task
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->error(null, 'Task not found', 404);
        }

        $request->validated();

        $task->update($request->all());

        return $this->success(new TaskResource($task));
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->error(null, 'Task not found', 404);
        }

        $task->delete();

        return $this->success(null, 'Task deleted successfully');
    }

    // Get tasks by owner ID
    // public function getTaskbyOwnerID($owner_id)
    // {
    //     $tasks = new TaskCollection(Task::where('owner_id', $owner_id)->get());
    //     return $this->success($tasks);
    // }

    // // Get tasks by assignee ID
    // public function getTaskbyAssigneeID($assignee_id)
    // {
    //     $tasks = new TaskCollection(Task::where('assignee_id', $assignee_id)->get());
    //     return $this->success($tasks);
    // }

    // // Get tasks by project ID
    // public function getTaskbyProjectID($project_id)
    // {
    //     $tasks = new TaskCollection(Task::where('project_id', $project_id)->get());
    //     return $this->success($tasks);
    // }
}
