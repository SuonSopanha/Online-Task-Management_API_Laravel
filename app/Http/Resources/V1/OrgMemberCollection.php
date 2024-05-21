<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrgMemberCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($orgMember) {
            return [
                'id' => $orgMember->id,
                'user_id' => $orgMember->user_id,
                'org_id' => $orgMember->org_id,
                'role' => $orgMember->role,
                'is_admin' => $orgMember->is_admin,
                'assigned_tasks' => $orgMember->assigned_tasks,
                'completed_tasks' => $orgMember->completed_tasks,
                'overdue_tasks' => $orgMember->overdue_tasks,
                'worked_hour' => $orgMember->worked_hour,
            ];
        })->toArray();
    }
}
