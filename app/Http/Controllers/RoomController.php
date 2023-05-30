<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Hotel;
use App\Models\Room;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RoomController extends Controller
{
    protected function checkIsHotelExists(int $hotelId): void
    {
        $hotel = Hotel::query()->find($hotelId);

        if (is_null($hotel)) {
            abort(404);
        }
    }

    public function index(int $hotelId): \Inertia\Response|\Inertia\ResponseFactory
    {
        $this->checkIsHotelExists($hotelId);

        // !важно НЕ использовать тут rooms(), иначе будет возвращать hasMany
        // в конкретно таком варианте вернет модельки rooms
        $rooms = Hotel::query()->find($hotelId)->rooms;

        return inertia('AdminSection/RoomList', [
            'hotelId' => $hotelId,
            'items' => RoomResource::collection($rooms)->resolve(),
        ]);
    }

    public function add(int $hotelId): \Inertia\Response|\Inertia\ResponseFactory
    {
        $this->checkIsHotelExists($hotelId);

        return inertia('AdminSection/AddRoom', ['hotelId' => $hotelId,]);
    }

    public function store(RoomRequest $request, int $hotelId): RedirectResponse
    {
        $this->checkIsHotelExists($hotelId);

        $validated = $request->validated();

        Room::query()->create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'square' => $validated['square'],
            'count_of_rooms' => $validated['countOfRooms'],
            'count_of_beds' => $validated['countOfBeds'],
            'floor' => $validated['floor'],
            'hotel_id' => $hotelId,
        ]);

        return redirect(route('dashboard.hotels-list.rooms-list', ['id' => $hotelId]));
    }
}
