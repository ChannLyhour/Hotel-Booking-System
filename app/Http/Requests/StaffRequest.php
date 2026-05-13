<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotel_id' => 'required|exists:hotels,id',
            'user_id' => 'required|exists:users,id',
            'department' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'work_schedule' => 'nullable|array',
            'is_active' => 'boolean',
        ];
    }
}
