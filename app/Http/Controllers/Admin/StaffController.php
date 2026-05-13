<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with(['user', 'hotel'])->latest()->paginate(10);
        return view('users.staff.index', compact('staff'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        $users = User::all(); // Simplified
        return view('users.staff.create', compact('hotels', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            'department' => 'required|string',
            'position' => 'required|string',
        ]);

        Staff::create($request->all());

        return redirect()->route('admin.staff.index')->with('success', 'Staff member onboarded successfully.');
    }

    public function show(Staff $staff)
    {
        return view('users.staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        $hotels = Hotel::all();
        $users = User::all();
        return view('users.staff.edit', compact('staff', 'hotels', 'users'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            'department' => 'required|string',
            'position' => 'required|string',
        ]);

        $staff->update($request->all());

        return redirect()->route('admin.staff.index')->with('success', 'Staff record updated.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Staff member removed.');
    }
}
