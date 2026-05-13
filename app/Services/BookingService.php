<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class BookingService
{
    /**
     * Create a new booking with associated rooms.
     */
    public function createBooking(array $data, array $rooms)
    {
        return DB::transaction(function () use ($data, $rooms) {
            // Generate unique reference
            $data['reference'] = 'BK-' . strtoupper(Str::random(8));
            
            $booking = Booking::create($data);

            foreach ($rooms as $roomData) {
                $booking->bookingRooms()->create($roomData);
            }

            return $booking->load('bookingRooms');
        });
    }

    /**
     * Get booking details.
     */
    public function getBooking(string $id)
    {
        return Booking::with(['guest', 'bookingRooms.room', 'bookingRooms.ratePlan'])->findOrFail($id);
    }

    /**
     * Update booking status.
     */
    public function updateStatus(string $id, string $status)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $status;
        $booking->save();
        return $booking;
    }

    /**
     * Cancel a booking.
     */
    public function cancelBooking(string $id, string $reason, string $cancelledBy)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->cancellation_reason = $reason;
        $booking->cancelled_by = $cancelledBy;
        $booking->cancelled_at = now();
        $booking->save();
        return $booking;
    }
}
