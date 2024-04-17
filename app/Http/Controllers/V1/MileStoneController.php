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

    public function index(Request $request)
    {
        $filter = new MileStoneQuery();
        $query = $filter->transform($request, MileStone::class); // Get the filtered query
        $milestones = $query->get(); // Retrieve the filtered data without pagination
        return $this->success(new MileStoneCollection($milestones));
    }

    public function store(StoreMileStoneRequest $request)
    {
        $request->validate();

        $milestones = MileStone::create($request->all());
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

    public function update(UpdateMileStoneRequest $request, $id)
    {
        $milestones = MileStone::find($id);

        if (!$milestones) {
            return $this->error(null, 'MileStone not found', 404);
        }
        $milestones->update($request->all());

        return $this->success([]);
    }

    public function destroy($id)
    {
        $milestones = MileStone::find($id);

        if (!$milestones) {
            return $this->error(null, 'MileStone not found', 404);
        }
        $milestones->delete();

        return $this->success(null, 'MileStone deleted successfully');
    }


}
