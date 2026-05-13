<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        // For demonstration, just returning a view
        return view('admin.bookings.index');
    }

    public function store(BookingRequest $request)
    {
        try {
            $bookingData = $request->safe()->except('rooms');
            $roomsData = $request->input('rooms');
            
            $booking = $this->bookingService->createBooking($bookingData, $roomsData);
            
            return redirect()->route('admin.bookings.show', $booking->id)
                             ->with('success', 'Booking created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating booking: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $booking = $this->bookingService->getBooking($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function cancel(Request $request, string $id)
    {
        $request->validate(['reason' => 'required|string']);
        
        try {
            $this->bookingService->cancelBooking($id, $request->reason, Auth::id());
            return redirect()->back()->with('success', 'Booking cancelled successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error cancelling booking: ' . $e->getMessage());
        }
    }
}
