<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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

        /** @var $fullPhotoPath null | string */
        $fullPhotoPath = null;

        if($request->photo !== null) {
            $photoPath = $request->photo->store('rooms', 'public');
            $photosFolders = '/storage/';

            $fullPhotoPath = $photosFolders . $photoPath;
        }

        Room::query()->create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'square' => $validated['square'],
            'count_of_rooms' => $validated['countOfRooms'],
            'count_of_beds' => $validated['countOfBeds'],
            'floor' => $validated['floor'],
            'hotel_id' => $hotel->getKey(),
            'photo_url' => $fullPhotoPath,
        ]);

        return redirect(route('dashboard.hotels-list.rooms-list', ['hotel' => $hotel->getKey()]));
    }

    public function edit(Room $room, Request $request): \Inertia\Response
    {
        return inertia('AdminSection/AddRoom', [
            'hotelId' => $room->hotel_id,
            'isEdit' => true,
            'room' => RoomResource::make($room)->resolve(),
        ]);
    }

    public function update(Room $room, RoomRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        /** @var $fullPhotoPath null | string */
        $fullPhotoPath = $request->photo;

        if($request->photo !== null && $request->photo instanceof UploadedFile) {
            $photoPath = $request->photo->store('rooms', 'public');
            $photosFolders = '/storage/';

            $fullPhotoPath = $photosFolders . $photoPath;
        }

        $room->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'square' => $validated['square'],
            'count_of_rooms' => $validated['countOfRooms'],
            'count_of_beds' => $validated['countOfBeds'],
            'floor' => $validated['floor'],
            'hotel_id' => $room->hotel_id,
            'photo_url' => $fullPhotoPath,
        ]);

        return redirect(route('dashboard.hotels-list.rooms-list', ['hotel' => $room->hotel_id]));
    }

    public function delete(Room $room):  \Illuminate\Http\RedirectResponse
    {
        $room->delete();
        return redirect(route('dashboard.hotels-list.rooms-list', ['hotel' => $room->hotel_id]));
    }
}
