<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        // return [
        //     $this->collection->map(function ($task) {
        //         return [
        //             'id' => $task->id,
        //             'project_id' => $task->project_id,
        //             'milestone_id' => $task->milestone_id,
        //             'stage_id' => $task->stage_id,
        //             'owner_id' => $task->owner_id,
        //             'on_tracking' => $task->on_tracking,
        //             'task_name' => $task->task_name,
        //             'description' => $task->description,
        //             'start_date' => $task->start_date,
        //             'due_date' => $task->due_date,
        //             'task_category' => $task->task_category,
        //             'work_hour_required' => $task->work_hour_required,
        //             'work_hour' => $task->work_hour,
        //             'status' => $task->status,
        //             'priority' => $task->priority,
        //             'severity' => $task->severity,
        //             'tag' => $task->tag,
        //             'assignee_id' => $task->assignee_id,
        //             'assignee_dates' => $task->assignee_dates,
        //             'complete' => $task->complete,
        //             'complete_date' => $task->complete_date
        //         ];
        //     }),
        // ];


        return $this->collection->map(function ($task) {
            return [
                'id' => $task->id,
                'project_id' => $task->project_id,
                'milestone_id' => $task->milestone_id,
                'stage_id' => $task->stage_id,
                'owner_id' => $task->owner_id,
                'on_tracking' => $task->on_tracking,
                'task_name' => $task->task_name,
                'description' => $task->description,
                'start_date' => $task->start_date,
                'due_date' => $task->due_date,
                'task_category' => $task->task_category,
                'work_hour_required' => $task->work_hour_required,
                'work_hour' => $task->work_hour,
                'status' => $task->status,
                'priority' => $task->priority,
                'severity' => $task->severity,
                'tag' => $task->tag,
                'assignee_id' => $task->assignee_id,
                'assignee_dates' => $task->assignee_dates,
                'complete' => $task->complete,
                'complete_date' => $task->complete_date
            ];
        })->toArray();
    }
}
