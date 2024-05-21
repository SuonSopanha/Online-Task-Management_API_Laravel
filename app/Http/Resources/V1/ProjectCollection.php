<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

class ProjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($project) {
            return [
                'id' => $project->id,
                'project_name' => $project->project_name,
                'owner_id' => $project->owner_id,
                'start_date' => Carbon::parse($project->start_date)->format('m/d/Y'),
                'end_date' => Carbon::parse($project->end_date)->format('m/d/Y'),
                'organization_id' => $project->organization_id,
                'project_status' => $project->project_status,
                'project_priority' => $project->project_priority,
            ];
        })->toArray();
    }
}
