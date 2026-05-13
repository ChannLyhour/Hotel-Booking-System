<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeRequest;
use App\Services\RoomTypeService;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    protected $roomTypeService;

    public function __construct(RoomTypeService $roomTypeService)
    {
        $this->roomTypeService = $roomTypeService;
    }

    public function index(Request $request)
    {
        $roomTypes = $this->roomTypeService->getAllRoomTypes($request->all());
        return view('admin.room_types.index', compact('roomTypes'));
    }


    public function store(RoomTypeRequest $request)
    {
        $data = $request->validated();
        
        // Handle price conversion if input as dollars
        if ($request->has('base_price_dollars')) {
            $data['base_price_cents'] = (int) ($request->base_price_dollars * 100);
        }

        $this->roomTypeService->createRoomType($data);
        return redirect()->back()->with('success', 'Room type created successfully.');
    }

    public function update(RoomTypeRequest $request, string $id)
    {
        $this->roomTypeService->updateRoomType($id, $request->validated());
        return redirect()->back()->with('success', 'Room type updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->roomTypeService->deleteRoomType($id);
        return redirect()->back()->with('success', 'Room type deleted successfully.');
    }
}
