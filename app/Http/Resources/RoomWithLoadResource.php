<?php

namespace App\Http\Resources;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomWithLoadResource extends JsonResource
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
            'name' => $resource->room,
            'price' => $resource->price,
            'square' => $resource->square,
            'countOfRooms' => $resource->count_of_rooms,
            'countOfBeds' => $resource->count_of_beds,
            'floor' => $resource->floor,
        ];
    }
}
