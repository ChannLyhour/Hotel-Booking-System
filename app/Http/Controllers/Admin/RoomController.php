<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;

    /**
     * Inject RoomService into the controller.
     */
    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Display a listing of the rooms.
     */
    public function index()
    {
        $roomTypes = $this->roomService->getAllRoomsGroupedByType();
        return view('admin.rooms.index', compact('roomTypes'));
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(RoomRequest $request)
    {
        try {
            $this->roomService->createRoom($request->validated());
            return redirect()->back()->with('success', 'Room created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating room: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified room in storage.
     */
    public function update(RoomRequest $request, string $id)
    {
        try {
            $this->roomService->updateRoom($id, $request->validated());
            return redirect()->back()->with('success', 'Room updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating room: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->roomService->deleteRoom($id);
            return redirect()->back()->with('success', 'Room deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting room: ' . $e->getMessage());
        }
    }

    /**
     * Update room status via AJAX or dedicated route.
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate(['status' => 'required|string']);
        
        try {
            $this->roomService->updateRoomStatus($id, $request->status);
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
