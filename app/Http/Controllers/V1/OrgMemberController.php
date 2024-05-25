<?php

namespace App\Http\Controllers\V1;

use App\Models\User;
use App\Models\OrgMember;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\V1\OrgMemberQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrgMemberResource;
use App\Http\Resources\V1\OrgMemberCollection;
use App\Http\Requests\V1\StoreOrgMemberRequest;
use App\Http\Requests\V1\UpdateOrgMemberRequest;

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


    public function update(UpdateOrgMemberRequest $request,OrgMember $orgMember)
    {
        $this->authorize('update', $orgMember);
        $validatedData = $request->validated();

        $orgMember->update($validatedData);
        return $this->success(new OrgMemberResource($orgMember));
    }


    public function destroy(OrgMember $orgMember)
    {
        $this->authorize('delete', $orgMember);
        $orgMember->delete();
        return $this->success(null, 'Organization member deleted successfully');
    }

    public function addMembers(Request $request)
{
    $request->validate([
        'org_id' => 'required|exists:organizations,id',
        'members' => 'required|array',
        'members.*.email' => 'required|email',
        'members.*.role' => 'required|string',
    ]);

    // Find the project instance using the project_id from the request
    $organization = Organization::find($request->org_id);

    $results = [];
    foreach ($request->members as $member) {
        $email = $member['email'];
        $role = $member['role'];

        $user = User::where('email', $email)->first();
        if (!$user) {
            $results[] = ['email' => $email, 'status' => 'not found'];
            continue;
        }

        if ($organization->members()->where('user_id', $user->id)->exists()) {
            $results[] = ['email' => $email, 'status' => 'already a member'];
            continue;
        }

        $organizationMember = new OrgMember();
        $organizationMember->org_id = $organization->id;
        $organizationMember->user_id = $user->id;
        $organizationMember->role = $role;
        $organizationMember->save();

        $results[] = ['email' => $email, 'status' => 'added'];
    }

    return response()->json(['results' => $results]);
}


}
