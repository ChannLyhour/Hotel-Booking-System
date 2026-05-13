<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::latest()->paginate(10);
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
            'email' => 'required|email|unique:guests,email',
            'phone' => 'required|string|max:20',
        ]);

        Guest::create($request->all());

        return redirect()->route('admin.guests.index')->with('success', 'Guest registered successfully.');
    }

    public function show(Guest guest)
    {
        return view('users.guests.show', compact('guest'));
    }

    public function edit(Guest guest)
    {
        return view('users.guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest guest)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email,' . $guest->id,
            'phone' => 'required|string|max:20',
        ]);

        $guest->update($request->all());

        return redirect()->route('admin.guests.index')->with('success', 'Guest updated successfully.');
    }

    public function destroy(Guest guest)
    {
        $guest->delete();
        return redirect()->route('admin.guests.index')->with('success', 'Guest record deleted.');
    }
}
