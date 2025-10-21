<div>
    <x-slot:header>
        Create New Booking
    </x-slot:header>

    <div class="container-fluid my-3">
        <div class="row">
            <!-- Main Form -->
            <div class="col-lg-8">
                <form wire:submit="saveBooking" class="needs-validation" novalidate>
                    <!-- Client Section -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i data-feather="user" style="width: 18px; height: 18px; display: inline;"></i> Client Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="client_id" class="form-label">Select Client <span class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('booking.client_id') is-invalid @enderror"
                                    id="client_id"
                                    wire:model.live="booking.client_id">
                                    <option value="">-- Choose a client --</option>
                                    @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                                    @endforeach
                                </select>
                                @error('booking.client_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                <small class="text-muted">Select the client for this booking</small>
                            </div>
                        </div>
                    </div>

                    <!-- Event Type & Package -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i data-feather="calendar" style="width: 18px; height: 18px; display: inline;"></i> Event Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="event_type_id" class="form-label">Event Type <span class="text-danger">*</span></label>
                                    <select
                                        class="form-control @error('booking.event_type_id') is-invalid @enderror"
                                        id="event_type_id"
                                        wire:model.live="booking.event_type_id">
                                        <option value="">-- Select event type --</option>
                                        @foreach($eventTypes as $eventType)
                                        <option value="{{ $eventType->id }}">{{ $eventType->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('booking.event_type_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="package_id" class="form-label">Package <span class="text-muted">(Optional)</span></label>
                                    <select
                                        class="form-control @error('booking.package_id') is-invalid @enderror"
                                        id="package_id"
                                        wire:model.live="booking.package_id">
                                        <option value="">-- Select package --</option>
                                        @foreach($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->title }} (KES {{ number_format($package->price, 0) }})</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Package price will auto-fill the booking price</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i data-feather="clock" style="width: 18px; height: 18px; display: inline;"></i> Date & Time</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_time" class="form-label">Start Date & Time <span class="text-danger">*</span></label>
                                    <input
                                        type="datetime-local"
                                        class="form-control @error('booking.start_time') is-invalid @enderror"
                                        id="start_time"
                                        wire:model.live="booking.start_time" />
                                    @error('booking.start_time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="end_time" class="form-label">End Date & Time <span class="text-danger">*</span></label>
                                    <input
                                        type="datetime-local"
                                        class="form-control @error('booking.end_time') is-invalid @enderror"
                                        id="end_time"
                                        wire:model.live="booking.end_time" />
                                    @error('booking.end_time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            @if($booking->start_time && $booking->end_time)
                            <div class="alert alert-info mb-0">
                                <small>
                                    <strong>Duration:</strong>
                                    {{ \Carbon\Carbon::parse($booking->start_time)->diffInHours(\Carbon\Carbon::parse($booking->end_time)) }} hours
                                </small>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Capacity -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i data-feather="users" style="width: 18px; height: 18px; display: inline;"></i> Guest Capacity</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="capacity_adults" class="form-label">Number of Adults <span class="text-danger">*</span></label>
                                    <input
                                        type="number"
                                        class="form-control @error('booking.capacity_adults') is-invalid @enderror"
                                        id="capacity_adults"
                                        wire:model.live="booking.capacity_adults"
                                        min="0" />
                                    @error('booking.capacity_adults') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="capacity_children" class="form-label">Number of Children <span class="text-danger">*</span></label>
                                    <input
                                        type="number"
                                        class="form-control @error('booking.capacity_children') is-invalid @enderror"
                                        id="capacity_children"
                                        wire:model.live="booking.capacity_children"
                                        min="0" />
                                    @error('booking.capacity_children') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i data-feather="dollar-sign" style="width: 18px; height: 18px; display: inline;"></i> Pricing</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price Per Unit (KES) <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    class="form-control @error('booking.price') is-invalid @enderror"
                                    id="price"
                                    wire:model.live="booking.price"
                                    step="0.01"
                                    min="0" />
                                @error('booking.price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                <small class="text-muted">Price will be auto-filled based on selected package or event type</small>
                            </div>
                        </div>
                    </div>

                    <!-- Sections -->
                    <div class="card mb-3">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i data-feather="grid" style="width: 18px; height: 18px; display: inline;"></i> Assign Sections</h6>
                            @if($availabilityMessage)
                            <span class="badge bg-{{ $availabilityOk ? 'success' : 'warning' }}">{{ $availabilityMessage }}</span>
                            @endif
                        </div>
                        <div class="card-body">
                            @if(!$booking->start_time || !$booking->end_time)
                            <div class="alert alert-warning mb-3">
                                <small>Please select booking dates to see available sections</small>
                            </div>
                            @elseif(!$availabilityOk)
                            <div class="alert alert-danger mb-3">
                                <small>No sections available for the selected dates. Please try different dates.</small>
                            </div>
                            @endif

                            <div class="row">
                                @forelse($availableSections as $section)
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="section_{{ $section->id }}"
                                            wire:model.live="selected_sections"
                                            value="{{ $section->id }}" />
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
                                    <p class="text-muted text-center py-3">No sections available for the selected dates</p>
                                </div>
                                @endforelse
                            </div>

                            @error('selected_sections')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i data-feather="file-text" style="width: 18px; height: 18px; display: inline;"></i> Additional Notes</h6>
                        </div>
                        <div class="card-body">
                            <textarea
                                class="form-control"
                                id="notes"
                                rows="4"
                                placeholder="Any special requirements or notes for this booking..."
                                wire:model="booking.notes"></textarea>
                            <small class="text-muted">Additional notes and special requirements</small>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="card">
                        <div class="card-body d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="save"></i> Create Booking
                            </button>
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                                <i data-feather="x"></i> Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Summary Sidebar -->
            <div class="col-lg-4">
                <!-- Cost Summary -->
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Cost Breakdown</h6>
                    </div>
                    <div class="card-body">
                        @if($booking->price)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Adults ({{ $booking->capacity_adults }})</span>
                                <strong>KES {{ number_format($costBreakdown['adults_cost'], 0) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Children ({{ $booking->capacity_children }}) @ 50%</span>
                                <strong>KES {{ number_format($costBreakdown['children_cost'], 0) }}</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total Cost:</strong>
                                <strong class="text-primary" style="font-size: 1.3em;">KES {{ number_format($totalCost, 0) }}</strong>
                            </div>
                        </div>

                        @if($totalCost > 0)
                        <div class="alert alert-light">
                            <small class="text-muted">
                                Price per unit: <strong>KES {{ number_format($booking->price, 0) }}</strong>
                            </small>
                        </div>
                        @endif
                        @else
                        <div class="alert alert-info">
                            <small>Select a package or event type to calculate cost</small>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Booking Summary -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Booking Summary</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <small class="text-muted">Client:</small>
                            <div class="fw-bold">
                                @if($booking->client_id)
                                {{ $clients->find($booking->client_id)?->name ?? 'Not selected' }}
                                @else
                                <span class="text-muted">Not selected</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-2">
                            <small class="text-muted">Event Type:</small>
                            <div class="fw-bold">
                                @if($booking->event_type_id)
                                {{ $eventTypes->find($booking->event_type_id)?->title ?? 'Not selected' }}
                                @else
                                <span class="text-muted">Not selected</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-2">
                            <small class="text-muted">Guests:</small>
                            <div class="fw-bold">
                                @if($booking->capacity_adults + $booking->capacity_children > 0)
                                {{ $booking->capacity_adults }} adults, {{ $booking->capacity_children }} children
                                @else
                                <span class="text-muted">Not specified</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-2">
                            <small class="text-muted">Sections:</small>
                            <div class="fw-bold">
                                @if(count($selected_sections) > 0)
                                {{ count($selected_sections) }} section(s) selected
                                @else
                                <span class="text-muted">None selected</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>