<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string family
 * @property string surname
 * @property string email
 * @property string phone
 */
class Client extends Model
{
    use HasFactory;
}
