<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $guestId = $this->route('guest');

        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:guests,email,' . $guestId,
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:100',
            'id_document_type' => 'nullable|string',
            'id_document_no' => 'nullable|string',
            'vip_tier' => 'required|string|in:standard,silver,gold,platinum',
            'loyalty_points' => 'integer|min:0',
            'preferences' => 'nullable|array',
        ];
    }
}
