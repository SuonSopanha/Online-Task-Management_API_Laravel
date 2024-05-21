<?php

namespace App\Services\V1;


use App\Models\Project;
use Illuminate\Http\Request;

class ProjectQuery
{

    protected $safeParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'project_name' => ['eq', 'like'],
        'owner_id' => ['eq'],
        'start_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'end_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'organization_id' => ['eq', 'like'],
        'project_status' => ['eq'],
        'project_priority' => ['eq'],
    ];



    protected $columnMap = [
        'id' => 'id',
        'project_name' => 'project_name',
        'owner_id' => 'owner_id',
        'start_date' => 'start_date',
        'end_date' => 'end_date',
        'organization_id' => 'organization_id',
        'project_status' => 'project_status',
        'project_priority' => 'project_priority',
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
        $eloQuery = Project::query();

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
