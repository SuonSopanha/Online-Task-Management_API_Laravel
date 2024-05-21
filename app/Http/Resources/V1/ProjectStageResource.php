<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
        'start_date' =>Carbon::parse($this->start_date)->format('m/d/y') ,
        'period' => $this->period,
        'end_date' => Carbon::parse($this->end_date)->format('m/d/y'),
        'completed' => $this->completed,
        'completion_date' => $this->completion_date ? Carbon::parse($this->complete_date)->format('m/d/y') : null

       ];
    }
}
