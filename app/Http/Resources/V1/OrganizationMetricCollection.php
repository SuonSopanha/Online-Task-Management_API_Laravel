<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganizationMetricsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($organizationMetrics) {
            return [
                'id' => $organizationMetrics->id,
                'organization_id' => $organizationMetrics->organization_id,
                'total_users' => $organizationMetrics->total_users,
                'active_users' => $organizationMetrics->active_users,
                'projects_created' => $organizationMetrics->projects_created,
                'projects_completed' => $organizationMetrics->projects_completed,
                'projects_in_progress' => $organizationMetrics->projects_in_progress,
                'average_project_completion_time' => $organizationMetrics->average_project_completion_time,
                'total_tasks' => $organizationMetrics->total_tasks,
                'completed_tasks' => $organizationMetrics->completed_tasks,
                'tasks_in_progress' => $organizationMetrics->tasks_in_progress,
                'tasks_overdue' => $organizationMetrics->tasks_overdue,
                'average_task_completion_time' => $organizationMetrics->average_task_completion_time,
            ];
        })->toArray();
    }
}
