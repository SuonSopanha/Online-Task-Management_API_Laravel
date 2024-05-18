<?php

namespace App\Http\Controllers\V1;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreOrganizationRequest;
use App\Http\Requests\V1\UpdateOrganizationRequest;
use App\Services\V1\OrganizationQuery;
use App\Http\Resources\V1\OrganizationCollection;
use App\Http\Resources\V1\OrganizationResource;

class OrganizationController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $filter = new OrganizationQuery();
        $query = $filter->transform($request);
        $organization = $query->get();
        return $this->success(new OrganizationCollection($organization));
    }

    public function store(StoreOrganizationRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['owner_id'] = auth()->user()->id;


        $organization = Organization::create($validatedData);
        return $this->success(new OrganizationResource($organization));
    }

    public function show($id)
    {
        $organization = Organization::find($id);

        if (!$organization) {
            return $this->error('', 'Organization not found', 404);
        }
        return $this->success(new OrganizationResource($organization));

    }


    public function update(UpdateOrganizationRequest $request,Organization $organization,$id)
    {
        $this->authorize('update', $organization);

        $organization = Organization::find($id);

        if (!$organization) {
            return $this->error('', 'Organization not found', 404);
        }
        $validatedData = $request->validated();
        $organization->fill($validatedData);
        $organization->save();
        return $this->success(new OrganizationResource($organization));

    }


    public function destroy(Organization $organization,$id)
    {
        $this->authorize('delete', $organization);
        $organization = Organization::find($id);

        if (!$organization) {
            return $this->error('', 'Organization not found', 404);
        }
        $organization->delete();
        return $this->success([], 'Organization deleted successfully');
    }


}
