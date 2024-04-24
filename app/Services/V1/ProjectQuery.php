<?php

namespace App\Services\V1;


use App\Models\Project;
use Illuminate\Http\Request;

class ProjectQuery
{

   protected $safeParams = [
    'id' => ['eq'],
    'name' => ['eq'],
    'description' => ['eq'],
    'created_at' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    'updated_at' => ['eq', 'lt', 'gt', 'lte', 'gte'],
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
    $eloQuery = Project::query();

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
