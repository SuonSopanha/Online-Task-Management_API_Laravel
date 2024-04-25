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
        return [

            $this->collection->map(function ($projectMember) {

                return [
                    'id' => $projectMember->id,
                    'project_id' => $projectMember->project_id,
                    'user_id' => $projectMember->user_id,
                    'role' => $projectMember->role,
                    'create_at' => $projectMember->create_at->format('Y-m-d H:i:s'),
                    'update_at' => $projectMember->update_at->format('Y-m-d H:i:s')
                ];
            }),
        ];
    }
}
