<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SchedulerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Index', [ // все это хавал Welcome
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', [SchedulerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/hotels-list', [HotelController::class, 'index'])->name('dashboard.hotels-list');

    Route::get('/dashboard/hotels-list/add', [HotelController::class, 'add'])->name('dashboard.hotels-list.add');
    Route::post('/dashboard/hotels-list/add', [HotelController::class, 'store'])->name('dashboard.hotels-list.save');
    //todo delete action for hotels
    // Route::delete('/dashboard/hotels-list/{id}/delete', [HotelController::class, 'delete'])->name('dashboard.hotels-list.delete');

    //внутри экшена происходит магия, из инертии можно передать параметр, либо тем именем который он назван в роуте, либо через id
    Route::get('/dashboard/hotels-list/{hotel}/rooms-list', [RoomController::class, 'index'])->name('dashboard.hotels-list.rooms-list');

    Route::get('/dashboard/hotels-list/{hotel}/rooms-list/add', [RoomController::class, 'add'])->name('dashboard.hotels-list.rooms-list.add');
    Route::post('/dashboard/hotels-list/{hotel}/rooms-list/add', [RoomController::class, 'store'])->name('dashboard.hotels-list.rooms-list.save');
    //todo delete action for rooms
    // Route::delete('/dashboard/hotels-list/{hotelId}/rooms-list/{roomId}/delete', [HotelController::class, 'delete'])->name('dashboard.hotels-list.rooms-list.delete');


    Route::post('/dashboard/clients/add', [ClientController::class, 'store'])->name('dashboard.clients.save');

//    Route::get('/dashboard', [SchedulerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
     Route::post('/dashboard/room/{room}/add-load', [SchedulerController::class, 'saveLoad'])->name('dashboard.room.save-load');
});

require __DIR__ . '/auth.php';
