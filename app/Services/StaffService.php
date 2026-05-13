<?php

namespace App\Services;

use App\Models\Staff;

class StaffService
{
    public function getAllStaff()
    {
        return Staff::with(['hotel', 'user'])->get();
    }

    public function createStaff(array $data)
    {
        return Staff::create($data);
    }

    public function updateStaff(string $id, array $data)
    {
        $staff = Staff::findOrFail($id);
        $staff->update($data);
        return $staff;
    }

    public function deleteStaff(string $id)
    {
        $staff = Staff::findOrFail($id);
        return $staff->delete();
    }
}
