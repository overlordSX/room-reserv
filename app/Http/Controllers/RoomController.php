<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RoomController extends Controller
{
    public function index(int $hotelId): \Inertia\Response|\Inertia\ResponseFactory
    {
        // !важно НЕ использовать тут rooms(), иначе будет возвращать hasMany
        // а в конкретно таком варианте вернет именно rooms
        $rooms = Hotel::query()->find($hotelId)->rooms;

        dd($rooms->toArray());
        //todo

        $roomsList = [];
        if ($rooms) {

//            echo '<pre>'; print_r($roomsList); echo '</pre>';

        }

//        return inertia('AdminSection/RoomList', ['hotelId' => $hotelId, 'items' => $roomsList]);
    }

    public function add(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('AdminSection/AddHotel');
    }

    public function store(HotelRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // так можно дернуть названия полей из БД
        //dd(Schema::getColumnListing('hotels'));

        Hotel::query()->create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'count_of_stars' => $validated['countOfStars'],
        ]);

        return redirect('dashboard/hotels-list');
    }
}
