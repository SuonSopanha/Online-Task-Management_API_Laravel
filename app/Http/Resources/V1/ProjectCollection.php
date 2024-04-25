<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     $this->collection->map(function ($project) {
        //         return [
        //             'id' => $project->id,
        //             'project_name' => $project->project_name,
        //             'onwer_id' => $project->onwer_id,
        //             'start_date' => $project->start_date,
        //             'end_date' => $project->end_date,
        //             'team_id' => $project->team_id,
        //             'project_status' => $project->project_status,
        //             'project_priority' => $project->project_priority,

        //         ];
        //     }),
        // ];

        return $this->collection->map(function ($project) {
            return [
                'id' => $project->id,
                'project_name' => $project->project_name,
                'onwer_id' => $project->onwer_id,
                'start_date' => $project->start_date,
                'end_date' => $project->end_date,
                'team_id' => $project->team_id,
                'project_status' => $project->project_status,
                'project_priority' => $project->project_priority,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ];
        })->toArray();
    }
}
