<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'photo_url' => $this->photo_url,
            'additional_info' => json_decode($this->additional_info),
            'role' => $this->role,
        ];
    }
}
