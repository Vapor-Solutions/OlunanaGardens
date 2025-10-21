<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form wire:submit.prevent="checkAvailability">
                    <!-- Header Section -->
                    <div class="card shadow-sm mb-4 border-0">
                        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <h2 class="text-white mb-0 d-flex align-items-center">
                                <i data-feather="calendar" class="me-2" style="width: 28px; height: 28px;"></i>
                                Request a Booking
                            </h2>
                            <p class="text-white-50 mb-0 mt-2">Fill in your details to check availability and request a booking</p>
                        </div>
                    </div>

                    <!-- Availability Alert -->
                    @if ($dateNotAvailable)
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i data-feather="alert-circle" class="me-2" style="width: 20px; height: 20px;"></i>
                                <div>
                                    <strong>Not Available</strong>
                                    <p class="mb-0 mt-1">The event chosen is not available for booking on this date and time. Please try a different date.</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Event Details Card -->
                    <div class="card shadow-sm mb-4 border-0">
                        <div class="card-header bg-light border-bottom">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i data-feather="info" class="me-2" style="width: 18px; height: 18px;"></i>
                                Event Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Date & Time -->
                            <div class="mb-4">
                                <label class="form-label fw-500">
                                    <i data-feather="calendar" class="me-2" style="width: 16px; height: 16px;"></i>
                                    Event Date & Time
                                </label>
                                <input type="datetime-local"
                                    wire:model='bookingRequest.start_time'
                                    class="form-control @error('bookingRequest.start_time') is-invalid @enderror"
                                    placeholder="Select date and time"
                                    required>
                                @error('bookingRequest.start_time')
                                    <div class="invalid-feedback d-block">
                                        <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Event Type -->
                            <div class="mb-4">
                                <label class="form-label fw-500">
                                    <i data-feather="type" class="me-2" style="width: 16px; height: 16px;"></i>
                                    Event Type
                                </label>
                                <select wire:model="bookingRequest.event_type_id"
                                    class="form-select @error('bookingRequest.event_type_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Choose an event type --</option>
                                    @foreach ($eventTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                                    @endforeach
                                </select>
                                @error('bookingRequest.event_type_id')
                                    <div class="invalid-feedback d-block">
                                        <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Menu Package -->
                            <div class="mb-4">
                                <label class="form-label fw-500">
                                    <i data-feather="utensils" class="me-2" style="width: 16px; height: 16px;"></i>
                                    Menu Package
                                </label>
                                <select wire:model="bookingRequest.package_id"
                                    class="form-select @error('bookingRequest.package_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Choose a menu package --</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">
                                            {{ $package->title }} - <x-currency></x-currency>{{ number_format($package->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bookingRequest.package_id')
                                    <div class="invalid-feedback d-block">
                                        <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Guest Details Card -->
                    <div class="card shadow-sm mb-4 border-0">
                        <div class="card-header bg-light border-bottom">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i data-feather="users" class="me-2" style="width: 18px; height: 18px;"></i>
                                Guest Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Adults & Children -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-500">
                                        <i data-feather="user" class="me-2" style="width: 16px; height: 16px;"></i>
                                        Number of Adults
                                    </label>
                                    <input type="number"
                                        min="1"
                                        wire:model='bookingRequest.capacity_adults'
                                        class="form-control @error('bookingRequest.capacity_adults') is-invalid @enderror"
                                        placeholder="1"
                                        required>
                                    @error('bookingRequest.capacity_adults')
                                        <div class="invalid-feedback d-block">
                                            <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-500">
                                        <i data-feather="smile" class="me-2" style="width: 16px; height: 16px;"></i>
                                        Number of Children
                                    </label>
                                    <input type="number"
                                        min="0"
                                        wire:model='bookingRequest.capacity_children'
                                        class="form-control @error('bookingRequest.capacity_children') is-invalid @enderror"
                                        placeholder="0"
                                        required>
                                    @error('bookingRequest.capacity_children')
                                        <div class="invalid-feedback d-block">
                                            <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Card -->
                    <div class="card shadow-sm mb-4 border-0">
                        <div class="card-header bg-light border-bottom">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i data-feather="contact" class="me-2" style="width: 18px; height: 18px;"></i>
                                Contact Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Full Name -->
                            <div class="mb-4">
                                <label class="form-label fw-500">
                                    <i data-feather="user" class="me-2" style="width: 16px; height: 16px;"></i>
                                    Full Name
                                </label>
                                <input type="text"
                                    class="form-control @error('client_name') is-invalid @enderror"
                                    placeholder="Your full name"
                                    wire:model='client_name'
                                    required>
                                @error('client_name')
                                    <div class="invalid-feedback d-block">
                                        <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label class="form-label fw-500">
                                    <i data-feather="mail" class="me-2" style="width: 16px; height: 16px;"></i>
                                    Email Address
                                </label>
                                <input type="email"
                                    class="form-control @error('client_email') is-invalid @enderror"
                                    placeholder="your.email@example.com"
                                    wire:model='client_email'
                                    required>
                                @error('client_email')
                                    <div class="invalid-feedback d-block">
                                        <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-4">
                                <label class="form-label fw-500">
                                    <i data-feather="phone" class="me-2" style="width: 16px; height: 16px;"></i>
                                    Phone Number
                                </label>
                                <input type="tel"
                                    class="form-control @error('client_phone_number') is-invalid @enderror"
                                    placeholder="+1 (555) 000-0000"
                                    wire:model='client_phone_number'
                                    required>
                                @error('client_phone_number')
                                    <div class="invalid-feedback d-block">
                                        <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div class="mb-4">
                                <label class="form-label fw-500">
                                    <i data-feather="map-pin" class="me-2" style="width: 16px; height: 16px;"></i>
                                    Country / Nationality
                                </label>
                                <input type="text"
                                    class="form-control @error('client_country') is-invalid @enderror"
                                    placeholder="Your country"
                                    wire:model='client_country'
                                    required>
                                @error('client_country')
                                    <div class="invalid-feedback d-block">
                                        <i data-feather="x-circle" class="me-1" style="width: 14px; height: 14px;"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
                        <button type="submit"
                            class="btn btn-primary btn-lg d-flex align-items-center justify-content-center"
                            wire:loading.attr="disabled">
                            <i data-feather="search" class="me-2" style="width: 18px; height: 18px;"></i>
                            <span wire:loading.remove>Check Availability</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Checking...
                            </span>
                        </button>
                    </div>

                    <!-- Info Box -->
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-start">
                            <i data-feather="info" class="me-2 mt-1" style="width: 18px; height: 18px;"></i>
                            <div>
                                <strong>Before you proceed:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Ensure all fields are filled correctly</li>
                                    <li>Double-check your email address for confirmation</li>
                                    <li>You'll receive a confirmation email shortly after submission</li>
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .form-label.fw-500 {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.75rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .card {
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        font-weight: 600;
        padding: 0.75rem 2rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(102, 126, 234, 0.4);
    }

    .btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .text-white-50 {
        opacity: 0.75;
    }
</style>
