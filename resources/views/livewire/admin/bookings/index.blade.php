<div>
    <x-slot:header>
        <div class="d-flex justify-content-between align-items-center">
            <span>Bookings Management</span>
            <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary btn-sm">
                <i data-feather="plus"></i> New Booking
            </a>
        </div>
    </x-slot>

    <div class="container-fluid my-3">
        <!-- Status Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-left-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-primary font-weight-bold text-lg">{{ $this->statusSummary['pending'] }}</div>
                                <div class="text-muted small">Pending Bookings</div>
                            </div>
                            <i data-feather="clock" class="text-primary" style="width: 40px; height: 40px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-success font-weight-bold text-lg">{{ $this->statusSummary['confirmed'] }}</div>
                                <div class="text-muted small">Confirmed Bookings</div>
                            </div>
                            <i data-feather="check-circle" class="text-success" style="width: 40px; height: 40px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-danger font-weight-bold text-lg">{{ $this->statusSummary['cancelled'] }}</div>
                                <div class="text-muted small">Cancelled Bookings</div>
                            </div>
                            <i data-feather="x-circle" class="text-danger" style="width: 40px; height: 40px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-secondary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="text-secondary font-weight-bold text-lg">{{ $this->statusSummary['completed'] }}</div>
                                <div class="text-muted small">Completed Bookings</div>
                            </div>
                            <i data-feather="check-square" class="text-secondary" style="width: 40px; height: 40px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">Filter & Search</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Search -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="search" class="form-label">Search</label>
                            <input
                                type="text"
                                class="form-control"
                                id="search"
                                placeholder="Reference, client name, event type..."
                                wire:model.live="search"
                            />
                            <small class="text-muted">Search by reference code, client name, or event type</small>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" wire:model.live="status">
                                <option value="">All Statuses</option>
                                @foreach(\App\Models\Booking::getAvailableStatuses() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Date From -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dateFrom" class="form-label">From Date</label>
                            <input
                                type="date"
                                class="form-control"
                                id="dateFrom"
                                wire:model.live="dateFrom"
                            />
                        </div>
                    </div>

                    <!-- Date To -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dateTo" class="form-label">To Date</label>
                            <input
                                type="date"
                                class="form-control"
                                id="dateTo"
                                wire:model.live="dateTo"
                            />
                        </div>
                    </div>

                    <!-- Reset Button -->
                    <div class="col-md-12 mt-2">
                        <button class="btn btn-outline-secondary btn-sm" wire:click="resetFilters">
                            <i data-feather="refresh-cw" style="width: 16px; height: 16px;"></i>
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Bookings List</h6>
                <small class="text-muted">{{ $this->bookings->total() }} bookings found</small>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="cursor: pointer;" wire:click="sort('id')">
                                ID
                                @if($sortBy === 'id')
                                    <i data-feather="{{ $sortDirection === 'asc' ? 'arrow-up' : 'arrow-down' }}" style="width: 14px; height: 14px; display: inline;"></i>
                                @endif
                            </th>
                            <th>Reference</th>
                            <th>Client</th>
                            <th>Event Type</th>
                            <th style="cursor: pointer;" wire:click="sort('start_time')">
                                Start Date
                                @if($sortBy === 'start_time')
                                    <i data-feather="{{ $sortDirection === 'asc' ? 'arrow-up' : 'arrow-down' }}" style="width: 14px; height: 14px; display: inline;"></i>
                                @endif
                            </th>
                            <th>Capacity</th>
                            <th style="cursor: pointer;" wire:click="sort('status')">
                                Status
                                @if($sortBy === 'status')
                                    <i data-feather="{{ $sortDirection === 'asc' ? 'arrow-up' : 'arrow-down' }}" style="width: 14px; height: 14px; display: inline;"></i>
                                @endif
                            </th>
                            <th style="cursor: pointer;" wire:click="sort('price')">
                                Total Cost
                                @if($sortBy === 'price')
                                    <i data-feather="{{ $sortDirection === 'asc' ? 'arrow-up' : 'arrow-down' }}" style="width: 14px; height: 14px; display: inline;"></i>
                                @endif
                            </th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->bookings as $booking)
                            <tr>
                                <td>
                                    <small class="text-muted">#{{ $booking->id }}</small>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1">{{ $booking->booking_ref }}</code>
                                </td>
                                <td>
                                    <strong>{{ $booking->client->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $booking->client->email }}</small>
                                </td>
                                <td>{{ $booking->eventType->title }}</td>
                                <td>
                                    <small>
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, H:i') }}
                                        <br>
                                        to
                                        <br>
                                        {{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y, H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        👨 {{ $booking->capacity_adults }}
                                        <br>
                                        👧 {{ $booking->capacity_children }}
                                    </small>
                                </td>
                                <td>
                                    <x-back.status-badge :status="$booking->status" size="sm" />
                                </td>
                                <td>
                                    <strong class="text-primary">KES {{ number_format($booking->total_cost, 0) }}</strong>
                                    <br>
                                    <small class="text-{{ $booking->isFullyPaid() ? 'success' : 'warning' }}">
                                        {{ $booking->isFullyPaid() ? 'Paid' : 'Outstanding: ' . number_format($booking->remaining_balance, 0) }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-outline-secondary" title="Edit booking">
                                            <i data-feather="edit-2" style="width: 16px; height: 16px;"></i>
                                        </a>

                                        <!-- Confirm Button (if pending) -->
                                        @if($booking->isPending())
                                            <button
                                                type="button"
                                                class="btn btn-outline-success"
                                                wire:click="confirmBooking({{ $booking->id }})"
                                                title="Confirm booking"
                                            >
                                                <i data-feather="check" style="width: 16px; height: 16px;"></i>
                                            </button>
                                        @endif

                                        <!-- Cancel Button (if not cancelled/completed) -->
                                        @if(!$booking->isCancelled() && !$booking->isCompleted())
                                            <button
                                                type="button"
                                                class="btn btn-outline-danger"
                                                wire:click="showCancelConfirm({{ $booking->id }})"
                                                title="Cancel booking"
                                            >
                                                <i data-feather="x" style="width: 16px; height: 16px;"></i>
                                            </button>
                                        @endif

                                        <!-- Delete Button (if pending only) -->
                                        @if($booking->isPending())
                                            <button
                                                type="button"
                                                class="btn btn-outline-dark"
                                                wire:click="showDeleteConfirm({{ $booking->id }})"
                                                title="Delete booking"
                                            >
                                                <i data-feather="trash-2" style="width: 16px; height: 16px;"></i>
                                            </button>
                                        @endif

                                        <!-- View Details Button -->
                                        <button
                                            type="button"
                                            class="btn btn-outline-info"
                                            data-bs-toggle="modal"
                                            data-bs-target="#bookingDetailModal{{ $booking->id }}"
                                            title="View details"
                                        >
                                            <i data-feather="eye" style="width: 16px; height: 16px;"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Detail Modal -->
                            <div class="modal fade" id="bookingDetailModal{{ $booking->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Booking Details - {{ $booking->booking_ref }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <p><strong>Reference:</strong> <code>{{ $booking->booking_ref }}</code></p>
                                                    <p><strong>Status:</strong> <x-back.status-badge :status="$booking->status" /></p>
                                                    <p><strong>Client:</strong> {{ $booking->client->name }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Event Type:</strong> {{ $booking->eventType->title }}</p>
                                                    <p><strong>Created:</strong> {{ $booking->created_at->format('d M Y, H:i') }}</p>
                                                    <p><strong>Updated:</strong> {{ $booking->updated_at->format('d M Y, H:i') }}</p>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, H:i') }}</p>
                                                    <p><strong>End:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y, H:i') }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Adults:</strong> {{ $booking->capacity_adults }}</p>
                                                    <p><strong>Children:</strong> {{ $booking->capacity_children }}</p>
                                                </div>
                                            </div>

                                            <hr>

                                            @if($booking->sections->count() > 0)
                                                <div class="mb-3">
                                                    <strong>Sections:</strong>
                                                    <div class="list-group list-group-sm mt-2">
                                                        @foreach($booking->sections as $section)
                                                            <div class="list-group-item">
                                                                <strong>{{ $section->name }}</strong>
                                                                <br>
                                                                <small class="text-muted">{{ $section->location ?? 'No location info' }}</small>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Total Cost:</strong> <span class="text-primary">KES {{ number_format($booking->total_cost, 0) }}</span></p>
                                                    <p><strong>Total Paid:</strong> <span class="text-success">KES {{ number_format($booking->total_paid, 0) }}</span></p>
                                                    <p><strong>Outstanding:</strong> <span class="text-warning">KES {{ number_format($booking->remaining_balance, 0) }}</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Payment Status:</strong>
                                                        @if($booking->isFullyPaid())
                                                            <span class="badge bg-success">Fully Paid</span>
                                                        @else
                                                            <span class="badge bg-warning">Pending Payment</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                            @if($booking->notes)
                                                <hr>
                                                <div>
                                                    <strong>Notes:</strong>
                                                    <p class="text-muted">{{ $booking->notes }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i data-feather="inbox" style="width: 48px; height: 48px;" class="text-muted mb-2"></i>
                                    <p class="text-muted">No bookings found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="card-footer">
                {{ $this->bookings->links(data: ['wire:key' => 'page-{page}']) }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteConfirm)
        <div class="modal show d-block" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" wire:click="$set('showDeleteConfirm', false)"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this booking?</p>
                        <p class="text-muted"><small>This action cannot be undone. Only pending bookings can be deleted.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showDeleteConfirm', false)">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteBooking">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            // Listen for cancel modal event
            Livewire.on('showCancelModal', (data) => {
                const bookingId = data.bookingId;
                const reason = prompt('Enter cancellation reason:');
                if (reason !== null) {
                    Livewire.dispatch('cancelBooking', { bookingId: bookingId, reason: reason });
                }
            });
        </script>
    @endpush
</div>
