<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::with('hotel')->latest()->get();
        return view('admin.room_types.index', compact('roomTypes'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('admin.room_types.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:room_types,code',
            'max_occupancy' => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
            'bed_type' => 'nullable|string',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'images.*' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        $data = $request->except('images');
        $data['base_price_cents'] = (int) ($request->base_price * 100);
        $data['amenities'] = $request->amenities ?? [];

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('room_types', 'public');
                $imagePaths[] = Storage::url($path);
            }
            $data['images'] = $imagePaths;
        }

        try {
            RoomType::create($data);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create room type: ' . $e->getMessage()]);
        }

        return redirect()->route('admin.room-types.index')->with('success', 'Room type created successfully.');
    }

    public function show(RoomType $roomType)
    {
        $roomType->load('hotel');
        return view('admin.room_types.show', compact('roomType'));
    }

    public function edit(RoomType $roomType)
    {
        $hotels = Hotel::all();
        return view('admin.room_types.edit', compact('roomType', 'hotels'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:room_types,code,' . $roomType->id,
            'max_occupancy' => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
            'bed_type' => 'nullable|string',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'images.*' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        $data = $request->except('images');
        $data['base_price_cents'] = (int) ($request->base_price * 100);
        $data['amenities'] = $request->amenities ?? [];

        if ($request->hasFile('images')) {
            // Optionally delete old images here
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('room_types', 'public');
                $imagePaths[] = Storage::url($path);
            }
            // Merge with existing or replace? User likely wants to replace if uploading new ones
            $data['images'] = $imagePaths;
        }

        try {
            $roomType->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update room type: ' . $e->getMessage()]);
        }

        return redirect()->route('admin.room-types.index')->with('success', 'Room type updated successfully.');
    }

    public function destroy(RoomType $roomType)

    {
        $roomType->delete();
        return redirect()->route('admin.room-types.index')->with('success', 'Room type deleted successfully.');
    }
}
