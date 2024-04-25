<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            $this->resource->map(function ($team){
                return [
                    'id' => $team->id,
                    'name' => $team->name,
                    'description' => $team->description,
                    'owner_id' => $team->owner_id
                ];
            }),
        ];
    }
}
