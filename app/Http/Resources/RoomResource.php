<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'id' => $resource->id,
            'name' => $resource->name,
            'photoUrl' => $resource->photo_url ?? null,
            'price' => $resource->price,
            'square' => $resource->square,
            'countOfRooms' => $resource->count_of_rooms,
            'countOfBeds' => $resource->count_of_beds,
            'floor' => $resource->floor,
        ];
    }
}
