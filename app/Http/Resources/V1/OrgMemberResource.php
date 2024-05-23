<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrgMemberResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user), // Replace this with the correct resource class $this->user_id,
            'org_id' => $this->org_id,
            'role' => $this->role,
            'is_admin' => $this->is_admin,
            'assigned_tasks' => $this->assigned_tasks,
            'completed_tasks' => $this->completed_tasks,
            'overdue_tasks' => $this->overdue_tasks,
            'worked_hour' => $this->worked_hour,
        ];
    }
}
