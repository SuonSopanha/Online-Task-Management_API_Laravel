<?php

namespace App\Services\V1;


use App\Models\ProjectMember;
use Illuminate\Http\Request;


class ProjectMemberQuery
{

    protected $safeParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'project_id' => ['eq'],
        'user_id' => ['eq'],
        'role' => ['eq', 'like'],
    ];

    protected $columnMap = [
        'id' => 'id',
        'project_id' => 'project_id',
        'user_id' => 'user_id',
        'role' => 'role',
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
        $eloQuery = ProjectMember::query();

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);
            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;
            foreach ($operators as $operator) {
                $eloQuery->where($column, $this->operatorMap[$operator] ?? $operator, $query);
            }
        }

        return $eloQuery;

    }



}
