<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
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
    Route::delete('/dashboard/hotels-list', [HotelController::class, 'delete'])->name('dashboard.hotels-list.delete');
});

require __DIR__ . '/auth.php';
