<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource = $this->resource;

        return [
            'family' => $resource->family,
            'name' => $resource->name,
            'surname' => $resource->surname,
            'phone' => $resource->phone,
            'email' => $resource->email,
        ];
    }
}
