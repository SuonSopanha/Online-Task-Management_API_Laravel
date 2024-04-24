<?php

namespace App\Services\V1;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamQuery
{

    protected $safeParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'name' => ['eq', 'like'],
        'description' => ['eq', 'like'],
        'owner_id' => ['eq'],
    ];


    protected $columnMap = [
        'id' => 'id',
        'name' => 'name',
        'description' => 'description',
        'owner_id' => 'owner_id',
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
        $eloQuery = Team::query();

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
