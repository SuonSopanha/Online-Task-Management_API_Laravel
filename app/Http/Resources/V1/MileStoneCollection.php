<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MileStoneCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            $this->collection->map(function ($milestone) {
                return [
                    'id' => $milestone->id,
                    'milestone_name' => $milestone->milestone_name,
                    'start_date' => $milestone->start_date,
                    'end_date' => $milestone->end_date,
                    'created_at' => $milestone->created_at,
                    'updated_at' => $milestone->updated_at
                ];
            }),
        ];
    }
}
