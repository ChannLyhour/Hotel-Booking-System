@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Guest Directory</h1>
            <p class="text-muted small mb-0">Browse and manage your customer database.</p>
        </div>
        <button class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="fa-solid fa-user-plus me-2"></i> Add Guest
        </button>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Guest Name</th>
                        <th>Contact</th>
                        <th>Nationality</th>
                        <th>Loyalty</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $guests = \App\Models\Guest::all(); @endphp
                    @forelse($guests as $guest)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-soft p-2 rounded-circle me-3 text-primary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    {{ substr($guest->first_name, 0, 1) }}{{ substr($guest->last_name, 0, 1) }}
                                </div>
                                <div class="fw-bold text-dark">{{ $guest->full_name }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="small">{{ $guest->email }}</div>
                            <div class="extra-small text-muted">{{ $guest->phone }}</div>
                        </td>
                        <td><span class="small text-muted"><i class="fa-solid fa-flag me-1"></i> {{ $guest->nationality }}</span></td>
                        <td>
                            <span class="badge bg-indigo-soft text-indigo rounded-pill px-3">{{ ucfirst($guest->vip_tier) }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <button class="btn btn-light btn-sm rounded-circle"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No guests in directory.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
