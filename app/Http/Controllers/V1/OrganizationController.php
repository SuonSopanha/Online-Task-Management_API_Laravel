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


    public function update(UpdateOrganizationRequest $request,Organization $organization)
    {
        $this->authorize('update', $organization);


        $validatedData = $request->validated();
        $organization->update($validatedData);
        return $this->success(new OrganizationResource($organization));

    }


    public function destroy(Organization $organization)
    {
        $this->authorize('delete', $organization);

        $organization->delete();
        return $this->success([], 'Organization deleted successfully');
    }


    //custom controller

    //get oragization by owner id
    public function getOrganizationByOwner()
    {
        $organization = Organization::where('owner_id', auth()->user()->id)->get();
        return $this->success(new OrganizationCollection($organization));
    }

    //get organization by member
    public function getOrganizationByMember()
    {
        $id = auth()->user()->id;
        $organization = Organization::whereHas('members', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->get();
        return $this->success(new OrganizationCollection($organization));
    }


}
