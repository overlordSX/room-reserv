<?php

namespace App\Http\Resources;

use App\Models\Room;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class RoomWithLoadResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var Room $resource
         */
        $resource = $this->resource;

        /**
         * @var Collection $reservations
         */
        $reservations = $this->additional['reservations'] ?? [];

        return [
            'id' => $resource->getKey(),
            'name' => $resource->name,
            'load' => ReservationResource::collection($reservations[$resource->getKey()] ?? [])->resolve(),
        ];
    }
}
