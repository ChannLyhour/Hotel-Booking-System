<?php

namespace App\Services;

use App\Models\User;

class StaffService
{
    public function getAllStaff()
    {
        return User::where('user_type', 'staff')->with('hotel')->get();
    }

    public function createStaff(array $data)
    {
        $data['user_type'] = 'staff';
        return User::create($data);
    }

    public function updateStaff(string $id, array $data)
    {
        $staff = User::where('user_type', 'staff')->findOrFail($id);
        $staff->update($data);
        return $staff;
    }

    public function deleteStaff(string $id)
    {
        $staff = User::where('user_type', 'staff')->findOrFail($id);
        return $staff->delete();
    }
}
