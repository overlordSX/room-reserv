<?php

namespace App\Rules;

use App\Models\Reservation;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Builder;


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
     * @param array<string, mixed> $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = $this->data['dateIncome'];
        $endDate = $this->data['dateOutcome'];

        if (Reservation::query()
            ->where('room_id', $this->data['roomId'])
            ->where(function (Builder $query) use ($startDate, $endDate) {
                $query->where(function (Builder $query) use ($startDate, $endDate) {
                    $query->where('date_income', '>=', Carbon::parse($startDate)->format('Y-m-d '))
                        ->Where('date_income', '<', Carbon::parse($endDate)->format('Y-m-d '));
                })
                    ->orWhere(function (Builder $query) use ($startDate, $endDate) {
                        $query->where('date_outcome', '>', Carbon::parse($startDate)->format('Y-m-d '))
                            ->Where('date_outcome', '<=', Carbon::parse($endDate)->format('Y-m-d '));
                    });
            })
            ->exists()) {
            $fail('В этом интервале дат уже есть бронирования, попробуйте выбрать другой');
        }
    }
}
