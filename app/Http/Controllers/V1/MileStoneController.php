<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreMileStoneRequest;
use App\Http\Requests\V1\UpdateMileStoneRequest;
use App\Services\V1\MileStoneQuery;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Milestone;
use App\Http\Resources\V1\MileStoneCollection;
use App\Http\Resources\V1\MileStoneResource;

class MileStoneController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $milestones = Milestone::where('owner_id',auth()->user()->id)->get();
        return $this->success(new MileStoneCollection($milestones));
    }

    // public function store(StoreMileStoneRequest $request)
    // {
    //     $validatedData = $request->validate();

    //     $milestones = Milestone::create($validatedData);
    //     return $this->success(new MileStoneResource($milestones));
    // }

    public function store(StoreMileStoneRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['owner_id'] = auth()->user()->id;
        $milestones = MileStone::create($validatedData);
        return $this->success(new MileStoneResource($milestones));
    }

    public function show($id)
    {
        $milestones = Milestone::find($id);

        if (!$milestones) {
            return $this->error(null, 'MileStone not found', 404);
        }
        return $this->success(new MileStoneResource($milestones));
    }

    public function update(UpdateMileStoneRequest $request, Milestone $milestone )
    {

        $this->authorize('update', $milestone);

        $validatedData = $request->validated();
        $milestone->update($validatedData);

        return $this->success([]);
    }

    public function destroy(Milestone $milestone )
    {

        $this->authorize('delete', $milestone);
        $milestone->delete();

        return $this->success(null, 'MileStone deleted successfully');
    }


}
