<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\V1\OrgMemberQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreOrgMemberRequest;
use App\Http\Requests\V1\UpdateOrgMemberRequest;
use App\Http\Resources\V1\OrgMemberCollection;
use App\Http\Resources\V1\OrgMemberResource;
use App\Models\OrgMember;

class OrgMemberController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    public function index(Request $request)
    {
        $filter = new OrgMemberQuery();
        $query = $filter->transform($request);


        $org_member = $query->get();
        return $this->success(new OrgMemberCollection($org_member));
    }


    public function store(StoreOrgMemberRequest $request)
    {
        $validatedData = $request->validated();

        $org_member = OrgMember::create($validatedData);

        return $this->success(new OrgMemberResource($org_member));
    }


    public function show($id)
    {

        $org_member = OrgMember::find($id);

        if (!$org_member) {
            return $this->error('', 'Organization member not found', 404);
        }

        return $this->success(new OrgMemberResource($org_member));
    }


    public function update(UpdateOrgMemberRequest $request,OrgMember $org_member)
    {
        $this->authorize('update', $org_member);
        $validatedData = $request->validated();

        $org_member->update($validatedData);
        return $this->success(new OrgMemberResource($org_member));
    }


    public function destroy(OrgMember $org_member)
    {
        $this->authorize('delete', $org_member);
        $org_member->delete();
        return $this->success(null, 'Organization member deleted successfully');
    }
}
