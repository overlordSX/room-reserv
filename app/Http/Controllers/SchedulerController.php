<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRoomLoadRequest;
use App\Http\Requests\RoomLoadRequest;
use App\Http\Requests\RoomLoadUpdateRequest;
use App\Http\Resources\HotelMinListResource;
use App\Http\Resources\RoomMinListResource;
use App\Http\Resources\RoomWithLoadResource;
use App\Models\Client;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SchedulerController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        $roomsFilterIds = [];
        $hotelFilterIds = [];

        if ($request->has('roomsIds')) {
            $roomsFilterIds = $request->input('roomsIds');
        }

        if ($request->has('hotelsIds')) {
            $hotelFilterIds = $request->input('hotelsIds');
        }

        $leftEdge = (Carbon::now())->subWeeks(3);
        $rightEdge = (Carbon::now())->addWeeks(3);
        $dbDateFormat = 'Y-m-d';


        // todo подгрузка дат дальше месяца влево вправо

        $roomModel = new Room();

        $roomQuery = $roomModel->query()->select(['id', 'name']);
        if (count($hotelFilterIds) > 0) {
            $roomQuery->whereIn('hotel_id', $hotelFilterIds);
        }

        $roomsIds = $roomQuery->get();

        $roomsId = $roomsIds->pluck('id');

        $reservationModel = new Reservation();

        $reservationQuery = $reservationModel->query()
            ->where('date_income', '>=', $leftEdge->format($dbDateFormat))
            ->where('date_outcome', '<=', $rightEdge->format($dbDateFormat))
            ->with(['client']);

        if (count($roomsFilterIds) > 0) {
            $reservationQuery->whereIn('room_id', $roomsFilterIds);
        } else {
            $reservationQuery->whereIn('room_id', $roomsId);
        }

        $reservations = $reservationQuery->get();

        $roomsForScheduler = count($roomsFilterIds) > 0 ? $roomsIds->whereIn('id', $roomsFilterIds) : $roomsIds;

        $resRooms = RoomWithLoadResource::collectWithAdditional($roomsForScheduler, ['reservations' => $reservations->groupBy('room_id')])
            ->resolve();

        $hotels = Hotel::query()
            ->select(['id', 'name'])
            ->get();

        $resHotelsMin = HotelMinListResource::collection($hotels)->resolve();
        $resRoomsMin = RoomMinListResource::collection($roomsIds)->resolve();

        return inertia('Scheduler', [
            'dateFrom' => date('Y-m-d'),
            'items' => $resRooms,
            'hotelsMin' => $resHotelsMin,
            'roomsMin' => $resRoomsMin,
            'roomsFilterIds' => $roomsFilterIds,
            'hotelsFilterIds' => $hotelFilterIds,
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

        return redirect(route('dashboard'));
    }

    public function saveNotVerifiedLoad(Room $room, ClientRoomLoadRequest $request): void
    {
        $validated = $request->validated();

        $client = Client::query()->firstWhere('phone', $validated['phone']);

        if (is_null($client)) {
            $client = Client::query()->create([
                'family' => $validated['family'],
                'name' => $validated['name'],
                'surname' => $validated['surname'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
            ]);
        }

        Reservation::query()->create([
            'count_of_guests' => $validated['countOfGuests'],
            'date_income' => Carbon::parse($validated['dateIncome'])->format('Y-m-d '),
            'date_outcome' => Carbon::parse($validated['dateOutcome'])->format('Y-m-d'), //todo можно проверить что все норм при работе с датами (когда есть время) Y-m-d h:i:s
            'room_id' => $room->getKey(),
            'client_id' => $client->getKey(),
            'is_approved' => false,
        ]);
    }

    public function updateLoad(RoomLoadUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $client = Client::query()->firstWhere('phone', $validated['phone']);

        if (is_null($client)) {
            abort(404);
        }

        $reservation = Reservation::query()->find($validated['loadId']);

        if (is_null($reservation)) abort(404);

        $reservation->update([
            'count_of_guests' => $validated['countOfGuests'],
            'date_income' => Carbon::parse($validated['dateIncome'])->format('Y-m-d '),
            'date_outcome' => Carbon::parse($validated['dateOutcome'])->format('Y-m-d'), //todo почекать что все норм при работе с датами (когда есть время) Y-m-d h:i:s
        ]);

        return redirect(route('dashboard'));
    }

    public function deleteLoad(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'loadId' => 'required|exists:' . Reservation::class . ',id',
        ]);

        Reservation::query()->where('id', '=', $validated['loadId'])->delete();

        return redirect(route('dashboard'));
    }

    public function approveLoad(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'loadId' => 'required|exists:' . Reservation::class . ',id',
        ]);

        $reservation = Reservation::query()->find($validated['loadId']);

        if (is_null($reservation)) abort(404);

        $reservation->update([
            'is_approved' => 1,
        ]);

        return redirect(route('dashboard'));
    }
}
