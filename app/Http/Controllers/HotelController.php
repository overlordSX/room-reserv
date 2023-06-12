<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HotelController extends Controller
{
    public function index(): \Inertia\Response
    {
        $hotels = Hotel::query()
            ->select(['id', 'name', 'count_of_stars', 'address', 'photo_url', 'count_of_rooms'])
            ->leftJoin(
                DB::raw('(SELECT hotel_id, COUNT(*) AS count_of_rooms FROM rooms GROUP BY rooms.hotel_id) AS count_rooms'),
                'hotels.id',
                '=',
                'count_rooms.hotel_id',
            )
            ->get();

        $hotelsList = HotelResource::collection($hotels)->resolve();

        return inertia('AdminSection/HotelList', ['items' => $hotelsList]);
    }

    public function create(): \Inertia\Response
    {
        return inertia('AdminSection/AddHotel');
    }

    public function store(HotelRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        /** @var $fullPhotoPath null | string */
        $fullPhotoPath = null;

        if($request->photo !== null) {
            $photoPath = $request->photo->store('hotels', 'public');
            $photosFolders = '/storage/';

            $fullPhotoPath = $photosFolders . $photoPath;
        }

        Hotel::query()->create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'count_of_stars' => $validated['countOfStars'],
            'photo_url' => $fullPhotoPath,
        ]);

        return redirect('dashboard/hotels-list');
    }

    public function edit(Hotel $hotel, Request $request): \Inertia\Response
    {
        return inertia('AdminSection/AddHotel', [
            'isEdit' => true,
            'hotel' => HotelResource::make($hotel)->resolve(),
        ]);
    }

    public function update(Hotel $hotel, HotelRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        /** @var $fullPhotoPath null | string */
        $fullPhotoPath = $request->photo;

        if($request->photo !== null && $request->photo instanceof UploadedFile) {
            $photoPath = $request->photo->store('hotels', 'public');
            $photosFolders = '/storage/';

            $fullPhotoPath = $photosFolders . $photoPath;
        }

        $hotel->update([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'count_of_stars' => $validated['countOfStars'],
            'photo_url' => $fullPhotoPath,
        ]);

        return redirect(route('dashboard.hotels-list'));
    }

    public function delete(Hotel $hotel):  \Illuminate\Http\RedirectResponse
    {
        $hotel->delete();
        return redirect(route('dashboard.hotels-list'));
    }
}
