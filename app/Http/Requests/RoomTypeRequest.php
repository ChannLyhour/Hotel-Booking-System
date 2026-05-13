<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roomTypeId = $this->route('room_type');

        return [
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:room_types,code,' . $roomTypeId,
            'max_occupancy' => 'required|integer|min:1',
            'base_price_cents' => 'required_without:base_price_dollars|integer|min:0',
            'base_price_dollars' => 'required_without:base_price_cents|numeric|min:0',
            'bed_type' => 'nullable|string',
            'amenities' => 'nullable|array',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }
}
