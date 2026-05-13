<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->latest()->paginate(10);
        return view('users.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('users.employees.create');
    }

    public function store(Request $request)
    {
        // Placeholder validation/storage
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department' => 'required|string',
        ]);

        Employee::create($request->all());

        return redirect()->route('admin.employees.index')->with('success', 'Employee added successfully.');
    }

    public function show(Employee $employee)
    {
        return view('users.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('users.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route('admin.employees.index')->with('success', 'Employee updated.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Employee removed.');
    }
}
