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
            'data' => $this->collection->map(function ($teamMember) {
                return [
                    'id' => $teamMember->id,
                    'email' => $teamMember->email,
                    'full_name' => $teamMember->full_name,
                    'photo_url' => $teamMember->photo_url,
                ];
            }),
        ];
    }
}

