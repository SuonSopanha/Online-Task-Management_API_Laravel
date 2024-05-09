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
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'industry' => $this->industry,
                'owner_id' => $this->owner_id,
                'email' => $this->email,
            ];
        })->toArray();
    }
}
