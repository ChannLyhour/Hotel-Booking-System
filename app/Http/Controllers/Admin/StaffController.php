<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('user_type', 'staff')->with('hotel')->latest()->paginate(10);
        return view('users.staff.index', compact('staff'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        $roles = Role::all();
        return view('users.staff.create', compact('hotels', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'hotel_id' => 'required|exists:hotels,id',
            'department' => 'required|string',
            'position' => 'required|string',
            'role_id' => 'required|exists:roles,id',
        ]);

        $data = $request->all();
        $data['user_type'] = 'staff';
        $data['password'] = bcrypt(Str::random(12)); // Random password for new staff

        User::create($data);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member onboarded successfully.');
    }

    public function show(User $staff)
    {
        if ($staff->user_type !== 'staff') abort(404);
        return view('users.staff.show', compact('staff'));
    }

    public function edit(User $staff)
    {
        if ($staff->user_type !== 'staff') abort(404);

        $hotels = Hotel::all();
        $roles = Role::all();
        return view('users.staff.edit', compact('staff', 'hotels', 'roles'));
    }

    public function update(Request $request, User $staff)
    {
        if ($staff->user_type !== 'staff') abort(404);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'hotel_id' => 'required|exists:hotels,id',
            'department' => 'required|string',
            'position' => 'required|string',
            'role_id' => 'required|exists:roles,id',
        ]);

        $staff->update($request->all());

        return redirect()->route('admin.staff.index')->with('success', 'Staff record updated.');
    }

    public function destroy(User $staff)
    {
        if ($staff->user_type !== 'staff') abort(404);

        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Staff member removed.');
    }
}
