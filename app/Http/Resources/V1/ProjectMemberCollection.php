<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectMemberCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [

        //     $this->collection->map(function ($projectMember) {

        //         return [
        //             'id' => $projectMember->id,
        //             'project_id' => $projectMember->project_id,
        //             'user_id' => $projectMember->user_id,
        //             'role' => $projectMember->role,

        //         ];
        //     }),
        // ];

        // $table->integer('assigned_tasks')->default(0);
        // $table->integer('completed_tasks')->default(0);
        // $table->integer('overdue_tasks')->default(0);
        // $table->integer('worked_hour')->default(0);

        return $this->collection->map(function ($projectMember) {
            return [
                'id' => $projectMember->id,
                'project_id' => $projectMember->project_id,
                'user_id' => $projectMember->user_id,
                'user' =>new UserResource( $projectMember->user),
                'role' => $projectMember->role,
                'assigned_tasks' => $projectMember->assigned_tasks,
                'completed_task' => $projectMember->completed_tasks,
                'overdue_tasks' => $projectMember->overdue_tasks,
                'worked_hour' => $projectMember->worked_hour
            ];
        })->toArray();
    }
}
