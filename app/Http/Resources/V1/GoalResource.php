<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'id' => $this->id,
            'team_id' => $this->team_id,
            'goal_name' => $this->goal_name,
            'description' => $this->description,
            'completed' => $this->completed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at            
        ];
        
    }
}
