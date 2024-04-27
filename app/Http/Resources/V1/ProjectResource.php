<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'project_name' => $this->project_name,
            'owner_id' => $this->owner_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'team_id' => $this->team_id,
            'project_status' => $this->project_status,
            'project_priority' => $this->project_priority,

        ];
     }
}
