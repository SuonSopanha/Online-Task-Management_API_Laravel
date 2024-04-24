<?php

namespace App\Services\V1;

use App\Models\ProjectStage;
use Illuminate\Http\Request;

class ProjectStageQuery
{
    protected $safeParams = [
        'id' => ['eq'],
        'name' => ['eq', 'like']
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
        'ne' => '!='
    ];

    public function transform(Request $request)
    {
        $eloQuery = ProjectStage::query();

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
