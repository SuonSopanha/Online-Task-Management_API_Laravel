<?php

namespace App\Services\V1;

use App\Models\Goal;
use Illuminate\Http\Request;


class GoalQuery
{

    protected $safeParams = [
        'id' => ['eq'],

    ];

    protected $columnMap = [
        'id' => 'id'
    ];


    protected $operatorMap = [
        'eq' => '=',
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
