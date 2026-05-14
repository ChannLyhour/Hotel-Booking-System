@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
     <div class="mb-4 d-flex justify-content-between align-items-start">
          <div>
               <a href="{{ route('admin.guests.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
                    <i class="fa-solid fa-arrow-left me-2"></i> Back to Guests
               </a>
               <h1 class="h3 mb-0 fw-bold text-dark">Guest Profile: {{ $guest->first_name }} {{ $guest->last_name }}</h1>
               <p class="text-muted small mb-0">Detailed history and profile information for this guest.</p>
          </div>
          <div class="d-flex gap-2">
               <a href="{{ route('admin.guests.edit', $guest->id) }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
               </a>
          </div>
     </div>

     <div class="row g-4">
          <!-- Sidebar: Guest Info Summary -->
          <div class="col-lg-4">
               <div class="card border-0 shadow-sm rounded-4 text-center p-4 mb-4">
                    <div class="avatar-xl mx-auto mb-3">
                         <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: 700;">
                              {{ substr($guest->first_name, 0, 1) }}{{ substr($guest->last_name, 0, 1) }}
                         </div>
                    </div>
                    <h4 class="fw-bold mb-1">{{ $guest->first_name }} {{ $guest->last_name }}</h4>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                         @php
                         $tierClass = match($guest->vip_tier) {
                         'Gold' => 'bg-warning text-dark',
                         'Silver' => 'bg-secondary text-white',
                         default => 'bg-light text-muted border'
                         };
                         @endphp
                         <span class="badge {{ $tierClass }} px-3 py-1 rounded-pill">
                              <i class="fa-solid fa-crown me-1 small"></i> {{ $guest->vip_tier ?? 'Basic' }}
                         </span>
                         <span class="badge bg-primary-soft text-primary px-3 py-1 rounded-pill">
                              {{ number_format($guest->loyalty_points) }} Points
                         </span>
                    </div>
                    <div class="text-muted small mb-4">
                         <i class="fa-solid fa-envelope me-1"></i> {{ $guest->email }}<br>
                         <i class="fa-solid fa-phone me-1 mt-2"></i> {{ $guest->phone }}
                    </div>
                    <div class="border-top pt-4 text-start">
                         <h6 class="fw-bold mb-3 small text-muted text-uppercase">Identification</h6>
                         <div class="mb-2">
                              <span class="text-muted small d-block">Document Type</span>
                              <span class="fw-medium text-dark">{{ $guest->id_document_type ?? 'Not Provided' }}</span>
                         </div>
                         <div class="mb-0">
                              <span class="text-muted small d-block">Document Number</span>
                              <span class="fw-medium text-dark">{{ $guest->id_document_no ?? 'Not Provided' }}</span>
                         </div>
                    </div>
               </div>

               <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold mb-3 small text-muted text-uppercase">Preferences & Notes</h6>
                    <div class="bg-light rounded-3 p-3 text-muted small italic">
                         @if($guest->preferences)
                         <ul class="mb-0 ps-3">
                              @foreach($guest->preferences as $pref)
                              <li>{{ $pref }}</li>
                              @endforeach
                         </ul>
                         @else
                         No specific preferences recorded for this guest.
                         @endif
                    </div>
               </div>
          </div>

          <!-- Main Content: History & Documents -->
          <div class="col-lg-8">
               <!-- Tabs Navigation -->
               <ul class="nav nav-pills nav-fill bg-white p-2 rounded-4 shadow-sm mb-4" id="guestTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                         <button class="nav-link active rounded-pill fw-bold py-2" id="bookings-tab" data-bs-toggle="tab" data-bs-target="#bookings" type="button" role="tab">
                              <i class="fa-solid fa-calendar-days me-2"></i> Booking History
                         </button>
                    </li>
                    <li class="nav-item" role="presentation">
                         <button class="nav-link rounded-pill fw-bold py-2" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">
                              <i class="fa-solid fa-file-invoice me-2"></i> Documents
                         </button>
                    </li>
               </ul>

               <div class="tab-content" id="guestTabsContent">
                    <!-- Bookings Tab -->
                    <div class="tab-pane fade show active" id="bookings" role="tabpanel">
                         <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                              <div class="table-responsive">
                                   <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                             <tr>
                                                  <th class="ps-4">Booking Ref</th>
                                                  <th>Period</th>
                                                  <th>Status</th>
                                                  <th class="text-end pe-4">Amount</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             @forelse($guest->bookings as $booking)
                                             <tr>
                                                  <td class="ps-4">
                                                       <a href="{{ route('admin.bookings.show', $booking->id) }}" class="fw-bold text-primary text-decoration-none">
                                                            #{{ substr($booking->id, 0, 8) }}
                                                       </a>
                                                       <div class="text-muted x-small text-uppercase mt-1">Booked on {{ $booking->created_at->format('d M Y') }}</div>
                                                  </td>
                                                  <td>
                                                       <div class="small text-dark fw-medium">{{ $booking->check_in->format('d M') }} - {{ $booking->check_out->format('d M Y') }}</div>
                                                       <div class="text-muted x-small">{{ $booking->check_in->diffInDays($booking->check_out) }} Nights</div>
                                                  </td>
                                                  <td>
                                                       @php
                                                       $statusClass = match($booking->status) {
                                                       'confirmed' => 'bg-success-soft text-success',
                                                       'pending' => 'bg-warning-soft text-warning',
                                                       'cancelled' => 'bg-danger-soft text-danger',
                                                       default => 'bg-light text-muted'
                                                       };
                                                       @endphp
                                                       <span class="badge {{ $statusClass }} rounded-pill px-3 py-1 text-capitalize">
                                                            {{ $booking->status }}
                                                       </span>
                                                  </td>
                                                  <td class="text-end pe-4">
                                                       <div class="fw-bold text-dark">${{ number_format($booking->total_price, 2) }}</div>
                                                  </td>
                                             </tr>
                                             @empty
                                             <tr>
                                                  <td colspan="4" class="text-center py-5 text-muted italic">
                                                       No booking history found for this guest.
                                                  </td>
                                             </tr>
                                             @endforelse
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>

                    <!-- Documents Tab -->
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                         <div class="row g-3">
                              @forelse($guest->documents as $doc)
                              <div class="col-md-6">
                                   <div class="card border shadow-none rounded-4 p-3 d-flex flex-row align-items-center">
                                        <div class="bg-light rounded-3 p-3 me-3 text-primary">
                                             <i class="fa-solid fa-file-pdf fs-3"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                             <h6 class="fw-bold mb-1">{{ $doc->document_type }}</h6>
                                             <p class="text-muted small mb-0">Added on {{ $doc->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-light border rounded-pill px-3">View</a>
                                   </div>
                              </div>
                              @empty
                              <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                                   <i class="fa-solid fa-folder-open text-muted opacity-25 fs-1 mb-3"></i>
                                   <p class="text-muted mb-0">No documents have been uploaded for this guest.</p>
                              </div>
                              @endforelse
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<style>
     .bg-primary-soft {
          background-color: rgba(13, 110, 253, 0.1);
     }

     .bg-success-soft {
          background-color: rgba(25, 135, 84, 0.1);
     }

     .bg-warning-soft {
          background-color: rgba(255, 193, 7, 0.1);
     }

     .bg-danger-soft {
          background-color: rgba(220, 53, 69, 0.1);
     }

     .x-small {
          font-size: 0.75rem;
     }

     .nav-pills .nav-link.active {
          background-color: var(--primary-indigo);
          color: white;
     }

     .nav-pills .nav-link {
          color: var(--text-sidebar);
     }
</style>
@endsection