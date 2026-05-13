<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Services\HotelService;

class HotelController extends Controller
{
    protected $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index()
    {
        $hotels = $this->hotelService->getAllHotels();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function store(HotelRequest $request)
    {
        $this->hotelService->createHotel($request->validated());
        return redirect()->back()->with('success', 'Hotel created successfully.');
    }

    public function update(HotelRequest $request, string $id)
    {
        $this->hotelService->updateHotel($id, $request->validated());
        return redirect()->back()->with('success', 'Hotel updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->hotelService->deleteHotel($id);
        return redirect()->back()->with('success', 'Hotel deleted successfully.');
    }
}
