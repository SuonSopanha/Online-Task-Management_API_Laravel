<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\V1\GoalQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreGoalRequest;
use App\Http\Requests\V1\UpdateGoalRequest;
use App\Http\Resources\V1\GoalResource;
use App\Models\Goal;

class GoalController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        $filter = new GoalQuery();
        $query = $filter->transform($request);

        $goal = $query->get();

        return $this->success(new GoalResource($goal));
    }

    public function store(StoreGoalRequest $request){
        $request->validate();

        $goal = Goal::create($request->all());
        return $this->success(new GoalResource($goal));

    }

    public function show($id){

        $goal = Goal::find($id);

        if(!$goal){
            return $this->error('', 'Goal not found', 404);
        }

        return $this->success(new GoalResource($goal));

    }

    public function update(UpdateGoalRequest $request, $id){

        $goal = Goal::find($id);

        if(!$goal){
            return $this->error('', 'Goal not found', 404);
        }

        $request->validate();

        $goal->update($request->all());

        return $this->success(new GoalResource($goal));

    }

    public function destroy($id){

        $goal = Goal::find($id);

        if (!$goal){
            return $this->error('', 'Goal not found', 404);
        }

        $goal->delete();

        return $this->success(null,'Goal deleted successfully');

    }
}
