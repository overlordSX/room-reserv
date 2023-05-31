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
//        $reservations = Reservation::query()->groupBy('room_id')->get() ;

        //todo + join клиента и возможно руками надо будет группировать load
        $rooms = Room::query()
            ->selectRaw('select reservations.id, room_id')
            ->leftJoin(
                'reservations',
                'rooms.id',
                '=',
                'reservations.room_id')
            ->get();

//        dd($rooms);

        $result = RoomWithLoadResource::collection($rooms)->resolve();



        //todo
        return inertia('Scheduler', [
            'dateFrom' => date('Y-m-d'),
            'items' => $result,
        ]);


        /*return inertia('Scheduler', [
            'dateFrom' => date('Y-m-d'),
            'items' => [
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
                        [
                            'id' => 2,
                            'name' => 'Кирилл Рева1',
                            'startDate' => '2023-05-26',
                            'endDate' => '2023-05-28',
                            'bgColor' => '#E6E9D1',
                            'people' => 1,
                        ],
                        [
                            'id' => 3,
                            'name' => 'Иван Которин2',
                            'startDate' => '2023-05-28',
                            'endDate' => '2023-05-29',
                            'people' => 1,
                        ],
                        [
                            'name' => 'Кирилл Рева2',
                            'startDate' => '2023-05-29',
                            'endDate' => '2023-06-01',
                            'bgColor' => '#e8fcdb',
                            'people' => 1,
                        ],
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Номер 2',
                    'load' => [
                        [
                            'id' => 1,
                            'name' => 'Иван Которин3',
                            'startDate' => '2023-05-24',
                            'endDate' => '2023-05-25',
                            'people' => 1,
                        ],
                        [
                            'id' => 2,
                            'name' => 'Кирилл Рева3',
                            'startDate' => '2023-05-29',
                            'endDate' => '2023-05-30',
                            'people' => 1,
                        ],
                        [
                            'id' => 3,
                            'name' => 'Иван Которин4',
                            'startDate' => '2023-05-30',
                            'endDate' => '2023-05-31',
                            'people' => 1,
                        ],
                    ]
                ],
                [
                    'id' => 3,
                    'name' => 'Номер 3',
                    'load' => [],
                ]
            ],
        ]);*/
    }

    public function saveLoad(Room $room, RoomLoadRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        /*dd([
            'count_of_guests' => $validated['countOfGuests'],
            'date_income0' => Carbon::parse($validated['dateIncome'])->format('Y-m-d h:i:s'),
            'date_income' => Carbon::parse($validated['dateIncome'])->setTimezone(0)->format('Y-m-d h:i:s'),
            'date_outcome0' => Carbon::parse($validated['dateOutcome'])->format('Y-m-d h:i:s'),
            'date_outcome' => Carbon::parse($validated['dateOutcome'])->setTimezone(0)->format('Y-m-d h:i:s'),
            'room_id' => $room->getKey(),
            'client_id' => Client::query()->firstWhere('phone', $validated['phone'])->getKey(),
        ]);*/

        $client = Client::query()->firstWhere('phone', $validated['phone']);

        dd($client);

        Reservation::query()->create([
            'count_of_guests' => $validated['countOfGuests'],
            'date_income' => Carbon::parse($validated['dateIncome'])->format('Y-m-d '),
            'date_outcome' => Carbon::parse($validated['dateOutcome'])->format('Y-m-d h:i:s'), //todo почекать что все норм при работе с датами (когда есть время)
            'room_id' => $room->getKey(),
            'client_id' => '',
        ]);

        // по хорошему надо возвращать добавленный roomLoad, но пока что так
        return redirect(route('dashboard'));
    }
}
