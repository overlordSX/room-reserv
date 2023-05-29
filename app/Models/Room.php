<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string name
 * @property string|null photo_url
 * @property int price
 * @property int square
 * @property int count_of_rooms
 * @property int count_of_beds
 * @property int floor
 */
class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo_url',
        'price',
        'square',
        'count_of_rooms',
        'count_of_beds',
        'floor',
    ];

    use HasFactory;

    /**
     * возвращает модель Отеля к которой принадлежит номер
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
