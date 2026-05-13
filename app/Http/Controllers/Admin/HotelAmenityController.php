<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelAmenityRequest;
use App\Services\HotelAmenityService;

class HotelAmenityController extends Controller
{
    protected $amenityService;

    public function __construct(HotelAmenityService $amenityService)
    {
        $this->amenityService = $amenityService;
    }

    public function index()
    {
        $amenities = $this->amenityService->getAllAmenities();
        return view('admin.amenities.index', compact('amenities'));
    }

    public function store(HotelAmenityRequest $request)
    {
        $this->amenityService->createAmenity($request->validated());
        return redirect()->back()->with('success', 'Amenity created successfully.');
    }

    public function update(HotelAmenityRequest $request, string $id)
    {
        $this->amenityService->updateAmenity($id, $request->validated());
        return redirect()->back()->with('success', 'Amenity updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->amenityService->deleteAmenity($id);
        return redirect()->back()->with('success', 'Amenity deleted successfully.');
    }
}
