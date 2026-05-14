<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('user_type', 'employee')->latest()->paginate(10);
        return view('users.employees.index', compact('employees'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('users.employees.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string',
            'position' => 'required|string',
            'hotel_id' => 'nullable|exists:hotels,id',
        ]);

        $data = $request->all();
        $data['user_type'] = 'employee';
        $data['password'] = bcrypt(Str::random(12));

        User::create($data);

        return redirect()->route('admin.employees.index')->with('success', 'Employee added successfully.');
    }

    public function show(User $employee)
    {
        if ($employee->user_type !== 'employee') abort(404);
        return view('users.employees.show', compact('employee'));
    }

    public function edit(User $employee)
    {
        if ($employee->user_type !== 'employee') abort(404);
        
        $hotels = Hotel::all();
        return view('users.employees.edit', compact('employee', 'hotels'));
    }

    public function update(Request $request, User $employee)
    {
        if ($employee->user_type !== 'employee') abort(404);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'department' => 'required|string',
            'position' => 'required|string',
        ]);

        $employee->update($request->all());
        return redirect()->route('admin.employees.index')->with('success', 'Employee updated.');
    }

    public function destroy(User $employee)
    {
        if ($employee->user_type !== 'employee') abort(404);
        
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Employee removed.');
    }
}

