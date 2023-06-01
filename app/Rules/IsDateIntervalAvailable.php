<?php

namespace App\Rules;

use App\Models\Reservation;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;


/**
 * Правило применяется для начальной даты в интервале
 *
 * наследует DataAwareRule, за счет которого при валидации есть доступ к остальным полям
 */
class IsDateIntervalAvailable implements ValidationRule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];


    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Reservation::query()
            ->where('room_id', $this->data['roomId'])
            ->where('date_income', '>=', $value)
            ->where('date_outcome', '<=', $this->data['dateOutcome'])
            ->exists()) {
            $fail('В этом интервале дат уже есть бронирования, попробуйте выбрать другой');
        }
    }
}
