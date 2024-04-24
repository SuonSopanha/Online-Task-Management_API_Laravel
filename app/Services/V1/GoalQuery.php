<?php

namespace App\Services\V1;

use App\Models\Goal;
use Illuminate\Http\Request;


class GoalQuery
{

    protected $safeParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'team_id' => ['eq'],
        'goal_name' => ['eq', 'like'],
        'description' => ['eq', 'like'],
        'completed' => ['eq'],
    ];

    protected $columnMap = [
        'id' => 'id',
        'team_id' => 'team_id',
        'goal_name' => 'goal_name',
        'description' => 'description',
        'completed' => 'completed',
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
        $eloQuery = Goal::query();

        foreach ($this->safeParams as $param => $operators) {

            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {

                if (isset($query[$operator])) {

                    $eloQuery->where($column, $this->operatorMap[$operator] ?? $operator, $query[$operator]);

                }

            }
        }

        return $eloQuery;

    }


}
