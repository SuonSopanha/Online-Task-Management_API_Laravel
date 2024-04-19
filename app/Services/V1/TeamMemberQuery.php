<?php

namespace App\Services\V1;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberQuery {

    protected $safeParams = [
        'user_id' => ['eq'],
        'team_id' => ['eq'],
    ];

    protected $columnMap = [
        'user_id' => 'user_id',
        'team_id' => 'team_id',
    ];

    protected $operatorMap = [
        'eq' => '=',
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
