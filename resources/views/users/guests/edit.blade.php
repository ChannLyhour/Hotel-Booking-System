@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
     <div class="mb-4">
          <a href="{{ route('admin.guests.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
               <i class="fa-solid fa-arrow-left me-2"></i> Back to Guests
          </a>
          <h1 class="h3 mb-0 fw-bold text-dark">Edit Guest: {{ $guest->first_name }} {{ $guest->last_name }}</h1>
          <p class="text-muted small mb-0">Update profile details and loyalty information.</p>
     </div>

     <div class="row justify-content-center">
          <div class="col-lg-10">
               <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form action="{{ route('admin.guests.update', $guest->id) }}" method="POST">
                         @csrf
                         @method('PUT')
                         <div class="row g-4">
                              <!-- Primary Information -->
                              <div class="col-12">
                                   <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Primary Information</h6>
                              </div>
                              <div class="col-md-6">
                                   <label class="form-label small fw-bold text-muted">First Name</label>
                                   <input type="text" name="first_name" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('first_name', $guest->first_name) }}" required>
                                   @error('first_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                              </div>
                              <div class="col-md-6">
                                   <label class="form-label small fw-bold text-muted">Last Name</label>
                                   <input type="text" name="last_name" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('last_name', $guest->last_name) }}" required>
                                   @error('last_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                              </div>
                              <div class="col-md-6">
                                   <label class="form-label small fw-bold text-muted">Email Address</label>
                                   <input type="email" name="email" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('email', $guest->email) }}" required>
                                   @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                              </div>
                              <div class="col-md-6">
                                   <label class="form-label small fw-bold text-muted">Phone Number</label>
                                   <input type="text" name="phone" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('phone', $guest->phone) }}" required>
                                   @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                              </div>

                              <!-- Identification & Loyalty -->
                              <div class="col-12 mt-5">
                                   <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Identification & Loyalty</h6>
                              </div>
                              <div class="col-md-4">
                                   <label class="form-label small fw-bold text-muted">Document Type</label>
                                   <select name="id_document_type" class="form-select bg-light border-0 py-2 px-3 shadow-none">
                                        <option value="Passport" {{ old('id_document_type', $guest->id_document_type) == 'Passport' ? 'selected' : '' }}>Passport</option>
                                        <option value="National ID" {{ old('id_document_type', $guest->id_document_type) == 'National ID' ? 'selected' : '' }}>National ID</option>
                                        <option value="Driver License" {{ old('id_document_type', $guest->id_document_type) == 'Driver License' ? 'selected' : '' }}>Driver License</option>
                                   </select>
                              </div>
                              <div class="col-md-4">
                                   <label class="form-label small fw-bold text-muted">Document Number</label>
                                   <input type="text" name="id_document_no" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('id_document_no', $guest->id_document_no) }}">
                              </div>
                              <div class="col-md-4">
                                   <label class="form-label small fw-bold text-muted">Nationality</label>
                                   <input type="text" name="nationality" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('nationality', $guest->nationality) }}">
                              </div>
                              <div class="col-md-6">
                                   <label class="form-label small fw-bold text-muted">VIP Tier</label>
                                   <select name="vip_tier" class="form-select bg-light border-0 py-2 px-3 shadow-none">
                                        <option value="Basic" {{ old('vip_tier', $guest->vip_tier) == 'Basic' ? 'selected' : '' }}>Basic</option>
                                        <option value="Silver" {{ old('vip_tier', $guest->vip_tier) == 'Silver' ? 'selected' : '' }}>Silver</option>
                                        <option value="Gold" {{ old('vip_tier', $guest->vip_tier) == 'Gold' ? 'selected' : '' }}>Gold</option>
                                   </select>
                              </div>
                              <div class="col-md-6">
                                   <label class="form-label small fw-bold text-muted">Loyalty Points</label>
                                   <input type="number" name="loyalty_points" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('loyalty_points', $guest->loyalty_points) }}">
                              </div>
                         </div>

                         <div class="mt-5 d-flex gap-2">
                              <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">
                                   Update Guest Profile
                              </button>
                              <a href="{{ route('admin.guests.index') }}" class="btn btn-light px-4 rounded-pill">Cancel</a>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>
@endsection