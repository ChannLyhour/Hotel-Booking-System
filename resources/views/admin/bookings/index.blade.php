@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Recent Bookings</h1>
            <p class="text-muted small mb-0">Track and manage guest reservations.</p>
        </div>
        <a href="#" class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="fa-solid fa-calendar-plus me-2"></i> New Booking
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Reference</th>
                        <th>Guest</th>
                        <th>Dates</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Mocking for preview if DB is empty
                        $bookings = \App\Models\Booking::with('guest')->latest()->get();
                    @endphp
                    @forelse($bookings as $booking)
                    <tr>
                        <td class="ps-4 fw-bold text-indigo">#{{ $booking->reference }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/150?u={{ $booking->guest->email }}" alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px;">
                                <div>
                                    <div class="fw-bold text-dark">{{ $booking->guest->full_name }}</div>
                                    <div class="text-muted extra-small">{{ $booking->guest->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small">{{ $booking->check_in_date->format('M d') }} - {{ $booking->check_out_date->format('M d') }}</div>
                            <div class="extra-small text-muted">{{ $booking->check_out_date->diffInDays($booking->check_in_date) }} Nights</div>
                        </td>
                        <td><span class="fw-bold text-dark">${{ number_format($booking->total_amount_cents / 100, 2) }}</span></td>
                        <td>
                            <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : 'warning' }}-soft text-{{ $booking->status == 'confirmed' ? 'success' : 'warning' }} rounded-pill px-3">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-light btn-sm rounded-pill px-3">Details</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">No bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
