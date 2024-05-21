<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProjectResource extends JsonResource
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
            'project_name' => $this->project_name,
            'owner_id' => $this->owner_id,
            'start_date' => Carbon::parse($this->start_date)->format('m/d/Y'),
            'end_date' => Carbon::parse($this->end_date)->format('m/d/Y'),
            'organization_id' => $this->organization_id,
            'project_status' => $this->project_status,
            'project_priority' => $this->project_priority,
        ];
    }
}
