<?php

namespace App\Http\Requests;

use App\Models\Room;
use App\Rules\IsDateIntervalAvailable;
use App\Rules\IsRoomHaveEnoughBeds;
use Illuminate\Foundation\Http\FormRequest;

class ClientRoomLoadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'roomId' => 'required|numeric|exists:' . Room::class . ',id',
            'countOfGuests' => ['bail', 'required','numeric','min:1','max:50', new IsRoomHaveEnoughBeds(),],
            'dateIncome' => ['bail', 'required', new IsDateIntervalAvailable(),],
            'dateOutcome' => 'bail|required',
            'phone' => 'bail|required|numeric|digits:11',
            'family' => 'bail|required|string|max:255',
            'name' => 'bail|required|string|max:255',
            'surname' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|email',
        ];
    }
}
