<?php

namespace App\Services\V1;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskQuery {

    protected $safeParams = [
        'id' => ['eq'],

    ];

    protected $columnMap = [
        'id' => 'id'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    public function transform(Request $request)
    {

        $eloQuery = Task::query();

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
