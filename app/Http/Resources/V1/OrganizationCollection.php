<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganizationCollection extends ResourceCollection
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
                'owner_id' => $organization->owner_id,
                'email' => $organization->email,
            ];
        })->toArray();
    }
}
