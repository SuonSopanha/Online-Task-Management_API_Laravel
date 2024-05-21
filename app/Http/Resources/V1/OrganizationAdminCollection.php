<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganizationAdminCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($organization) {
            return [
                'id' => $organization->id,
                'name' => $organization->name,
                'description' => $organization->description,
                'industry' => $organization->industry,
                'owner' => new UserResource($organization->owner), // Include the owner resource
                'email' => $organization->email,
            ];
        })->toArray();
    }
}
