<?php

namespace App\Services\V1;

use App\Models\MileStone;
use Illuminate\Http\Request;


class MileStoneQuery{

    protected $safeParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'milestone_name' => ['eq', 'like'],
        'start_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
        'end_date' => ['eq', 'lt', 'lte', 'gt', 'gte', 'ne'],
    ];

    protected $columnMap = [
        'id' => 'id',
        'milestone_name' => 'milestone_name',
        'start_date' => 'start_date',
        'end_date' => 'end_date',
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

    public function transform(Request $request){

        $eloQuery = MileStone::query();

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
