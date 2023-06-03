<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'square' => 'required|integer|min:9',
            'countOfRooms' => 'required|integer|max:100|min:1',
            'countOfBeds' => 'required|integer|max:100|min:1',
            'floor' => 'required|integer|max:500|min:1',
            'photo' => 'image',
        ];
    }
}
