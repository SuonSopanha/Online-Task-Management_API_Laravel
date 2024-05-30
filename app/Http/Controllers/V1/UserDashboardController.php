<?php

namespace App\Http\Controllers\V1;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');

    }

    public function taskStatusMetrics(){

        //get all task of user that have owner_id or assignee_id
        $tasks = Task::where('owner_id', auth()->user()->id)
        ->orWhere('assignee_id', auth()->user()->id)
        ->get();

        //get the tasks that have status = Completed
        $completedTasks = $tasks->where('status', 'Completed')->count();
        //get the tasks that have status = In Progress
        $inProgressTasks = $tasks->where('status', 'In Progress')->count();
        //get the tasks that have status = Not Started
        $notStartedTasks = $tasks->where('status', 'Pending')->count();
        //get the tasks that have status = Deferred
        $deferredTasks = $tasks->where('status', 'Overdue')->count();


        return response()->json([
            'completedTasks' => $completedTasks,
            'inProgressTasks' => $inProgressTasks,
            'notStartedTasks' => $notStartedTasks,
            'deferredTasks' => $deferredTasks
        ], 200);
    }

    public function taskPriorityMetrics(){
        //get all task of user that have owner_id or assignee_id
        $tasks = Task::where('owner_id', auth()->user()->id)
        ->orWhere('assignee_id', auth()->user()->id)
        ->get();

        //get the tasks that have priority = High
        $highPriorityTasks = $tasks->where('priority', 'High')->count();
        //get the tasks that have priority = Medium
        $mediumPriorityTasks = $tasks->where('priority', 'Medium')->count();
        //get the tasks that have priority = Low
        $lowPriorityTasks = $tasks->where('priority', 'Low')->count();

        $criticalPriorityTasks = $tasks->where('priority', 'Critical')->count();


        return response()->json([
            'highPriorityTasks' => $highPriorityTasks,
            'mediumPriorityTasks' => $mediumPriorityTasks,
            'lowPriorityTasks' => $lowPriorityTasks,
            'criticalPriorityTasks' => $criticalPriorityTasks
        ], 200);


    }


    public function taskDueDateMetrics(){

        //get all task of user that have owner_id or assignee_id
        $tasks = Task::where('owner_id', auth()->user()->id)
        ->orWhere('assignee_id', auth()->user()->id)
        ->get();

        //different due date by month
        $dueDateByMonth = $tasks->groupBy(function($task){
            return Carbon::parse($task->due_date)->format('F');
        })->map(function($tasks){
            return $tasks->count();
        })->toArray();


        return response()->json([

        ], 200);
    }




}
