<?php

namespace App\Http\Controllers\V1;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Services\V1\OrganizationQuery;

class OrganizationController extends Controller
{
    use HttpResponses;


    public function index(Request $request)
    {
        $filter = new OrganizationQuery();
        $query = $filter->transform($request);
        return $this->success($query);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $organization = Organization::create($data);
        return $this->success($organization, 'Organization created successfully');
    }


    public function update(Request $request, Organization $organization)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $organization->update($data);
        return $this->success($organization, 'Organization updated successfully');
    }


    public function destroy(Organization $organization)
    {
        $organization->delete();
        return $this->success([], 'Organization deleted successfully');
    }


}
