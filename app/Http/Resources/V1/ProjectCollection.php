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
        return [
            $this->collection->map(function ($user) {
                return [
                    'id' => $task->id,
                    'project_name' => $task->project_name,
                    'onwer_id' => $task->onwer_id,
                    'start_date' => $task->start_date,
                    'end_date' => $task->end_date,
                    'team_id' => $task->team_id,
                    'project_status' => $task->project_status,
                    'project_priority' => $task->project_priority,
                    'created_at' => $task->created_at,
                    'updated_at' => $task->updated_at,
                ];
            }),
        ];
    }
}
