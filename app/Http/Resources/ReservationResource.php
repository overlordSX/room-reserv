<?php

namespace App\Http\Resources;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    protected array $longDurationColors = [
        '#e8fcdb',
        '#EEF2CB',
        '#E6E9D1',
    ];

    protected function getRandomColor(): string
    {
        return $this->longDurationColors[rand(0, count($this->longDurationColors) - 1)];
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        /** @var Reservation $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->getKey(),
            'name' => $resource->client->getFullName(),
            'phone' => $resource->client->phone,
            'startDate' => $resource->date_income,
            'endDate' => $resource->date_outcome,
            'bgColor' => $this->getRandomColor(),
            'people' => $resource->count_of_guests,
        ];
    }
}
