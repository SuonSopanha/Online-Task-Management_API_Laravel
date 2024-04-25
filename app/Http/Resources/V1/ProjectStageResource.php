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
        'id' => $user->id,
        'project_id' => $user->project_id,
        'stage_name' => $user->stage_name,
        'start_date' => $user->start_date,
        'period' => $user->period,
        'end_date' => $user->end_date,
        'completed' => $user->completed,
        'completion_date' => $user->completion_date,
        'created_at' => $user->created_at,
        'updated_at' => $user->updated_at
       ];
    }
}
