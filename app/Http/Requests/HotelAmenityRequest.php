<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelAmenityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'details' => 'nullable|array',
            'is_active' => 'boolean',
        ];
    }
}
