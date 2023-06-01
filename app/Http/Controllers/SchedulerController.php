<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomLoadRequest;
use App\Http\Resources\RoomWithLoadResource;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class SchedulerController extends Controller
{
    public function index(): \Inertia\Response
    {
        $leftEdge = (Carbon::now())->subWeeks(3);
        $rightEdge = (Carbon::now())->addWeeks(3);
        $dbDateFormat = 'Y-m-d';


        // todo фильтр
        $rooms = Room::query()->select(['id', 'name'])->get();

        $roomsId = $rooms->pluck('id');

        $reservations = Reservation::query()
            ->whereIn('room_id', $roomsId)
            ->where('date_income', '>=', $leftEdge->format($dbDateFormat))
            ->where('date_outcome', '<=', $rightEdge->format($dbDateFormat))
            ->with(['client'])
            ->get();

//        $reservations = ->toArray();

        $resRooms = RoomWithLoadResource::collectWithAdditional($rooms, ['reservations' => $reservations->groupBy('room_id')])
            ->resolve();

        return inertia('Scheduler', [
            'dateFrom' => date('Y-m-d'),
            'items' => $resRooms,
        ]);

        /* 'items' => [
            [
                'id' => 1,
                'name' => 'Номер 1',
                'load' => [
                    [
                        'id' => 1,
                        'name' => 'Иван Которин1',
                        'startDate' => '2023-05-23',
                        'endDate' => '2023-05-26',
                        'bgColor' => '#EEF2CB',
                        'people' => 2,
                    ],
                    ...
                ]
            ],
        ]*/
    }

    public function saveLoad(Room $room, RoomLoadRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $client = Client::query()->firstWhere('phone', $validated['phone']);

        if (is_null($client)) {
            abort(404);
        }

        Reservation::query()->create([
            'count_of_guests' => $validated['countOfGuests'],
            'date_income' => Carbon::parse($validated['dateIncome'])->format('Y-m-d '),
            'date_outcome' => Carbon::parse($validated['dateOutcome'])->format('Y-m-d'), //todo почекать что все норм при работе с датами (когда есть время) Y-m-d h:i:s
            'room_id' => $room->getKey(),
            'client_id' => $client->getKey(),
        ]);

        // по хорошему надо возвращать добавленный roomLoad, но пока что так
        return redirect(route('dashboard'));
    }
}
