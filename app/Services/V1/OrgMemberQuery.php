<?php

namespace App\Services\V1;

use App\Models\OrgMember;
use Illuminate\Http\Request;

class OrgMemberQuery
{

    protected $safeParams = [
        'id' => ['eq'],
        'user_id' => ['eq'],
        'org_id' => ['eq'],
        'role' => ['eq', 'like'],
        'is_admin' => ['eq'],
        'assigned_tasks' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'completed_tasks' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'overdue_tasks' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'worked_hour' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected $columnMap = [
        'id' => 'id',
        'user_id' => 'user_id',
        'org_id' => 'org_id',
        'role' => 'role',
        'is_admin' => 'is_admin',
        'assigned_tasks' => 'assigned_tasks',
        'completed_tasks' => 'completed_tasks',
        'overdue_tasks' => 'overdue_tasks',
        'worked_hour' => 'worked_hour',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'like' => 'like',
    ];

    public function transform(Request $request)
    {

        $eloQuery = OrgMember::query();

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
