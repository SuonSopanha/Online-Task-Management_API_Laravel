<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user), // Replace this with the correct resource class $this->user_id,
            'role' => $this->role,
            'assigned_tasks' => $this->assigned_tasks,
            'completed_task' => $this->completed_tasks,
            'overdue_tasks' => $this->overdue_tasks,
            'worked_hour' => $this->worked_hour

        ];
    }
}
