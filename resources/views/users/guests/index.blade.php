@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Guest Records</h1>
            <p class="text-muted small mb-0">Manage guest profiles, history, and loyalty information.</p>
        </div>
        <a href="{{ route('admin.guests.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Register Guest
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <x-card-table 
        title="Guest List" 
        :search="true" 
        :filter="true"
        :pagination="$guests">
        
        <x-slot:headers>
            <th class="ps-4">Guest</th>
            <th>Contact Info</th>
            <th>Nationality</th>
            <th>VIP Tier</th>
            <th>Loyalty</th>
            <th class="text-end pe-4">Actions</th>
        </x-slot:headers>

        @forelse($guests as $guest)
        <tr>
            <td class="ps-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm me-3">
                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            {{ substr($guest->first_name, 0, 1) }}{{ substr($guest->last_name, 0, 1) }}
                        </div>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">{{ $guest->first_name }} {{ $guest->last_name }}</div>
                        <div class="text-muted x-small">ID: {{ $guest->id_document_no ?? 'N/A' }}</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="small text-dark"><i class="fa-solid fa-envelope me-1 text-muted"></i> {{ $guest->email }}</div>
                <div class="small text-muted"><i class="fa-solid fa-phone me-1 text-muted"></i> {{ $guest->phone }}</div>
            </td>
            <td>
                <span class="small fw-medium">{{ $guest->nationality }}</span>
            </td>
            <td>
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
            </td>
            <td>
                <div class="fw-bold text-primary">{{ number_format($guest->loyalty_points) }}</div>
                <div class="text-muted x-small">Points</div>
            </td>
            <td class="text-end pe-4">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.guests.show', $guest->id) }}" class="btn btn-sm btn-light border px-2 shadow-none" title="View Details"><i class="fa-solid fa-circle-info text-primary"></i></a>
                    <a href="{{ route('admin.guests.edit', $guest->id) }}" class="btn btn-sm btn-light border px-2 shadow-none" title="Edit"><i class="fa-solid fa-pen-to-square text-info"></i></a>
                    <form action="{{ route('admin.guests.destroy', $guest->id) }}" method="POST" class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-light border px-2 shadow-none" title="Delete"><i class="fa-solid fa-trash text-danger"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center py-5 text-muted">No guest records found.</td>
        </tr>
        @endforelse
    </x-card-table>
</div>

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if(!confirm('Are you sure you want to delete this guest record?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
