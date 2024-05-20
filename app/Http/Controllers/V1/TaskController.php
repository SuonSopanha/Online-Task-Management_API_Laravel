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

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Get all tasks    // Get all tasks
    public function index(Request $request)
    {
        $filter = new TaskQuery();
        $query = $filter->transform($request); // Get the filtered query

        // Get the filtered tasks
        $tasks = $query->get(); // Retrieve the filtered data without pagination
        // Return the filtered tasks
        return $this->success(new TaskCollection($tasks));
    }
    // Create a new task
    public function store(StoreTaskRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['owner_id'] = auth()->user()->id;

        $task = Task::create($validatedData);

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
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $validatedData = $request->validated();
        $task->update($validatedData);

        return $this->success(new TaskResource($task));
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return $this->success(null, 'Task deleted successfully');
    }

    //custom controller

    //get task by owner_id
    public function getTaskByOwner()
    {
        $task = Task::where('owner_id', auth()->user()->id)->get();
        return $this->success(new TaskCollection($task));
    }

    //get task by assignee_id
    public function getTaskByAssignee()
    {
        $task = Task::where('assignee_id', auth()->user()->id)->get();
        return $this->success(new TaskCollection($task));
    }

}
