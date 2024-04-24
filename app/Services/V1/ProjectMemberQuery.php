<?php

namespace App\Services\V1;


use App\Models\ProjectMember;
use Illuminate\Http\Request;


class ProjectMemberQuery
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
        $eloQuery = ProjectMember::query();

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);
            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;
            foreach ($operators as $operator) {
                $eloQuery->where($column, $this->operatorMap[$operator] ?? $operator, $query);
            }
        }

        return $eloQuery;

    }



}
