<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

class ProjectStageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     $this->collection->map(function ($projectStage) {
        //         return [
        //             'id' => $projectStage->id,
        //             'project_id' => $projectStage->project_id,
        //             'stage_name' => $projectStage->stage_name,
        //             'start_date' => $projectStage->start_date,
        //             'period' => $projectStage->period,
        //             'end_date' => $projectStage->end_date,
        //             'completed' => $projectStage->completed,
        //             'completion_date' => $projectStage->completion_date,

        //         ];
        //     }),
        // ];


        return $this->collection->map(function ($projectStage) {
            return [
                'id' => $projectStage->id,
                'project_id' => $projectStage->project_id,
                'stage_name' => $projectStage->stage_name,
                'start_date' => Carbon::parse($projectStage->start_date)->format('m/d/Y'),
                'period' => $projectStage->period,
                'end_date' => Carbon::parse($projectStage->end_date)->format('m/d/Y'),
                'completed' => $projectStage->completed,
                'completion_date' => $projectStage->completion_date ? Carbon::parse($projectStage->completion_date)->format('m/d/Y') : null,
            ];
        })->toArray();
    }
}
