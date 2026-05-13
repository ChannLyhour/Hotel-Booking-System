@props([
    'title' => null,
    'headers' => null,
    'empty' => 'No data found.',
    'footer' => null,
    'search' => false,
    'filter' => false,
    'pagination' => null,
])

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    @if($title || $search || $filter || isset($headerActions))
    <div class="card-header bg-white border-0 py-3">
        <div class="row align-items-center g-3">
            <div class="col-md-4">
                @if($title)
                    <h5 class="mb-0 fw-bold text-dark">{{ $title }}</h5>
                @endif
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-md-end align-items-center gap-2">
                    @if($search)
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control bg-light border-start-0 ps-0 shadow-none" placeholder="Search..." value="{{ request('search') }}">
                    </div>
                    @endif
                    
                    @if($filter)
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light border px-3 dropdown-toggle shadow-none" type="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-filter me-1 text-muted"></i> Filter
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg border-0 rounded-3" style="min-width: 250px;">
                            @isset($filters)
                                {{ $filters }}
                            @else
                                <p class="small text-muted mb-0">No filters available</p>
                            @endisset
                        </div>
                    </div>
                    @endif

                    @isset($headerActions)
                        <div class="d-flex gap-2">
                            {{ $headerActions }}
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            @if($headers)
            <thead class="bg-light">
                <tr>
                    {{ $headers }}
                </tr>
            </thead>
            @endif
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if($pagination || $footer)
    <div class="card-footer bg-white border-top py-3">
        @if($pagination)
            {{ $pagination->links('pagination::bootstrap-5') }}
        @else
            {{ $footer }}
        @endif
    </div>
    @endif
</div>

