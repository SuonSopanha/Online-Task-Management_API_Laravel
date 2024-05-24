<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Models\ProjectMember;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Services\V1\ProjectMemberQuery;
use App\Http\Resources\V1\ProjectMemberResource;
use App\Http\Resources\V1\ProjectMemberCollection;
use App\Http\Requests\V1\StoreProjectMemberRequest;
use App\Http\Requests\V1\UpdateProjectMemberRequest;
use App\Models\Project;

class ProjectMemberController extends Controller
{

    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    public function index(Request $request)
    {
        $filter = new ProjectMemberQuery();
        $query = $filter->transform($request);


        $project_member = $query->with(['user'])->get();

        return $this->success(new ProjectMemberCollection($project_member));
    }


    public function store(StoreProjectMemberRequest $request)
    {
        $validatedData = $request->validated();


        $project_member = ProjectMember::create($validatedData);

        return $this->success(new ProjectMemberResource($project_member));
    }


    public function show($id)
    {
        $project_member = ProjectMember::find($id);

        if (!$project_member) {
            return $this->error('', 'Project member not found', 404);
        }

        return $this->success(new ProjectMemberResource($project_member));
    }


    public function update(UpdateProjectMemberRequest $request, ProjectMember $projectMember)
    {

        $this->authorize('update', $projectMember);
        $validatedData = $request->validated();

        $projectMember->update($validatedData);

        return $this->success(new ProjectMemberResource($projectMember));
    }

    public function destroy(ProjectMember $projectMember)
    {

        $this->authorize('delete', $projectMember);
        $projectMember->delete();

        return $this->success(null, 'Project member deleted successfully');
    }

    public function getMemberByProjectId($id)
    {
        // Assuming 'project_id' is the column name in the 'project_members' table
        $project_members = ProjectMember::where('project_id', $id)
                                        ->with('user') // Load related user data
                                        ->get();

        // Return the result, wrapped in a success response or any other desired format
        return $this->success(new ProjectMemberCollection($project_members));
    }



}
