<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GoalCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->collection->map(function ($goal){
                return [
                    'id' => $goal->id,
                    'team_id' => $goal->team_id,
                    'goal_name' => $goal->goal_name,
                    'description' => $goal->description,
                    'completed' => $goal->completed
                ];
            }),
        ];
    }

    
}
