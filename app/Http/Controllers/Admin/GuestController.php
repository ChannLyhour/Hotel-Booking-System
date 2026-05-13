<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestRequest;
use App\Services\GuestService;

class GuestController extends Controller
{
    protected $guestService;

    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    public function index()
    {
        $guests = $this->guestService->getAllGuests();
        return view('admin.guests.index', compact('guests'));
    }

    public function store(GuestRequest $request)
    {
        $this->guestService->createGuest($request->validated());
        return redirect()->back()->with('success', 'Guest created successfully.');
    }

    public function update(GuestRequest $request, string $id)
    {
        $this->guestService->updateGuest($id, $request->validated());
        return redirect()->back()->with('success', 'Guest updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->guestService->deleteGuest($id);
        return redirect()->back()->with('success', 'Guest deleted successfully.');
    }
}
