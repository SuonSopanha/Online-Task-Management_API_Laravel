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
                    'id' => $this->id,
                    'name' => $this->name,
                    'description' => $this->description,
                    'owner_id' => $this->owner_id,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ];
            }),
        ];
     }
}
