<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function index()
    {
        $guests = User::where('user_type', 'guest')->latest()->paginate(10);
        return view('users.guests.index', compact('guests'));
    }

    public function create()
    {
        return view('users.guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'id_document_type' => 'nullable|string|max:50',
            'id_document_no' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['user_type'] = 'guest';
        $data['name'] = $request->first_name . ' ' . $request->last_name;
        $data['password'] = bcrypt(Str::random(16)); // Random password for guests

        User::create($data);

        return redirect()->route('admin.guests.index')->with('success', 'Guest registered successfully.');
    }

    public function show(User $guest)
    {
        if ($guest->user_type !== 'guest') abort(404);

        $guest->load(['bookings', 'documents']);
        return view('users.guests.show', compact('guest'));
    }

    public function edit(User $guest)
    {
        if ($guest->user_type !== 'guest') abort(404);

        return view('users.guests.edit', compact('guest'));
    }

    public function update(Request $request, User $guest)
    {
        if ($guest->user_type !== 'guest') abort(404);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $guest->id,
            'phone' => 'required|string|max:20',
            'id_document_type' => 'nullable|string|max:50',
            'id_document_no' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['name'] = $request->first_name . ' ' . $request->last_name;

        $guest->update($data);

        return redirect()->route('admin.guests.index')->with('success', 'Guest updated successfully.');
    }

    public function destroy(User $guest)
    {
        if ($guest->user_type !== 'guest') abort(404);

        $guest->delete();
        return redirect()->route('admin.guests.index')->with('success', 'Guest record deleted.');
    }
}
