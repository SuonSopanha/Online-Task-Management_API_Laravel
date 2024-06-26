<?php

namespace App\Http\Controllers\V1;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\V1\ProjectQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreProjectRequest;
use App\Http\Requests\V1\UpdateProjectRequest;
use App\Http\Resources\V1\ProjectCollection;
use App\Http\Resources\V1\ProjectResource;

class ProjectController extends Controller
{

    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProjectQuery();
        $query = $filter->transform($request, Project::query());

        $project = $query->get();

        return $this->success(new ProjectCollection($project));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['owner_id'] = auth()->user()->id;


        $project = Project::create($validatedData);

        return $this->success(new ProjectResource($project));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return $this->error('', 'Project not found', 404);
        }

        return $this->success(new ProjectResource($project));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $this->authorize('update', $project);

        $validatedData = $request->validated();

        $project->update($validatedData);

        return $this->success(new ProjectResource($project));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();

        return $this->success(new ProjectResource($project));
    }

    //custom controller

    //get project by owner_id
    public function getProjectByOwner()
    {
        $id = auth()->user()->id;
        $project = Project::where('owner_id', $id)->get();
        return $this->success(new ProjectCollection($project));
    }

    //get project by memmber
    public function getProjectByMember()
    {
        $id = auth()->user()->id;
        $project = Project::whereHas('project_members', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->get();
        return $this->success(new ProjectCollection($project));
    }

    public function getProjectsByOwnerOrMember()
    {
        $userId = auth()->user()->id;

        $projects = Project::where('owner_id', $userId)
            ->orWhereHas('project_members', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();

        return $this->success(new ProjectCollection($projects));
    }
}
