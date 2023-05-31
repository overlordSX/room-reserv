<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string family
 * @property string name
 * @property string surname
 * @property string email
 * @property string phone
 * @property Collection|Reservation reservation
 */
class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'family',
        'name',
        'surname',
        'phone',
        'email',
    ];

    /**
     * Возвращает брони принадлежащие клиенту
     *
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
