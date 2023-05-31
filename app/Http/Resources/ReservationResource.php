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
        $randIndex = floor(rand() * count($this->longDurationColors));

        return $this->longDurationColors[$randIndex];
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

        /*$a = [
            'id' => 1,
            'name' => 'Иван Которин1',
            'startDate' => '2023-05-23',
            'endDate' => '2023-05-26',
            'bgColor' => '#EEF2CB',
            'people' => 2,
        ];*/

        //todo скорее всего это не финалочка

        return [
            'id' => $resource->getKey(),
            'name' => $resource->client->name,
            'startDate' => $resource->date_income,
            'endDate' => $resource->date_outcome,
            'bgColor' => $this->getRandomColor(),
            'people' => $resource->count_of_guests,
        ];
    }
}
