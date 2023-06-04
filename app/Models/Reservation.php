<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string name
 * @property int count_of_guests
 * @property Carbon date_income
 * @property Carbon date_outcome
 * @property int client_id
 * @property int hotel_id
 * @property int is_approved
 * @property Room room
 * @property Client client
 */
class Reservation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'count_of_guests',
        'date_income',
        'date_outcome',
        'client_id',
        'room_id',
        'is_approved',
    ];

    use HasFactory;

    /**
     * Возвращает клиента принадлежащего брони
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * возвращает номер привязанный к брони
     *
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
