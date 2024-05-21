<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreMileStoneRequest;
use App\Http\Requests\V1\UpdateMileStoneRequest;
use App\Services\V1\MileStoneQuery;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\MileStone;
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
        $milestones = MileStone::where('owner_id',auth()->user()->id)->get();
        return $this->success(new MileStoneCollection($milestones));
    }

    // public function store(StoreMileStoneRequest $request)
    // {
    //     $validatedData = $request->validate();

    //     $milestones = MileStone::create($validatedData);
    //     return $this->success(new MileStoneResource($milestones));
    // }

    public function store(StoreMileStoneRequest $request)
    {
        $validatedData = $request->validated();

        $milestones = MileStone::create($validatedData);
        return $this->success(new MileStoneResource($milestones));
    }

    public function show($id)
    {
        $milestones = MileStone::find($id);

        if (!$milestones) {
            return $this->error(null, 'MileStone not found', 404);
        }
        return $this->success(new MileStoneResource($milestones));
    }

    public function update(UpdateMileStoneRequest $request, MileStone $milestone )
    {

        $this->authorize('update', $milestone);

        $validatedData = $request->validated();
        $milestone->update($validatedData);

        return $this->success([]);
    }

    public function destroy(MileStone $milestone )
    {

        $this->authorize('delete', $milestone);
        $milestone->delete();

        return $this->success(null, 'MileStone deleted successfully');
    }


}
