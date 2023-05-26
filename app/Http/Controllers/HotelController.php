<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('AdminSection/HotelList', []);
    }

    public function add(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('AdminSection/AddHotel', []);
    }
}
