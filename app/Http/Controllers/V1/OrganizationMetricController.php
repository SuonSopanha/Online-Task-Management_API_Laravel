<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\OrganizationMetric;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrganizationMetricResource;
use App\Http\Requests\V1\StoreOrganizationMetricRequest;
use App\Http\Requests\V1\UpdateOrganizationMetricRequest;

class OrganizationMetricController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(StoreOrganizationMetricRequest $request){
        $validatedData = $request->validated();

        $organization_metric = OrganizationMetric::create($validatedData);

        return $this->success(new OrganizationMetricResource($organization_metric));

    }

    public function show($id){
        $organization_metric = OrganizationMetric::find($id);

        if(!$organization_metric){
            return $this->error(null, 'Organization metric not found', 404);
        }

        return $this->success(new OrganizationMetricResource($organization_metric));
    }

    public function update(UpdateOrganizationMetricRequest $request, OrganizationMetric $organizationMetric){

        $this->authorize('update', $organizationMetric);
        $validatedData = $request->validated();
        $organizationMetric->update($validatedData);

        return $this->success(new OrganizationMetricResource($organizationMetric));
    }

    public function destroy(OrganizationMetric $organizationMetric){

        $this->authorize('delete', $organizationMetric);
        $organizationMetric->delete();

        return $this->success(null, 'Organization metric deleted');
    }

}
