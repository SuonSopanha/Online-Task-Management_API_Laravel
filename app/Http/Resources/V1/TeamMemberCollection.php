<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TeamMemberCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [  
            
            $this->collection->map(function ($teamMember) {
                
                return [
                    'id' => $teamMember->id,
                    'team_id' => $teamMember->team_id,
                    'user_id' => $teamMember->user_id,
                    'role' => $teamMember->role,
                    'create_at' => $teamMember->create_at->format('Y-m-d H:i:s'),
                    'update_at' => $teamMember->update_at->format('Y-m-d H:i:s')
                ];
            }),
        ];
    }
}

