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
        // Add authorization logic here if needed (e.g., check if user is admin)
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $roomId = $this->route('room'); // Get room ID from route for unique validation

        return [
            'room_type_id' => 'required|exists:room_types,id',
            'number' => 'required|string|max:50|unique:rooms,number,' . $roomId,
            'floor' => 'nullable|integer',
            'status' => 'required|string|in:available,occupied,maintenance,cleaning',
            'features' => 'nullable|array',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'room_type_id.exists' => 'The selected room type is invalid.',
            'status.in' => 'The status must be one of: available, occupied, maintenance, cleaning.',
        ];
    }
}
