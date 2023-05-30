<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Hotel;
use App\Models\Room;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RoomController extends Controller
{
    public function index(Hotel $hotel): \Inertia\Response|\Inertia\ResponseFactory
    {
        // !важно НЕ использовать тут rooms(), иначе будет возвращать hasMany
        // в конкретно таком варианте вернет модельки rooms
//        $rooms = Hotel::query()->find($hotelId)->rooms;

        $rooms = $hotel->rooms;

        return inertia('AdminSection/RoomList', [
            'hotelId' => $hotel->getKey(),
            'items' => RoomResource::collection($rooms)->resolve(),
        ]);
    }

    public function add(Hotel $hotel): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('AdminSection/AddRoom', ['hotelId' => $hotel->getKey(),]);
    }

    public function store(Hotel $hotel, RoomRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Room::query()->create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'square' => $validated['square'],
            'count_of_rooms' => $validated['countOfRooms'],
            'count_of_beds' => $validated['countOfBeds'],
            'floor' => $validated['floor'],
            'hotel_id' => $hotel->getKey(),
        ]);

        return redirect(route('dashboard.hotels-list.rooms-list', ['hotel' => $hotel->getKey()]));
    }
}
