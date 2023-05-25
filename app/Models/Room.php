<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string|null photoUrl
 * @property int price
 * @property int square
 * @property int countOfRooms
 * @property int countOfBeds
 * @property int floor
 */
class Room extends Model
{
    use HasFactory;
}
