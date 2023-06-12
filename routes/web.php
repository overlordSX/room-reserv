<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\SearchAvailableRoomsController;
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

Route::get('/', [SearchAvailableRoomsController::class, 'index'])->name('main');
Route::get('/search', [SearchAvailableRoomsController::class, 'search'])->name('search');
Route::get('/search/available-room/{room}', [SearchAvailableRoomsController::class, 'showRoom'])->name('search.available-room');
Route::post('/reservations/room/{room}/add-load', [SchedulerController::class, 'saveNotVerifiedLoad'])->name('reservations.room.add-load');

Route::get('/dashboard', [SchedulerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //todo по сути не нужно, но можно добавить, если будет не хватать
    /*    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');*/

    Route::get('/dashboard/hotels-list', [HotelController::class, 'index'])->name('dashboard.hotels-list');

    Route::get('/dashboard/hotels-list/add', [HotelController::class, 'create'])->name('dashboard.hotels-list.add');
    Route::post('/dashboard/hotels-list/add', [HotelController::class, 'store'])->name('dashboard.hotels-list.save');
    Route::get('/dashboard/hotel/{hotel}/edit', [HotelController::class, 'edit'])->name('dashboard.hotel.edit');
    Route::post('/dashboard/hotel/{hotel}/update', [HotelController::class, 'update'])->name('dashboard.hotel.update');
    Route::post('/dashboard/hotel/{hotel}/delete', [HotelController::class, 'delete'])->name('dashboard.hotel.delete');

    //внутри экшена происходит магия, из инертии можно передать параметр, либо тем именем который он назван в роуте, либо через id
    Route::get('/dashboard/hotels-list/{hotel}/rooms-list', [RoomController::class, 'index'])->name('dashboard.hotels-list.rooms-list');

    Route::get('/dashboard/hotels-list/{hotel}/rooms-list/add', [RoomController::class, 'add'])->name('dashboard.hotels-list.rooms-list.add');
    Route::post('/dashboard/hotels-list/{hotel}/rooms-list/add', [RoomController::class, 'store'])->name('dashboard.hotels-list.rooms-list.save');
    Route::get('/dashboard/room/{room}/edit', [RoomController::class, 'edit'])->name('dashboard.room.edit');
    Route::post('/dashboard/room/{room}/update', [RoomController::class, 'update'])->name('dashboard.room.update');
    Route::post('/dashboard/room/{room}//delete', [RoomController::class, 'delete'])->name('dashboard.room.delete');


    Route::post('/dashboard/clients/add', [ClientController::class, 'store'])->name('dashboard.clients.save');

    Route::post('/dashboard/room/{room}/add-load', [SchedulerController::class, 'saveLoad'])->name('dashboard.room.save-load');
    Route::post('/dashboard/approve-load', [SchedulerController::class, 'approveLoad'])->name('dashboard.room.approve-load');
    Route::post('/dashboard/update-load', [SchedulerController::class, 'updateLoad'])->name('dashboard.room.update-load');
    Route::post('/dashboard/delete-load', [SchedulerController::class, 'deleteLoad'])->name('dashboard.room.delete-load');
});

require __DIR__ . '/auth.php';
