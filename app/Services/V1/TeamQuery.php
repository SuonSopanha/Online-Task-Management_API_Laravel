<?php

namespace App\Services\V1;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamQuery
{

    protected $safeParams = [
        'id' => ['eq'],
        'name' => ['eq'],
        'description' => ['eq'],
        'created_at' => ['eq', 'gt', 'lt'],
        'updated_at' => ['eq', 'gt', 'lt'],
    ];


    protected $columnMap = [
        'id' => 'id',
        'name' => 'name',
        'description' => 'description',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];


    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
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
