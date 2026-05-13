<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Guest;
use App\Models\Staff;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Display a listing of guests.
     */
    public function guests()
    {
        $guests = Guest::latest()->paginate(10);
        return view('users.guests', compact('guests'));
    }

    /**
     * Display a listing of staff.
     */
    public function staff()
    {
        $staff = Staff::with('user', 'hotel')->latest()->paginate(10);
        return view('users.staff', compact('staff'));
    }

    /**
     * Display a listing of employees (Specific subset of staff).
     */
    public function employees()
    {
        $employees = Staff::with('user', 'hotel')
            ->where('department', '!=', 'Management') // Just an example filter
            ->latest()
            ->paginate(10);
        return view('users.employees', compact('employees'));
    }

    /**
     * Display roles and permissions.
     */
    public function roles()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('users.roles', compact('roles', 'permissions'));
    }
}
