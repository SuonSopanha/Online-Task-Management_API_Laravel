<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\V1\GoalQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreGoalRequest;
use App\Http\Requests\V1\UpdateGoalRequest;
use App\Http\Resources\V1\GoalCollection;
use App\Http\Resources\V1\GoalResource;
use App\Models\Goal;

class GoalController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $filter = new GoalQuery();
        $query = $filter->transform($request);


        $goal = $query->get();

        return $this->success(new GoalCollection($goal));
    }

    public function store(StoreGoalRequest $request){
        $validatedData = $request->validated();

        $goal = Goal::create($validatedData);
        return $this->success(new GoalResource($goal));

    }

    public function show($id){

        $goal = Goal::find($id);

        if(!$goal){
            return $this->error('', 'Goal not found', 404);
        }

        return $this->success(new GoalResource($goal));

    }

    public function update(UpdateGoalRequest $request,Goal $goal){

        $this->authorize('update', $goal);

        $validatedData = $request->validated();

        $goal->update($validatedData);

        return $this->success(new GoalResource($goal));

    }

    public function destroy(Goal $goal){

        $this->authorize('delete', $goal);
        $goal->delete();

        return $this->success(null,'Goal deleted successfully');

    }
}
