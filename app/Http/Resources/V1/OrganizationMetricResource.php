<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationMetricResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'organization_id' => $this->organization_id,
            'total_users' => $this->total_users,
            'active_users' => $this->active_users,
            'projects_created' => $this->projects_created,
            'projects_completed' => $this->projects_completed,
            'projects_in_progress' => $this->projects_in_progress,
            'average_project_completion_time' => $this->average_project_completion_time,
            'total_tasks' => $this->total_tasks,
            'completed_tasks' => $this->completed_tasks,
            'tasks_in_progress' => $this->tasks_in_progress,
            'tasks_overdue' => $this->tasks_overdue,
            'average_task_completion_time' => $this->average_task_completion_time,
        ];
    }
}
