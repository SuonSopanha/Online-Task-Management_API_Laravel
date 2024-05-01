<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MileStoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'milestone_name' => $this->milestone_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'owner_id' => $this->owner_id
        ];
    }
}
