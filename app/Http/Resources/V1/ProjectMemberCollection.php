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

        return $this->collection->map(function ($projectMember) {
            return [
                'id' => $projectMember->id,
                'project_id' => $projectMember->project_id,
                'user_id' => $projectMember->user_id,
                'full_name' => $projectMember->user->full_name,
                'photo_url' => $projectMember->user->photo_url,
                'email' => $projectMember->user->email,
                'role' => $projectMember->role,
            ];
        })->toArray();
    }
}
