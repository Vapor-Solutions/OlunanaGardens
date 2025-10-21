<div>
    <x-slot:header>
        <div class="d-flex justify-content-between align-items-center">
            <span>Booking Requests</span>
            <div class="badge bg-secondary">{{ $this->bookingRequests->total() }} Total</div>
        </div>
    </x-slot>

    <div class="container-fluid my-3">
        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-left-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Pending</small>
                                <h3 class="mb-0 text-primary">{{ \App\Models\BookingRequest::where('status', 'pending')->count() }}</h3>
                            </div>
                            <i data-feather="alert-circle" style="width: 40px; height: 40px;" class="text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Accepted</small>
                                <h3 class="mb-0 text-success">{{ \App\Models\BookingRequest::where('status', 'accepted')->count() }}</h3>
                            </div>
                            <i data-feather="check" style="width: 40px; height: 40px;" class="text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Converted</small>
                                <h3 class="mb-0 text-info">{{ \App\Models\BookingRequest::where('status', 'converted')->count() }}</h3>
                            </div>
                            <i data-feather="arrow-right-circle" style="width: 40px; height: 40px;" class="text-info opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Rejected</small>
                                <h3 class="mb-0 text-danger">{{ \App\Models\BookingRequest::where('status', 'rejected')->count() }}</h3>
                            </div>
                            <i data-feather="x-circle" style="width: 40px; height: 40px;" class="text-danger opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Panel -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i data-feather="filter" style="width: 18px; height: 18px; display: inline;"></i> Filters & Search</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Search</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Search by client name, email, or event type..."
                            wire:model.live="search"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" wire:model.live="status">
                            <option value="">-- All Statuses --</option>
                            <option value="pending">Pending Review</option>
                            <option value="accepted">Accepted</option>
                            <option value="converted">Converted to Booking</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                @if($search || $status)
                    <button class="btn btn-sm btn-outline-secondary" wire:click="resetFilters">
                        <i data-feather="x" style="width: 14px; height: 14px; display: inline;"></i> Clear Filters
                    </button>
                @endif
            </div>
        </div>

        <!-- Requests Table -->
        <div class="card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Booking Requests</h6>
                <span class="badge bg-secondary">{{ $this->bookingRequests->count() }} Showing</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="cursor-pointer" wire:click="sort('created_at')">
                                <i data-feather="calendar" style="width: 14px; height: 14px; display: inline;"></i> Date
                                @if($sortBy === 'created_at')
                                    <i data-feather="{{ $sortDirection === 'asc' ? 'arrow-up' : 'arrow-down' }}" style="width: 12px; height: 12px; display: inline;"></i>
                                @endif
                            </th>
                            <th><i data-feather="user" style="width: 14px; height: 14px; display: inline;"></i> Client</th>
                            <th><i data-feather="mail" style="width: 14px; height: 14px; display: inline;"></i> Email</th>
                            <th><i data-feather="phone" style="width: 14px; height: 14px; display: inline;"></i> Phone</th>
                            <th><i data-feather="calendar-check" style="width: 14px; height: 14px; display: inline;"></i> Event Type</th>
                            <th class="text-center"><i data-feather="users" style="width: 14px; height: 14px; display: inline;"></i> Guests</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Cost</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->bookingRequests as $request)
                            <tr>
                                <td class="fw-bold">{{ $request->created_at->format('M d, Y') }}</td>
                                <td>
                                    <strong>{{ $request->client->name }}</strong>
                                </td>
                                <td>
                                    <small>{{ $request->client->email }}</small>
                                </td>
                                <td>
                                    <small>{{ $request->client->phone_number ?? '—' }}</small>
                                </td>
                                <td>{{ $request->eventType->title }}</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ $request->capacity_adults }}A / {{ $request->capacity_children }}C</span>
                                </td>
                                <td class="text-center">
                                    @if($request->isPending())
                                        <span class="badge bg-warning text-dark">
                                            <i data-feather="alert-circle" style="width: 12px; height: 12px; display: inline;"></i> Pending
                                        </span>
                                    @elseif($request->isAccepted())
                                        <span class="badge bg-info text-white">
                                            <i data-feather="check" style="width: 12px; height: 12px; display: inline;"></i> Accepted
                                        </span>
                                    @elseif($request->isConverted())
                                        <span class="badge bg-success text-white">
                                            <i data-feather="arrow-right" style="width: 12px; height: 12px; display: inline;"></i> Converted
                                        </span>
                                    @elseif($request->isRejected())
                                        <span class="badge bg-danger text-white">
                                            <i data-feather="x-circle" style="width: 12px; height: 12px; display: inline;"></i> Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <strong>KES {{ number_format($request->calculateTotalCost(), 0) }}</strong>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        @if($request->isPending())
                                            <button type="button" class="btn btn-sm btn-success" title="Accept" wire:click="acceptRequest({{ $request->id }})">
                                                <i data-feather="check" style="width: 14px; height: 14px;"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-info" title="Convert to Booking" wire:click="showConvertModal({{ $request->id }})">
                                                <i data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" title="Reject" wire:click="showRejectModal({{ $request->id }})">
                                                <i data-feather="x" style="width: 14px; height: 14px;"></i>
                                            </button>
                                        @elseif($request->isAccepted())
                                            <button type="button" class="btn btn-sm btn-info" title="Convert to Booking" wire:click="showConvertModal({{ $request->id }})">
                                                <i data-feather="arrow-right" style="width: 14px; height: 14px;"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" title="Reject" wire:click="showRejectModal({{ $request->id }})">
                                                <i data-feather="x" style="width: 14px; height: 14px;"></i>
                                            </button>
                                        @elseif($request->isConverted())
                                            <a href="{{ route('admin.bookings.edit', $request->convertedBooking->id) }}" class="btn btn-sm btn-primary" title="View Booking">
                                                <i data-feather="eye" style="width: 14px; height: 14px;"></i>
                                            </a>
                                        @elseif($request->isRejected())
                                            <span class="badge bg-secondary">No Actions Available</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <p class="text-muted mb-0">No booking requests found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($this->bookingRequests->hasPages())
                <div class="card-footer bg-light">
                    {{ $this->bookingRequests->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Convert to Booking Modal -->
    @if($showConvertModal && $requestToConvert)
        @php
            $request = \App\Models\BookingRequest::find($requestToConvert);
        @endphp
        <div class="modal show d-block" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Convert Request to Booking</h5>
                        <button type="button" class="btn-close" wire:click="$set('showConvertModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        @if($request)
                            <div class="mb-4">
                                <h6 class="mb-3">Request Details</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">Client</small>
                                        <p class="fw-bold">{{ $request->client->name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Event Type</small>
                                        <p class="fw-bold">{{ $request->eventType->title }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Start Date/Time</small>
                                        <p class="fw-bold">{{ $request->start_time->format('M d, Y H:i') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">End Date/Time</small>
                                        <p class="fw-bold">{{ $request->end_time->format('M d, Y H:i') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Guests</small>
                                        <p class="fw-bold">{{ $request->capacity_adults }} Adults, {{ $request->capacity_children }} Children</p>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Estimated Cost</small>
                                        <p class="fw-bold text-primary">KES {{ number_format($request->calculateTotalCost(), 0) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Assign Sections <span class="text-danger">*</span></label>
                                <div class="row">
                                    @forelse($availableSections as $section)
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="section_{{ $section->id }}"
                                                    wire:model="selected_sections"
                                                    value="{{ $section->id }}"
                                                />
                                                <label class="form-check-label" for="section_{{ $section->id }}">
                                                    <strong>{{ $section->name }}</strong>
                                                    @if($section->location)
                                                        <br><small class="text-muted">{{ $section->location }}</small>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-warning mb-0">
                                                <small>No sections available for the selected dates</small>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                @error('selected_sections')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Admin Notes <span class="text-muted">(Optional)</span></label>
                                <textarea
                                    class="form-control"
                                    rows="3"
                                    placeholder="Add any notes about this conversion..."
                                    wire:model="adminNotes"
                                ></textarea>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showConvertModal', false)">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="convertToBooking">Create Booking</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Reject Modal -->
    @if($showRejectModal && $requestToReject)
        @php
            $rejectRequest = \App\Models\BookingRequest::find($requestToReject);
        @endphp
        <div class="modal show d-block" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Booking Request</h5>
                        <button type="button" class="btn-close" wire:click="$set('showRejectModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        @if($rejectRequest)
                            <div class="mb-3">
                                <small class="text-muted">Request from</small>
                                <p class="fw-bold">{{ $rejectRequest->client->name }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                                <textarea
                                    class="form-control @error('rejectionReason') is-invalid @enderror"
                                    rows="4"
                                    placeholder="Please provide a reason for rejecting this request..."
                                    wire:model="rejectionReason"
                                ></textarea>
                                @error('rejectionReason')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Internal Notes <span class="text-muted">(Optional)</span></label>
                                <textarea
                                    class="form-control"
                                    rows="3"
                                    placeholder="Add internal notes..."
                                    wire:model="adminNotes"
                                ></textarea>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showRejectModal', false)">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="rejectRequest">Reject Request</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
