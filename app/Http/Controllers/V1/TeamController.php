<?php

namespace App\Http\Controllers\V1;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\V1\TeamQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TeamResource;
use App\Http\Resources\V1\TeamCollection;
use App\Http\Requests\V1\StoreTeamRequest;
use App\Http\Requests\V1\UpdateTeamRequest;

class TeamController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $filter = new TeamQuery();
        $query = $filter->transform($request);


        $team = $query->get();


        return $this->success(new TeamCollection($team));

    }

    public function store(StoreTeamRequest $request){

        $validatedData = $request->validated();
        $validatedData['owner_id'] = auth()->user()->id;

        $team = Team::create($validatedData);

        return $this->success(new TeamResource($team));

    }


    public function show($id){
        $team = Team::find($id);

        if (!$team) {
            return $this->error('', 'Team not found', 404);
        }

        return $this->success(new TeamResource($team));


    }

    public function update(UpdateTeamRequest $request, $id){
        $team = Team::find($id);

        if (!$team) {
            return $this->error('', 'Team not found', 404);
        }

        $validatedData = $request->validated();

        $team->update($validatedData);

        return $this->success(new TeamResource($team));

    }

    public function destroy($id){

        $team = Team::find($id);

        if (!$team) {
            return $this->error('', 'Team not found', 404);
        }

        $team->delete();

        return $this->success(new TeamResource($team));

    }

}
