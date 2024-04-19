<?php

namespace App\Http\Controllers\V1;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Services\V1\TeamMemberQuery;
use App\Http\Resources\V1\TeamMemberResource;
use App\Http\Resources\V1\TeamMemberCollection;
use App\Http\Requests\V1\StoreTeamMemberRequest;
use App\Http\Requests\V1\UpdateTeamMemberRequest;

class TeamMemberController extends Controller
{
    use HttpResponses;

    public function index(Request $request){

        $filter = new TeamMemberQuery();
        $query = $filter->transform($request);

        $task_member = $query->get();

        return $this->success(new TeamMemberCollection($task_member));

    }

    public function store(StoreTeamMemberRequest $request){

        $request->validate();

        $task_member = TeamMember::create($request->all());


        return $this->success(new TeamMemberResource($task_member));


    }

    public function show($id){
        $team_member = TeamMember::findOrFail($id);

        if(!$team_member){
            return $this->error('', 'Team member not found', 404);
        }

        return $this->success(new TeamMemberResource($team_member));

    }

    public function update(UpdateTeamMemberRequest $request, $id){

        $team_member = TeamMember::find($id);

        if(!$team_member){
            return $this->error('', 'Team member not found', 404);
        }

        $team_member->update($request->all());


        return $this->success(new TeamMemberResource($team_member));



    }

    public function destroy($id){

        $team_member = TeamMember::find($id);

        if(!$team_member){
            return $this->error('', 'Team member not found', 404);
        }

        $team_member->delete();

        return $this->success([], 'Team member deleted successfully');

    }


}
