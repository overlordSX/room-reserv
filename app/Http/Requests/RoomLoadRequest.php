<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class RoomLoadRequest extends FormRequest
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
            'phone' => 'required|numeric|digits:11|exists:' . Client::class,
            'countOfGuests' => 'required|numeric|min:1|max:50',
            'dateIncome' => 'required',
            'dateOutcome' => 'required',
        ];
    }
}
