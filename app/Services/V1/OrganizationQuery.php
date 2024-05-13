<?php

namespace App\Services\V1;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationQuery {

    protected $safeParams = [
        'id' => ['eq'],
        'name' => ['eq', 'like'],
        'industry' => ['eq', 'like'],
        'owner_id' => ['eq'],
    ];

    protected $columnMap = [
        'id' => 'id',
        'name' => 'name',
        'industry' => 'industry',
        'owner_id' => 'owner_id',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'like' => 'like',
    ];

    public function transform(Request $request)
    {
        $eloQuery = Organization::query();

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);
            if (!isset($query)) {
                continue;
            }
            $column = $this->columnMap[$param] ?? $param;
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $value = $operator === 'like' ? '%' . $query[$operator] . '%' : $query[$operator];
                    $eloQuery->where($column, $this->operatorMap[$operator] ?? $operator, $value);
                }
            }
        }

        return $eloQuery;
    }
}
