<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Schema;

class HotelController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $hotelsList = HotelResource::collection(Hotel::all())->resolve();

        return inertia('AdminSection/HotelList', ['items' => $hotelsList]);
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
