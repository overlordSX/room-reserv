<?php

namespace App\Http\Resources;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelMinListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Hotel $resource */
        $resource = $this->resource;

        return [
            'label' => $resource->name,
            'value' => $resource->getKey(),
        ];
    }
}
