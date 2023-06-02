<?php

namespace App\Http\Controllers;

use App\Http\Resources\HotelMinListResource;
use App\Http\Resources\RoomResource;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


class SearchAvailableRoomsController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        $hotels = Hotel::query()
            ->select(['id', 'name', 'count_of_rooms'])
            ->leftJoin(
                DB::raw('(SELECT hotel_id, COUNT(*) AS count_of_rooms FROM rooms GROUP BY rooms.hotel_id) AS count_rooms'),
                'hotels.id',
                '=',
                'count_rooms.hotel_id',
            )
            ->get();

        $hotels = $hotels->filter(function ($hotel) {
            return !is_null($hotel->count_of_rooms);
        });

        $resHotelsMin = HotelMinListResource::collection($hotels)->resolve();

        return Inertia::render('Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'hotelsMin' => $resHotelsMin,
        ]);
    }

    public function search(Request $request): \Inertia\Response|RedirectResponse
    {
        $hotelFilterIds = [];
        $startDate = null;
        $endDate = null;
        $countOfGuests = null;


        if ($request->has('startDate')) {
            $startDate = $request->input('startDate');
        }
        if ($request->has('endDate')) {
            $endDate = $request->input('endDate');
        }
        if ($request->has('hotelsIds')) {
            $hotelFilterIds = $request->input('hotelsIds');
        }
        if ($request->has('countOfGuests')) {
            $countOfGuests = $request->input('countOfGuests');
        }

        if (is_null($startDate) || is_null($endDate)) {
            return redirect('/');
        }

        $reservationQuery = Reservation::query()
            ->select(['id', 'room_id'])
            ->where('date_income', '>=', Carbon::parse($startDate)->format('Y-m-d '))
            ->where('date_outcome', '<=', Carbon::parse($endDate)->format('Y-m-d '));

        $availableHotelRoomsFilter = count($hotelFilterIds) > 0 ? (Room::query()->whereIn('hotel_id', $hotelFilterIds)->get())->pluck('id') : null;

        if (!is_null($availableHotelRoomsFilter)) {
            $reservationQuery->whereIn('room_id', $availableHotelRoomsFilter);
        }

        $reservedRoomsIds = ($reservationQuery->get())->pluck('room_id');

        $availableToReserveRoomsQuery = Room::query()->whereNotIn('id', $reservedRoomsIds);

        if (!is_null($availableHotelRoomsFilter)) {
            $availableToReserveRoomsQuery->whereIn('id', $availableHotelRoomsFilter);
        }
        if (!is_null($countOfGuests)) {
            $availableToReserveRoomsQuery->where('count_of_beds', '>=', $countOfGuests);
        }

        $availableToReserveRooms = $availableToReserveRoomsQuery->get();

        return inertia('Search/RoomList', [
            'items' => RoomResource::collection($availableToReserveRooms)->resolve(),
        ]);
    }
}
