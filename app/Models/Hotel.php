<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property int countOfStars
 * @property string address
 * @property string|null photoUrl
 */
class Hotel extends Model
{
    use HasFactory;
}
