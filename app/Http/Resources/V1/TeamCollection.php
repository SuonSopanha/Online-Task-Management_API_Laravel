<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TeamCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }

    public function toArray(Request $request): array
     {
        // return parent::toArray($request);
        return [
            
            $this->collection->map(function ($team){
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
