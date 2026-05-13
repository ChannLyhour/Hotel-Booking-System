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
        return view('users.users.index', compact('users'));
    }

    /**
     * Show form to create a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.users.create', compact('roles'));
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.users.show', compact('user'));
    }

    /**
     * Show form to edit a user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.users.edit', compact('user', 'roles'));
    }

    /**
     * Update a user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Display roles and permissions listing.
     */
    public function roles()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('users.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show form to create a new role.
     */
    public function createRole()
    {
        return view('users.roles.create');
    }

    /**
     * Show form to edit an existing role.
     */
    public function editRole(Role $role)
    {
        return view('users.roles.edit', compact('role'));
    }

    /**
     * Store a new role.
     */
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:roles,slug',
            'permissions' => 'nullable|array'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->permissions_cache = $request->permissions ?? [];
        $role->save();

        if ($request->has('permissions')) {
            foreach ($request->permissions as $permStr) {
                $parts = explode(':', $permStr);
                if (count($parts) === 2) {
                    Permission::create([
                        'role_id' => $role->id,
                        'resource' => $parts[0],
                        'action' => $parts[1]
                    ]);
                }
            }
        }

        return redirect()->route('admin.users.roles')->with('success', 'Role created successfully.');
    }

    /**
     * Update an existing role.
     */
    public function updateRole(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:roles,slug,' . $role->id,
            'permissions' => 'nullable|array'
        ]);

        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->permissions_cache = $request->permissions ?? [];
        $role->save();

        // Sync permissions relationship
        $role->permissions()->delete();

        if ($request->has('permissions')) {
            foreach ($request->permissions as $permStr) {
                $parts = explode(':', $permStr);
                if (count($parts) === 2) {
                    Permission::create([
                        'role_id' => $role->id,
                        'resource' => $parts[0],
                        'action' => $parts[1]
                    ]);
                }
            }
        }

        return redirect()->route('admin.users.roles')->with('success', 'Role updated successfully.');
    }

    /**
     * Delete a role.
     */
    public function destroyRole(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete role assigned to users.');
        }

        $role->permissions()->delete();
        $role->delete();

        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}
