<?php

namespace App\Services\V1;

use App\Models\ProjectStage;
use Illuminate\Http\Request;

class ProjectStageQuery
{
    protected $safeParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'project_id' => ['eq'],
        'stage_name' => ['eq', 'like'],
        'start_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'period' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'end_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'completed' => ['eq'],
        'completion_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
    ];

    protected $columnMap = [
        'id' => 'id',
        'project_id' => 'project_id',
        'stage_name' => 'stage_name',
        'start_date' => 'start_date',
        'period' => 'period',
        'end_date' => 'end_date',
        'completed' => 'completed',
        'completion_date' => 'completion_date',
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
        $eloQuery = ProjectStage::query();

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);
            if ($query) {
                $column = $this->columnMap[$param] ?? $param;
                foreach ($operators as $operator) {
                    $eloQuery->where($column, $this->operatorMap[$operator], $query);
                }
            }
        }
        return $eloQuery;
    }
}
