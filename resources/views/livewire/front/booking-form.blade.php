<div>
    <style>
        /* Gradient Background */
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Card Styling */
        .card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        .card:hover {
            box-shadow: 0 0.75rem 2rem rgba(0, 0, 0, 0.12) !important;
        }

        .card-header {
            border-bottom: none !important;
        }

        .card-footer {
            border-top: 1px solid #e9ecef;
        }

        /* Form Controls */
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .form-label.small {
            font-size: 0.875rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control-sm,
        .form-select-sm {
            font-size: 0.875rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.5rem 1.5rem rgba(102, 126, 234, 0.35);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Feedback Text */
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        /* Spacing Utilities */
        .text-white-50 {
            opacity: 0.8;
        }

        /* Section Dividers */
        .border-bottom {
            border-color: #e9ecef !important;
        }

        /* Alert Styling */
        .alert {
            border-radius: 0.375rem;
            border: none;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .card-body {
                padding: 1rem !important;
            }

            .form-control,
            .form-select {
                font-size: 1rem;
            }

            .btn {
                font-size: 0.9rem;
            }
        }
    </style>
    <form wire:submit.prevent="checkAvailability">
        <!-- Main Card Container -->
        <div class="card shadow-lg border-0 h-100">
            <!-- Header Section -->
            <!-- Availability Alert -->
            @if ($dateNotAvailable)
            <div class="alert alert-danger alert-dismissible fade show mb-0 mt-3 mx-4" role="alert" style="border-radius: 0.375rem;">
                <div class="d-flex align-items-start">
                    <i data-feather="alert-circle" class="me-2 mt-1" style="width: 18px; height: 18px; flex-shrink: 0;"></i>
                    <div style="flex-grow: 1;">
                        <strong class="d-block">Not Available</strong>
                        <small class="text-muted">Selected date/time unavailable. Try different dates.</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Form Content -->
            <div class="card-body p-4">
                <!-- Section 1: Event Details -->
                <div class="mb-4 pb-3 border-bottom">
                    <h6 class="text-muted text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <i data-feather="calendar" class="me-1" style="width: 14px; height: 14px;"></i>
                        Event Details
                    </h6>

                    <!-- Date & Time -->
                    <div class="mb-3">
                        <label class="form-label small fw-600">Event Date & Time</label>
                        <input type="datetime-local"
                            wire:model='bookingRequest.start_time'
                            class="form-control form-control-sm @error('bookingRequest.start_time') is-invalid @enderror"
                            required>
                        @error('bookingRequest.start_time')
                        <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Event Type -->
                    <div class="mb-3">
                        <label class="form-label small fw-600">Event Type</label>
                        <select wire:model="bookingRequest.event_type_id"
                            class="form-select form-select-sm @error('bookingRequest.event_type_id') is-invalid @enderror"
                            required>
                            <option value="">Choose event type...</option>
                            @foreach ($eventTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                        @error('bookingRequest.event_type_id')
                        <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Menu Package -->
                    <div class="mb-0">
                        <label class="form-label small fw-600">Menu Package</label>
                        <select wire:model="bookingRequest.package_id"
                            class="form-select form-select-sm @error('bookingRequest.package_id') is-invalid @enderror"
                            required>
                            <option value="">Choose package...</option>
                            @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->title }} - <x-currency></x-currency>{{ number_format($package->price, 2) }}</option>
                            @endforeach
                        </select>
                        @error('bookingRequest.package_id')
                        <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Section 2: Guest & Contact Details -->
                <div class="mb-4 pb-3 border-bottom">
                    <h6 class="text-muted text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <i data-feather="users" class="me-1" style="width: 14px; height: 14px;"></i>
                        Guest Information
                    </h6>

                    <!-- Adults & Children (Side by side) -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-600">Adults</label>
                            <input type="number"
                                min="1"
                                wire:model='bookingRequest.capacity_adults'
                                class="form-control form-control-sm @error('bookingRequest.capacity_adults') is-invalid @enderror"
                                required>
                            @error('bookingRequest.capacity_adults')
                            <div class="invalid-feedback d-block small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-600">Children</label>
                            <input type="number"
                                min="0"
                                wire:model='bookingRequest.capacity_children'
                                class="form-control form-control-sm @error('bookingRequest.capacity_children') is-invalid @enderror"
                                required>
                            @error('bookingRequest.capacity_children')
                            <div class="invalid-feedback d-block small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 3: Contact Information -->
                <div class="mb-0">
                    <h6 class="text-muted text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <i data-feather="contact" class="me-1" style="width: 14px; height: 14px;"></i>
                        Your Information
                    </h6>

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label class="form-label small fw-600">Full Name</label>
                        <input type="text"
                            class="form-control form-control-sm @error('client_name') is-invalid @enderror"
                            wire:model='client_name'
                            required>
                        @error('client_name')
                        <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label small fw-600">Email Address</label>
                        <input type="email"
                            class="form-control form-control-sm @error('client_email') is-invalid @enderror"
                            wire:model='client_email'
                            required>
                        @error('client_email')
                        <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label class="form-label small fw-600">Phone Number</label>
                        <input type="tel"
                            class="form-control form-control-sm @error('client_phone_number') is-invalid @enderror"
                            wire:model='client_phone_number'
                            required>
                        @error('client_phone_number')
                        <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="mb-0">
                        <label class="form-label small fw-600">Country / Nationality</label>
                        <input type="text"
                            class="form-control form-control-sm @error('client_country') is-invalid @enderror"
                            wire:model='client_country'
                            required>
                        @error('client_country')
                        <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-grid gap-2 pt-3 mt-3 border-top">
                <button type="submit"
                    class="btn btn-primary d-flex align-items-center justify-content-center py-2"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        <i data-feather="search" class="me-2" style="width: 16px; height: 16px;"></i>
                        Check Availability
                    </span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Checking...
                    </span>
                </button>
            </div>
        </div>

        <!-- Info Box (Inside Card Footer) -->
        <div class="card-footer border-top p-3">
            <small class="text-muted d-flex align-items-start">
                <i data-feather="alert-circle" class="me-2 mt-0" style="width: 14px; height: 14px; flex-shrink: 0; margin-top: 2px;"></i>
                <span>Check all fields carefully. You'll receive a confirmation email after submission.</span>
            </small>
        </div>
        <!-- End Main Card Container -->
    </form>
</div>