<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectStageResource extends JsonResource
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
        'project_id' => $this->project_id,
        'stage_name' => $this->stage_name,
        'start_date' => $this->start_date,
        'period' => $this->period,
        'end_date' => $this->end_date,
        'completed' => $this->completed,
        'completion_date' => $this->completion_date,

       ];
    }
}
