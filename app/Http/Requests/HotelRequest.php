<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $hotelId = $this->route('hotel');

        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:hotels,slug,' . $hotelId,
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'currency_code' => 'required|string|size:3',
            'timezone' => 'required|string',
            'contact_info' => 'nullable|array',
            'settings' => 'nullable|array',
            'is_active' => 'boolean',
        ];
    }
}
