<?php

namespace App\Services\V1;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskQuery {

    protected $safeParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'project_id' => ['eq'],
        'milestone_id' => ['eq'],
        'stage_id' => ['eq'],
        'owner_id' => ['eq'],
        'on_tracking' => ['eq'],
        'task_name' => ['eq', 'like'],
        'description' => ['eq', 'like'],
        'start_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'due_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'task_category' => ['eq', 'like'],
        'work_hour_required' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'work_hour' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'status' => ['eq'],
        'priority' => ['eq'],
        'severity' => ['eq'],
        'tag' => ['eq', 'like'],
        'assignee_id' => ['eq'],
        'assignee_dates' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'complete' => ['eq'],
        'complete_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
    ];

    protected $columnMap = [
        'id' => 'id',
        'project_id' => 'project_id',
        'milestone_id' => 'milestone_id',
        'stage_id' => 'stage_id',
        'owner_id' => 'owner_id',
        'on_tracking' => 'on_tracking',
        'task_name' => 'task_name',
        'description' => 'description',
        'start_date' => 'start_date',
        'due_date' => 'due_date',
        'task_category' => 'task_category',
        'work_hour_required' => 'work_hour_required',
        'work_hour' => 'work_hour',
        'status' => 'status',
        'priority' => 'priority',
        'severity' => 'severity',
        'tag' => 'tag',
        'assignee_id' => 'assignee_id',
        'assignee_dates' => 'assignee_dates',
        'complete' => 'complete',
        'complete_date' => 'complete_date',
    ];



    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
        'like' => 'like',
    ];

    public function transform(Request $request)
    {

        $eloQuery = Task::query();

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery->where($column, $this->operatorMap[$operator], $query[$operator]);
                }
            }
        }

        return $eloQuery;

    }
}
