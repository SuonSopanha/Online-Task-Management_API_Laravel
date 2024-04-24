<?php

namespace App\Services\V1;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberQuery {

    protected $safeParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'team_id' => ['eq'],
        'user_id' => ['eq'],
        'role' => ['eq', 'like'],
    ];

    protected $columnMap = [
        'id' => 'id',
        'team_id' => 'team_id',
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
        $eloQuery = TeamMember::query();

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
