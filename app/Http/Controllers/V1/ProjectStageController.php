<?php

namespace App\Http\Controllers\V1;

use App\Models\ProjectStage;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Services\V1\ProjectStageQuery;
use App\Http\Resources\V1\ProjectStageResource;
use App\Http\Resources\V1\ProjectStageCollection;
use App\Http\Requests\V1\StoreProjectStageRequest;

class ProjectStageController extends Controller
{
    use HttpResponses;

    public function index(Request $request){

        $filter = new ProjectStageQuery();
        $query = $filter->transform($request);

        $project_stage = $query->get();

        return $this->success(new ProjectStageCollection($project_stage));

    }

    public function store(StoreProjectStageRequest $request){

        $request->validate();

        $project_stage = ProjectStage::create($request->all());

        return $this->success(new ProjectStageResource($project_stage));

    }

    public function show($id)
    {

        $project_stage = ProjectStage::find($id);

        if (!$project_stage) {
            return $this->error(null, 'Project Stage not found', 404);
        }

        return $this->success(new ProjectStageResource($project_stage));
    }

    public function update(Request $request, $id){

        $project_stage = ProjectStage::find($id);

        if(!$project_stage){
            return $this->error(null, 'Project Stage not found', 404);
        }

        $project_stage->update($request->all());

        return $this->success(new ProjectStageResource($project_stage));

    }

    public function destroy($id){

        $project_stage = ProjectStage::find($id);

        if(!$project_stage){
            return $this->error(null, 'Project Stage not found', 404);
        }

        $project_stage->delete();

        return $this->success(null, 'Project Stage deleted');

    }

}
